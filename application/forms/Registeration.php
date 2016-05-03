<?php

class Application_Form_Registeration extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $id = $this->createElement('hidden','id');
        $name = $this->createElement('text','name');
        $name->setLabel('Name:')
                    ->setRequired(true)
                    ->addFilter('StripTags');
        $name->setAttrib("class", "form-control");
        $name->setAttrib("placeholder", "Name");
        
        $email = $this->createElement('text','email');
        $email->setLabel('Email: *')
                ->setRequired(true);
        $email->addValidator(new Zend_Validate_EmailAddress());
		$email->addValidator(new Zend_Validate_Db_NoRecordExists(array(
					'table' => 'users',
					'field' => 'email',
				)));
        $email->setAttrib("class", "form-control");
        $email->setAttrib("placeholder", "Email");
                
        
                
        $password = $this->createElement('password','password');
        $password->setLabel('Password: *')
                ->setRequired(true);
        $password->setAttrib("class", "form-control");
        $password->setAttrib("placeholder", "Password");
        
        $gender =new Zend_Form_Element_Radio("gender");
        $gender->addFilter(new Zend_Filter_StringTrim())
        ->setMultiOptions(array('male'=>'Male', 'female'=>'Female'))
        ->setAttrib("name", "gender")
        ->setRequired(true)
        ->setDecorators(array( array('ViewHelper') ));
       
       
        
        $image = new Zend_File_Transfer_Adapter_Http();
        $image = new Zend_Form_Element_File('image');
        $image->setLabel("Upload Image ")
            ->setRequired(true)               
            ->addValidator('Extension',false,'jpg,png,gif,jpeg')
            ->setDestination("/var/www/html/zend/zend_task/public/images")
            ->addValidator('Count',false,1) //ensure only 1 file
            ->addValidator('Size',false,102400*100) //limit to 100K
            ->getValidator('Extension')->setMessage('This file type is not supportted.');

        
           
                
        $register = $this->createElement('submit','register');
        $register->setLabel('Submit');
        $register->setAttrib("class", "btn btn-primary")
                                ->setIgnore(true);
                
                
        $this->addElements(array(
                        $name,
                        $email,
                        $password,
                        $gender,
                        $image,
                        $register,
                        $id
        ));
    }

}

