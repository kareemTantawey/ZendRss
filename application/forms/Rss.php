<?php

class Application_Form_Rss extends Zend_Form
{

    public function init()
    {
        
/* Form Elements & Other Definitions Here ... */
        $id = new Zend_Form_Element_Hidden("id");

        $url = new Zend_Form_Element_Text("url");
        $url->setRequired();
        $url->setlabel("Site rss url:");
        $url->setAttrib("class",array("form-control"));
        $url->setAttrib("placeholder","Enter site rss url ...");


        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class","btn-lg btn-primary");
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib('class','form-horizontal');
        $this->addElements(array($id,$url,$submit));
    }


    


}

