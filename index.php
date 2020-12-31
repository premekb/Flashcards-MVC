<?php
    /**
     * The controller for the login page.
     */
    require_once "includes/autoload.inc.php";
    include_once "views/header.view.php";
    include_once "views/login.view.php";

    session_start();

    // If the user is logged in.
    if (isset($_SESSION["id"])){
        header("location: decks.php");
    }

    $error = false;

    // Handles the login form.
    if (isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $validation = new Users();
        $_SESSION["loginEmail"] = $_POST["email"];

        $validationResult = $validation->loginValidation($email, $password);

        if ($validationResult){
            unset($_SESSION["loginEmail"]);
            $_SESSION["id"] = $validationResult;
            header("location: decks.php");
        }

        else{
            $error = "Wrong credentials entered.";
        }
    }

    $headerView = new headerView();
    $headerView->generateHead();
    
    $loginEmail = isset($_SESSION["loginEmail"]) ? $_SESSION["loginEmail"] : False;

    $view = new LoginView();

    $view->generateLoginForm($error, $loginEmail);

?>

<?php
    include_once "views/footer.view.php";
    $footerView = new FooterView();
    $footerView->generatePageEnd();
?>