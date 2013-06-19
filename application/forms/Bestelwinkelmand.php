<?php
class Application_Form_Bestelwinkelmand extends My_Form  {
    
        public function init(){
        // set the defaults
        $this->setMethod(Zend_Form::METHOD_POST);
        //$this->setAttrib('enctype', 'multiparts/form-data');
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->setAction('/winkelmand/winkelmandtonen');

         // element Referentie
         $this->addElement(new Zend_Form_Element_Text('Referentie',array(
            'label'=>"lblReferentie",
            'size'=>30,
            'maxlength'=>30,
            'required'=>true,
            'filters' => array('StringTrim')
            )));
         $this->setElementDecorators($this->elementDecorators);

        // element button
        $this->addElement(new Zend_Form_Element_Button('Bestellen', array(
            'type'=>"submit",
            'label'=>'lblBestellen',
            'required'=> false,
            'ignore'=> true,
            'decorators'=>$this->buttonDecorators
            )));

         
        }

    public function loadDefaultDecorators()
    {
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table' ,'class' => 'frm_01','style' => 'width:50%;')),
            'Form',
        ));
    }
}
?>
