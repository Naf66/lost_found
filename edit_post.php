<?php
session_start();

include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    header("Location: my_posts.php");
    exit();
}

$post_id = $_GET['id'];



$sql = "SELECT * FROM lost_found

WHERE id='$post_id'

AND user_id='$user_id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if (!$row) {
    header("Location: my_posts.php");
    exit();
}



if (isset($_POST['update'])) {

    $title = $_POST['title'];

    $description = $_POST['description'];

    $category = $_POST['category'];

    $location = $_POST['location'];

    $status = $_POST['status'];


    $image_path = $row['image'];


    if (!empty($_FILES['image']['name'])) {

        $image_name = $_FILES['image']['name'];

        $tmp_name = $_FILES['image']['tmp_name'];

        $image_path = "uploads/items/" . $image_name;

        move_uploaded_file($tmp_name, $image_path);
    }

    $update_sql = "UPDATE lost_found

    SET

    title='$title',
    description='$description',
    category='$category',
    location='$location',
    status='$status',
    image='$image_path'

    WHERE id='$post_id'";

    if (mysqli_query($conn, $update_sql)) {

        header("Location: my_posts.php");

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

    <title>Edit Post</title>

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

                <p class="p4">✏️ Edit Post</p>

                <form action="" method="POST" enctype="multipart/form-data" class="formgrid">

                    <div class="cell">

                        <label>Item Title</label>

                        <input type="text" name="title" value="<?php echo $row['title']; ?>" required>

                    </div>

                    <div class="cell">

                        <label>Category</label>

                        <select name="category" required>

                            <option value="<?php echo $row['category']; ?>">

                                <?php echo $row['category']; ?>

                            </option>

                            <option value="Electronics">Electronics</option>

                            <option value="Wallet">Wallet</option>

                            <option value="ID Card">ID Card</option>

                            <option value="Bag">Bag</option>

                            <option value="Books">Books</option>

                            <option value="Other">Other</option>

                        </select>

                    </div>

                    <div class="cell">

                        <label>Location</label>

                        <input type="text" name="location" value="<?php echo $row['location']; ?>" required>

                    </div>

                    <div class="cell">

                        <label>Status</label>

                        <select name="status" required>

                            <option value="<?php echo $row['status']; ?>">

                                <?php echo strtoupper($row['status']); ?>

                            </option>

                            <option value="lost">Lost</option>

                            <option value="found">Found</option>

                        </select>

                    </div>

                    <div class="cell">

                        <label>Description</label>

                        <textarea name="description" rows="5" required><?php echo $row['description']; ?></textarea>

                    </div>

                    <div class="cell">

                        <label>Current Image</label>

                        <img src="<?php echo $row['image']; ?>" class="edit-image">

                    </div>

                    <div class="cell">

                        <label>Upload New Image</label>

                        <input type="file" name="image" accept="image/*">

                    </div>

                    <div class="submit">

                        <button type="submit" name="update" class="p5">

                            Update Post

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