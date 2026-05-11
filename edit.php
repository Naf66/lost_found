<?php
session_start();

include "db.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];



$sql = "SELECT * FROM student_data

WHERE id='$user_id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);



if (isset($_POST['update'])) {

  $name = $_POST['name'];

  $email = $_POST['email'];

  $phone = $_POST['phone'];

  $dept = $_POST['dept'];


  $profile_pic = $row['profile_pic'];

  if (!empty($_FILES['profile_pic']['name'])) {

    $image_name = $_FILES['profile_pic']['name'];

    $tmp_name = $_FILES['profile_pic']['tmp_name'];

    $profile_pic = "uploads/" . $image_name;

    move_uploaded_file($tmp_name, $profile_pic);
  }


  $update_sql = "UPDATE student_data

    SET

    name='$name',
    email='$email',
    phone='$phone',
    dept='$dept',
    profile_pic='$profile_pic'

    WHERE id='$user_id'";

  if (mysqli_query($conn, $update_sql)) {

    $_SESSION['name'] = $name;

    header("Location: dashboard.php");

    exit();

  } else {

    echo "Error : " . mysqli_error($conn);
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Edit Profile</title>

  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="full">


    <div class="nav">

      <a href="index.php">Home</a>

      <a href="posts.php">Browse Items</a>

      <a href="create_post.php">Create Post</a>

      <a href="my_posts.php">My Posts</a>

      <a href="dashboard.php">Dashboard</a>

      <a href="logout.php">Logout</a>

    </div>


    <div class="form-container">

      <div class="form-content">

        <p class="p4">👤 Edit Profile</p>

        <form action="" method="POST" enctype="multipart/form-data" class="formgrid">

          <div class="cell">

            <label>Full Name</label>

            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

          </div>

          <div class="cell">

            <label>Email</label>

            <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

          </div>

          <div class="cell">

            <label>Phone</label>

            <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>

          </div>

          <div class="cell">

            <label>Department</label>

            <input type="text" name="dept" value="<?php echo $row['dept']; ?>">

          </div>

          <div class="cell">

            <label>Current Profile Picture</label>

            <img src="<?php echo $row['profile_pic']; ?>" class="edit-image">

          </div>

          <div class="cell">

            <label>Upload New Picture</label>

            <input type="file" name="profile_pic" accept="image/*">

          </div>

          <div class="submit">

            <button type="submit" name="update" class="p5">

              Update Profile

            </button>

          </div>

        </form>

      </div>

    </div>

  </div>

  <footer class="footer">
    <p>© 2026 University Lost & Found System</p>
    <p>Built with PHP & MySQL </p>
    <p>Developed by Md.Mohaimin-ul-Mohsin</p>
  </footer>

</body>

</html>