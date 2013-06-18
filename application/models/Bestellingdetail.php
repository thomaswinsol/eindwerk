<?php
class Application_Model_Bestellingdetail extends My_Model
{
    protected $_name = 'bestellingdetail'; //table name
    protected $_id = 'id'; //primary key

    public function save($winkelmand, $id)
    {
             $productModel = new Application_Model_Product();
	     foreach ($winkelmand as $key => $value) {
                $product=$productModel->getProduct($key);
                $dbFields=array("IDBestelling"=>$id, "IDProduct"=>$key,"AantalBesteld"=>$value,"Prijs"=>$product['Eenheidsprijs']);
                $this->insert($dbFields);
             }
    }
    /**
     * Insert
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

