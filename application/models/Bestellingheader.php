<?php
class Application_Model_Bestellingheader extends My_Model
{
    protected $_name = 'bestellingheader'; //table name
    protected $_id = 'id'; //primary key
        
    public function save($data,$id = NULL)
    {
    	//ini
    	$currentTime =  date("Y-m-d H:i:s", time());
        $dbFields = array(
        	'IDGebruiker'       => $data['IDGebruiker'],
                'datumbestelling'   => $currentTime,
                'referentie'        => $data['referentie'],
                'leveringsadres'    => "...",
        );

        return $this->insert($dbFields);                               
    }

    
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

    public function getAantalBestellingen($userid=null)
    {
            $sql = $this->db
            ->select()
            ->from(array('h' => 'bestellingheader'), array('count(id) as aantalbestellingen') );
            $sql->where ('h.IDGebruiker = '.(int)$userid);
            $data = $this->db->fetchAll($sql);
            if (!empty($data[0]['aantalbestellingen'])) {
                return current($data);

            }else {
                return "";
            }
    }
         
}

