<?php
/**
 * Product helper
 *
 * @uses viewHelper Zend_View_Helper
 */
class Zend_View_Helper_toonfoto extends Zend_View_Helper_Abstract
{
		
        public function toonfoto($fotoId){
            $fotoModel = new Application_Model_Foto();
            $foto = $fotoModel->getOne((int)$fotoId);
            if (!empty($foto)) {
                echo "<img height='120' src='/uploads/foto/".$foto['fileName']."'>";
            }
        }


}

