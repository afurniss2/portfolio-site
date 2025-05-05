<?php
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
  header("Location: admin.php");
  exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';
  if ($username === 'admin' && $password === 'secret123') {
    $_SESSION['admin'] = true;
    header("Location: admin.php");
    exit;
  } else {
    $error = "Invalid credentials";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="styles.css">
  <style>
  * {
    box-sizing: border-box;
  }

  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
  }

  .login-container {
    width: 100%;
    max-width: 400px;
    padding: 2rem;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  }

  .login-container h2 {
    text-align: center;
    margin-bottom: 1.5rem;
  }

  .login-container input {
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .login-container button {
    width: 100%;
    padding: 0.75rem;
    background-color: #0077cc;
    color: white;
    font-size: 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .login-container button:hover {
    background-color: #005fa3;
  }

  .login-container .error {
    color: red;
    text-align: center;
    margin-top: 0.5rem;
  }
</style>

</head>
<body>
  <div class="login-container">
    <h2>Admin Login</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
      <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </form>
  </div>
</body>
</html>
