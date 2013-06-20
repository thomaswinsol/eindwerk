<?php
class Zend_View_Helper_ToonBestellingen extends Zend_View_Helper_Abstract
{

    public function ToonBestellingen()
    {
        $html=null;
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity() ) {
            $gebruiker= $auth->getIdentity();
            
            $userid = $gebruiker->id;
            $bestellingheaderModel = new Application_Model_Bestellingheader();
            $data=$bestellingheaderModel->getAantalBestellingen($userid);
            if (!empty($data)) {
                $html .= "<br/>".
                 "<a href='".($this->view->url(array('controller'=>'winkelmand' , 'action'=>'bestellingtonen')))."'>".
                    $this->view->translate("lblUwBestellingen")."(". $data['aantalbestellingen'] .")</a>";
                return $html;
            }
        }
        return "";
        
    }

}

