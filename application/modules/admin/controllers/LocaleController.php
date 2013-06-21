<?php
class admin_LocaleController extends My_Controller_Action
{    
    public function SetLocaleAction()
    {

        $form = new admin_Form_Locale;
        $localeModel = new Application_Model_Locale();
        $locale= $localeModel->getLocaleForm();
        if ($this->getRequest()->isPost()){
            $postParams= $this->getRequest()->getPost();
            if (!$form->isValid($postParams)) {
                return;
            }
            $formData  = $this->_request->getPost();

            $values = implode(",", $formData['locale']);
            $data['status']=0;
            $localeModel->updateLocale($data,$values,"not");
            $data['status']=1;
            $localeModel->updateLocale($data,$values);
            $this->_helper->redirector('lijst', 'locale', 'admin');
        }
        $form->populate($locale);
        $this->view->form= $form;
       
    }
    
}

