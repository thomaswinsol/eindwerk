<?php

class Application_Form_Lostpassword extends My_Form {

    public function init(){
        // set the defaults
        $this->setMethod(Zend_Form::METHOD_POST);
        //$this->setAttrib('enctype', 'multiparts/form-data');
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->setAction('/gebruiker/lostpassword');

        // element e-mail
        $this->addElement(new Zend_Form_Element_Text('email',array(
            'label'=>"lblEmail",
            'required'=>true,
            'size'=>35,
             'validators' => array(
                            array('EmailAddress',true)),
            'filters' => array('StringTrim')
            )));

         $this->setElementDecorators($this->elementDecorators);

         // element button
        $this->addElement(new Zend_Form_Element_Button('lostpassword', array(
            'type'=>"submit",
            'label'=>'btnVerzenden',
            'required'=> false,
            'ignore'=> true,
            'decorators'=>$this->buttonDecorators
            )));

    }

}

?>