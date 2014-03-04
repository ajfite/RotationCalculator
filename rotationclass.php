<?php

/* 
 *  Copyright 2014 A.J. Fite
 *  Please see the license file for more information.
 */

/*
 * TODO: Summer pattern
 * 
 * Theoretical summer pattern based off http://registrar.calpoly.edu/node/76
 * 
 * 1, 12, 7, 2, 9, 8, 3, 10, 5, 4, 11, 6
 */

/**
 * Class for calculating rotation numbers
 */
class rotation {
    /**
     * The base year that the algorithm calculates the pattern off of
     * 
     * TODO: Rewrite the algo so this isn't necessary anymore
     * 
     * @var int epoch year
     */
    protected $EPOCH_YEAR = 2012;
    /**
     * Used in the algorithim to offset the pattern based on years
     * since 2012
     * 
     * @var int number of quarters in a year
     */
    protected $YEAR_VALUE = 3;
    
    /**
     * The pattern used to find the rotation numbers
     * 
     * Note that 00 indicates summer which is not yet implemented
     * 
     * @var array the array pattern 
     */
    protected $pattern = [5,7,3,11,4,9,2,10,6,8,1,12];
    
    private $rotval;
    
    /**
     * Builds the rotation class for finding rotation numbers
     * 
     * @param int 4 digit year greater than 2012
     * @param int quarter number (use the constants in the quarter class)
     * @param int the name offset (0-11), calculated in the name class
     */
    public function __construct($year, $quarter, $nameval) {
        $this->rotval = ((($year - $this->EPOCH_YEAR) * $this->YEAR_VALUE) + $quarter + (8*$nameval));
        
        if($nameval >= 3 && $nameval <= 5) {
            $this->rotval += 6;
        } elseif ($nameval > 5 && $nameval < 9) {
            $this->rotval += 3;
        } elseif ($nameval > 8 && $nameval < 11) {
            $this->rotval += -3;
        } elseif ($nameval == 11) {
            $this->rotval += 9;
        }
        
        $this->rotval = $this->rotval % 12;
    
    }

    /**
     * Gives the rotation number
     * 
     * @return int Rotation number
     */
    public function getval() {
        return $this->pattern[(int)$this->rotval];
    }    
}

/**
 * Class containing the constants for quarter values
 * 
 * Summer is weird
 */
abstract class quarters {
   
    const WINTER = 1;
    const SPRING = 2;
    const SUMMER = 4; // WHY SUMMER WHY
    const FALL = 3;
}