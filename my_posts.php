<?php
session_start();

include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM lost_found

WHERE user_id='$user_id'

ORDER BY created_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Posts</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="full">


        <div class="nav">

            <a href="index.php">Home</a>

            <a href="posts.php">Browse Items</a>

            <a href="create_post.php">Create Post</a>

            <a href="dashboard.php">Dashboard</a>

            <a href="logout.php">Logout</a>

            <div class="user-info">

                <span class="user-name">
                    <?php echo $_SESSION['name']; ?>
                </span>

                <img src="uploads/default.png" class="profile-pic">

            </div>

        </div>

        <div class="posts-title">

            <h1>📦 My Posts</h1>

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

                            <h2>
                                <?php echo $row['title']; ?>
                            </h2>

                            <p class="status <?php echo $row['status']; ?>">

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

                            <p class="description">

                                <?php echo substr($row['description'], 0, 120); ?>...

                            </p>

                            <p class="post-date">

                                Posted on:
                                <?php echo $row['created_at']; ?>

                            </p>


                            <div class="post-actions">

                                <a href="edit_post.php?id=<?php echo $row['id']; ?>">

                                    <button class="edit-btn">
                                        Edit
                                    </button>

                                </a>

                                <a href="delete_post.php?id=<?php echo $row['id']; ?>"
                                    onclick="return confirm('Delete this post?')">

                                    <button class="delete-btn">
                                        Delete
                                    </button>

                                </a>

                            </div>

                        </div>

                    </div>

                    <?php
                }

            } else {

                echo "

        <div class='empty-posts'>

            <h2>No posts yet</h2>

            <p>Create your first lost/found post.</p>

        </div>

        ";
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