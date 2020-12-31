/**
 * Calls the validation function, if passed then sets up the hidden inputs
 * to be sent to the server.
 * 
 * @param {submitEvent} event 
 * 
 * @return {void, boolean}
 */

function submit(event){
    let front = quillFront.root.innerHTML.trim();
    let back = quillBack.root.innerHTML.trim();
    let frontNoFormat = quillFront.getText().trim();
    let backNoFormat = quillBack.getText().trim();

    if (!validate(front, back, frontNoFormat, backNoFormat)){
        event.preventDefault();
        return false;
    }

    document.querySelector("input[name=front]").value = front;
    document.querySelector("input[name=back]").value = back;

    document.querySelector("input[name=front_noformat]").value = frontNoFormat;
    document.querySelector("input[name=back_noformat]").value = backNoFormat;
}

/**
 * Performs the client-side validation.
 * 
 * @param {string} front Front text of a card.
 * @param {string} back Back text of a card.
 * @param {string} frontNoFormat Front text of a card without formatting tags.
 * @param {string} backNoFormat Back text of a card without formatting tags.
 * 
 * @return {boolean}
 */
function validate(front, back, frontNoFormat, backNoFormat){
    if (txtEmpty(frontNoFormat, backNoFormat) || tooLong(front, back)){
        return false;
    }

    return true;
}

/**
 * Checks if both the texts are not too long.
 * 
 * @param {string} front Front text of a card.
 * @param {string} back Back text of a card.
 * 
 * @return {boolean}
 */
function tooLong(front, back){
    if (front.length > 3999 || back.length > 3999){
        alert("The text is too long. The maximum allowed length on boths sides is 3999 characters.");
        return true;
    }

    return false;
}

/**
 * Checks if both sides are filled in.
 * 
 * @param {string} front Front text of a card.
 * @param {string} back Back text of a card.
 * 
 * @return {boolean}
 */
function txtEmpty(front, back){
    if (front.length == 0 || back.length == 0){
        alert("Both sides need to be filled in.");
        return true
    }

    return false;
}

// Initialize the quill editors inside card_front and card_back divs.
var quillFront = new Quill('#card_front', {
    theme: 'snow'
  });

  var quillBack = new Quill('#card_back', {
    theme: 'snow'
  });

document.querySelector("form").addEventListener("submit", submit);