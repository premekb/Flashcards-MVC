<?php
/**
 * The model for the cards table.
 */
class Cards extends Db{
    private $conn;

    function __construct() {
        $this->conn = $this->connect();
    }

    /**
     * Removes all cards in a deck.
     * 
     * @param deckId Unique id of a deck.
     * 
     * @return Void
     */
    public function removeCards($deckId){
        try {
            $stmt = $this->conn->prepare("DELETE FROM cards WHERE deck_id = :deckId");
            $stmt->bindParam(":deckId", $deckId);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Removes a card based on its id.
     * 
     * @param cardId Unique id of a card.
     * 
     * @return Void
     */
    public function removeCard($cardId){
        try {
            $stmt = $this->conn->prepare("DELETE FROM cards WHERE id = :cardId");
            $stmt->bindParam(":cardId", $cardId);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Adds a new card into a deck.
     * 
     * @param deckId Unique id of a deck.
     * @param front Front text of a card with formatting.
     * @param back Back text of a card with formatting.
     * @param frontNoFormat Front text of a card without formatting tags.
     * @param backNoFormat Back text of a card without formatting tags.
     * 
     * @return void
     */
    public function addCard($deckId, $front, $back, $frontNoFormat, $backNoFormat){
        try {
            $stmt = $this->conn->prepare("INSERT INTO cards (deck_id, front_text, back_text, front_text_noformat, back_text_noformat) VALUES (:deckId, :front, :back, :frontNoFormat, :backNoFormat)");
            $stmt->bindParam(":deckId", $deckId);
            $stmt->bindParam(":front", $front);
            $stmt->bindParam(":back", $back);
            $stmt->bindParam(":frontNoFormat", $frontNoFormat);
            $stmt->bindParam(":backNoFormat", $backNoFormat);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

     /**
     * Returns all cards belonging to a deck.
     * 
     * @param deckId Unique id of a deck.
     * 
     * @return array Item represents a deck row from the database.
     */
    public function getTable($deckId) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM cards WHERE deck_id = :deckId");
            $stmt->bindParam(":deckId", $deckId);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

     /**
     * Returns a deck id, to which a card belongs.
     * 
     * @param cardId Unique id of a card.
     * 
     * @return int
     */
    public function getDeckId($cardId){
        try {
            $stmt = $this->conn->prepare("SELECT deck_id FROM cards WHERE id = :cardId");
            $stmt->bindParam(":cardId", $cardId);
            $stmt->execute();
            return $stmt->fetch()["deck_id"];
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

     /**
     * Returns a single card.
     * 
     * @param cardId Unique id of a deck.
     * 
     * @return array
     */
    public function getCard($cardId){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM cards WHERE id = :cardId");
            $stmt->bindParam(":cardId", $cardId);
            $stmt->execute();
            return $stmt->fetch();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Updates a card text.
     * 
     * @param deckId Unique id of a deck.
     * @param front Front text of a card with formatting.
     * @param back Back text of a card with formatting.
     * @param frontNoFormat Front text of a card without formatting tags.
     * @param backNoFormat Back text of a card without formatting tags.
     * 
     * @return void
     */
    public function editCard($cardId, $front, $back, $frontNoFormat, $backNoFormat){
        try {
            $stmt = $this->conn->prepare("UPDATE cards SET front_text = :front, back_text = :back, back_text_noformat = :backNoFormat, front_text_noformat = :frontNoFormat  WHERE id = :cardId");
            $stmt->bindParam(":cardId", $cardId);
            $stmt->bindParam(":front", $front);
            $stmt->bindParam(":back", $back);
            $stmt->bindParam(":frontNoFormat", $frontNoFormat);
            $stmt->bindParam(":backNoFormat", $backNoFormat);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Returns a random card.
     * 
     * @param deckId Unique id of a deck.
     * 
     * @return array
     */
    public function getRandomCard($deckId){
        try {
            $stmt = $this->conn->prepare("SELECT deck_id, front_text, back_text FROM cards WHERE deck_id = :deckId ORDER BY RAND() LIMIT 1");
            $stmt->bindParam(":deckId", $deckId);
            $stmt->execute();
            return $stmt->fetch();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}