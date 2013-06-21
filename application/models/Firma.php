<?php
class Application_Model_Firma extends My_Model
{
    protected $_name = 'firma'; //table name
    protected $_id   = 'id'; //primary key


    public function save($data,$id = NULL)
    {
    	$currentTime =  date("Y-m-d H:i:s", time());
        $isUpdate = FALSE;
        $dbFields = array(
        	'Firma'      => $data['Firma'],
                'Straat'     => $data['Straat'],
                'Postcode'   => $data['Postcode'],
                'Gemeente'   => $data['Gemeente'],
                'Tel'        => $data['Tel'],
                'Fax'        => $data['Fax'],
                'Email'      => $data['Email'],
                'BTWnummer'  => $data['BTWnummer'],
                'Website'    => $data['Website'],
        );

        if (!empty($id)) {
        	$isUpdate = TRUE;
        	$this->update($dbFields,$id);
        	return $id;
        }
        $id = $this->insert($dbFields);
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