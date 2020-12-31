/**
 * Asks the user to confirm, that he really wants to remove a deck.
 * 
 * @param {submitEvent} event
 * 
 * @return {void} 
 */
function areYouSure(event){
    if (!confirm("Are you sure you want to remove it?")){
        event.preventDefault();
    }
}

var buttons = document.querySelectorAll("input[value=Remove]")

// Add event listeners to all remove buttons.
for (i = 0; i < buttons.length; i++){
    buttons[i].addEventListener("click", areYouSure);
}