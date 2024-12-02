<?php

session_start();
require_once('connectdb.php');

if(isset($_POST['submit'])){
    $email = $con->real_escape_string($_POST['email']);
    $pass = $con->real_escape_string($_POST['pass']);

   $sql = "SELECT * FROM USERS WHERE EMAIL = '$email'";
   $query = $con->query($sql);
   $row = $query->fetch_assoc();
   $countMail = $query->num_rows;

   if($countMail == 1 && password_verify($pass, $row['password'])  ){
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['email'] = $row['email'];
        echo "<script>
                alert('Login Succefully');
                window.location.href = 'home.php'
            </script>";
   }else{
    echo "<script>
                alert('Incorrect email or password');
               
            </script>";
   }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - FUTO Ambulance</title>
  <style>
    /* General Styles */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #ff4c4c, #ff2e2e);
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background: #fff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    h1 {
      margin-bottom: 1rem;
      color: #ff4c4c;
    }

    p {
      margin-bottom: 2rem;
      color: #666;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    .form-group {
      margin-bottom: 1rem;
      text-align: left;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 0.5rem;
      color: #333;
    }

    .form-group input {
      width: 100%;
      padding: 0.8rem;
      font-size: 1rem;
      border: 1px solid #ddd;
      border-radius: 5px;
      transition: border 0.3s;
    }

    .form-group input:focus {
      border-color: #ff4c4c;
      outline: none;
    }

    .btn {
      background: #ff4c4c;
      color: #fff;
      padding: 0.8rem;
      font-size: 1rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #e04343;
    }

    .signup-link {
      margin-top: 1rem;
      font-size: 0.9rem;
      color: #007bff;
      text-decoration: none;
    }

    .signup-link:hover {
      text-decoration: underline;
    }

    /* Error Message Styling */
    .error {
      color: #ff4c4c;
      font-size: 0.9rem;
      margin-top: -0.5rem;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Welcome Back</h1>
    <p>Log in to continue accessing FUTO Ambulance services.</p>
    <form action="" method="post">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        <p class="error" id="email-error" style="display: none;">Please enter a valid email address.</p>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="pass" placeholder="Enter your password" required>
        <p class="error" id="password-error" style="display: none;">Password is required.</p>
      </div>
      <button type="submit" class="btn" onclick="return validateForm()" name="submit">Log In</button>
    </form>
    <a href="signup.php" class="signup-link">Don't have an account? Sign up</a> <!-- Link updated -->
  </div>

  <script>
    // Basic Form Validation
    function validateForm() {
      const email = document.getElementById('email');
      const password = document.getElementById('password');
      const emailError = document.getElementById('email-error');
      const passwordError = document.getElementById('password-error');

      let isValid = true;

      // Email Validation
      if (!email.value || !email.value.includes('@')) {
        emailError.style.display = 'block';
        isValid = false;
      } else {
        emailError.style.display = 'none';
      }

      // Password Validation
      if (!password.value) {
        passwordError.style.display = 'block';
        isValid = false;
      } else {
        passwordError.style.display = 'none';
      }

      return isValid;
    }
  </script>
</body>
</html>