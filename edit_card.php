<?php
    /**
     * The controller for editing a card.
     */
    require_once "includes/autoload.inc.php";
    include_once "views/header.view.php";
    include_once "views/cards.view.php";

    session_start();

    // Checks if the user is logged in and if the page was entered correctly.
    if (!isset($_SESSION["id"]) || !isset($_REQUEST["deckId"]) || !isset($_REQUEST["cardId"])){
        header("location: decks.php");
    }

    $decksModel = new Decks();
    $deckId = $_REQUEST["deckId"];

    // Checks if the user has the right to see this page and if the get parameter is correct.
    if (!$decksModel->deckExists($deckId) || !$decksModel->isCreator($_SESSION["id"], $deckId)){
        header("location: decks.php");
    }

    $error = False;

    // Handles the edit card form.
    if (isset($_POST["edit"])){
        $cardFront = $_POST["front"];
        $cardBack = $_POST["back"];
        $cardFrontNoFormat = trim($_POST["front_noformat"]);
        $cardBackNoFormat = trim($_POST["back_noformat"]);


        if (strlen($cardFront) == 0 || strlen($cardBack) == 0){
            $error = "You have to fill in both of the fields.";
        }

        if (strlen($cardFront) > 4000){
            $error = "The front text is too long.";
        }

        if (strlen($cardBack) > 4000){
            $error = "The back text is too long.";
        }

        if(!$error){
            $cardsModel = new Cards();
            $cardsModel->editCard($_REQUEST["cardId"], $cardFront, $cardBack, $cardFrontNoFormat, $cardBackNoFormat);
            header("location: cards.php?deckId=" . $_POST["deckId"]);
        }
    }

    $headerView = new headerView();
    $headerView->generateHead();
    $headerView->generateNavBar();
?>
<main class='container-fluid'>
    <?php
        $cardModel = new Cards;
        $card = $cardModel->getCard($_REQUEST["cardId"]);

        $oldFront = $card["front_text"];
        $oldBack = $card["back_text"];

        $newCardView = new cardsView();

        $newCardView->generateEditCardForm($error, $deckId, $oldFront, $oldBack, $_REQUEST["cardId"]);

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