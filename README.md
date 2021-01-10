# Flashcards-MVC
 A flashcards PHP app built using the MVC pattern, MySQL, Bootstrap 4, plain JS and Quill editor. [Try it out :)](https://www.premekbelka.com/flashcards/index.php)
 
# Functionality
 - Registration and login system.
 - Organising your flashcards into decks.
 - Editing flashcards in a WYSIWYG editor Quill.
 - Flashcard review process utilizing AJAX.
 
 # Code structure
  - Controlers - All of the php files in the root folder serve as front page controllers. They instantiate models, which fetch the data from the DB and then pass the data to appropriate views.
  - Views - Echoes out the html code.
  - Models - Every table in the DB, has its own model.
  - static - Contains css styles, and JS code.
  - includes - Autoloader, logout script
  
