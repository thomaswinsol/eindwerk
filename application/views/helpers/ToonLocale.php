<?php
class Zend_View_Helper_ToonLocale extends Zend_View_Helper_Abstract
{
    public function ToonLocale()
    {
        $html=null;
        $localeModel = new Application_Model_Locale();
        $locale = $localeModel->getAll("status=1");
        if (!empty($locale)) {
            foreach ($locale as $l) {
                $html.= 
                "<a href='". 
                 ($this->view->url(array('module'=> 'default', 'controller'=>'taal' , 'action'=>'selecttaal', 'lang'=>$this->view->escape($l['locale'])) ))
                        ."'>".$this->view->escape($this->view->translate($l['omschrijving'])) ."</a>"."&nbsp;&nbsp;";
            }  
        }        
        return $html;
    }

}

