<?php
class WinkelmandController extends My_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->disableLayout();
        parent::init();
    }


    public function ajaxVoegtoeWinkelmandAction() {        
        $formData  = $this->_request->getPost();
        parse_str($formData['data'], $data);
        $form = new Application_Form_Voegtoe();
        $error=0;
        if (!isset($this->context['winkelmand'])) {
            $this->context['winkelmand']=null;
            $this->SaveContext();
        }
        if (!$form->isValid($data)){
    	    $error=1;
    	}
        else {
            $this->context['winkelmand'][$data['id']]=$data['Aantal'];
            if (empty($this->context['winkelmand'][$data['id']])) {
                unset($this->context['winkelmand'][$data['id']]);
            }
            $this->SaveContext();
        }
        $this->view->winkelmand=$this->context['winkelmand'];
        $this->view->error=$error;
    }


    public function userhasnoidentityAction()
    {
         $this->_helper->viewRenderer->setNoRender();
         $this->flashMessenger->setNamespace('Errors');
         $tr= Zend_Registry::get('Zend_Translate');
         $this->flashMessenger->addMessage($tr->translate('txtNoIdentity'));
         $this->_helper->redirector('register', 'gebruiker');
    }

    public function winkelmandleegmakenAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->context['winkelmand']=null;
        $this->SaveContext();
        $this->_helper->redirector('home', 'index');
    }

    public function winkelmandbestellenAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        // Bestelling header
        $bestellingheaderModel = new Application_Model_Bestellingheader();
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity() ) {
            $gebruiker= $auth->getIdentity();
            $userid = $gebruiker->id;
        }
        $dbFields=array("userID"=>(int)$userid);
        $bestellingid=$bestellingheaderModel->save($dbFields);
        
        // Bestelling detail
        $bestellingdetailModel = new Application_Model_Bestellingdetail();
        $bestellingdetailModel->save($this->context['winkelmand'],$bestellingid);
        
        // Winkelmand leegmaken
        $this->context['winkelmand']=null;
        $this->SaveContext();
        $this->_helper->redirector('home', 'index');
    }

}





