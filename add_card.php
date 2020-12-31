<?php
    /**
     * The controller for adding a new card.
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

    $error = False;

    // Handles the add card form.
    if (isset($_POST["submit"])){
        $cardFront = $_POST["front"];
        $cardBack = $_POST["back"];
        $cardFrontNoFormat = trim($_POST["front_noformat"]);
        $cardBackNoFormat = trim($_POST["back_noformat"]);

        $_SESSION["front"] = $cardFront;
        $_SESSION["back"] = $cardBack;

        if (strlen($cardFrontNoFormat) == 0 || strlen($cardBackNoFormat) == 0){
            $error = "You have to fill in both of the fields.";
        }

        if (strlen($cardFront) > 4000){
            $error = "The front text is too long.";
        }

        if (strlen($cardBack) > 4000){
            $error = "The back text is too long.";
        }

        if(!$error){
            unset($_SESSION["front"]);
            unset($_SESSION["back"]);

            $decksModel = new Decks();
            $decksModel->newCard($deckId);

            $cardsModel = new Cards();
            $cardsModel->addCard($deckId, $cardFront, $cardBack, $cardFrontNoFormat, $cardBackNoFormat);
        }
    }
    
    $headerView = new headerView();
    $headerView->generateHead();
    $headerView->generateNavBar();
?>
<main class='container-fluid'>
    <?php

        // Check if there are any values from a failed form submission.
        $oldFront = isset($_SESSION["front"]) ? $_SESSION["front"] : False;
        $oldBack = isset($_SESSION["back"]) ? $_SESSION["back"] : False;

        $newCardView = new cardsView();

        $newCardView->generateNewCardForm($error, $deckId, $oldFront, $oldBack);
    ?>
     <!-- Include the Quill library -->
     <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
     <script src='static/js/add_card_quill.js'></script>
</main>
<?php
    include_once "views/footer.view.php";
    $footerView = new FooterView();
    $footerView->generatePageEnd();
?>