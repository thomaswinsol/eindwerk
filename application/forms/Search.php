<?php
class Application_Form_Search extends My_Form  {

    
    public function init()
    {
        // set the defaults
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->setAction('/index/home');

        // element categorie
        $categorieModel = new Application_Model_Categorie();
        $defaultOptions = array('key'=> 'id', 'value' =>'titel', 'emptyRow' => True);
        $categorie = $categorieModel->buildSelect($defaultOptions);
        $elem = new Zend_Form_Element_Select('Categorie');
        $elem->setLabel('txtCategorie')
             ->setMultiOptions($categorie);
        $this->addElement($elem);

          // element titel
        $this->addElement(new Zend_Form_Element_Text('titel',array(
            'label'=>"txtTitel",
            'filters' => array('StringTrim'),
            'validators' => array( array('StringLength',true, array('max'=>255)))
            )));

         // element productstatus
        $productstatusModel = new Application_Model_Productstatus();
        $defaultOptions = array('key'=> 'id', 'value' =>'omschrijving', 'emptyRow' => True);
        $where='id>2 and status=1';
        $productstatus = $productstatusModel->buildSelect($defaultOptions,$where);
        $elem = new Zend_Form_Element_Select('status');
        $elem->setLabel('txtExtra')
             ->setMultiOptions($productstatus);
        $this->addElement($elem);

        $this->setElementDecorators($this->elementDecorators);

        // element ID
        $this->addElement(new Zend_Form_Element_Hidden('ID',array()));
        
        // button zoeken
        $this->addElement(new Zend_Form_Element_Button('Zoeken', array(
            'type'=>"submit",
            'required'=> false,
            'ignore'=> true,
            'decorators'=>$this->buttonDecorators
            )));
        }

    public function loadDefaultDecorators()
    {
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table' ,'class' => 'frm_01','style' => 'width:30%;')),
            'Form',
        ));
    }
}
?>
