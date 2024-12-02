<?php

require_once('connectdb.php');

if(isset($_POST['submit'])){
  $fname = $con->real_escape_string($_POST['fname']) ;
  $email = $con->real_escape_string($_POST['email']);
  $pass = $con->real_escape_string($_POST['pass']);
  $cpass = $con->real_escape_string($_POST['cpass']);
  $hpass = password_hash($pass, PASSWORD_DEFAULT);

  $checkEmail = "SELECT * FROM `users` WHERE `email` = '$email'";
  $check = $con->query($checkEmail);
  $count = $check->num_rows;

  if($count == 0){
      if($pass == $cpass){
          $query ="INSERT INTO `USERS`(`fullname`, `email`, `password`) VALUES('$fname', '$email', '$hpass')";
          $result = $con->query($query);
          echo "<script>alert('You have succesfully registered, you can now log in');
          window.location.href = 'login.php';
          </script>";        
      }else{
          echo "Re-confirm your password";
      }
  }else{
      echo "<script>alert('Email Already taken')</script>";
  }

 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - FUTO Ambulance</title>
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

    .login-link {
      margin-top: 1rem;
      font-size: 0.9rem;
      color: #007bff;
      text-decoration: none;
    }

    .login-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Create Account</h1>
    <p>Sign up to access FUTO Ambulance services.</p>
    <form action="" method="post">
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="fname" placeholder="Enter your full name" required>
      </div>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="pass" placeholder="Create a password" required>
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="cpass" placeholder="Confirm your password" required>
      </div>
      <!-- <button type="submit" name="submit" class="btn">Sign Up</button> -->
       <input type="submit" value="Sign Up" name="submit" class="btn">
    </form>
    <a href="login.php" class="login-link">Already have an account? Log In</a>
  </div>
</body>
</html>