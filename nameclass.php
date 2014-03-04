<?php

/*
 *  Copyright 2014 A.J. Fite
 *  Please see the license file for more information.
 */

/**
 * Last name goes in, integer values come out.
 */
class name {
    /**
     * Array for calculating the group a given name falls in
     * 
     * @var array contains the last 3 letters accepted for a given rotation
     */
    protected $namearray = array("BOL","COH","ELZ","GRA","HUN","LAN","MCE","OLZ","RIC","SMH","VAL");
    
    /**
     * The last name entered
     * 
     * FIXME: NOT SANATIZED, this seems like a bad thing...
     * 
     * @var string $name
     */
    private $name;
    /**
     * The integer value of the name
     * @var int $nameval
     */
    private $nameval;
    
    /**
     * 
     * @param string $name The last name being queried
     * @throws Exception Invalid Name Entry Exception
     */
    public function __construct($name) {
        $this->name = $name;
        
        if(!$this->nameExsists()) {
            throw new Exception("Invalid name entry");
        }
               
        $this->nameval = $this->findNameVal();
    }
    
    /**
     * Checks if the name is valid
     * 
     * @return boolean is the name valid?
     */
    private function nameExsists() {
        
        if (ctype_alpha($this->name) && strlen($this->name) > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Finds the integer value of the last name for the rotation algo
     * 
     * @return int the value of the name (0-11)
     */
    private function findNameVal() {
        $subname = strtoupper(substr($this->name, 0, 3));
        
        //This just seems wrong, but I was lazy and it works (pull requests welcome)
        array_push($this->namearray, $subname); //sticks last name on end of array
        sort($this->namearray); //Sorts the array AAA->ZZZ
        return array_search($subname, $this->namearray); //Where is the name?
    }
    
    public function __toString() {
        return htmlspecialchars($this->name);
    }
    
    /**
     * The integer value of the name for the algo
     * 
     * @return int the value of the name (0-11)
     */
    public function getNameval() {
        return $this->nameval;
    }

}
