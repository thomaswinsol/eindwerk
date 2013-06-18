<?php
class Application_Model_Locale extends My_Model
{
    protected $_name = 'locale';
    protected $_id   = 'id'; //primary key
    
    public function getLocale($where=NULL){
        $locale = parent::getAll($where,"id");
        $locale_array=array();
	foreach ( $locale as $l ) {
            $locale_array[$l['id']] = $l['code'];
        }
        return $locale_array;
     }
}
?>

