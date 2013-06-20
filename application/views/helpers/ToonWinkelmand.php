<?php
class Zend_View_Helper_ToonWinkelmand extends Zend_View_Helper_Abstract
{

    public function ToonWinkelmand($data, $detail=null)
    {
        $html=null;

        if (count($data)>0) {
        $html .=
            "<div>".
                 "<a href='".($this->view->url(array('controller'=>'winkelmand' , 'action'=>'winkelmandtonen')))."'>".
                    "<img src='/base/images/icons/icon_basket.png'> ".
                    $this->view->translate("txtWinkelmand")."(". count($data) .
                ")</a>".
            "</div>";
        }
        else {
             $html .=
            "<div>".
                    "<img src='/base/images/icons/icon_basket.png'> ".
                    $this->view->translate("txtWinkelmand")."(". count($data) .")".
            "</div>";
        }
        $html .='<br/>';
        if (!empty($data)) {
            $productModel = new Application_Model_Product();
            $counter=0;
            $totaal=0;

            
            foreach ($data as $key => $value) {
                $product=$productModel->getProduct($key);
                if (!empty($product)) {
                    if ($counter==0) {
                        $html .= "<table class='frm_01 frm_02'>";
                        if ($detail) {
                        $html .= "<tr>";
                            $html .= "<th class='foto'>"."</th>";
                            $html .= "<th>".$this->view->translate("txtProduct")."</th>";
                            $html .= "<th>".$this->view->translate("txtAantal")."</th>";
                            $html .= "<th>".$this->view->translate("txtPrijs")."</th>";
                         $html .= "</tr>";
                        }
                    }

                $totaal += ($product['eenheidsprijs']*$value);
                if ($detail){
                    $html .= "<tr>";
                        $html .= "<td class='foto'>". ($this->view->GetFoto($product['id']))."</td>";
                        $html .= "<td class='price'>".$product['titel']."</td>";
                        $html .= "<td class='price'>".$value."</td>";
                        $html .= "<td class='price'>".$this->view->ShowCurrency($product['eenheidsprijs'])."</td>";
                    $html .= "</tr>";
                }
                $counter++;
                }
                
            }
            if ($counter>0) {
                $html .= "<tfoot>";
                $html .= "<tr>";
                $html .= "<td colspan=3 class='price'>Totaal</td>";
                    $html.= "<td class='price'>". $this->view->ShowCurrency($totaal)."</td>";
                $html .= "</tr>";
                    $html .= "<tr>";
                    $html.= "<td colspan=4><a ";
                if ($detail) {
                    $html .='id=Winkelmandbestellen';
                    $html .= " href='". $this->view->url(array('controller'=>'winkelmand' , 'action'=>'winkelmandbestellen')) ."'>". $this->view->translate('txtBestellen')."</a></td>";
                }
                else {
                    $html .= " href='". $this->view->url(array('controller'=>'winkelmand' , 'action'=>'winkelmandtonen')) ."'>". $this->view->translate('txtBestellen')."</a></td>";
                }
                   
                    $html .= "</tr>";

                if ($detail){
                 $html .= "<tr>";
                 $html.= "<td colspan=4><a href='". $this->view->url(array('controller'=>'winkelmand' , 'action'=>'winkelmandLeegmaken')) ."'>". $this->view->translate('txtWinkelmandLeegmaken')."</a></td>";
                 $html .= "</tr>";
                }
                $html .= "</tfoot>";
                $html .= "</table>";
            }
        }
        
        return $html;
    }

}

