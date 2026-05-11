<?php
session_start();
include "db.php";

$user_data = null;

if (isset($_SESSION['user_id'])) {

  $user_id = $_SESSION['user_id'];

  $user_sql = "SELECT * FROM student_data

    WHERE id='$user_id'";

  $user_result = mysqli_query($conn, $user_sql);

  $user_data = mysqli_fetch_assoc($user_result);
}

$sql = "SELECT lost_found.*, student_data.name, student_data.profile_pic,student_data.phone

FROM lost_found

JOIN student_data

ON lost_found.user_id = student_data.id

ORDER BY created_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Items</title>
  <link rel="stylesheet" href="style.css">
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

        <div class="user-info">
          <?php echo $_SESSION['name']; ?>
          <span class="user-name">
            <img src="<?php echo $user_data['profile_pic']; ?>" class="profile-pic">
          </span>
        </div>

      <?php } else { ?>

        <a href="login.php">Login</a>

        <a href="register.php">Register</a>

      <?php } ?>

    </div>


    <div class="posts-title">
      <h1>🎒 Lost & Found Items</h1>
    </div>


    <div class="posts-container">

      <?php
      if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
          ?>

          <div class="post-card">

            <div class="image-container">

              <img src="<?php echo $row['image']; ?>" class="post-image">

            </div>

            <div class="post-content">
              <div class="post-user">

                <img src="<?php echo $row['profile_pic']; ?>" class="mini-profile">

                <div class="user-details">

                  <p class="poster-name">

                    <?php echo $row['name']; ?>

                  </p>

                  <p class="post-date">

                    <?php echo date(
                      "d M Y, h:i A",
                      strtotime($row['created_at'])
                    ); ?>

                  </p>

                </div>

              </div>

              <h2><?php echo $row['title']; ?></h2>

              <p class="status <?php echo $row['status']; ?>">
                Status:
                <?php echo strtoupper($row['status']); ?>
              </p>

              <p>
                <strong>Category:</strong>
                <?php echo $row['category']; ?>
              </p>

              <p>
                <strong>Location:</strong>
                <?php echo $row['location']; ?>
              </p>
              <p>
                <strong>Contact:</strong>

                <?php echo $row['phone']; ?>
              </p>

              <p class="description">
                <?php echo $row['description']; ?>
              </p>

            </div>

          </div>

          <?php
        }
      } else {
        echo "<h2>No items posted yet.</h2>";
      }
      ?>

    </div>

  </div>

  <footer class="footer">
    <p>© 2026 University Lost & Found System</p>
    <p>Built with PHP & MySQL </p>
    <p>Developed by Md.Mohaimin-ul-Mohsin</p>
  </footer>

</body>

</html>