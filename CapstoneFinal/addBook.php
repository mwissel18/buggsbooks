<?php

if (!isset($title)) { $title = '' ;}
if (!isset($isbn)) { $isbn = '' ;}
if (!isset($genre)) { $genre = '' ;}
if (!isset($arPoints)) { $arPoints = '' ;}
if (!isset ($readingLevel)) { $readingLevel="";}
if (!isset ($description)) { $description="";}
if (!isset ($numCopies)) { $numCopies="";}
//if (!isset($err['fName'])) { $err['fName']="";}
//if (!isset($err['lName'])) { $err['lName']="";}
//if (!isset($err['uName'])) { $err['uName']="";}
//if (!isset($err['noEmail'])) { $err['noEmail']="";}
//if (!isset($err['email'])) { $err['email']="";}
//if (!isset($err['invalidEmail'])) { $err['invalidEmail']="";}
//if (!isset($err['NameTaken'])) { $err['NameTaken']="";}
//if (!isset($err['emailTaken'])) { $err['emailTaken']="";}
//if (!isset($err['shortPass'])) { $err['shortPass']="";}
//if (!isset($err['lcasePass'])) { $err['lcasePass']="";}
//if (!isset($err['ucasePass'])) { $err['ucasePass']="";}
//if (!isset($err['digPass'])) { $err['digPass']="";}
//if (!isset($err['uNamefirstchar'])) { $err['uNamefirstchar']="";}
//if (!isset($err['lNamefirstchar'])) { $err['lNamefirstchar']="";}
//if (!isset($err['fNamefirstchar'])) { $err['fNamefirstchar']="";}
//
//require_once('user_db.php');
//$users = user_db::select_all_sorted();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Von Lau Library</title>
        <link rel="stylesheet" type="text/css" href="yankee.css" />
    </head>
    <body>
        
        <?php include("Header.php"); ?>
        
        <h1>New Book:</h1>
        <form action="index.php" method="POST">
             <input type="hidden" name="action" value="register" />
            <label>Book Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
            <br>
            
            <label>ISBN</label>
            <input type="text" name="ISBN" value="<?php echo htmlspecialchars($isbn); ?>">
            <br>

            <label>Book Condition:</label>
            <label>Excellent</label>
            <input type="radio" name="condition" checked value="excellent">
            <label>| Good</label>
            <input type="radio"  name="condition" value="good">
            <label>| Fair</label>
            <input type="radio"  name="condition" value="fair">
            <label>| Poor</label>
            <input type="radio"  name="condition" value="poor">
            <label>| Bad</label>
            <input type="radio"  name="condition" value="bad">
            <br>
            
            <br>
            <label>Recommended?</label>
            <label>Yes</label>
            <input type="radio" name="recommended" checked value="yes">
            <label>No</label>
            <input type="radio"  name="recommended" value="no">
            <br>
            <label>Genre:</label>
            <input type="text" name="genre" value="<?php echo htmlspecialchars($genre); ?>">
            
            <br>
            <label>AR Points:</label>
            <input type="text" name="arPoints" value="<?php echo htmlspecialchars($arPoints); ?>">
            
            <br>
            <label>Reading Level:</label>
            <input type="text" name="readingLevel" value="<?php echo htmlspecialchars($readingLevel); ?>">
            
            <br>
            <label>Description:</label>
            <textarea rows="10" cols="50" name="description" placeholder="Describe this book:"></textarea>
            <br>
            <label>Number of Copies</label>
            <input type="text" name="numCopies" value="<?php echo htmlspecialchars($numCopies); ?>"
            <br>
            <br>
            <input type="submit" value="Add Book" style="float: right; margin-bottom: 30px; margin-left: 25px;"><br>
        </form>
        
        
        <br>
        <br>
        <br>
        <br>
        <form action="index.php" method="POST" >
            <input type="hidden" name="action" value="viewAllBooks">
            <input type="submit" value="View all Books">
        </form>
        
        
        
        
       
        
    </body>
</html>
