<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="yankee.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="scripts/yankee.js"></script>
    </head>
    <body>
        <?php include("Header.php"); ?>
        <h1>Profile Page</h1>
        <img src="images/<?php echo htmlspecialchars(user_db::profilePic_search($user->getUName())) ?>" width="200" height="200"><br>
        <br>
        <br>
        <br>
        <table id="pageTable" style="margin-bottom: 25px; ">
         <?php foreach ($comments as $comment) : ?>
                <tr>
                    <td><?php echo $comment->getCommentTo(); ?></td>
                    <td><?php echo $comment->getCommentFrom(); ?></td>
                    <td><?php echo $comment->getCommentText(); ?></td>
                    <td><?php echo $comment->getCommentDate(); ?></td>              
                </tr>
            <?php endforeach; ?>
        </table>
        <form action='index.php' method='post'>
            <input type="hidden" name="action" value="addComment">

            <?php if ($loggedIn == true) { ?>
                <label>User Name:</label>
                <input type="text" name="uName" value="<?php echo htmlspecialchars($user->getuName()); ?>" ><br>
                <label>First Name:</label>
                <input type="text" name="fName" value="<?php echo htmlspecialchars($user->getFName()); ?>" >
                <br>
                <label>Last Name:</label>
                <input type="text" name="lName" value="<?php echo htmlspecialchars($user->getLName()); ?>" ><br>
                <label>Email Address:</label>
                <input type="text" name="email" value="<?php echo htmlspecialchars($user->getEmail()); ?>" >
                <br>
            <?php } else { ?>      
                <input type="text" name="uName" value="<?php echo htmlspecialchars($user->getuName()); ?>" disabled=""><br>
                <label>First Name:</label>
                <input type="text" name="fName" value="<?php echo htmlspecialchars($user->getFName()); ?>" disabled="">


                <br>
                <label>Last Name:</label>
                <input type="text" name="lName" value="<?php echo htmlspecialchars($user->getLName()); ?>" disabled="">
                <br>
                <label>Email Address:</label>
                <input type="text" name="email" value="<?php echo htmlspecialchars($user->getEmail()); ?>" disabled="">
            <?php } ?>
            <br>
           

            <?php if ($loggedIn == true) { ?>
                <textarea rows="10" cols="50" name="comment" placeholder="Comment on my profile!"></textarea>
            <?php } else { ?>      
                <textarea rows="10" cols="50" value="" placeholder="Log in to Comment on my profile!" disabled=""></textarea>
            <?php } ?>
            <br><br>
             <input type='submit' value='Comment'>
        </form>
    </body>
</html>
