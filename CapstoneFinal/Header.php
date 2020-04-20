
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        $loggedIn = false;
                
        if ($_SESSION['uName'] !== "" ) {
            
            $loggedIn = true;
        }
        
        ?>
        
        <div class="navbar">
            
                <div class="navItem">
                    <a href="index.php">Home</a>
                </div>
                <div class="navItem">
                    <a href="index.php?action=viewAllUsers">View Users</a>
                </div>
                <div class="navItem">
                    <a href="index.php?action=myProfile">Profile</a>
                </div>
                <div class="navItem">
                    <a href="index.php?action=logOut">Logout</a>
               </div>
            <?php if ($loggedIn == true) { ?>
            <div class="navItem">
                    <a href="index.php?action=editProfile">Edit Profile</a>
               </div>
            <?php } ?>
            
        </div>
    </body>
</html>
