var CUR_PAGE = 1;
var QUERY_STRING = window.location.search;

/**
 * Redraws the arrow navigation buttons accordingly.
 * 
 * @return {void}
 */
function redrawUi(){
    var itemsNumber = document.querySelector("#items").value;
    var pages = Math.ceil(itemsNumber / 26);

    if (CUR_PAGE == 1){
        removeLeft();
    }

    else{
        addLeft();
    }
    
    if (CUR_PAGE == pages){
        removeRight();
    }

    else{
        addRight();
    }
}

/**
 * Makes an AJAX request for a new table to the server and replaces the old table.
 * 
 * @return {void}
 */
function redrawTable(){
    var xhttp = new XMLHttpRequest();
    var deckId = getDeckId();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.querySelector("table").innerHTML = this.responseText;
    }
  };
  if (deckId){
    xhttp.open("GET", "pagination.ajax.php?page=" + String(CUR_PAGE) + "&deckId=" + String(deckId), true);
  }
  else{
    xhttp.open("GET", "pagination.ajax.php?page=" + String(CUR_PAGE), true);
  }
  xhttp.send();
}

/**
 * Sets the visibility of the left button to hidden.
 * 
 * @return {void}
 */
function removeLeft(){
    var leftButton = document.querySelector("#left");
    leftButton.classList.add("hidden");
}

/**
 * Sets the visibility of the right button to hidden.
 * 
 * @return {void}
 */
function removeRight(){
    var rightButton = document.querySelector("#right");
    rightButton.classList.add("hidden");
}

/**
 * Removes the hidden class of the left button.
 * 
 * @return {void}
 */
function addLeft(){
    var leftButton = document.querySelector("#left");
    leftButton.classList.remove("hidden");
}

/**
 * Removes the hidden class of the right button.
 * 
 * @return {void}
 */
function addRight(){
    var rightButton = document.querySelector("#right");
    rightButton.classList.remove("hidden");
}

/**
 * Tries to extract the deckId parameter from the URL.
 * 
 * @return {string, boolean}
 */
function getDeckId(){
    var queryString = window.location.search;
    const deckId = new URLSearchParams(queryString).get("deckId");
    if (deckId){
        return deckId
    }

    return false;
}

/**
 * Main function when a button is pressed. It determines what button was pressed
 * and calls functions which redraw the UI and table.
 * 
 * @param {clickEvent} event 
 * 
 * @return {void}
 */
function paginate(event){
    if (event.target.id == "right"){
        CUR_PAGE += 1;
    }

    else{
        CUR_PAGE -= 1;
    }
    redrawTable();
    redrawUi();
}

redrawUi();

document.querySelector("#left").addEventListener("click", paginate);
document.querySelector("#right").addEventListener("click", paginate);

