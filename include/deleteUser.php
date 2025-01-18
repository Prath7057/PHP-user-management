<?php
require_once 'connection.php';
//
$id = $_REQUEST['id'] ?? 0;
$imageDirectory = '../public/images/';
//
$query = "SELECT image FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
//
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $image = $user['image'];
    //
    if ($image && file_exists( $imageDirectory . $image)) {
        unlink( $imageDirectory . $image);
    }
    //
    $deleteQuery = "DELETE FROM users WHERE id = $id";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    //
} else {
    echo json_encode(['success' => false, 'message' => 'User not found.']);
}
include 'openUserList.php';
?>