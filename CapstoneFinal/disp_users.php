<?php
require_once('user_db.php');

$books = book_db::select_all();
?>
<!DOCTYPE html>
<html>


    <head>
        <title>Von Lau Library</title>
        <link rel="stylesheet" type="text/css" href="yankee.css" />
    </head>


    <body>
        <?php include("Header.php"); ?>
        <h2>Book List</h2>
        <table>
            <tr>
                <th>Title:</th>
                <th>ISBN:</th>
                <th>Condition:</th>
                <th>Genre:</th>
                <th>AR Points:</th>
                <th>Reading Level:</th>
                <th>Description:</th>
                <th>Number of Copies:</th>
            </tr>

            <?php foreach ($books as $book) : ?>
                <tr>
                    <td><?php echo $book->getTitle(); ?></a></td>
                    <td><?php echo $book->getISBN(); ?></td>
                    <td><?php echo $book->getCondition(); ?></td>
                    <td><?php echo $book->getGenre(); ?></td>
                    <td><?php echo $book->getARPoints(); ?></td>
                    <td><?php echo $book->getReadingLevel(); ?></td>
                    <td><?php echo $book->getDescription(); ?></td>
                    <td><?php echo $book->getNumCopied(); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        
        <p><a href="index.php?action=register">Register</a></p>     
        <br>
        <p class="err"><?php echo $errorMessage;?></p>

    </body>
</html>