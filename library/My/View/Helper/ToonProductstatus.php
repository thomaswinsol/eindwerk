<?php
/**
* Product helper
*
* @uses viewHelper Zend_View_Helper
*/
class Zend_View_Helper_ToonProductstatus extends Zend_View_Helper_Abstract
{

        public function ToonProductstatus($statusId){
            $statusId=(int)$statusId;
            if ($statusId<3) {
                return null;
            }
            $productstatusModel = new Application_Model_Productstatus();
            $productstatus = $productstatusModel->getOne($statusId);
            if (!empty($productstatus)) {
                return "<div style='margin-left:5px;float:left;'><img alt='' src='/images/promoblok/orange.png'></div><div class='prod-status'>".$productstatus['omschrijving']."</div>";
            }
            return null;
        }


}
