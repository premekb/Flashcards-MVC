<?php
/**
 * The view class for the header.
 */
class headerView {
    /**
     * The beginning of an html page.
     * 
     * @return void
     */
    function generateHead(){
      $title = $this->getTitle();
      echo "<!DOCTYPE html>
      <html lang='en'>
      <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
          <link href='https://cdn.quilljs.com/1.3.6/quill.snow.css' rel='stylesheet'>
          <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
          <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
          <link rel='stylesheet' href='static/styles/styles.css'>
          <title>$title</title>
      </head>
      <body>";
    }

    /**
     * Generates the navigation menu.
     * 
     * @return void
     */
    public function generateNavbar(){
      echo "<nav class='navbar navbar-expand-lg navbar-light bg-light fixed-top'>
      <a class='navbar-brand' href='decks.php'>Flashcards app</a>
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo01' aria-controls='navbarTogglerDemo01' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>
      <div class='collapse navbar-collapse' id='navbarTogglerDemo01'>
        <ul class='navbar-nav mr-auto mt-2 mt-lg-0'>
          <li class='nav-item'>
            <a class='nav-link' href='decks.php'>Decks</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='new_deck.php'>New deck</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='account.php'>Account</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='includes/logout.inc.php'>Logout</a>
          </li>
        </ul>
      </div>
    </nav>";
    }

  /**
   * Returns a title based on the current page.
   * 
   * @return String
   */
   private function getTitle(){
     $file = basename($_SERVER["PHP_SELF"]);
     switch($file){
        case "decks.php":
          return "Your decks";
        case "index.php":
          return "Login";
        case "register.php":
          return "Register";
        case "new_deck.php":
          return "Add a new deck";
        case "account.php":
          return "Change your password";
        case "add_card.php":
          return "Add a new card";
        case "cards.php":
          return "Cards";
        case "edit_card.php":
          return "Edit a card";
        case "review.php";
          return "Cards review";
     }
     return "Unknown page";
    }
}