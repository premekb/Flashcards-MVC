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

