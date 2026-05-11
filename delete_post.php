<?php
session_start();

include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {

    $post_id = $_GET['id'];

    $user_id = $_SESSION['user_id'];

    $check_sql = "SELECT * FROM lost_found

    WHERE id='$post_id'

    AND user_id='$user_id'";

    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {

        $delete_sql = "DELETE FROM lost_found

        WHERE id='$post_id'";

        mysqli_query($conn, $delete_sql);
    }
}

header("Location: my_posts.php");

exit();
?>