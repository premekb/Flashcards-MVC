<?php
    /**
     * The controller for the account page.
     */
    require_once "includes/autoload.inc.php";
    include_once "views/header.view.php";
    include_once "views/login.view.php";

    session_start();

    // If the user is not logged in.
    if (!isset($_SESSION["id"])){
        header("location: index.php");
    }

    $error = False;

    // Handles the change your password form.
    if (isset($_POST["submit"])){
        $password = $_POST["password"];
        $rPassword = $_POST["r_password"];

        if ($password != $rPassword){
            $error = "Passwords don't match";
        }

        if (strlen($password) < 6){
            $error = "Password has to be at least 6 characters long.";
        }

        if (!$error){
            $usersModel = new Users();
            $usersModel->changePassword($_SESSION["id"], $_POST["password"]);
            $error = "<span style = 'color: green'>Password changed.</span>";
        }
    }

    $headerView = new headerView();
    $headerView->generateHead();
    $headerView->generateNavBar();
?>
<main>
    <?php
    $accountView = new LoginView();
    $accountView->generateAccountForm($error);
    ?>

</main>
<?php
    include_once "views/footer.view.php";
    $footerView = new FooterView();
    $footerView->generatePageEnd();
?>