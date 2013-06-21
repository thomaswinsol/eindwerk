<?php
class PaginaController extends My_Controller_Action
{

    public function getpaginaAction()
    {
        $this->flashMessenger->setNamespace('Errors');
        $this->view->flashMessenger = $this->flashMessenger->getMessages();
        $id = (int) $this->_getParam('id');
        $paginaModel = new Application_Model_Pagina();
        $this->view->pagina=$paginaModel->getPagina($id);
    }

}





