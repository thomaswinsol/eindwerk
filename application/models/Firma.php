<?php
class Application_Model_Firma extends My_Model
{
    protected $_name = 'firma'; //table name
    protected $_id   = 'id'; //primary key
 
    /**
     * Insert
     * @return int last insert ID
     */
    public function insert($data)
    {
        return parent::insert($data);       
    }

    /**
     * Update
     * @return int numbers of rows updated
     */
    public function update($data,$id)
    {
        return parent::update($data, 'id = '. (int)$id);
    }
    


}