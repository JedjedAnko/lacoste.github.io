

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="login.css">
  <title>Lacoste | Login</title>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container sign-up-container">
      <form action="creatacc.php" method="POST">
        <h1>Create Account</h1>
        <input type="text" placeholder="Username" name="Username" />
        <input type="password" placeholder="Password" name="Password" />
        <input type="password" placeholder="Confirm Password" name="confirm_password" />
        <button type="submit" name="submit" value="Submit">Sign Up</button>
      </form>
    </div>
    <div class="form-container sign-in-container">
      <form action="session_chk.php" method="POST" onsubmit="return validateForm()">
        <h1>Sign in</h1>
        <input type="text" placeholder="Username" name="Username" />
        <input type="password" placeholder="Password" name="Password" />
        <a href="#">Forgot your password?</a>
        <button name="login">Sign In</button>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Welcome Back!</h1>
          <p>
            To keep connected with us please login with your personal info
          </p>
          <button class="ghost" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Hello, Friend!</h1>
          <p>Enter your personal details and start journey with us</p>
          <button class="ghost" id="signUp">Sign Up</button>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
  const signUpButton = document.getElementById("signUp");
  const signInButton = document.getElementById("signIn");
  const container = document.getElementById("container");

  signUpButton.addEventListener("click", () => {
    container.classList.add("right-panel-active");
  });

  signInButton.addEventListener("click", () => {
    container.classList.remove("right-panel-active");
  });
</script>
<script>
  function validateForm() {
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;

    if (password != confirm_password) {
      alert("Passwords do not match");
      return false;
    }
    return true;
  }
</script>

</html>