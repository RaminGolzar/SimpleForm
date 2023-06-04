<?php
require_once './SimpleForm.php';
require_once './SearchBox/SearchBox.php';

/* ----------------------------------------------------------------------
 * SimpleForm
 * ----------------------------------------------------------------------
 */

$sf = new SimpleForm\SimpleForm();

/* these options for dropdown method */
$options = [
    'Tehran' ,
    'Pecan' ,
    'Tokuo' ,
    'kabol' ,
];

/* this array for submit method */
$submits = [
    'subSave green' => 'Save' ,
    'http://www.google.com red' => 'Google' ,
];

$form = $sf->Heading ('New Form')
        ->text ('txt1' , 'Name:' , '111111' , 'Your Name')
        ->email ('txt2' , 'Email:' , '222222' , 'Your Email')
        ->password ('txtPass' , 'Pass:' , 'Password' , 'Your Password')
        ->textarea ('txtAddress' , 'Address' , 'ADDR' , 'Your Address')
        ->radio ('rdo1' , 'Iran' , 'iran' , true)
        ->radio ('rdo1' , 'American' , 'american' , false)
        ->checkbox ('chk1' , 'PHP' , 'php' , true)
        ->checkbox ('chk2' , 'python' , 'python' , false)
        ->checkbox ('chk3' , 'js' , 'js' , false)
        ->dropdown ('drop1' , 'Provinces: ' , $options , 'kabol')
        ->hidden ('hide1' , 2222)
        ->submit ($submits)
        ->get_form ();

/* ----------------------------------------------------------------------
 * SearchBox
 * ----------------------------------------------------------------------
 */

$sb = new SimpleForm\SearchBox\SearchBox();

$searchBox = $sb->create_searchbox ();
?>

<html>
    <head>
        <title>Simple Form</title>
        <link rel="stylesheet" href="./w3.css/w3.css"/>
    </head>
    <body>
        <?= $form?>

        <?= $searchBox?>
    </body>
</html>
