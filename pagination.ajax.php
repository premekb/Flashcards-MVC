<?php
    /**
     * The controller for getting a next page in a table.
     */
    session_start();
    require_once "includes/autoload.inc.php";

    // User is not logged in or no page was passed.
    if (!isset($_SESSION["id"]) || !isset($_GET["page"])){
            echo false;
            return false;
        }

    $decksModel = new Decks();
    $page = $_GET["page"];
    
    // DeckId was passed, generate a next page in a table of cards.
    if (isset($_GET["deckId"])){
        $deckId = $_GET["deckId"];
        // Checks if the user has the right to see this page and if the get parameter is correct.
        if (!$decksModel->deckExists($deckId) || !$decksModel->isCreator($_SESSION["id"], $deckId)){
            echo false;
            return false;
        }
        // Generate next page in the table of cards.
        include_once "views/cards.view.php";
        $cardsModel = new Cards();
        $table = $cardsModel->getTable($deckId, $page);

        $cardsView = new cardsView();
        $cardsView->generateTable($table);
    }

    // Generate next page in the table of decks.
    else{
        include_once "views/decks.view.php";
        $decksModel = new Decks();
        $table = $decksModel->getTable($_SESSION["id"], $page);

        $decksView = new decksView();
        $decksView->generateTable($table);
    }