<?php
class Application_Model_Gebruiker extends My_Model
{
    protected $_name = 'gebruiker'; //table name
    protected $_id   = 'id'; //primary key

    public function save($data,$id = NULL)
    {
        $dbFields = array(
                'naam'   => $currentTime,
                'leveringsadres'    => "xxxx",
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
    

    public function getAutocomplete($where=NULL){
        $user = parent::getAll($where);

	$matches = array();
        foreach ( $user as $u ) {
                        $u['id']  =trim($u['id']);
        		$u['naam']=trim($u['email']);
        		$u['value'] = trim($u['id']);
                        if ($u['status']==1) {
                            $u['label'] = trim($u['email']);
                        } else {
                            $u['label'] = "<span style='text-decoration:line-through;'>".trim($u['email'])."</span>";
                        }

			$matches[] = $u;
        }
        return $matches;
     }

     
     public function saveIdentifier($id){
        $eId = uniqid($id . '.', true);
        $dbFields = array(
            'eId' => $eId,
        );
        $this->updateById($dbFields,$id);
        return $eId;
    }

}