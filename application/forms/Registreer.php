<?php

class Application_Form_Registreer extends My_Form {

    public function init(){
        // set the defaults
        $this->setMethod(Zend_Form::METHOD_POST);
        //$this->setAttrib('enctype', 'multiparts/form-data');
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->setAction('/gebruiker/register');

        // element e-mail
        $this->addElement(new Zend_Form_Element_Text('email',array(
            'label'=>"lblEmail",
            'required'=>true,
            'size'=>35,
             'validators' => array(
                            array('EmailAddress',true)),
            // filters
            'filters' => array('StringTrim')
            )));

        // element naam
        $this->addElement(new Zend_Form_Element_Text('naam',array(
            'label'=>"lblVoornaam",
            'required'=>true,
            'filters' => array('StringTrim')
            )));

        // element wachtwoord
        $this->addElement(new Zend_Form_Element_Password('paswoord',array(
            'label'=>"lblPaswoord",
            'required'=>true,
            // filters
            'filters' => array('StringTrim')
            )));

         $this->setElementDecorators($this->elementDecorators);

         // element button
        $this->addElement(new Zend_Form_Element_Button('register', array(
            'type'=>"submit",
            'label'=>'btnRegister',
            'required'=> false,
            'ignore'=> true,
            'decorators'=>$this->buttonDecorators
            )));

    }

}

?>