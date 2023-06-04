<?php
require_once './SimpleForm.php';
require_once './SearchBox/SearchBox.php';
;

$sf = new SimpleForm\SimpleForm();

$options = [
    'Tehran' ,
    'Pecan' ,
    'Tokuo' ,
    'kabol' ,
];

$submits = [
    'subSave red' => 'Save' ,
    'http://www.faradars.org red' => 'FaraDars' ,
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

$sb = new SimpleForm\SearchBox\SearchBox();

$searchBox = $sb->create_searchbox ();

//echo $form;
//
//echo '<br/>----------------------------------------<br/>';
//
//echo '<p style="font-size: 25px;">'
// . htmlentities ($form)
// . '</p>';
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
