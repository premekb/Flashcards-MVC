<?php
    /**
     * The controller for adding a new deck.
     */
    require_once "includes/autoload.inc.php";
    include_once "views/header.view.php";
    include_once "views/decks.view.php";

    session_start();

    // Checks if the user is logged in.
    if (!isset($_SESSION["id"])){
        header("location: index.php");
    }

    $error = False;

    // Handles the new deck form.
    if (isset($_POST["submit"])){
        $name = $_POST["name"];

        if (strlen($name) > 0 && strlen($name) < 256) {
            $deckModel = new Decks();
            $deckModel->newDeck($name, $_SESSION["id"]);
            $error = "A new deck was created.";
        }

        else {
            $error = "The length of the deck name has to be 0 - 255 characters long.";
        }
    }

    $headerView = new headerView();
    $headerView->generateHead();
    $headerView->generateNavBar();
?>
<main>
    <?php
    $decksView = new decksView();

    $decksView->generateNewDeckForm($error);
    ?>

</main>
<?php
    include_once "views/footer.view.php";
    $footerView = new FooterView();
    $footerView->generatePageEnd();
?>