<?php
require_once 'connection.php';
//
$id = $_REQUEST['id'] ?? 0;
$imageDirectory = './public/images/';
//
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    ?>
    <div class="container d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
        <img src="<?php echo $imageDirectory.$user['image'];?>" class="card-img-top" alt="user-image" style="min-height:150px;">
        <div class="card-body">
            <h5 class="card-title"><?php echo $user['image']; ?></h5>
            <p class="card-text">
            Gender : <?php echo $user['gender']; ?><br>
            Mobile : <?php echo $user['mobile']; ?><br>
            Email : <?php echo $user['email']; ?><br>
            </p>
            <button class="btn btn-info btn-sm update-btn" onclick="openUserForm('UpdateUser',<?php echo $user['id']; ?>);">Update User</button>
            <button class="btn btn-warning btn-sm update-btn"  onclick="openUserList();">Back</button>
        </div>
    </div>
</div>
<?php } else { ?>
    <div class="card" style="width: 18rem;">
        No User Available
    </div>
<?php } ?>