<?php
class Zend_View_Helper_ShowFirm extends Zend_View_Helper_Abstract
{

    public function ShowFirm($data)
    {
        $html=null;        
        if (!empty($data)) {             
                    $html .= "<p>".$data['Firma']."</p>";
                    $html .= "<p>".$data['Straat']."</p>";
                    $html .= "<p>".$data['Postcode']." " . $data['Gemeente']."</p>";
                    $html .= "<p>".$data['Tel']."</p>";
                    $html .= "<p>".$data['Fax']."</p>";
                    $html .= "<p>".$data['Email']."</p>";
                    $html .= "<p>".$data['BTWnummer']."</p>";
        }
        return $html;
    }

}

