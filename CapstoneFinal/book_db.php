<?php

class book_db {

    public static function select_all_books() {

        $db = newDatabase::getDB();

        $query = 'SELECT * FROM books';
        $statement = $db->prepare($query);
        $statement->execute();
        $books = $statement->fetchAll();
        $book0 = [];

        foreach ($books as $value) {
            $book0[$value['bookID']] = new Book($value['title'], $value['isbn'], $value['condition'], $value['recommended'], $value['genre'], $value['arPoints'], $value['readingLevel'], $value['description'], $value['numCopies'], $value['checkedout']);
        }
        $statement->closeCursor();
        return $book0;
    }

    public static function insert_books($book) {
        $db = newDatabase::getDB();
        /* @var $user User */
        $query = 'INSERT INTO books
                 (title, isbn, condition, recommended, genre, arPoints, readingLevel, description, numCopies, checkedout)
              VALUES
                 (:title, :isbn, :condition, :recommended, :genre, :arPoints, :readingLevel, :description, :numCopies, :checkedout)';
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $book->getTitle());
        $statement->bindValue(':isbn', $book->getISBN());
        $statement->bindValue(':condition', $book->getCondition());
        $statement->bindValue(':recommended', $book->getRecommended());
        $statement->bindValue(':genre', $book->getGenre());
        $statement->bindValue(':arPoints', $book->getARPoints());
        $statement->bindValue(':readingLevel', $book->getReadingLevel());
        $statement->bindValue(':description', $book->getDescription());
        $statement->bindValue(':numCopies', $book->getNumCopies());
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
            condition = :condition,
            recommended = :recommended,
            genre = :genre,
            arPoints = :arPoints,
            readingLevel = :readingLevel,
            description = :description,
            numCopies = :numCopies,
            checkedout = :checkedout
            where uName = :uName';

        $statement = $db->prepare($query);
        $statement->bindValue(':title', $book->getTitle());
        $statement->bindValue(':isbn', $book->getISBN());
        $statement->bindValue(':condition', $book->getCondition());
        $statement->bindValue(':recommended', $book->getRecommended());
        $statement->bindValue(':genre', $book->getGenre());
        $statement->bindValue(':arPoints', $book->getARPoints());
        $statement->bindValue(':readingLevel', $book->getReadingLevel());
        $statement->bindValue(':description', $book->getDescription());
        $statement->bindValue(':numCopies', $book->getNumCopies());
        $statement->bindValue(':checkedout', $book->getCheckedout());

        $statement->execute();
        $statement->closeCursor();
    }

    public static function select_all_books_sorted() {

        $db = newDatabase::getDB();

        $query = 'SELECT * FROM books
                   order by title';
        $statement = $db->prepare($query);
        $statement->execute();
        $books = $statement->fetchAll();
        $book0 = [];

        foreach ($books as $value) {
            $book0[$value['bookID']] = new Book($value['title'], $value['isbn'], $value['condition'], $value['recommended'], $value['genre'], $value['arPoints'], $value['readingLevel'], $value['description'], $value['numCopies'], $value['checkedout']);
        }
        $statement->closeCursor();
        return $book0;
    }
    


}
