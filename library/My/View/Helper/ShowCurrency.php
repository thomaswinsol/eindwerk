<?php
class Zend_View_Helper_ShowCurrency extends Zend_View_Helper_Abstract
{

    public function ShowCurrency($amount)
    {
        if (!empty($amount)) {
            $currency = new Zend_Currency();
            $converted_amount=$this->GetExchangeRate($currency->getShortName(),$amount);
            if ($converted_amount===null)
            {
                return null;
            }
            else {
                return $currency->toCurrency($converted_amount);
            }
        }
        else {
            return "";
        }

    }


    public function GetExchangeRate($currency,$amount) {
       
        if (trim($currency)=='EUR') {
            return null;
        }
        $number = urlencode("1");
        $from_GBP0 = urlencode("EUR");
        $to_usd= urlencode("GBP");
        $Dallor = "hl=en&q=$number$from_GBP0%3D%3F$to_usd";
            $US_Rate = file_get_contents("http://google.com/ig/calculator?".$Dallor);
            if ($US_Rate === false) {
               return null;
            }
        $US_data = explode('"', $US_Rate);
        $US_data = explode(' ', $US_data['3']);
        $var_USD = $US_data['0'];
        return ($var_USD*$amount);
    }

}

