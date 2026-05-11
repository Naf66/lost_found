<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM student_data WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="full">

    <div class="nav">

      <a href="index.php">Home</a>

      <a href="posts.php">Browse Items</a>

      <?php if (isset($_SESSION['user_id'])) { ?>

        <a href="create_post.php">Create Post</a>
        <a href="my_posts.php">My Posts</a>

        <a href="dashboard.php">Dashboard</a>

        <a href="logout.php">Logout</a>

      <?php } else { ?>

        <a href="login.php">Login</a>

        <a href="register.php">Register</a>

      <?php } ?>
      <div class="user-info">
        <?php echo $_SESSION['name']; ?>
        <span class="user-name">
          <img src="<?php echo $row['profile_pic']; ?>" class="profile-pic">
        </span>
      </div>

    </div>

    <div class="form-container">

      <div class="form-content">

        <p class="p4">🎓 Student Dashboard</p>

        <div class="cell">
          <label>Full Name</label>
          <p><?php echo $row['name']; ?></p>
        </div>

        <div class="cell">
          <label>Roll No</label>
          <p><?php echo $row['roll']; ?></p>
        </div>

        <div class="cell">
          <label>Registration No</label>
          <p><?php echo $row['reg_no']; ?></p>
        </div>

        <div class="cell">
          <label>Email</label>
          <p><?php echo $row['email']; ?></p>
        </div>

        <div class="cell">
          <label>Phone</label>
          <p><?php echo $row['phone']; ?></p>
        </div>

        <div class="cell">
          <label>Department</label>
          <p><?php echo $row['dept']; ?></p>
        </div>

        <div class="cell">
          <label>Session</label>
          <p><?php echo $row['session']; ?></p>
        </div>

        <div class="submit">
          <a href="edit.php">
            <button>Edit Profile</button>
          </a>
        </div>

      </div>

    </div>

  </div>

  <footer class="footer">
    <p>© 2026 Student Registration System</p>
    <p>Built with PHP & MySQL </p>
    <p>Developed by Md.Mohaimin-ul-Mohsin</p>
  </footer>

</body>

</html>