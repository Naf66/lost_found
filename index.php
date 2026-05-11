<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>University Lost & Found</title>
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

    <div class="container">

      <div class="logpanel">
        <p class="p1">Web Programming Assignment - CSE 2101</p>

        <p class="p3">
          Course Instructor :<br>
          Professor Md. Mojahidul Islam
          <br><br>

          Submitted by :<br>
          Md. Mohaimin-ul-Mohsin
        </p>
      </div>

      <div class="intro">
        <p class="p1">University Lost & Found Portal</p>

        <p class="p2">
          A university-based lost and found platform where students can
          report lost items, upload found belongings, and help reconnect
          owners with their valuables through a secure community system.
        </p>
      </div>

    </div>

    <div class="dec">

      <div class="fdec">
        <p>If you want to post lost or found items</p>

        <a class="reg" href="register.php">
          Join the Community
        </a>

      </div>

    </div>

  </div>

</body>

<footer class="footer">
  <p>© 2026 University Lost & Found System</p>
  <p>Built with PHP & MySQL </p>
  <p>Developed by Md.Mohaimin-ul-Mohsin</p>
</footer>

</html>