<?php
class Application_Form_Voegtoe extends My_Form  {
    
        public function init(){
        // set the defaults
        $this->setMethod(Zend_Form::METHOD_POST);
        //$this->setAttrib('enctype', 'multiparts/form-data');
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);

         // element Aantal
         $this->addElement(new Zend_Form_Element_Text('Aantal',array(
            'label'=>"txtAantal",
            'size'=>5,
            'maxlength'=>5,
            'required'=>true,
            'class'=>"onlyDecimals",
            'filters' => array('StringTrim')
            )));
         $this->setElementDecorators($this->elementDecorators);

        // element button
        $this->addElement(new Zend_Form_Element_Button('VoegToe', array(
            'type'=>"submit",
            'label'=>'',
            'required'=> false,
            'ignore'=> true,
            'class'=>'btnbasket',
            'decorators'=>$this->buttonDecorators
            )));

         
        }
}
?>
