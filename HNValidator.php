<?php
/*
/   Class validator
/   Avaiable: required, email, size, between, min, max, regex
*/

class HNValidator {
    private $rules, $errors, $attributes;
    
    public function __construct($rules, $attributes) {
        $this->rules = $rules;
        $this->attributes = $attributes;
    }   
    
    // TODO: process validate
    public function validate(){
        foreach ($this->rules as $k => $values) {
            $content = $this->attributes[$k];
            foreach ($values as $v) {
                    $errFound = false;
                    switch ($v) {
                        case "required":
                            if($this->required($content) == false) {
                                $this->errors[] = array($k => $k .' must not be empty');
                                $errFound = true;
                             }
                            break;
                        case "email":
                            if($this->email($content) == false) {
                                $this->errors[] = array($k => $k .' is not a valid');
                                $errFound = true;
                            }
                            break;
                        case (strpos($v,"between") !== false):
                            if($this->between($content, $v[8], $v[10]) == false) {
                                $this->errors[] = array($k => $k .' lenght is not between ' .$v[8] .' and ' .$v[10]);
                                $errFound = true;
                            }
                            break;
                        case (strpos($v,"max") !== false):
                            if($this->max($content, $v[4]) == false) {
                                $this->errors[] = array($k => $k .' lenght is exceed ' .$v[4]);
                                $errFound = true;
                            }
                            break;
                        case (strpos($v,"min") !== false):
                            if($this->min($content, $v[4]) == false) {
                                $this->errors[] = array($k => $k.' lenght is less than ' .$v[4]);
                                $errFound = true;
                            }
                            break;
                        case (strpos($v,"size") !== false):
                            if($this->size($content, $v[5]) == false) {
                                $this->errors[] = array($k => $k.' lenght is not ' .$v[4]);
                                $errFound = true;
                            }
                            break;
                        case (strpos($v,"regex") !== false):
                            $regexLen = strlen($v)-7;
                            $pattern = substr($v,6,$regexLen);
                            if($this->regex($content, $pattern) == false) {
                                $this->errors[] = array($k => $k.' is invalid');
                                $errFound = true;
                            }
                            break;
                    }                
                if ($errFound) {
                    break;
                }
            }
        }
        
        return $this->errors;
    }
    
    // TODO: Add error into validator
    public function addError($att, $error) {
        $this->errors[] = array($att, $error);
    }
    
    
    // <!-- Validate condition area -->
    private function required($val) {
        if($val) {
            return true;
        } else return false;
    }
    
    private function size($val, $len) {
        return (strlen($val) == $len);
    }
    
    private function regex($val, $pattern) {
        if (preg_match($pattern, $val)) {
            return true;
        } else return false;
    }
    
    private function min($val, $len) {
        return (strlen($val) >= $len);
    }
    
    private function max($val, $len) {
        return (strlen($val) <= $len);
    }
                       
    private function between($val, $min, $max) {
        $strLen = strlen($val);
        return ($strLen >= min && $strLen <= $max);
    }
    
    private function email($val) {
        return filter_var($val, FILTER_VALIDATE_EMAIL);
    }
}