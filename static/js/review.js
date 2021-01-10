/**
 * Decides, whether to flip the card or to get a new one.
 * 
 * @param {submitEvent} event
 * 
 * @return {void} 
 */
function main(){
    if (button.innerHTML == "Flip"){
        button.innerHTML = "Next card";
        flip();
    }

    else{
        button.innerHTML = "Flip";
        deckId = document.querySelector("#deckId").innerHTML;
        ajaxNextCard(deckId);
    }
}

/**
 * Rewrites the DOM with a new card.
 * 
 * @param {submitEvent} event
 * 
 * @return {void} 
 */
function rewriteCard(card){
    var frontDiv = document.querySelector("#front_text");
    var backDiv = document.querySelector("#back_text");

    // If the server generated same card, try up to 9 times. 
    // The amount of repeated requests to the server drops with the number of cards in a deck.
    // Therefore it shouldn't be a performance concern during a regular usage
    if (frontDiv.innerHTML == card["front_text"] && ajaxCtr < 9){
        ajaxCtr += 1;
        ajaxNextCard(deckId);
        return false;
    }

    ajaxCtr = 0;
    frontDiv.innerHTML = card["front_text"];
    backDiv.innerHTML = card["back_text"];

    var backWrapper = document.querySelector("#back");
    var hr = document.querySelector("hr");
    backWrapper.classList.add("hidden");
    hr.classList.add("hidden");
}


/**
 * Makes an ajax request to the server for a new card.
 * 
 * @param {string} deckId
 * 
 * @return {void} 
 */
function ajaxNextCard(deckId){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        rewriteCard(JSON.parse(this.responseText));
    }
  };
  xhttp.open("GET", "next_card.ajax.php?deckId=" + deckId, true);
  xhttp.send();
}

/**
 * Uncovers the back part of a card.
 * 
 * @param {submitEvent} event
 * 
 * @return {void} 
 */
function flip(){
    var backText = document.querySelector("#back");
    var hr = document.querySelector("hr");
    backText.classList.remove("hidden");
    hr.classList.remove("hidden");
}


/**
 * Calls the main function on a space key press.
 * 
 * @param {keydown} event
 * 
 * @return {void} 
 */
function spaceKeyCheck(event){
    if (event.code == "Space"){
        main();
    }
}

var button = document.querySelector("#flip");
button.addEventListener("click", main);
document.addEventListener("keydown", spaceKeyCheck);


// Global variable for counting the ajax requests to the server in case of repeated cards.
var ajaxCtr = 0;