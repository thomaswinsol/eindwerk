<?php
class Zend_View_Helper_toonWinkelmand extends Zend_View_Helper_Abstract
{

    public function toonWinkelmand($data)
    {
        $html=null;
        
            $html .=
            "<div class='winkelmandempty'>".
            "<img src='/base/images/icons/icon_basket.png'>".
                $this->view->translate("txtWinkelmand")."(".count($data).")".
            "</div>";

        return $html;
    }

}

