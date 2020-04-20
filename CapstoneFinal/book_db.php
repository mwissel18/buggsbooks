<?php

class user_db {

    public static function select_all() {

        $db = newDatabase::getDB();

        $query = 'SELECT * FROM books';
        $statement = $db->prepare($query);
        $statement->execute();
        $books = $statement->fetchAll();
        $book0 = [];

        foreach ($books as $value) {
            $book0[$value['bookID']] = new Book($value['title'], $value['isbn'], $value['book_condition'], $value['recommended'], $value['genre'], $value['ar_points'], $value['reading_level'], $value['description'], $value['num_copies'], $value['checkedout']);
        }
        $statement->closeCursor();
        return $book0;
    }

    public static function insert_books($book) {
        $db = newDatabase::getDB();
        /* @var $user User */
        $query = 'INSERT INTO books
                 (title, isbn, book_condition, recommended, genre, ar_points, reading_level, description, num_copies, checkedout)
              VALUES
                 (:title, :isbn, :book_condition, :recommended, :genre, :ar_points, :reading_level, :description, :num_copies, :checkedout)';
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $book->getTitle());
        $statement->bindValue(':isbn', $book->getISBN());
        $statement->bindValue(':book_condition', $book->getCondition());
        $statement->bindValue(':recommended', $book->getRecommended());
        $statement->bindValue(':genre', $book->getGenre());
        $statement->bindValue(':ar_points', $book->getARPoints());
        $statement->bindValue(':reading_level', $book->getReadingLevel());
        $statement->bindValue(':description', $book->getDescription());
        $statement->bindValue(':num_copies', $book->getNumCopies());
        $statement->bindValue(':checkedout', $book->getCheckedout());

        $statement->execute();
        $statement->closeCursor();
    }

    public static function search_by_title($title) {
        $db = newDatabase::getDB();
        $query = 'SELECT * FROM books where title = :title';
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->execute();
        $results = $statement->fetchAll();
        if (empty($results)) {
            return false;
        } else if ($results[0]['title'] === $title) {
            return true;
        }
    }

    

    

    public static function update_Book($book) {
        $db = newDatabase::getDB();
        /* @var $user User */
        $query = 'Update books
            set title = :title,
            isbn = :isbn,
            book_condition = :book_condition,
            recommended = :recommended,
            genre = :genre,
            ar_points = :ar_points,
            reading_level = :reading_level,
            description = :description,
            num_copies = :num_copies,
            checkedout = :checkedout
            where uName = :uName';

        $statement = $db->prepare($query);
        $statement->bindValue(':title', $book->getTitle());
        $statement->bindValue(':isbn', $book->getISBN());
        $statement->bindValue(':book_condition', $book->getCondition());
        $statement->bindValue(':recommended', $book->getRecommended());
        $statement->bindValue(':genre', $book->getGenre());
        $statement->bindValue(':ar_points', $book->getARPoints());
        $statement->bindValue(':reading_level', $book->getReadingLevel());
        $statement->bindValue(':description', $book->getDescription());
        $statement->bindValue(':num_copies', $book->getNumCopies());
        $statement->bindValue(':checkedout', $book->getCheckedout());

        $statement->execute();
        $statement->closeCursor();
    }

    public static function select_all_sorted() {

        $db = newDatabase::getDB();

        $query = 'SELECT * FROM books
                   order by title';
        $statement = $db->prepare($query);
        $statement->execute();
        $books = $statement->fetchAll();
        $book0 = [];

        foreach ($books as $value) {
            $book0[$value['bookID']] = new Book($value['title'], $value['isbn'], $value['book_condition'], $value['recommended'], $value['genre'], $value['ar_points'], $value['reading_level'], $value['description'], $value['num_copies'], $value['checkedout']);
        }
        $statement->closeCursor();
        return $book0;
    }
    


}
