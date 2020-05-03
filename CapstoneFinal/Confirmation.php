<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

    <html>
        <head>
            <meta charset="UTF-8">
            <title>Buggs Books</title>
            <link rel="stylesheet" type="text/css" href="yankee.css"/>
        </head>
        <body>
            <label> <?php
    echo htmlspecialchars($welcomeMessage);
    ?> </label>
        <a href="index.php?action=register">Home</a>
        <a href="index.php?action=viewAllUsers">See all Users</a>
    </body>
</html>
