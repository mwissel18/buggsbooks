<?php
if (!isset($fName)) {
    $fName = '';
}
if (!isset($lName)) {
    $lName = '';
}
if (!isset($uName)) {
    $uName = '';
}
if (!isset($email)) {
    $email = '';
}
if (!isset($err['fName'])) {
    $err['fName'] = "";
}
if (!isset($err['lName'])) {
    $err['lName'] = "";
}
if (!isset($err['uName'])) {
    $err['uName'] = "";
}
if (!isset($err['noEmail'])) {
    $err['noEmail'] = "";
}
if (!isset($err['shortPass'])) { $err['shortPass']="";}
if (!isset($err['lcasePass'])) { $err['lcasePass']="";}
if (!isset($err['ucasePass'])) { $err['ucasePass']="";}
if (!isset($err['digPass'])) { $err['digPass']="";}
if (!isset($err['invalidEmail'])) {
    $err['invalidEmail'] = "";
}
if (!isset($err['NameTaken'])) {
    $err['NameTaken'] = "";
}
if (!isset($err['emailTaken'])) {
    $err['emailTaken'] = "";
}
$currUser = user_db::get_user($_SESSION['uName']);
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tweeter</title>
        <link rel="stylesheet" type="text/css" href="yankee.css" />
    </head>
    <body>
        <?php include("Header.php"); ?>
        <h1>Profile Page</h1>
        
        
        <img src="images/<?php echo htmlspecialchars(user_db::profilePic_search($currUser->getUName()))?>" width="200" height="200"><br>
        <br>
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="uploadImage"/>
            <input type="file" name="image" />
            
            <input type="submit" value="Update Pic"/>
        </form><br>
        <br>



        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="update">
            <label>User Name:</label>
            <input type="text" name="uName" value="<?php echo htmlspecialchars($currUser->getuName()); ?>" disabled="">
            <br>

            <label>First Name:</label>

            <input type="text" name="fName" value="<?php echo htmlspecialchars($currUser->getFName()); ?>">
            <label class="err"><?php echo htmlspecialchars($err['fName']); ?></label>

            <br>
            <label>Last Name:</label>

            <input type="text" name="lName" value="<?php echo htmlspecialchars($currUser->getLName()); ?>">
            <label class="err"><?php echo htmlspecialchars($err['lName']); ?></label><br>

            <label>Email Address:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($currUser->getEmail()); ?>">
            <label class="err"><?php echo htmlspecialchars($err['noEmail']); ?></label><br>
            <label>Password<label>
            <input type="text" name="password">
             <label class="err"><?php echo htmlspecialchars($err['shortPass']); 
                                      echo htmlspecialchars($err['lcasePass']);
                                      echo htmlspecialchars($err['ucasePass']);
                                      echo htmlspecialchars($err['digPass']);?></label><br>
            <label>Update Password?</label>
            <label>yes</label>
            <input type="radio" name="updatePass" value="yes">
            <label>no</label>
            <input type="radio"  name="updatePass"  checked value="no">
            
            <input type="submit" value="Update"><br>
        </form>
        <p><a href="index.php?action=viewAllUsers">Users List</a></p>     
    </body>
</html>
