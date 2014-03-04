<?php

/*
 *  Copyright 2014 A.J. Fite
 *  Please see the license file for more information.
 * 
 *  This file is ugly and was thrown together rather quickly
 */

require 'nameclass.php';
require 'rotationclass.php';

use name;
use rotation;

//My not so graceful method of checking for input
try {
    $name = new name(filter_input(INPUT_GET,"lastname"));
} catch (Exception $e) {
    $name = null;
}

/* TODO: Make this user configurable, currently it just calculates 15
 * years past the current year.
 */
$startyear = date("Y") - 1;
$endyear = $startyear + 21;

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cal Poly Rotation Schedule Calculator</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="rot.css" type="text/css">
    </head>
    <body>
        <header><h1>Cal Poly Rotation Schedule</h1></header>

        <form id="info" method="get" action="index.php">
            <input type="text" placeholder="Last Name" id="lastname" name="lastname" />
            <button type="submit">Find my rotations!</button>
        </form>

            <?php if ($name != null): ?>

        <h2>Rotations for <?php echo $name; ?></h2>
        <p>Summer uses a different rotation pattern, I am working on finding the future rotation schedule for summer, until then summer is not computed by this application.</p>
                <table>
                    <thead>
                        <tr>
                            <td>Year</td>
                            <td>Winter</td>
                            <td>Spring</td>
                            <td>Fall</td>
                            <td>Summer</td>
                        </tr>
                    </thead>
                <?php for($year = $startyear; $year <= $endyear; $year++): ?>
                    <tr id="<?php echo $year; ?>">
                        <td><?php echo $year; ?></td>
                    <?php for($quarter = 0; $quarter < 3; $quarter++): 
                            $rot = new rotation($year, $quarter, $name->getNameval()); 
                            ?>
                            
                            <td><?php echo $rot->getval(); ?></td>
                        <?php //endif; 
                        endfor; ?>
                            <td>Coming soon</td>
                    </tr>
                <?php endfor; ?>
                </table>

            <?php else: ?>
                <p>Error in last name entry, last names may only contain letters!</p>
            <?php endif; ?>

        <footer>
            <p>Ghetto Fabulous V1.2 - Now with more correctness and less eye bleeding!</p>
            <p>&copy; 2014 <a href="http://ajfite.com">A.J. Fite</a> (OPEN SOURCE COMING SOON) -- <a href="LICENSE.html">License</a></p>
        </footer>
</body>
</html>