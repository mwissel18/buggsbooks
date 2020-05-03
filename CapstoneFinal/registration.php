<?php

if (!isset($fName)) { $fName = '' ;}
if (!isset($lName)) { $lName = '' ;}
if (!isset($uName)) { $uName = '' ;}
if (!isset($loginUName)) { $loginUName = '' ;}
if (!isset($email)) { $email = '' ;}
if (!isset ($password)) { $password="";}
if (!isset ($loginPassword)) { $loginPassword="";}
if (!isset($err['fName'])) { $err['fName']="";}
if (!isset($err['lName'])) { $err['lName']="";}
if (!isset($err['uName'])) { $err['uName']="";}
if (!isset($err['noEmail'])) { $err['noEmail']="";}
if (!isset($err['email'])) { $err['email']="";}
if (!isset($err['invalidEmail'])) { $err['invalidEmail']="";}
if (!isset($err['NameTaken'])) { $err['NameTaken']="";}
if (!isset($err['emailTaken'])) { $err['emailTaken']="";}
if (!isset($err['shortPass'])) { $err['shortPass']="";}
if (!isset($err['lcasePass'])) { $err['lcasePass']="";}
if (!isset($err['ucasePass'])) { $err['ucasePass']="";}
if (!isset($err['digPass'])) { $err['digPass']="";}
if (!isset($err['uNamefirstchar'])) { $err['uNamefirstchar']="";}
if (!isset($err['lNamefirstchar'])) { $err['lNamefirstchar']="";}
if (!isset($err['fNamefirstchar'])) { $err['fNamefirstchar']="";}

require_once('user_db.php');
$users = user_db::select_all_sorted();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Buggs Books</title>
        <link rel="stylesheet" type="text/css" href="yankee.css" />
    </head>
    <body>
        
        <?php include("Header.php"); ?>
        <div id="UsersBox">
              <?php foreach ($users as $user) : ?>
            <div id="UserBoxRow">
                <?php echo $user->getUName(); ?>
                <form action="index.php" method="POST">
                    <input type="hidden" name="user" value="<?php echo $user->getUName(); ?>">
                    <input type="hidden" name="action" value="goToProfile">
                    <input type="submit" value="view">
                </form>
            </div>
              
            <?php endforeach; ?>
        </div>
        <h1>Registration</h1>
        <form action="index.php" method="POST">
             <input type="hidden" name="action" value="register" />
            <label>User Name:</label>
            <input type="text" name="uName" value="<?php echo htmlspecialchars($uName); ?>">
            <label class="err"><?php echo htmlspecialchars($err['uName']);
                                     echo htmlspecialchars($err['NameTaken']);
                                      echo htmlspecialchars($err['uNamefirstchar']); ?></label><br>
            
            <label>Password</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
            <label class="err"><?php echo htmlspecialchars($err['shortPass']); 
                                      echo htmlspecialchars($err['lcasePass']);
                                      echo htmlspecialchars($err['ucasePass']);
                                      echo htmlspecialchars($err['digPass']);?></label><br>

            <label>First Name:</label>
            
            <input type="text" name="fName" value="<?php echo htmlspecialchars($fName); ?>">
            <label class="err"><?php echo htmlspecialchars($err['fName']);
                                         echo htmlspecialchars($err['fNamefirstchar']); ?></label>
            
            <br>
            <label>Last Name:</label>
              
            <input type="text" name="lName" value="<?php echo htmlspecialchars($lName); ?>">
            <label class="err"><?php echo htmlspecialchars($err['lName']);              
                                        echo htmlspecialchars($err['lNamefirstchar']) ?></label><br>
            
            <label>Email Address:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <label class="err"><?php echo htmlspecialchars($err['email']) . htmlspecialchars($err['emailTaken']); ?></label><br>
            
            <input type="submit" value="Register" style="float: right; margin-bottom: 30px; margin-left: 25px;"><br>
        </form>
        <div class="loginBox">
            <h1>Login</h1>
            <form action="index.php" method="POST">
             <input type="hidden" name="action" value="logIn" />
                <label>Username</label>
                <input type="text" name="loginUName">
                <label>Password</label>
                <input type="password" name="loginPassword">
                <input type="submit"  value="login">
            </form>
        </div>
        <p class="err"><?php echo $message;  ?></p>
        <br>
        <br>
        <br>
        <br>
        <form action="index.php" method="POST" >
            <input type="hidden" name="action" value="viewAllUsers">
            <input type="submit" value="View all Users">
        </form>
        
        
        
        
       <p><a href="index.php?action=dispProfile">Profile Page</a>
        
    </body>
</html>
