<?php
/**
* Description of Auth
*
* @author webmaster
*/
    class My_Auth_Auth extends Zend_Controller_Plugin_Abstract {
        private $_includeAuthActions = array(
            'winkelmand'  => array('winkelmandbestellen'),
        );


    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $loginController = 'gebruiker';
        $loginAction = 'login';
        //$locale = Zend_Registry::get('Zend_Locale');
        $auth = Zend_Auth::getInstance();
                
        // If user is not logged in and is  requesting the bestelwinkelmand action
        // - redirect to registration page
        if (!$auth->hasIdentity() &&
                $request->getControllerName() != $loginController
                 && $request->getActionName() != $loginAction)
        {
            $controllerName = $request->getControllerName();
            $actionName     = $request->getActionName();
           

            if (array_key_exists($controllerName,$this->_includeAuthActions)
                    && in_array($actionName,$this->_includeAuthActions[$controllerName])) {
                 $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
                $redirector->gotoUrl('/winkelmand/userhasnoidentity');
            }
            
        }
       
    }

}
?>