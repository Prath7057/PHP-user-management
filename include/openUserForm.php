<?php
require_once 'connection.php';
//
$id = $_REQUEST['id'] ?? null;
$panelname = $_REQUEST['panelName'] ?? null;
//
if ($panelname == 'UpdateUser') {
    $query = "select * from users";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    }
}
?>
<div class="container d-flex justify-content-center">
    <form id="userForm" class="w-50">
        <?php if ($panelname == 'UpdateUser') { ?>
            <h2 class="text-center">UPDATE USER</h2>
        <?php } else { ?>
            <h2 class="text-center">ADD USER</h2>
        <?php } ?>
        <div class="modal-body">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $user['name'] ?? '';?>" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option <?php if (isset($user['gender']) && $user['gender'] == 'Male') { echo 'selected';} ?> value="Male">Male</option>
                    <option <?php if (isset($user['gender']) && $user['gender'] == 'Female') { echo 'selected';} ?> value="Female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="text" name="mobile" id="mobile" class="form-control" pattern="[0-9]{10}"  value="<?php echo $user['mobile'] ?? '';?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control"  value="<?php echo $user['email'] ?? '';?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>
        </div>
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
        <input type="hidden" name="panelName" id="panelName" value="<?php echo $panelname; ?>">
        <div class="modal-footer">
            <button type="button" id="SubmitBtn" class="btn btn-primary"
                onclick="submitUserForm();">Save</button>
        </div>
    </form>
</div>