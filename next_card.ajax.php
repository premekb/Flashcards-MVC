<?php
    /**
     * The controller for getting a next card during a card review.
     */
    session_start();
    require_once "includes/autoload.inc.php";

    // User is not logged in or no deck id was passed.
    if (!isset($_SESSION["id"]) || !isset($_GET["deckId"])){
            echo false;
            return false;
        }

    $decksModel = new Decks();
    $deckId = $_GET["deckId"];

    // Checks if the user has the right to see this page and if the get parameter is correct.
    if (!$decksModel->deckExists($deckId) || !$decksModel->isCreator($_SESSION["id"], $deckId)){
        echo false;
        return false;
    }

    $cardsModel = new Cards();
    $card = $cardsModel->getRandomCard($deckId);
    echo json_encode($card);