<?php
/**
 * The view class for generating forms and information about cards.
 */
class cardsView{
    /**
     * Generates form for adding a new card.
     * 
     * @param error Error message.
     * @param deckId Unique id of a deck, inserted into a hidden input.
     * @param oldFront Contains a front text if the form submission ends in error.
     * @param oldBack Contains a back text if the form submission ends in error.
     * 
     * 
     * @return void
     */
    public function generateNewCardForm($error, $deckId, $oldFront, $oldBack){
        $oldFront = htmlspecialchars($oldFront, ENT_QUOTES);
        $oldBack = htmlspecialchars($oldBack, ENT_QUOTES);

        echo "<section class='row justify-content-center'>
        <section class='col-12 col-sm-7 col-md-4'>
            <form action='add_card.php' method='POST' id='addCard'>
            
                <div class='form-group'>
                    <label for='front'>Front text</label>
                    <div id='card_front'>$oldFront</div>
                    <input type='hidden' name='front' value='$oldFront'>
                    <input type='hidden' name='front_noformat' value='$oldFront'>
                </div>
                <div class='form-group'>
                    <label for='back'>Back text</label>
                    <div id='card_back'>$oldBack</div>
                    <input type='hidden' name='back' value='$oldBack'>
                    <input type='hidden' name='back_noformat' value='$oldBack'>
                </div>
                <span class='row justify-content-center error'>$error</span>
                <div class='form-group'>
                    <input type='submit' name='submit' value='Add a new card' class='btn btn-success btn-block'>
                    <input type='hidden' name='deckId' value='$deckId'>
                </div>
            </form>
        </section>
    </section>";
    }

    /**
     * Generates form for editing a card.
     * 
     * @param error Error message.
     * @param deckId Unique id of a deck, inserted into a hidden input.
     * @param oldFront Contains a front text of the original card, or when submission ends in an error.
     * @param oldBack Contains a back text of the original card, or when submission ends in an error.
     * @param cardId Contains a unique card id, inserted into a hidden input.
     * 
     * 
     * @return void
     */
    public function generateEditCardForm($error, $deckId, $oldFront, $oldBack, $cardId){
        $oldFront = $oldFront;
        $oldBack = $oldBack;
        $cardId = htmlspecialchars($cardId, ENT_QUOTES);

        echo "<section class='row justify-content-center'>
        <section class='col-12 col-sm-7 col-md-4'>
            <form action='edit_card.php' method='POST' id='addCard'>
            <div class='form-group'>
            <label for='front'>Front text</label>
            <div id='card_front'>$oldFront</div>
            <input type='hidden' name='front' value='$oldFront'>
            <input type='hidden' name='front_noformat' value='$oldFront'>
        </div>
        <div class='form-group'>
            <label for='back'>Back text</label>
            <div id='card_back'>$oldBack</div>
            <input type='hidden' name='back' value='$oldBack'>
            <input type='hidden' name='back_noformat' value='$oldBack'>
        </div>
                <span class='row justify-content-center error'>$error</span>
                <div class='form-group'>
                    <input type='submit' name='edit' value='Edit' class='btn btn-success btn-block'>
                    <input type='hidden' name='deckId' value='$deckId'>
                    <input type='hidden' name='cardId' value='$cardId'>
                </div>
            </form>
        </section>
    </section>";
    }

    /**
     * Generates a table of cards in a deck.
     * 
     * @param result Rows from the card db table.
     * 
     * @return void
     */
    public function generateTable($result){
        echo "<table class='table table-striped'>
        <thead>
          <tr class='d-flex'>
            <th scope='col' class='col-5'>Front</th>
            <th scope='col' class='col-5'>Back</th>
            <th scope='col' class='col-2'>Action</th>
          </tr>
        </thead>
        <tbody>";

        // Echo the table body
      foreach ($result as $row){
        $front = htmlspecialchars($row["front_text_noformat"], ENT_QUOTES);
        $front = strlen($front) > 80 ? substr($front, 0, 77) . "..." : $front;
        $back = htmlspecialchars($row["back_text_noformat"], ENT_QUOTES);
        $back = strlen($back) > 80 ? substr($back, 0, 77) . "..." : $back;
        $cardId = $row["id"];
        $deckId = $row["deck_id"];

        echo "<tr class='d-flex'>";
        echo "<th scope='row' class='col-5 overflow-hidden'>$front</th>";
        echo "<td class='col-5 overflow-hidden'>$back</td>";
        echo "<td class='col-2'><form action='cards.php?deckId=$deckId' method='POST'>
        <input type='submit' class='btn btn-primary' name='edit' value='Edit'>
        <input type='submit' class='btn btn-danger' name='remove' value='Remove'>
        <input type='hidden' name='cardId' value='$cardId'>
        </form></td></tr>";
        }

        echo "</tbody></table>";
    }

    /**
     * Generates card front and back text during the card review.
     * 
     * Used only for initialization, latter cards are retrieved through AJAX
     * and shown using JS.
     * 
     * @param card A row from the cards db table.
     * 
     * @return void
     */
    public function generateCard($card){
        $front = $card["front_text"];
        $back = $card["back_text"];
        $deckId = $card["deck_id"];
        echo "<div class='container' id='front'><div class='ql-editor' id='front_text'>$front</div></div>";
        echo "<div class='container' id='hr'><hr class='hidden'></div>";
        echo "<div class='container hidden' id='back'><div id='back_text' class='ql-editor'>$back</div></div>";
        echo "<div hidden id='deckId'>$deckId</div>";
    }

    /**
     * Generates a message, that there are no cards to be reviewed.
     * 
     * @return void
     */
    public function generateNoCard(){
        echo "<div class='container' style='display:block' id='front'><h1>There is nothing to review</h1></br><div>Go ahead and add a new card :)</div></div>";
    }
}