<?php
class GebruikerController extends My_Controller_Action
{
    /**
    * Login
    */
    public function loginAction()
    {
	$this->_helper->layout->disableLayout();   
        $form = new Application_Form_Signup();
        if (!$this->getRequest()->isPost()) {
        	$this->view->data = $this->getRequest()->getParams(); 
                return false;
        }
        
        $this->_helper->viewRenderer->setNoRender();

        $formData = $values = $this->_request->getPost();
        if (!$form->isValid($formData)) {
            $this->flashMessenger->setNamespace('Errors');
            $this->flashMessenger->addMessage('-Invalid user or password');
            $this->_helper->redirector('home', 'index');
        }

        $adapter = new Zend_Auth_Adapter_DbTable(
            Zend_Db_Table::getDefaultAdapter() // set earlier in Bootstrap
        );

        $adapter->setTableName('gebruiker'); 
        $adapter->setIdentityColumn('email'); 
        $adapter->setCredentialColumn('paswoord'); 
        $adapter->setIdentity($values['email']);
        $adapter->setCredential($values['paswoord']); 
        $adapter->setCredentialTreatment('md5(?) AND status = 1');
        //$adapter->setCredentialTreatment('? AND status = 1');
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter); 
       
        // authentication OK
        if ($result->isValid())
        { 
            $gebruikerModel = new Application_Model_Gebruiker();
            $gebruiker = $gebruikerModel->getOneByField('email', $formData['email']);
            $this->countbestellingen($gebruiker);
            $auth->getStorage()
                ->write($adapter->getResultRowObject(null, "password"));
            $identity = $adapter->getResultRowObject();           
        } else
        {        
            $this->flashMessenger->setNamespace('Errors');
            $this->flashMessenger->addMessage('-Authentication failed');
        }
        $this->_helper->redirector('home', 'index');
    }

    /**
    * Registreer
    */
    public function registerAction()
    {
         $this->flashMessenger->setNamespace('Errors');
         $this->view->flashMessenger = $this->flashMessenger->getMessages();
         $form = new Application_Form_Registreer;
         $this->view->form = $form;

         if ($this->getRequest()->isPost()){
            $postParams= $this->getRequest()->getPost();
            if (!$form->isValid($postParams)) {
                return;
            }
            $formData  = $this->_request->getPost();
            $gebruikerModel = new Application_Model_Gebruiker();
            $gebruiker = $gebruikerModel->getOneByField('email', $formData['email']);
            $tr= Zend_Registry::get('Zend_Translate');
            if (!empty($gebruiker)){
                $this->flashMessenger->setNamespace('Errors');
                $this->flashMessenger->addMessage($tr->translate('txtUserAlreadyRegistrated'));
                $this->_helper->redirector('register', 'gebruiker');
            }
            else {
                $dbFields=array("naam"=>$formData['naam'],"email"=>$formData['email'],"paswoord"=>md5($formData['paswoord']),"idrole"=>1,"status"=>1);
                $gebruikerModel->insert($dbFields);
            }
            
            $this->flashMessenger->setNamespace('Errors');            
            $this->flashMessenger->addMessage($tr->translate('txtRegisterEmail'));
            $this->_helper->redirector('home', 'index');
        }

    }
    
    /**
     * Log out a user
     */
    public function logoutAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        Zend_Auth::getInstance()->clearIdentity();
        $this->context['bestellingen']=null;
        $this->SaveContext();
        $this->_helper->redirector('home','index');
    }

    /**
    * Lost Password
    */
    public function lostpasswordAction()
    {
         $this->flashMessenger->setNamespace('Errors');
         $this->view->flashMessenger = $this->flashMessenger->getMessages();
         $form = new Application_Form_Lostpassword;
         $this->view->form = $form;
         if ($this->getRequest()->isPost()){
            $postParams= $this->getRequest()->getPost();
            if (!$form->isValid($postParams)) {
                return;
            }
            $formData  = $this->_request->getPost();
            $gebruikerModel = new Application_Model_Gebruiker();
            $gebruiker = $gebruikerModel->getOneByField('email', $formData['email']);
            $tr= Zend_Registry::get('Zend_Translate');
            if (empty($gebruiker)){
                $this->flashMessenger->setNamespace('Errors');
                $message=$tr->translate('txtEmailNotFound').":".$formData['email'];
                $this->flashMessenger->addMessage($message);
                $this->_helper->redirector('lostpassword', 'gebruiker');
            }
            try {
                $templateName = My_Controller_Plugin_Mail::TEMPLATE_LOST_PASSWORD;
                $data['eId'] = $gebruikerModel->saveIdentifier($gebruiker['id']);
                $data['email'] = $gebruiker['email'];
                $data['url']   = $this->getFullUrl() .'/gebruiker/reset/eId/' . $data['eId'];                
                $this->mail->send($templateName,$data);
                $this->flashMessenger->setNamespace('Errors');
                $message=$tr->translate('txtEmailResetSend').":".$formData['email'];
                $this->flashMessenger->addMessage($message);
                $this->_helper->redirector('home','index');
            } catch (Exception $e){
                throw $e;
            }
         }
    }

    

    public function resetAction(){
        $this->view->form = new Application_Form_Reset();

        $data = $this->getRequest()->getParams();
        $save = false;

        $eId = $this->getRequest()->getParam('eId');

        if ($this->getRequest()->isPost()) {
        //submit
            $data = $this->_request->getPost();
            $save = true;
        }
        $this->view->data = $data;
        $gebruikerModel = new Application_Model_Gebruiker();
        $gebruiker = $gebruikerModel->getOneByField('eId',(string)$eId);
        if (empty($gebruiker)){
            $this->flashMessenger->setNamespace('Errors');
            $message='eID not found';
            $this->flashMessenger->addMessage($message);
            $url = '/' . $this->getRequest()->getControllerName().'/reset/eId/'.$eId;
            $this->_redirect($url);
        }
        $this->view->user = $gebruiker;
        if (!$save){
            return;
        }
        if (empty($data['password1'])){
            $this->flashMessenger->setNamespace('Errors');
            $message='Password 1 is required';
            $this->flashMessenger->addMessage($message);
            $url = '/' . $this->getRequest()->getControllerName().'/reset/eId/'.$eId;
            $this->_redirect($url);
        }
        if ($data['password1'] !==$data['password2']){
            $this->flashMessenger->setNamespace('Errors');
            $message="the two password fields' values aren't the same." ;
            $this->flashMessenger->addMessage($message);
            $url = '/' . $this->getRequest()->getControllerName().'/reset/eId/'.$eId;
            $this->_redirect($url);
        }
        //save new password
        try{
            $dbFields = array(
                     'eId' => null,
                     'paswoord' => md5($data['password1']),
            );
            $gebruikerModel->update($dbFields,$gebruiker['id']);
            $this->flashMessenger->setNamespace('Errors');
            $message='Reset password succeeded';
            $this->flashMessenger->addMessage($message);
            $this->_helper->redirector('home','index');
        }
        catch (Exception $e){
            $this->flashMessenger->setNamespace('Errors');
            $message='Reset password not succeeded';
            $this->flashMessenger->addMessage($message);
            $url = '/' . $this->getRequest()->getControllerName().'/reset/eId/'.$eId;
            $this->_redirect($url);
        }
    }
      
}