<?php

// this file has been deprecated, but thanks to github we can't delete it ;)



    $dsn = 'mysql:host=localhost;dbname=yankee';
    $username = 'root';
    $password = '';

    try {
        $db= new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
        //Displays the exception and keeps on rolling, uncomment the exit if you want it to halt instead
        //exit();
    }
    
//    function select_all()
//    {
//        global $db;
// 
//      $query = 'SELECT * FROM users';
//      $statement = $db->prepare($query);
//      $statement->execute();
//      $results =  $statement->fetchAll();
//      return $results;
//    }
//    
//    function insert_users($uName, $fName, $lName, $email)
//    {
//        global $db;
// 
//      $query = 'INSERT INTO users
//                 (uName, fName, lName, email)
//              VALUES
//                 (:uName, :fName, :lName, :email)';
//    $statement = $db->prepare($query);
//    $statement->bindValue(':uName', $uName);
//    $statement->bindValue(':fName', $fName);
//    $statement->bindValue(':lName', $lName);
//    $statement->bindValue(':email', $email);
//    $statement->execute();
//    $statement->closeCursor();
//
//    }
//    
//    function search_by_username($uName)
//    {
//        global $db;
// 
//      $query = 'SELECT * FROM users where uName = :uName';
//      $statement = $db->prepare($query);
//      $statement->bindValue(':uName', $uName);
//      $statement->execute();
//      $results =  $statement->fetchAll();
//      if (empty($results) ) {
//          return false;
//      } else if( $results[0]['uName'] === $uName) {
//          return true;
//      }
//      
//    }
//    
//    function search_by_email($email)
//    {
//        global $db;
// 
//      $query = 'SELECT * FROM users where email = :email';
//      $statement = $db->prepare($query);
//      $statement->bindValue(':email', $email);
//      $statement->execute();
//      $results =  $statement->fetchAll();
//      if (empty($results)) {
//          return false;
//      } else if ( $results[0]['email'] === $email){
//          return true;
//      }
//      
//    }
//
//?>
