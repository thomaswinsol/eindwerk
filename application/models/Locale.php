<?php
class Application_Model_Locale extends My_Model
{
    protected $_name = 'locale';
    protected $_id   = 'id'; //primary key
    
    public function getLocale($where=NULL){
        $locale = parent::getAll($where,"id");
        $locale_array=array();
	foreach ( $locale as $l ) {
            $locale_array[$l['id']] = $l['locale'];
        }
        return $locale_array;
     }

     public function getLocaleForm(){
        $locale = parent::getAll("status=1");
	foreach ( $locale as $l ) {
            $values['locale'][] = $l['id'];
        }
        return $values;
     }

    public function updateLocale($data, $id, $not=null)
    {
        return parent::update($data, 'id ' . trim($not).' in ('. $id .")");
    }

}
?>

