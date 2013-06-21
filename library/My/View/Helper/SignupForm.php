<?php
class Zend_View_Helper_SignupForm extends Zend_View_Helper_Abstract
{

    public function signupForm(Application_Form_Signup $form)
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $username = $auth->getIdentity();
            $logoutUrl = $this->view->url(array('controller'=>'gebruiker', 'action'=>'logout'), null, true);
            return $this->view->translate('txtWelkom') .' , '. $username->naam . '. <a href="'.$logoutUrl.'">Logout</a>';
        }
        
             $html = $form->render();
             $registerUrl = $this->view->url(array('controller'=>'gebruiker', 'action'=>'register'), null, true);
             $html .=  "<a href='". $registerUrl."'>". $this->view->translate('btnRegister')."</a>";
             $html .= "&nbsp;&nbsp;&nbsp;";
             $lostPasswordUrl = $this->view->url(array('controller'=>'gebruiker', 'action'=>'lostpassword'), null, true);
             $html .=  "<a href='". $lostPasswordUrl."'>". $this->view->translate('btnLostPassword')."</a>";

        return $html;
    }

}

