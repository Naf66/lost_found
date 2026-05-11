<?php
include "db.php";
if (isset($_POST['submit'])) {
  $name = $_POST['fname'];
  $roll = $_POST['rolln'];
  $reg = $_POST['regn'];
  $mail = $_POST['email'];
  $phone = $_POST['phone'];
  $dept = $_POST['dept'];
  $session = $_POST['session'];
  $pass = $_POST['passwd'];
  $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
  $profile_name = $_FILES['profile_pic']['name'];
  $tmp_name = $_FILES['profile_pic']['tmp_name'];

  $folder = "uploads/" . $profile_name;

  move_uploaded_file($tmp_name, $folder);

  $sql = "INSERT INTO student_data(name,roll,reg_no,email,phone,dept,session,password,profile_pic) VALUES 
  ('$name','$roll','$reg','$mail','$phone','$dept','$session','$hash_pass','$folder')";

  if (mysqli_query($conn, $sql)) {
    $success = true;
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration</title>
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
    <div class="form-container">
      <div class="form-content">
        <p class="p4">🗐 Student Registration</p>

        <form action="" method="POST" enctype="multipart/form-data" class="formgrid">
          <div class="cell">
            <label>Full Name</label>
            <input type="text" name="fname" required />
          </div>
          <div class="cell">
            <label>Roll No</label>
            <input type="number" name="rolln" required />
          </div>
          <div class="cell">
            <label>Registration No</label>
            <input type="text" name="regn" required />
          </div>
          <div class="cell">
            <label>Email </label>
            <input type="email" name="email" required />
          </div>
          <div class="cell">
            <label>Phone</label>
            <input type="tel" name="phone" required />
          </div>
          <div class="cell">
            <label>Department</label>
            <input type="text" name="dept" required />
          </div>
          <div class="cell">
            <label>Session</label>
            <input type="text" name="session" required />
          </div>
          <div class="cell">
            <label>Password</label>
            <input type="password" name="passwd" required />
          </div>
          <div class="cell">
            <label>Profile Picture</label>
            <input type="file" name="profile_pic" accept="image/*" required>
          </div>
          <div class="submit">
            <p><button name="submit" class="p5" type="submit" value="register">Submit</button></p>
          </div>
        </form>
        <div class="p6">Already have an account? <a href="login.php">Login here</a></div>
      </div>
    </div>
  </div>
  <?php if (isset($success) && $success): ?>
    <script>
      alert("Registration successful! Login Now ?");
      window.location.href = "login.php";
    </script>
  <?php endif; ?>
</body>
<footer class="footer">
  <p>© 2026 Student Registration System</p>
  <p>Built with PHP & MySQL </p>
  <p>Developed by Md.Mohaimin-ul-Mohsin</p>
</footer>

</html>