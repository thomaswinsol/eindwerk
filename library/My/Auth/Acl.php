<?php
/**
* Description of Acl
*
* @author webmaster
*/
class My_Auth_Acl extends Zend_Controller_Plugin_Abstract {
    //put your code here

    public function preDispatch(Zend_Controller_Request_Abstract $request) {

        // Op welke controllers heb je rechten
        $acl = new Zend_Acl();
        $acl->add(new Zend_Acl_Resource(My_Resources::ADMIN_MODULE));

        // roles
        $acl->addRole(new Zend_Acl_Role(My_Roles::ADMIN));
        $acl->addRole(new Zend_Acl_Role(My_Roles::GUEST));
        $acl->addRole(new Zend_Acl_Role(My_Roles::USER));

        /////////////////
        // permissions //
        /////////////////
        $acl->allow(My_Roles::ADMIN, array(
                                My_Resources::ADMIN_MODULE,
        ));

        Zend_Registry::set('Zend_Acl', $acl);

    }
}

?>
