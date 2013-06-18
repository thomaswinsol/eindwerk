<?php
class Zend_View_Helper_ShowCurrency extends Zend_View_Helper_Abstract
{

    public function ShowCurrency($data)
    {
        if (!empty($data)) {
            $currency = new Zend_Currency();
            return $currency->toCurrency($data);
        }
        else {
            return "";
        }

    }

}

