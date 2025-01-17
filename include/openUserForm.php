<?php 
$id = $_REQUEST['id'] ?? null; 
$panelname = $_REQUEST['panelName'] ?? null; 
?>
<div class="container d-flex justify-content-center">
    <form id="userForm" class="w-50">
        <h2 class="text-center">ADD USER</h2>

        <div class="modal-body">
            <input type="hidden" name="id" id="userId">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="text" name="mobile" id="mobile" class="form-control" pattern="[0-9]{10}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>
        </div>
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <input type="hidden" name="panelName" id="panelName" value="<?php echo $panelname;?>">
        <div class="modal-footer">
            <button type="button" id="SubmitBtn" class="btn btn-primary"
            onclick="submitUserForm();"
            >Save</button>
        </div>
    </form>
</div>