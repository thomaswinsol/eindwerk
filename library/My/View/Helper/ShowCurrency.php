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
                $currency = new Zend_Currency('nl_BE');
                return $currency->toCurrency($amount);
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
            return $amount;
        }
        $number = urlencode("1");
        $from   = urlencode("EUR");
        $to     = urlencode($currency);
        $param   = "hl=en&q=$number$from%3D%3F$to";
            $result = file_get_contents("http://google.com/ig/calculator?".$param);
            if ($result === false) {                               
               return null;
            }
        $rate = explode('"', $result);
        $rate = explode(' ', $rate['3']);
        $var_rate = $rate['0'];
        return ($var_rate*$amount);
    }

}

