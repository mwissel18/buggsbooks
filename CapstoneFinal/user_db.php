<?php

class user_db {

    public static function select_all() {

        $db = newDatabase::getDB();

        $query = 'SELECT * FROM users';
        $statement = $db->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();
        $user0 = [];

        foreach ($users as $value) {
            $user0[$value['uName']] = new User($value['fName'], $value['lName'], $value['uName'], $value['email'], $value['password']);
        }
        $statement->closeCursor();
        return $user0;
    }

    public static function insert_users($user) {
        $db = newDatabase::getDB();
        /* @var $user User */
        $query = 'INSERT INTO users
                 (uName, fName, lName, email, password)
              VALUES
                 (:uName, :fName, :lName, :email, :password)';
        $statement = $db->prepare($query);
        $statement->bindValue(':uName', $user->getUName());
        $statement->bindValue(':fName', $user->getFName());
        $statement->bindValue(':lName', $user->getLName());
        $statement->bindValue(':email', $user->getEmail());
        $statement->bindValue(':password', $user->getPassword());

        $statement->execute();
        $statement->closeCursor();
    }

    public static function search_by_username2($uName) {
        $db = newDatabase::getDB();
        $query = 'SELECT * FROM users where uName = :uName';
        $statement = $db->prepare($query);
        $statement->bindValue(':uName', $uName);
        $statement->execute();
        $results = $statement->fetchAll();
        if (empty($results)) {
            return false;
        } else if ($results[0]['uName'] === $uName) {
            return true;
        }
    }

    public static function verify_UserPass($uName, $Password) {
        $db = newDatabase::getDB();
        $query = 'SELECT * FROM users where uName = :uName';
        $statement = $db->prepare($query);
        $statement->bindValue(':uName', $uName);
        $statement->execute();
        $results = $statement->fetchAll();
        if (empty($results)) {
            return false;
        }
        if ($results[0]['uName'] === $uName && password_verify($Password, $results[0]['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function get_user($uName) {
        $db = newDatabase::getDB();
        $query = 'SELECT * FROM users where uName = :uName';
        $statement = $db->prepare($query);
        $statement->bindValue(':uName', $uName);
        $statement->execute();
        $results = $statement->fetchAll();
        if (empty($results)) {
            return false;
        } else {
            $User = new User($results[0]['fName'], $results[0]['lName'], $results[0]['uName'], $results[0]['email'], $results[0]['password'], $results[0]['profilePic']);
        }
        return $User;
    }

    public static function search_by_email($email) {
        $db = newDatabase::getDB();

        $query = 'SELECT * FROM users where email = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $results = $statement->fetchAll();
        if (empty($results)) {
            return false;
        } else if ($results[0]['email'] === $email) {
            return true;
        }
    }

    public static function insert_profile_pic($uName, $pic) {
        $db = newDatabase::getDB();

        $query = 'update users 
                  set profilePic = :pic
                  where uName = :uName';
        $statement = $db->prepare($query);
        $statement->bindValue(':uName', $uName);
        $statement->bindValue(':pic', $pic);
        $statement->execute();
        $results = $statement->fetchAll();
    }

    public static function update_User($user) {
        $db = newDatabase::getDB();
        /* @var $user User */
        $query = 'Update users
            set uName = :uName,
            fName = :fName,
            lName = :lName,
            email = :email,
            password = :password
            where uName = :uName';

        $statement = $db->prepare($query);
        $statement->bindValue(':uName', $user->getUName());
        $statement->bindValue(':fName', $user->getFName());
        $statement->bindValue(':lName', $user->getLName());
        $statement->bindValue(':email', $user->getEmail());
        $statement->bindValue(':password', $user->getPassword());

        $statement->execute();
        $statement->closeCursor();
    }

    public static function profilePic_search($uName) {
        $db = newDatabase::getDB();
        $query = 'Select profilePic 
                 From Users 
                 Where uName = :uName';
        $statement = $db->prepare($query);
        $statement->bindValue(':uName', $uName);
        $statement->execute();
        $results = $statement->fetch();
        return $results[0];
    }

    public static function add_comment($commentTo, $commentFrom, $commentText, $commentDate) {
        $db = newDatabase::getDB();

        $query = 'INSERT INTO comments
                 (commentFrom, commentTo, commentText, commentDate)
              VALUES
                 (:commentFrom, :commentTo, :commentText, :commentDate)';

        $statement = $db->prepare($query);
        $statement->bindValue(':commentTo', $commentTo);
        $statement->bindValue(':commentFrom', $commentFrom);
        $statement->bindValue(':commentText', $commentText);
        $statement->bindValue(':commentDate', $commentDate);

        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function get_comments_by_username($uName) {
        $db = newDatabase::getDB();
        $query = 'SELECT * FROM comments where commentTo = :uName';
        $statement = $db->prepare($query);
        $statement->bindValue(':uName', $uName);
        $statement->execute();
        $comments = $statement->fetchAll();
        $comments0 = [];
        foreach ($comments as $value) {
            $comments0[$value['CommentID']] = new Comment($value['CommentID'], $value['commentFrom'], $value['commentTo'], $value['commentText'], $value['commentDate']);
        }
        $statement->closeCursor();
        
        return $comments0;
    }
    
    public static function select_all_sorted() {

        $db = newDatabase::getDB();

        $query = 'SELECT * FROM users
                   order by lName';
        $statement = $db->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();
        $user0 = [];

        foreach ($users as $value) {
            $user0[$value['uName']] = new User($value['fName'], $value['lName'], $value['uName'], $value['email'], $value['password']);
        }
        $statement->closeCursor();
        return $user0;
    }
    


}
