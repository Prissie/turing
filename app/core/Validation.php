<?php

namespace app\core;

use app\core\Session as Session;

class Validation
{
  	private $data;
    private $errors = array();

    public  function setField($value, $field, $parameter = null)
    {
    	$this->data = array("value" => trim($value),
    						 "field" => $field,
    						 "parameter" => $parameter,
    						 );
    	return $this;
    }

    public  function required()
    {
    	if(empty($this->data['value'])){
    		$this->errors[] = sprintf("The field %s is required!", $this->data['field']);

    	}
    	return $this;
    }

    public function email()
    {
    	if(!filter_var($this->data['value'], FILTER_VALIDATE_EMAIL)){
    		$this->errors[] = sprintf("The field %s just accept one andress valid!", $this->data['field']);
    	}
    	return $this;
    }


    public function numeric()
    {
        if(!is_numeric($this->data['value'])){
         	$this->errors[] = sprintf("The field %s has been numeric!", $this->data['field']);
        }
     	return $this;
    }

    public function exactSize()
    {
    	if(!strlen($this->data['value'] == $this->data['parameter'])){
         	$this->errors[] = sprintf("The field %s has been the same size of %s!", $this->data['field'],$this->data['parameter']);
        }
    	return $this;
    }

    public function maxSize()
    {
        if(!strlen($this->data['value'] < $this->data['parameter'])){
            $this->erros[] = sprintf("The field %s has been smaller that %s!", $this->data['field'],$this->data['parameter']);
        }
        return $this;
    }

    public function comparar()
    {
        if(!($this->data['value'] == $this->data['parameter'])){
            $this->erros[] = sprintf("The field %s  has been the sames!", $this->data['field']);
        }
        return $this;
    }

    public function validate(){

    	if(empty($this->errors)){
    		return true;
    	}else{
    		return false;
    	}
    }
 
    public function getErros(){
        foreach ($this->errors as $error) {
            Session::add('fail', $error);
        }
        return $this->errors;
    }




    
}