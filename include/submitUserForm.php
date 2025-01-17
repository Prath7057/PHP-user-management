<?php
require_once 'connection.php';
//
$panelName = $_REQUEST['panelName'];
$name = $_POST['name'] ?? '';
$gender = $_POST['gender'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$email = $_POST['email'] ?? '';
$image = $_FILES['image'] ?? null;
$id = $_POST['id'] ?? '';
$imageDirectory = '../public/images/';

if (empty($name) || empty($gender) || empty($mobile) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
    exit;
}

if (!preg_match('/^[0-9]{10}$/', $mobile)) {
    echo json_encode(['success' => false, 'message' => 'Invalid mobile number.']);
    exit;
}

if ($panelName == 'AddUser') {
    //
    $imageName = '';
    if ($image && $image['error'] == 0) {
        $imageName = uniqid() . '-' . $image['name'];
        move_uploaded_file($image['tmp_name'], $imageDirectory . $imageName);
    }
    //
    $sql = "INSERT INTO users (name, gender, mobile, email, image) VALUES ('$name', '$gender', '$mobile', '$email', '$imageName')";
     // 
     if (!mysqli_query($conn, $sql)) {
        echo json_encode(['success' => false, 'message' => 'Failed to add user.']);
    }
    //
} else if ($panelName == 'UpdateUser') {
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    //
    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'User not found.']);
        exit;
    }
    //
    $oldImage = $user['image'];
    //
    $imageName = $oldImage;
    if ($image && $image['error'] == 0) {
        $imageName = uniqid() . '-' . $image['name'];
        if (move_uploaded_file($image['tmp_name'], $imageDirectory . $imageName)) {
            if (!empty($oldImage) && file_exists( $imageDirectory . $oldImage)) {
                unlink($imageDirectory . $oldImage);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload the new image.']);
            exit;
        }
    }
    //
    $sql = "UPDATE users SET name = '$name', gender = '$gender', mobile = '$mobile', email = '$email', image = '$imageName' WHERE id = $id";
    // 
    if (!mysqli_query($conn, $sql)) {
        echo json_encode(['success' => false, 'message' => 'Failed to update user.']);
    }
}
include 'openUserList.php';
