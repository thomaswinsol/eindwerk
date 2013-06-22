<?php
/**
* Setup view variables
*/
class My_Controller_Plugin_Mail extends Zend_Controller_Plugin_Abstract
{
	
     const TEMPLATE_LOST_PASSWORD = 'LostPassword';
    
     public $view;
    
     public function __construct()
     {
     	$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
     	$viewRenderer->init();
     	$this->view = $viewRenderer->view;
     }     
     
     
     private function hasMailAccess(){
     	if (APPLICATION_ENV == 'production'){
     		return TRUE;
     	}
     	return false;
     }
     
     
     public function send($templateName,$data = null){ 
     	if (!$this->hasMailAccess()){
     		return FALSE; 
     	}
     	
     	$templateMethod = 'template_'.$templateName;
     	if (!method_exists($this,$templateMethod)){
     		throw new Exception('Mail template not found');
     	}
     	 
     	return $this->$templateMethod($data);
     	// mail('thomas.vanhuysse@telenet.be','testing','het werkt');
     	// echo 'mail model é: ';    
     }
     
     
     // ---------
     // TEMPLATES
     // ---------     
     protected function LostPassword($data){
     	if (empty($data) ){
     		return FALSE;
     	}
                ini_set("SMTP", "10.10.101.38");
		ini_set("sendmail_from", "thomas.vanhuysse@telenet.be");
		ini_set("smtp_port", "25");
	
     		$mail = new Zend_Mail('ISO-8859-1');
     		$mail->setFrom('thomas.vanhuysse@telenet.be', 'Thomas');

     		$mail->addTo('thomas.vanhuysse@telenet.be', 'Winsol');
     		$mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
     		$this->view->data = $data;     	
     		$html = $this->view->render('/mail/lostPassword.phtml');
     		$result=explode(":::",$html);
     		$mail->setBodyHtml($result[0],'ISO-8859-1',Zend_Mime::ENCODING_BASE64);
     		$mail->setSubject($result[1]);
     		$mail->send(); 
     		
     		return TRUE;
     }     
     
	 
} 
