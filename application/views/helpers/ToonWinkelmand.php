<?php
class Zend_View_Helper_ToonWinkelmand extends Zend_View_Helper_Abstract
{

    public function ToonWinkelmand($data)
    {
        $html=null;

        $html .=
            "<div class='winkelmandempty'>".
            "<img src='/base/images/icons/icon_basket.png'>".
                $this->view->translate("txtWinkelmand")."(".count($data).")".
            "</div>";

        if (!empty($data)) {
            $productModel = new Application_Model_Product();
            $counter=0;
            $totaal=0;

            
            foreach ($data as $key => $value) {
                $product=$productModel->getProduct($key);
                if (!empty($product)) {
                    if ($counter==0) {
                        $html .= "<table class='frm_01 frm_02'>";
                        $html .= "<tr>";
                            $html .= "<th>".$this->view->translate("txtProduct")."</th>";
                            $html .= "<th>".$this->view->translate("txtAantal")."</th>";
                            $html .= "<th>".$this->view->translate("txtPrijs")."</th>";
                         $html .= "</tr>";
                    }

                $totaal += ($product['eenheidsprijs']*$value);
                
                $html .= "<tr>";
                    $html .= "<td>".$product['titel']."</td>";
                    $html .= "<td>".$value."</td>";
                    $html .= "<td class='price'>".$this->view->ShowCurrency($product['eenheidsprijs'])."</td>";
                $html .= "</tr>";
                $counter++;
                }
                
            }
            if ($counter>0) {
                $html .= "<tfoot>";
                $html .= "<tr><td></td>";
                $html .= "<td>Totaal</td>";
                    $html.= "<td class='price'>". $this->view->ShowCurrency($totaal)."</td>";
                $html .= "</tr>";
                $html .= "<tr>";
                    $html.= "<td colspan=3><a id='Winkelmandbestellen' href='". $this->view->url(array('controller'=>'winkelmand' , 'action'=>'winkelmandbestellen')) ."'>". $this->view->translate('txtBestellen')."</a></td>";
                $html .= "</tr>";
                 $html .= "<tr>";
                $html.= "<td colspan=3><a href='". $this->view->url(array('controller'=>'winkelmand' , 'action'=>'winkelmandLeegmaken')) ."'>". $this->view->translate('txtWinkelmandLeegmaken')."</a></td>";
                $html .= "</tr>";
                $html .= "</tfoot>";
                $html .= "</table>";
            }
        }
        
        return $html;
    }

}

