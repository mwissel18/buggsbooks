<?php

require 'user_db.php';
require 'newDatabase.php';
require 'User.php';
require 'Comment.php';
session_start();
if (!isset($_SESSION['uName'])) {
    $_SESSION['uName'] = "";
}

$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == null) {
        $action = 'default';
    }
}

$message = "";

switch ($action) {
    case 'default':
        include('registration.php');
        die();



    case 'register':
        require_once('user_db.php');
        $users = user_db::select_all_sorted();
        $options = [
            //DO set a cost factor, experiment to find a number that is sufficiently high but doesn't kill your performance
            'cost' => 12
                //DON'T supply your own salt like this, let password_hash do that for you
                //'salt' => "notgoodnotgoodnotgoodnotgoodnotgood",
        ];

        $err = [];
        $welcomeMessage = "";
        $fName = filter_input(INPUT_POST, 'fName');
        $lName = filter_input(INPUT_POST, 'lName');
        $uName = filter_input(INPUT_POST, 'uName');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');


        if (preg_match('/^.{10}/', $password) != 1) {
            $err['shortPass'] = "Password must be at least 10 characters.";
        }
        if (preg_match('/[a-z]/', $password) != 1) {
            $err['lcasePass'] = "Your password must contain a lowercase letter.";
        }

        if (preg_match('/[A-Z]/', $password) != 1) {
            $err['ucasePass'] = "Your password must contain an Uppercase letter.";
        }

        if (preg_match('/[0-9]/', $password) != 1) {
            $err['digPass'] = "Your password must contain a digit.";
        }

        if ($fName == null || $fName == "") {
            $err['fName'] = "Enter a First Name";
        }
        if (preg_match('/^[a-zA-Z]/', $fName) != 1) {
            $err['fNamefirstchar'] = "First Name must begin with a letter";
        }
        if ($lName == null || $lName == "") {
            $err['lName'] = "Enter a last name";
        }
        if (preg_match('/^[a-zA-Z]/', $lName) != 1) {
            $err['lNamefirstchar'] = "Last Name must begin with a letter";
        }
        if (preg_match('/^.{4,30}$/', $uName) != 1) {
            $err['uName'] = "Username required,must be between 4 and 30 characters";
        }
        if (preg_match('/^[a-zA-Z]/', $uName) != 1) {
            $err['uNamefirstchar'] = "Username must begin with a letter";
        }
        if ($email == null || $email == "") {
            $err['noEmail'] = "Enter an Email";
        } else if ($email == false) {
            $err['invalidEmail'] = "Email is invalid";
        }
        if (user_db::search_by_username2($uName) === true) {
            $err['NameTaken'] = "Duplicate username, please try again";
        }
        if (user_db::search_by_email($email) === true) {
            $err['emailTaken'] = "Duplicate email, please try again";
        }

        if (empty($err)) {
            $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);
            $User = new User($fName, $lName, $uName, $email, $hashpass);
            user_db::insert_users($User);
            $welcomeMessage .= "Welcome to the site " . $fName . "!";
            include 'Confirmation.php';
        } else {
            include('registration.php');
        }


        die();
        break;



    case 'viewAllUsers':
        $errorMessage = filter_input(INPUT_GET, 'error');
        require_once "newDatabase.php";
        include 'disp_users.php';
        die();
        break;
    case 'dispProfile':

        if ($_SESSION['uName'] == "") {
            $message = "Please Login.";
            include 'registration.php';
        } else {
            $currUser = user_db::get_user($_SESSION['uName']);

            function get_file_list($path) {
                $files = array();
                if (!is_dir($path)) {
                    return $files;
                }
                $items = scandir($path);
                foreach ($items as $item) {
                    $item_path = $path . DIRECTORY_SEPARATOR . $item;
                    if (is_file($item_path)) {
                        $files[] = $item;
                    }
                }
                return $files;
            }

            if (isset($_FILES['image'])) {
                $errors = array();
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                $temp = $_FILES['image']['name'];
                $temp = explode('.', $temp);
                $temp = end($temp);
                $file_ext = strtolower($temp);

                var_dump($_FILES);

                $extensions = array("jpeg", "jpg", "png", "gif");

                if (in_array($file_ext, $extensions) === false) {
                    $errors[] = "file extension not in whitelist: " . join(',', $extensions);
                }

                if (empty($errors) == true) {
                    move_uploaded_file($file_tmp, "imageDir/" . $file_name);
                    echo "Success";
                } else {
                    var_dump($errors);
                }
            }

            $image_dir = 'images';
            $image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir;
            if (isset($_FILES['file1'])) {
                $filename = $_FILES['file1']['name'];
                if (empty($filename)) {
                    
                }
                $source = $_FILES['file1']['tmp_name'];
                $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
                move_uploaded_file($source, $target);

                // create the '400' and '100' versions of the image
                process_image($image_dir_path, $filename);
            }
            $files = get_file_list($image_dir_path);
            include 'profileUpdate.php';
        }
        die();
        break;



    case 'logIn':
        $loginUName = filter_input(INPUT_POST, 'loginUName');
        $loginPassword = filter_input(INPUT_POST, 'loginPassword');

        if (user_db::verify_UserPass($loginUName, $loginPassword)) {
            $_SESSION['uName'] = $loginUName;
            include 'profileUpdate.php';
        } else {
            $message = "Invalid login, please try again";
            include 'registration.php';
        }
        die();
        break;



    case 'uploadImage':

        $loginError = "";
        $uname = $_SESSION['uName'];

        if (isset($_FILES['image'])) {
            $errors = array();
            // Credit :  https://www.php.net/manual/en/function.uniqid.php
            $file_name = uniqid("", true) . $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $temp = $_FILES['image']['name'];
            $temp = explode('.', $temp);
            $temp = end($temp);
            $file_ext = strtolower($temp);
            $extensions = array("jpeg", "jpg", "png", "gif");
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "file extension not in whitelist: " . join(',', $extensions);
            }
            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "images/" . $file_name);
                user_db::insert_profile_pic($uname, $file_name);
            }
        }
        include 'profileUpdate.php';
        die();
        break;



    case 'update':
        $options = [
            //DO set a cost factor, experiment to find a number that is sufficiently high but doesn't kill your performance
            'cost' => 12
                //DON'T supply your own salt like this, let password_hash do that for you
                //'salt' => "notgoodnotgoodnotgoodnotgoodnotgood",
        ];
        $err = [];

        $fName = filter_input(INPUT_POST, 'fName');
        $lName = filter_input(INPUT_POST, 'lName');
        $uName = filter_input(INPUT_POST, 'uName');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $updatePass = filter_input(INPUT_POST, 'updatePass');
        $currUser = user_db::get_user($_SESSION['uName']);

        if ($updatePass == "yes") {
            if (preg_match('/^.{10}/', $password) != 1) {
                $err['shortPass'] = "Password must be at least 10 characters.";
            }
            if (preg_match('/[a-z]/', $password) != 1) {
                $err['lcasePass'] = "Your password must contain a lowercase letter.";
            }

            if (preg_match('/[A-Z]/', $password) != 1) {
                $err['ucasePass'] = "Your password must contain an Uppercase letter.";
            }

            if (preg_match('/[0-9]/', $password) != 1) {
                $err['digPass'] = "Your password must contain a digit.";
            }
        }
        if ($fName == null || $fName == "") {
            $err['fName'] = "Enter a First Name";
        }
        if (preg_match('/^[a-zA-Z]/', $fName) != 1) {
            $err['fNamefirstchar'] = "First Name must begin with a letter";
        }
        if ($lName == null || $lName == "") {
            $err['lName'] = "Enter a last name";
        }
        if (preg_match('/^[a-zA-Z]/', $lName) != 1) {
            $err['lNamefirstchar'] = "Last Name must begin with a letter";
        }

        if ($email == null || $email == "") {
            $err['noEmail'] = "Enter an Email";
        } else if ($email == false) {
            $err['invalidEmail'] = "Email is invalid";
        }



        if (empty($err)) {
            if ($updatePass == "yes") {
                $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);
                $User = new User($fName, $lName, $_SESSION['uName'], $email, $hashpass);
            } else {
                $User = new User($fName, $lName, $currUser->getUName(), $email, $currUser->getPassword());
            }
            user_db::update_User($User);
            $welcomeMessage = "Welcome to the site " . $fName . "!";
            include 'Confirmation.php';
        } else {

            include('profileUpdate.php');
        }

        die();
        break;



    case "goToProfile":



    case "goToProfile":
        $userName = filter_input(INPUT_POST, 'user');
        if ($userName == null) {
            $userName = filter_input(INPUT_GET, 'user');
            if ($userName === null || empty($userName)) {
                $errorMessage = 'Error try again';
                include 'disp_users.php';
                die();
            }
        }
       $user = user_db::get_user($userName);
        $loggedIn = false;
        $comments = user_db::get_comments_by_username($userName);

        if ($_SESSION['uName'] != "") {
            $loggedIn = true;
        }
        include('profile.php');
        die();
        break;



    case 'logOut':
        $_SESSION['uName'] = "";
        include 'Logout.php';
        die();
        break;


    case 'myProfile':
        if ($_SESSION['uName'] === "") {
            $message = "Please log in to view your profile.";
            include 'registration.php';
        } else {
            $user = user_db::get_user($_SESSION['uName']);
            $loggedIn = true;
            $comments = user_db::get_comments_by_username($_SESSION['uName']);

            include('profile.php');
        }
        die();
        break;
    case 'addComment':

        $commentDate = date("Y-m-d H:i:s");

        $commentTo = filter_input(INPUT_POST, 'uName');
        $commentFrom = $_SESSION['uName'];
        $commentText = filter_input(INPUT_POST, 'comment');

        user_db::add_comment($commentTo, $commentFrom, $commentText, $commentDate);
        $comments = user_db::get_comments_by_username($commentTo);
        $user = user_db::get_user($commentTo);
        include('profile.php');
        die();
        break;

    case 'editProfile':

        include 'profileUpdate.php';

        die();
        break;
}
