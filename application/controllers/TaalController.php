<?php
class TaalController extends My_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    }


    public function selecttaalAction()
    {
        $session = new Zend_Session_Namespace('translation');
        $session->language=$this->_getParam('lang');
        $this->_helper->redirector('home', 'index');
    }

}





