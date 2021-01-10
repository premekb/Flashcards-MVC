<?php
/**
 * The view class for the footer.
 */
class FooterView {
    /**
     * Ends an html page.
     * 
     * @return void
     */
    public function generatePageEnd(){
        echo "</body>
        </html>";
    }

    /**
     * Generates a pagination footer for the decks and cards page.
     * 
     * @return void
     */
    public function generatePaginationFooter($amount){
        echo "<footer class='footer'>
        <div class='container'>
        <button type='submit' id='left' class='btn btn-primary'>&lt;--</button>
        <button type='submit' id='right' class='btn btn-primary'>--&gt;</button>
        <input type='hidden' id='items' value='$amount'></input>
        </div>
        </footer>";
    }

    /**
     * Generates the footer on the review page.
     * 
     * @return void
     */
    public function generateReviewFooter(){
        echo "<footer class='footer'>
        <div class='container'>
        <button type='submit' class='btn btn-primary btn-block' id='flip'>Flip</button>
        </div>
        </footer>";
    }
}

