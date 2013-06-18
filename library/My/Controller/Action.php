<?php
/**
 * Abstract controller
 * Provides listing, edit and delete functionality
 */
abstract class My_Controller_Action extends Zend_Controller_Action
{
    protected $context;
    protected $baseUrl='/eindwerk/public';
    protected $flashMessenger = NULL;

    public function init()
    {
        
        $defaultNamespace = new Zend_Session_Namespace ();
        if(!array_key_exists('context', $_SESSION))
        {
            $_SESSION['context']=array('winkelmand'=>null);
        }
        if (!isset($_SESSION['context']['Firma'])) {
            $firmaModel = new Application_Model_Firma();
            $firma= $firmaModel->getOne(1);
            $_SESSION['context']['Firma']=$firma;            
        }
        $module = $this->getRequest()->getModuleName();
        if (strtolower($module)=="admin") {
           unset($_SESSION['context']['winkelmand']);
           unset($_SESSION['context']['Firma']);
        }
        $this->context = $_SESSION ['context'];        
        $this->flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->flashMessenger->setNamespace('Errors');       
    }    
   

    public function __destruct()
    {
        $this->SaveContext ();
    }

    public function SaveContext()
    {
        $_SESSION ['context'] = $this->context;
    }

    /*public function IsAllowed($resource) {
        $registry = Zend_Registry::getInstance();
        $acl = $registry->get('Zend_Acl');
        if (!$acl->IsAllowed($this->context['userrole'],$resource )){
            return false;
        }
        return true;
    }*/

    public function lijstAction()
    {
         $params['controller'] = $this->getRequest()->getControllerName();
         $form = new admin_Form_Autocomplete(null,$params);
         $this->view->form = $form;
    }

    public function autocompleteAction() {
                $field='label';
                $id =  $this->_getParam('id');
                If (!empty($id)) {
                    $field="email";
                }
                $this->_helper->layout->disableLayout();
                $this->_helper->viewRenderer->setNoRender();
 		$param= $this->_getParam('term');
                $controller = ucfirst($this->getRequest()->getControllerName());
                $model= 'Application_Model_'.trim($controller);
                $autocompleteModel = new $model;
 		$data['naam']=trim($param);
                $where = $field. " like '%".trim($param)."%'";
 		$result=$autocompleteModel->getAutocomplete($where);
 		$this->_helper->json(array_values($result));
    }

    public function detailAction()
    {
         $controller = ucfirst($this->getRequest()->getControllerName());
         $model= 'Application_Model_'.trim($controller);               
         $detailModel = new $model;

         $param["langFields"] = $detailModel->getLangFields();
         $param["modelFields"]= $detailModel->getModelFields();
         $param["status"]= $detailModel->getStatus();
         $taalModel = new Application_Model_Taal();
         $param["languages"]= $taalModel->getTaal();
         $param["controller"]= strtolower($controller);

         $detailform = new admin_Form_Detail(null,$param);

         $id = (int) $this->_getParam('id');
         If (!empty($id)) {
             $formData= $detailModel->GetDataAndTranslation($id);
             $formData['ID']=$id;
             $detailform->populate($formData);
         }
         $this->view->form = $detailform;
         if ($this->getRequest()->isPost()){
            $postParams= $this->getRequest()->getPost();
            if (!$detailform->isValid($postParams)) {
                return;
            }
            $formData  = $this->_request->getPost();

            $data= $detailModel->SplitDataAndTranslation($formData);
            $detailModel->save($data, $data['ID']);
            $this->_helper->redirector('lijst', strtolower($controller));
         }         
    }

   
}
