<?php
/**
 * Product helper
 *
 * @uses viewHelper Zend_View_Helper
 */
class Zend_View_Helper_GetFoto extends Zend_View_Helper_Abstract
{
		
        public function GetFoto($productId){ 
            $productfotoModel = new Application_Model_ProductFoto();
            $result = $productfotoModel->getAll("idproduct=".(int)$productId);
            if (!empty($result)) {
                $fotoModel = new Application_Model_Foto();
                $foto=$fotoModel->getOne($result[0]['idfoto']);
                echo "<img height='120' src='/uploads/foto/".$foto['fileName']."'>";
            }
        }


}

