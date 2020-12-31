<?php
    /**
     * The controller for the registration page.
     */
    require_once "includes/autoload.inc.php";
    include_once "views/header.view.php";
    include_once "views/login.view.php";

    session_start();

    $error = False;

    // Handles the registration form.
    if (isset($_POST["submit"])) {
        $validation = new Users();
        $email = $_POST["email"];
        $password = $_POST["password"];
        $rPassword = $_POST["r_password"];

        $_SESSION["registerEmail"] = $_POST["email"];

        if (strlen($password) < 6){
            $error = "Password must be longer than 6 characters.";
        }

        if ($password != $rPassword){
            $error = "Passwords don't match.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "Invalid email.";
        }

        if ($validation->emailExists($email)){
            $error = "An account with this email already exists.";
        }
        
        if (!$error){
            unset($_SESSION["registerEmail"]);
            $validation->createUser($email, password_hash($password, PASSWORD_DEFAULT));
            $validationResult = $validation->loginValidation($email, $password);
            if ($validationResult){
                $_SESSION["id"] = $validationResult;
            }
            header("location: index.php");
        }
    }

    $headerView = new headerView();
    $headerView->generateHead();

    $registerEmail = isset($_SESSION["registerEmail"]) ? $_SESSION["registerEmail"] : False;

    $view = new LoginView();
    
    $view->generateRegisterForm($error, $registerEmail);
?>

<?php
    include_once "views/footer.view.php";
    $footerView = new FooterView();
    $footerView->generatePageEnd();
?>