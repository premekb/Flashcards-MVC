<?php
    /**
     * The controller for the page showing cards in a deck.
     */
    require_once "includes/autoload.inc.php";
    include_once "views/header.view.php";
    include_once "views/cards.view.php";

    session_start();

    // Checks if the user is logged in and if the page was entered correctly.
    if (!isset($_SESSION["id"]) || !isset($_REQUEST["deckId"])){
        header("location: decks.php");
    }

    $decksModel = new Decks();
    $deckId = $_REQUEST["deckId"];

    // Checks if the user has the right to see this page and if the get parameter is correct.
    if (!$decksModel->deckExists($deckId) || !$decksModel->isCreator($_SESSION["id"], $deckId)){
        header("location: decks.php");
    }

    // Handles the remove button.
    if (isset($_POST["remove"])){
        $cardsModel = new Cards();
        $deckId = $cardsModel->getDeckId($_POST["cardId"]);

        $deckModel = new Decks();
        // Validate if the user has the right to delete the card
        if ($deckModel->isCreator($_SESSION["id"], $deckId)){
            $cardsModel->removeCard($_POST["cardId"]);
            $deckModel->decrementCard($deckId);
        }
    }

    // Handles the edit button.
    if (isset($_POST["edit"])){
        $cardId = $_POST["cardId"];
        $deckId = $_GET["deckId"];
        header("location: edit_card.php?cardId=" . $cardId . "&deckId=" . $deckId);
    }

    $headerView = new headerView();
    $headerView->generateHead();
    $headerView->generatenavBar();

?>

<main>
<?php
    $cardsModel = new Cards();
    $table = $cardsModel->getTable($deckId);

    $cardsView = new cardsView();
    $cardsView->generateTable($table);
?>
</main>
<script src="static/js/remove.js" defer></script>
<?php
    include_once "views/footer.view.php";
    $footerView = new FooterView();
    $footerView->generatePageEnd();
?>