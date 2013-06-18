<?php
class My_Controller_Plugin_Navigation extends Zend_Controller_Plugin_Abstract
{
/**
 * 
 * @param \Zend_Controller_Request_Abstract $request
 * @return \Zend_Navigation
 */
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        
        //make navigation
        $role=1;
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity() ) {
            $gebruiker= $auth->getIdentity();
            $role = $gebruiker->idrole;
        }

        $menuModel = new Application_Model_Menu();
        $urls= $menuModel->getMenu($role);


        $container = new Zend_Navigation;

        /*$urls = array (
         array ( 'label'=> 'menuHome', 'module'=>'default', 'action'=> 'home', 'controller'=> 'index', 'params'=> array() ),
         array ( 'label'=> 'menuProduct', 'module'=>'dealer', 'action'=> 'lijst', 'controller'=> 'product', 'params'=> array() ),
         array ( 'label'=> 'menuCategorie', 'module'=>'dealer', 'action'=> 'lijst', 'controller'=> 'categorie', 'params'=> array() ),
         array ( 'label'=> 'menuFotoUpload', 'module'=>'dealer', 'action'=> 'lijst', 'controller'=> 'foto', 'params'=> array() ),
         array ( 'label'=> 'menuPages', 'module'=>'dealer', 'action'=> 'lijst', 'controller'=> 'pagina', 'params'=> array() ),
        );*/
        
        foreach  ($urls as $url) {
            $param=null;
            if (!empty($url['params'])) {
                $urlparam=explode(',',$url['params']);
                $param[$urlparam[0]]=$urlparam[1];
            }
            
            $page = new Zend_Navigation_Page_Mvc(array(
                'label' => $url['label'] ,
                'module' => $url['module'],
                'action'=> $url['action'],
                'controller'=> $url['controller'],
                //'route'=> 'default',
                'params'=> $param,
            ));
            $container->addPage($page);
        }
        Zend_Registry::set('Zend_Navigation', $container);
        return $container;
        
    }
}

?>
