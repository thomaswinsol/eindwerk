<?php
class Application_Model_Product extends My_Model
{
    protected $_name = 'product'; //table name
    protected $_sName = 'product_vertaling.product';
    protected $_id    = 'id';
    protected $model_fields = array( array("name"=> "eenheidsprijs", "type"=>"decimal"), array("name"=> "eenheidsprijs", "type"=>"decimal") );
    protected $lang_fields = array('titel', 'teaser', 'inhoud');
    protected $status= 'Productstatus';
    
    public function getProducten($data=null, $status=null)
    {
            $locale= Zend_Registry::get('Zend_Locale');
           
            $taalcode=(!empty($locale))?substr($locale,0,2):'nl';
            $sql = $this->db
            ->select()
            ->from(array('p' => 'product'), array('id', 'label', 'status' , 'eenheidsprijs' ) )
            ->join(array('v' => 'product_vertaling'), ' p.id = v.product_id  ', array('titel','teaser','inhoud','vertaald', 'taal_id') )
            ->join(array('t' => 'taal'), ' t.id = v.taal_id  ', array('code', 'status as t.satus') );;

            $sql->where ('t.code = '."'".$taalcode."'");
            // Status= inactief
            if (empty($status)) {
                $sql->where ('p.status <>2 ');
            }
           
        $selectie=null;
        if (!empty($data['Categorie'])){
            $sql->join(array('c' => 'product_categorie'), ' p.id = c.idproduct  ', array('c.idcategorie') );
            $sql->where ('c.idcategorie = '. (int)$data['Categorie'] );
            $selectie=1;
        }
        if (!empty($data['label'])){
            $sql->where ('label like '."'%".trim($data['label'])."%'");
            $selectie=1;
        }
        if (!empty($data['titel'])){
            $sql->where ('v.titel like '."'%".trim($data['titel'])."%'");
            $selectie=1;
        }
         // Status: In de kijker
            if (empty($selectie)) {
                $sql->where ('p.status = 3 ');
            }
        $data = $this->db->fetchAll($sql);

        return $data;
    }


    public function getProduct($id=null)
    {
            $locale= Zend_Registry::get('Zend_Locale');
            $taalcode=(!empty($locale))?substr($locale,0,2):'nl';
            $sql = $this->db
            ->select()
            ->from(array('p' => 'product'), array('id', 'label', 'status' , 'eenheidsprijs' ) )
            ->join(array('v' => 'product_vertaling'), ' p.id = v.product_id  ', array('titel','teaser','inhoud','vertaald', 'taal_id') )
            ->join(array('t' => 'taal'), ' t.id = v.taal_id  ', array('code', 'status as t.satus') );;

            $sql->where ('t.code = '."'".$taalcode."'");

        If (!empty($status)) {
            $sql->where ('p.status = '.$status);
        }
        $sql->where ('p.id = '.(int)$id);
        $data = $this->db->fetchRow($sql);

        return $data;
    }

    public function getLangFields()
    {
        return $this->lang_fields;
    }

    public function getModelFields()
    {
        return $this->model_fields;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function save($data,$id = NULL)
    {
    	$currentTime =  date("Y-m-d H:i:s", time());
        $eenheidsprijs= empty($data['eenheidsprijs'])?0:$data['eenheidsprijs'];
        $isUpdate = FALSE;
        $dbFields = array(
        	'label'          => $data['label'],
                'status'         => (int)$data['status'],
                'eenheidsprijs'  => $eenheidsprijs,
        );

        if (!empty($id)) {
        	$isUpdate = TRUE;
        	$this->update($dbFields,$id);
                $this->savetranslation($data, $id);
        	return $id;
        }
        $id = $this->insert($dbFields);
        $this->savetranslation($data, $id);
    }

    public function savetranslation($data,$id = NULL)
    {
        $vertalingModel = new Application_Model_Productvertaling();
        $vertalingModel->deleteById($id, "product_id");
        foreach ($data['translation'] as $key => $value) {
            $translated= !empty($value['titel'])?1:0;
            $dbFields=array(
                "product_id"   => $id,
                "taal_id"     => $key,
                "titel"       => trim($value['titel']),
                "teaser"      => trim($value['teaser']),
                "inhoud"      => trim($value['inhoud']),
                "vertaald"    => $translated
            );
            $vertalingModel->save($dbFields);
        }
    }

    public function getAutocomplete($where=NULL){
        $product = parent::getAll($where);

	$matches = array();
        foreach ( $product as $p ) {
                        $p['id']  =trim($p['id']);
        		$p['naam']=trim($p['label']);
        		$p['value'] = trim($p['id']);
                        if ($p['status']) {
                            $p['label'] = trim($p['label']);
                        } else {
                            $p['label'] = "<span style='text-decoration:line-through;'>".trim($p['label'])."</span>";
                        }
			$matches[] = $p;
        }
        return $matches;
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