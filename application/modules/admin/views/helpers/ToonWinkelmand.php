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

        return $html;
    }

}

