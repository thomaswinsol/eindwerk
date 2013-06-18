<?php
class Application_Model_Categorievertaling extends My_Model
{
    protected $_name = 'categorie_vertaling'; //table name
    protected $_id   = 'id'; //primary key
    
    public function save($data,$id = NULL)
    {
    	//ini
    	$currentTime =  date("Y-m-d H:i:s", time());
        $dbFields = array(
        	'categorie_id' => $data['categorie_id'],
                'taal_id'      => $data['taal_id'],
                'titel'        => $data['titel'],
                'vertaald'     => $data['vertaald']
        );


        return $this->insert($dbFields);
    }

    
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