<?php

/*

 */

class Comment {

    private $CommentID, $commentFrom, $commentTo, $commentText, $commentDate;

    function __construct($CommentID, $commentFrom, $commentTo, $commentText, $commentDate) {
        $this->CommentID = $CommentID;
        $this->commentFrom = $commentFrom;
        $this->commentTo = $commentTo;
        $this->commentText = $commentText;
        $this->commentDate = $commentDate;
    }
    function getCommentID() {
        return $this->CommentID;
    }

    function getCommentFrom() {
        return $this->commentFrom;
    }

    function getCommentTo() {
        return $this->commentTo;
    }

    function getCommentText() {
        return $this->commentText;
    }

    function getCommentDate() {
        return $this->commentDate;
    }

    function setCommentID($CommentID) {
        $this->CommentID = $CommentID;
    }

    function setCommentFrom($commentFrom) {
        $this->commentFrom = $commentFrom;
    }

    function setCommentTo($commentTo) {
        $this->commentTo = $commentTo;
    }

    function setCommentText($commentText) {
        $this->commentText = $commentText;
    }

    function setCommentDate($commentDate) {
        $this->commentDate = $commentDate;
    }


}
