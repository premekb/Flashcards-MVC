<?php
/**
 * The model for the decks table.
 */
class Decks extends Db{
    private $conn;

    /**
     * Connects to the database, stores the connection in conn property.
     */
    function __construct() {
        $this->conn = $this->connect();
    }

    /**
     * Inserts a new deck into the DB.
     * 
     * @param name Name of the deck.
     * @param createdBy Id of the creator.
     * 
     * @return void
     */
    public function newDeck($name, $createdBy) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO decks (created_by, name, last_reviewed) VALUES (:createdBy, :name, :date)");
            $stmt->bindParam(":createdBy", $createdBy);
            $stmt->bindParam(":name", $name);
            $date = date("Y-m-d");
            $stmt->bindParam(":date", $date);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Returns all decks belonging to a user.
     * 
     * @param uid Id of the owner.
     * 
     * @return array All deck rows belonging to a user.
     */
    public function getTable($uid) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM decks WHERE created_by = :uid ORDER BY last_reviewed DESC");
            $stmt->bindParam(":uid", $uid);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Validates if uid is a creator of a deck.
     * 
     * @param uid Unique id of a user.
     * @param deckId Unique id of a deck.
     * 
     * @return Boolean
     */
    public function isCreator($uid, $deckId) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM decks WHERE created_by = :uid AND id = :deckId");
            $stmt->bindParam(":uid", $uid);
            $stmt->bindParam(":deckId", $deckId);
            $stmt->execute();
            return $stmt->rowCount() == 1;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Removes the deck from the decks table.
     * 
     * @param deckId Unique id of a deck.
     * 
     * @return Void
     */
    public function removeDeck($deckId){
        try {
            $stmt = $this->conn->prepare("DELETE FROM decks WHERE id = :deckId");
            $stmt->bindParam(":deckId", $deckId);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Checks if a deck with a given id exists.
     * 
     * @param deckId Unique id of a deck.
     * 
     * @return Boolean
     */
    public function deckExists($deckId){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM decks WHERE id = :deckId");
            $stmt->bindParam(":deckId", $deckId);
            $stmt->execute();
            return $stmt->rowCount() == 1;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Increments the card counter.
     * 
     * @param deckId Unique id of a deck.
     * 
     * @return Void
     */
    public function newCard($deckId){
        try{
            $stmt = $this->conn->prepare("UPDATE decks SET cards = cards + 1 WHERE id = :deckId");
            $stmt->bindParam(":deckId", $deckId);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Decrements the card counter.
     * 
     * @param deckId Unique id of a deck.
     * 
     * @return Void
     */
    public function decrementCard($deckId){
        try{
            $stmt = $this->conn->prepare("UPDATE decks SET cards = cards - 1 WHERE id = :deckId");
            $stmt->bindParam(":deckId", $deckId);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Sets the last reviewed date to current date.
     * 
     * @param deckId Unique id of a deck.
     * 
     * @return Void
     */
    public function refreshReviewDate($deckId){
        try{
            $date = date("Y-m-d");
            $stmt = $this->conn->prepare("UPDATE decks SET last_reviewed = :date WHERE id = :deckId");
            $stmt->bindParam(":deckId", $deckId);
            $stmt->bindParam(":date", $date);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
    