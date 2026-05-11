<?php
session_start();
include "db.php";
if (isset($_POST['submit'])) {
  $mail = $_POST['lemail'];
  $passwd = $_POST['password'];

  $sql = "SELECT * FROM student_data WHERE email='$mail'";
  $result = mysqli_query($conn, $sql);


  $row = mysqli_fetch_assoc($result);

  if ($row) {


    if (password_verify($passwd, $row['password'])) {


      $_SESSION['user_id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['email'] = $row['email'];

      header("Location: dashboard.php");
      exit();

    } else {
      $error = "Wrong password! Try Again";
    }

  } else {
    $error = "User not found!";
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="full">
    <div class="nav">

      <a href="index.php">Home</a>

      <a href="posts.php">Browse Items</a>

      <?php if (isset($_SESSION['user_id'])) { ?>

        <a href="create_post.php">Create Post</a>

        <a href="dashboard.php">Dashboard</a>

        <a href="logout.php">Logout</a>

      <?php } else { ?>

        <a href="login.php">Login</a>

        <a href="register.php">Register</a>

      <?php } ?>

    </div>
    <div class="login-container">
      <div class="login-content">
        <?php if (isset($error)) { ?>
          <p
            style="color:red; padding: 5px;border:1px;border-radius:10px; background-color:rgba(0, 0, 0, 0.67);font-size:27px; font_weight:500;">
            <?php echo $error; ?>
          </p>
        <?php } ?>
        <p class="p4">✨Login</p>
        <form action="" method="POST" class="login-form">
          <div class="cell">
            <label>Email</label>
            <input type="email" name="lemail" required /><br>
          </div>
          <div class="cell">
            <label>Password</label>
            <input type="password" name="password" required /><br><br>
          </div>
          <div class="submit">
            <button type="submit" name="submit">Login</button>
          </div>
        </form>
        <p class="p6">Don't have an account?<a href="register.php">Register here</a></p>
      </div>
    </div>
  </div>
</body>
<footer class="footer">
  <p>© 2026 Student Registration System</p>
  <p>Built with PHP & MySQL </p>
  <p>Developed by Md.Mohaimin-ul-Mohsin</p>
</footer>

</html>