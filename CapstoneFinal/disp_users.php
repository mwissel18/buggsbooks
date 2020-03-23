<?php
require_once('user_db.php');

$users = user_db::select_all();
?>
<!DOCTYPE html>
<html>


    <head>
        <title>Tweeter</title>
        <link rel="stylesheet" type="text/css" href="yankee.css" />
    </head>


    <body>
        <?php include("Header.php"); ?>
        <h2>Users List</h2>
        <table>
            <tr>
                <th>Username:</th>
                <th>First Name:</th>
                <th>Last Name:</th>
                <th>Email:</th>
            </tr>

            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><a href="index.php?action=goToProfile&user=<?php echo $user->getUName(); ?>"><?php echo $user->getUName(); ?></a></td>
                    <td><?php echo $user->getFName(); ?></td>
                    <td><?php echo $user->getLName(); ?></td>
                    <td><?php echo $user->getEmail(); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        
        <p><a href="index.php?action=register">Register</a></p>     
        <br>
        <p class="err"><?php echo $errorMessage;?></p>

    </body>
</html>