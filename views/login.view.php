<?php
/**
 * The view class for the login and registration page.
 */
class LoginView {
    /**
     * Generates the login form.
     * 
     * @param error Error message in case of failed submission.
     * @param email Email from a session in case of a failed submission.
     * 
     * @return void
     */
    public function generateLoginForm($error, $email){
      $email = htmlspecialchars($email, ENT_QUOTES);
        echo "
        <main class='container-fluid'>
            <section class='row justify-content-center'>
                <section class='col-12 col-sm-6 col-md-3'>
        <form action='index.php' method='POST' class='form-container' id='login'>
        <div class='form-group'>
          <label for='exampleInputEmail1'>Email address</label>
          <input type='email' name='email' class='form-control' id='exampleInputEmail1' value='$email' aria-describedby='emailHelp' placeholder='Enter email' required>
          <small id='emailHelp' class='form-text text-muted'>We'll never share your email with anyone else.</small>
        </div>
        <div class='form-group'>
          <label for='exampleInputPassword1'>Password</label>
          <input type='password' name='password' class='form-control' id='exampleInputPassword1' placeholder='Password' required>
        </div>
        <a href='register.php' class='row justify-content-center' id='login-link'>Create a new account</a>
        <span class='row justify-content-center error'>$error</span>
        <input type='submit' name='submit' value='Login' class='btn btn-primary btn-block'>
      </form>
      </section>
      </section>
    </main>";
    }

    /**
     * Generates the registration form.
     * 
     * @param error Error message in case of failed submission.
     * @param email Email from a session in case of a failed submission.
     * 
     * @return void
     */
    public function generateRegisterForm($error, $email){
      $email = htmlspecialchars($email, ENT_QUOTES);
      echo "
      <main class='container-fluid'>
          <section class='row justify-content-center'>
              <section class='col-12 col-sm-6 col-md-3'>
      <form action='register.php' method='POST' class='form-container' id='login'>
      <div class='form-group'>
        <label for='exampleInputEmail1'>Email address</label>
        <input type='email' name='email' class='form-control' id='exampleInputEmail1' value='$email' aria-describedby='emailHelp' placeholder='Enter email' required>
        <small id='emailHelp' class='form-text text-muted'>We'll never share your email with anyone else.</small>
      </div>
      <div class='form-group'>
        <label for='exampleInputPassword1'>Password</label>
        <input type='password' name='password' class='form-control' id='exampleInputPassword1' placeholder='Enter password' required>
      </div>
      <div class='form-group'>
        <label for='r_password'>Repeat your password</label>
        <input type='password' name='r_password' class='form-control' id='r_password' placeholder='Enter password again' required>
      </div>
      <a href='index.php' class='row justify-content-center' id='login-link'>Back to login page</a>
      <span class='row justify-content-center error'>$error</span>
      <input type='submit' name='submit' value='Register' class='btn btn-primary btn-block'>
    </form>
    </section>
    </section>
  </main>";
  }
  
  /**
   * Generates the form for changing a password.
   * 
   * @param error Error message in case of failed submission.
   * 
   * @return void
   */
  public function generateAccountForm($error){
    echo "
      <main class='container-fluid'>
          <section class='row justify-content-center'>
              <section class='col-12 col-sm-6 col-md-3'>
      <form action='account.php' method='POST' class='form-container' id='login'>
      <div class='form-group'>
        <label for='exampleInputPassword1'>Password</label>
        <input type='password' name='password' class='form-control' id='exampleInputPassword1' placeholder='Enter password' required>
      </div>
      <div class='form-group'>
        <label for='r_password'>Repeat your password</label>
        <input type='password' name='r_password' class='form-control' id='r_password' placeholder='Enter password again' required>
      </div>
      <span class='row justify-content-center error'>$error</span>
      <input type='submit' name='submit' value='Change your password' class='btn btn-primary btn-block'>
    </form>
    </section>
    </section>
  </main>";
  }
}

