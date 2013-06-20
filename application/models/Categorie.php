<?php
class Application_Model_Categorie extends My_Model
{
    protected $_name = 'categorie'; //table name
    protected $_id   = 'id'; //primary key
    protected $_sName = 'categorie_vertaling.categorie';

    protected $lang_fields  = array('titel');
    protected $model_fields = array();
    protected $status = '';

    public function save($data,$id = NULL)
    {
    	$currentTime =  date("Y-m-d H:i:s", time());
        $isUpdate = FALSE;
        $dbFields = array(
        	'label'      => $data['label'],
                'status'     => (int)$data['status'],
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
        $vertalingModel = new Application_Model_Categorievertaling();
        $vertalingModel->deleteById($id, "categorie_id");
        foreach ($data['translation'] as $key => $value) {
            $translated= !empty($value['titel'])?1:0;
            $dbFields=array(
                "categorie_id"   => $id,
                "taal_id"     => $key,
                "titel"       => trim($value['titel']),
                "vertaald"    => $translated
            );
            $vertalingModel->save($dbFields);
        }
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

    public function getAll($where=null, $order=null)
    {        
          $locale= Zend_Registry::get('Zend_Locale');
          $taalcode=(!empty($locale))?substr($locale,0,2):'nl';

            $sql = $this->db
            ->select()
            ->from(array('c' => 'categorie'), array('id', 'label', 'status') )
            ->join(array('v' => 'categorie_vertaling'), ' c.id = v.categorie_id  ', array('titel','vertaald', 'taal_id') )
            ->join(array('t' => 'taal'), ' t.id = v.taal_id  ', array('code') );
            $sql->where ('t.code = '."'".$taalcode."'");
            $sql->where ('c.status = 1');

            $data = $this->db->fetchAll($sql);
            
            $counter=0;
            foreach ($data as $d) {
                if ( empty($d['titel'])) {                   
                    $data[$counter]['titel']=$d['label'];
                }
                $counter++;
            }
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

     public function getAutocomplete($where=NULL){
        $categorie= parent::getAll($where);

	$matches = array();
        foreach ( $categorie as $c ) {
                        $c['id']  =trim($c['id']);
        		$c['naam']=trim($c['label']);
        		$c['value'] = trim($c['id']);
                        if ($c['status']) {
                            $c['label'] = trim($c['label']);
                        } else {
                            $c['label'] = "<span style='text-decoration:line-through;'>".trim($c['label'])."</span>";
                        }

			$matches[] = $c;
        }
        return $matches;
     }

}