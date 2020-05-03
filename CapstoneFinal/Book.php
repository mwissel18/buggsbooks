<?php

/*

 */
class Book { 
   private $title, $isbn, $condition, $recommended, $genre, $arPoints, $readingLevel, $description, $numCopies, $checkedout;
   
  
   public function __construct($title, $isbn, $condition, $recommended, $genre, $arPoints, $readingLevel, $description, $numCopies, $checkedout){
       $this->title = $title;
       $this->isbn = $isbn;
       $this->condition = $condition;
       $this->recommended = $recommended;
       $this->genre = $genre;
       $this->arPoints = $arPoints;
       $this->readingLevel = $readingLevel;
       $this->description = $description;
       $this->numCopies = $numCopies;
       $this->checkedout = $checkedout;
   }
   function getTitle() {
       return $this->title;
   }

   function getISBN() {
       return $this->isbn;
   }

   function getCondition() {
       return $this->condition;
   }
   
   function getRecommended() {
       return $this->recommended;
   }

   function getGenre() {
       return $this->genre;
   }

   function getARPoints() {
       return $this->arPoints;
   }

   function getReadingLevel() {
       return $this->readingLevel;
   }

   function getDescription() {
       return $this->description;
   }

   function getNumCopies() {
       return $this->numCopies;
   }
   
   function getCheckedout() {
       return $this->checkedout;
   }

      function setTitle($title) {
       $this->title = $title;
   }

   function setIsbn($isbn) {
       $this->isbn = $isbn;
   }

   function setCondition($condition) {
       $this->condition = $condition;
   }
   
   function setRecommended($recommended) {
       $this->recommended = $recommended;
   }

   function setGenre($genre) {
       $this->genre = $genre;
   }

   function setArPoints($arPoints) {
       $this->arPoints = $arPoints;
   }

   function setReadingLevel($readingLevel) {
       $this->readingLevel = $readingLevel;
   }

   function setDescription($description) {
       $this->description = $description;
   }

   function setNumCopies($numCopies) {
       $this->numCopies = $numCopies;
   }

   function setCheckedout($checkedout) {
       $this->checkedout = $checkedout;
   }




}
