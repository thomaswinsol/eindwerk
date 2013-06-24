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


    public function noaccessAction()
    {
         $this->_helper->viewRenderer->setNoRender();
         $this->flashMessenger->setNamespace('Errors');
         $tr= Zend_Registry::get('Zend_Translate');
         $error = (int) $this->_getParam('error');
         // Bestellen enkel mogelijk indien ingelogd
         if ($error==1){
            $this->flashMessenger->addMessage($tr->translate('txtNoIdentity'));
            $this->_helper->redirector('register', 'gebruiker');
         }
         // Geen toegang (ACL)
         if ($error==2){
            $this->flashMessenger->addMessage($tr->translate('txtNoAccess'));
            $this->_helper->redirector('home', 'index');
         }
         
    }

    public function winkelmandleegmakenAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->context['winkelmand']=null;
        $this->SaveContext();
        $this->_helper->redirector('home', 'index');
    }

    public function winkelmandtonenAction()
    {
        $this->_helper->layout->enableLayout();
        if (isset($this->context['winkelmand'])) {
            $this->view->winkelmand=$this->context['winkelmand'];
        }
        $bestellen = (int) $this->_getParam('bestellen');
        if (isset($bestellen) and $bestellen) {
            $this->view->form = new Application_Form_Bestelwinkelmand;
        }

        if ($this->getRequest()->isPost()){
            $postParams= $this->getRequest()->getPost();
            $form = new Application_Form_Bestelwinkelmand;
            if (!$form->isValid($postParams)) {
                return;
            }
            $formData  = $this->_request->getPost();
            $this->bestellen($formData['Referentie']);
        }
    }

    public function winkelmandbestellenAction()
    {
        $this->_helper->layout->enableLayout();
        if (isset($this->context['winkelmand'])) {
            $this->view->winkelmand=$this->context['winkelmand'];
        }
        
        $this->view->form = new Application_Form_Bestelwinkelmand;

        if ($this->getRequest()->isPost()){
            $postParams= $this->getRequest()->getPost();
            $form = new Application_Form_Bestelwinkelmand;
            if (!$form->isValid($postParams)) {
                return;
            }
            $formData  = $this->_request->getPost();
            $this->bestellen($formData['Referentie']);
        }
    }


    private function bestellen($referentie)
    {
        $this->_helper->viewRenderer->setNoRender();
        $bestellingheaderModel = new Application_Model_Bestellingheader();
        // Ophalen id gebruiker
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity() ) {
            $gebruiker= $auth->getIdentity();
            $userid = $gebruiker->id;
        }
        $dbFields=array("IDGebruiker"=>(int)$userid, "referentie"=>$referentie, "status"=>1);
        $bestellingid=$bestellingheaderModel->save($dbFields);

        // Bestelling detail
        $bestellingdetailModel = new Application_Model_Bestellingdetail();
        $bestellingdetailModel->save($this->context['winkelmand'],$bestellingid);

        // Winkelmand leegmaken
        $this->context['winkelmand']=null;
        $gebruikerModel = new Application_Model_Gebruiker();
        $gebruiker = $gebruikerModel->getOne($userid);
        $this->countbestellingen($gebruiker);
        $this->SaveContext();
        $this->_helper->redirector('home', 'index');
    }


     public function bestellingtonenAction() {
        // Afbeelden datagrid bestellingen
        $this->_helper->layout->enableLayout();
        try
        {
            $bestellingheaderModel = new Application_Model_Bestellingheader();
            $bestellingen = $bestellingheaderModel->getTotaalBestellingen();
            $this->view->dataGrid = $bestellingheaderModel->BuildDataGrid($bestellingen);

        } catch(Exception $e) {
    		return NULL;
    	}
    }

    public function showpdfAction(){
        // Opvragen pdf bestelling
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();

    	$id                       = (int)$this->getRequest()->getParam('id');
    	$bestellingheaderModel    = new Application_Model_Bestellingheader();
    	$bestelling               = $bestellingheaderModel->getBestellingen($id);

    	$bestellingheaderModel->buildPdf($bestelling,$id);
    }

}





