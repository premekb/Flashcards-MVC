<?php
    /**
     * The controller for showing a table of decks.
     */
    require_once "includes/autoload.inc.php";
    include_once "views/header.view.php";
    include_once "views/decks.view.php";

    session_start();

    // Checks if the user is logged in.
    if (!isset($_SESSION["id"])){
        header("location: index.php");
    }

    // Handles the remove deck button.
    if (isset($_POST["remove"])){
        $decksModel = new Decks();
        if ($decksModel->isCreator($_SESSION["id"], $_POST["deckId"])){
            $cardsModel = new Cards();
            $cardsModel->removeCards($_POST["deckId"]);

            $decksModel->removeDeck($_POST["deckId"]);
        }
    }

    // Handles the add card button.
    if (isset($_POST["add"])){
        $deckId = $_POST["deckId"];
        header("location: add_card.php?deckId=" . $deckId);
    }

    if (isset($_POST["cards"])){
        $deckId = $_POST["deckId"];
        header("location: cards.php?deckId=" . $deckId);
    }

    if (isset($_POST["review"])){
        $deckId = $_POST["deckId"];
        header("location: review.php?deckId=" . $deckId);
    }

    $headerView = new headerView();
    $headerView->generateHead();
    $headerView->generateNavbar();
?>
<main class='table'>
    <?php
    $decksModel = new Decks();
    $table = $decksModel->getTable($_SESSION["id"]);

    $decksView = new decksView();
    $decksView->generateTable($table);
    ?>

</main>
<script src="static/js/remove.js" defer></script>
<script src="static/js/pagination.js" defer></script>
<?php
    include_once "views/footer.view.php";
    $footerView = new FooterView();
    $numberOfDecks = $decksModel->getNumberOfDecks($_SESSION["id"])["COUNT(*)"];
    
    $footerView->generatePaginationFooter($numberOfDecks);
    $footerView->generatePageEnd();
?>