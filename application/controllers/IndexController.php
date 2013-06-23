<?php

class IndexController extends My_Controller_Action
{

    public function indexAction()
    {
        $this->_helper->redirector('home', 'index');
    }

    public function homeAction()
    {
        $this->flashMessenger->setNamespace('Errors');
        $this->view->flashMessenger = $this->flashMessenger->getMessages();

        $form = new Application_Form_Search;
        if ($this->getRequest()->isPost()){
            $postParams= $this->getRequest()->getPost();
            if (!$form->isValid($postParams)) {
                return;
            }
            $formData  = $this->_request->getPost();
            $this->context['Zoeken']=$formData;
            $this->SaveContext();
        }
        if (!empty($this->context['Zoeken'])) {
            $form->populate( $this->context['Zoeken'] );
        }
        else {
            $this->context['Zoeken']=null;
        }
        $this->view->form = $form;
        //Uitvoern query op Producten
        $productModel = new Application_Model_Product();
        $this->view->producten=$productModel->getProducten($this->context['Zoeken']);
    }


    public function productinfoAction()
    {
        $id = (int) $this->_getParam('id');
        $productModel = new Application_Model_Product();
        $this->view->product= $productModel->getProduct($id);
        //Ophalen Productfoto's
        $productfotoModel = new Application_Model_Productfoto();
        $this->view->fotos= $productfotoModel->getFotosForProductId($id);
        //Ophalen Productcategorien
        $productcategorieModel = new Application_Model_Productcategorie();
        $this->view->categorie= $productcategorieModel->getCategorieForProduct($id);
    }



}





