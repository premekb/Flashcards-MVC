<?php
/**
 * The view class for generating forms and information about decks.
 */
class DecksView {
    /**
     * Generates a table of decks belonging to a particular user.
     * 
     * @param result Rows from the decks table.
     * 
     * @return void
     */
    public function generateTable($result) {
        echo "<table class='table table-striped'>
        <thead>
          <tr class='d-flex'>
            <th scope='col' class='col-4'>Deck</th>
            <th scope='col' class='col-3'>Last Reviewed</th>
            <th scope='col' class='col-2'>Cards</th>
            <th scope='col' class='col-3'>Action</th>
          </tr>
        </thead>
        <tbody>";

      // Echo the table body
      foreach ($result as $row){
            $name = htmlspecialchars($row["name"], ENT_QUOTES);
            $cards = $row["cards"];
            $deckId = $row["id"];
            $date = $row["last_reviewed"];

            echo "<tr class='d-flex'>";
            echo "<th scope='row' class='col-4 overflow-hidden'>$name</th>";
            echo "<td class='col-3'>$date</td>";
            echo "<td class='col-2'>$cards</td>";
            echo "<td class='col-3'><form action='decks.php' method='POST'>
            <input type='submit' class='btn btn-success' name='review' value='Review'>
            <input type='submit' class='btn btn-primary' name='add' value='Add'>
            <input type='submit' class='btn btn-info' name='cards' value='Cards'>
            <input type='submit' class='btn btn-danger' name='remove' value='Remove'>
            <input type='hidden' name='deckId' value='$deckId'>
            </form></td></tr>";
      }

      echo "</tbody></table>";
    }

    /**
     * Generates a form for creating a new deck.
     * 
     * @param error Error message
     * 
     * @return void
     */
    public function generateNewDeckForm($error) {
        $successStyle = $error == "A new deck was created." ? "style='color:green'" : False;
        echo "<main class='container-fluid'>
        <section class='row justify-content-center'>
                <section class='col-12 col-sm-6 col-md-3'>
        <form action='new_deck.php' method='POST' class='form-container' id='login'>
        <div class='form-group'>
          <label for='exampleInputEmail1'>Deck name</label>
          <input type='text' name='name' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter deck name' required>
        </div>
        <span class='row justify-content-center error' $successStyle>$error</span>
        <input type='submit' name='submit' value='Create a new deck' class='btn btn-primary btn-block'>
      </form>
      </section>
        </main>";
    }
}

    