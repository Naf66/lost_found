<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {

    $user_id = $_SESSION['user_id'];

    $title = $_POST['title'];

    $description = $_POST['description'];

    $category = $_POST['category'];

    $location = $_POST['location'];

    $status = $_POST['status'];

    $image_name = $_FILES['image']['name'];

    $tmp_name = $_FILES['image']['tmp_name'];

    $folder = "uploads/items/" . $image_name;

    move_uploaded_file($tmp_name, $folder);


    $sql = "INSERT INTO lost_found
    (user_id,title,description,category,location,image,status)
    
    VALUES
    
    ('$user_id','$title','$description','$category','$location','$folder','$status')";

    if (mysqli_query($conn, $sql)) {

        $success = true;

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

    <title>Create Post</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="full">


        <div class="nav">

            <a href="index.php">Home</a>

            <a href="posts.php">Browse Items</a>

            <a href="dashboard.php">Dashboard</a>

            <a href="logout.php">Logout</a>

            <div class="user-info">

                <span class="user-name">
                    <?php echo $_SESSION['name']; ?>
                </span>

                <img src="uploads/default.png" class="profile-pic">

            </div>

        </div>

        <div class="form-container">

            <div class="form-content">

                <p class="p4">🎒 Create Lost & Found Post</p>

                <form action="" method="POST" enctype="multipart/form-data" class="formgrid">

                    <div class="cell">
                        <label>Item Title</label>
                        <input type="text" name="title" required>
                    </div>

                    <div class="cell">
                        <label>Category</label>

                        <select name="category" required>

                            <option value="">Select</option>

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
                        <input type="text" name="location" required>
                    </div>

                    <div class="cell">
                        <label>Status</label>

                        <select name="status" required>

                            <option value="">Select</option>

                            <option value="lost">Lost</option>

                            <option value="found">Found</option>

                        </select>
                    </div>

                    <div class="cell">
                        <label>Description</label>

                        <textarea name="description" rows="5" required></textarea>
                    </div>

                    <div class="cell">
                        <label>Upload Image</label>

                        <input type="file" name="image" accept="image/*" required>
                    </div>

                    <div class="submit">

                        <button type="submit" name="submit" class="p5">
                            Post Item
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <?php if (isset($success)) { ?>

        <script>

            alert("Post created successfully!");

            window.location.href = "posts.php";

        </script>

    <?php } ?>

    <footer class="footer">
        <p>© 2026 University Lost & Found System</p>
        <p>Built with PHP & MySQL </p>
        <p>Developed by Md.Mohaimin-ul-Mohsin</p>
    </footer>

</body>

</html>