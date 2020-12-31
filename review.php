<?php
    /**
     * The controller for the card review.
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

    // Refresh the review date
    else{
        $decksModel = new Decks();
        $decksModel->refreshReviewDate($deckId);
    }

    $headerView = new headerView();
    $headerView->generateHead();
    $headerView->generatenavBar();
?>

<main>
    <?php
        $cardsModel = new Cards();
        $card = $cardsModel->getRandomCard($deckId);

        $cardsView = new cardsView();

        if (!$card){
            $cardsView->generateNoCard();
        }

        else{
        $cardsView->generateCard($card);
        }
    ?>
    <script src="static/js/review.js" defer></script>
</main>

<?php
    include_once "views/footer.view.php";
    $footerView = new FooterView();

    if ($card){
    $footerView->generateReviewFooter();
    }
    
    $footerView->generatePageEnd();
?>