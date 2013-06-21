<?php
class Application_Form_Search extends My_Form  {

    
    public function init()
    {
        // set the defaults
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->setAction('/index/home');

        // element ID
        $this->addElement(new Zend_Form_Element_Hidden('ID',array( )));
        // element Categorie
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

        $this->setElementDecorators($this->elementDecorators);

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
