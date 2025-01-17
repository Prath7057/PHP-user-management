<?php
require_once 'connection.php';
?>
<div class="container">
    <h2 class="text-center">User List</h2>
    <table id="userTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "select * from users";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $counter = 1;
                while ($user = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['gender']; ?></td>
                        <td><?php echo $user['mobile']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <?php if (!empty($user['image'])): ?>
                                <img src="./public/images/<?php echo $user['image']; ?>" alt="-" style="width: 50px; height: 50px;">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm view-btn" data-id="<?php echo $user['id']; ?>">View</button>
                            <button class="btn btn-warning btn-sm update-btn" onclick="openUserForm('UpdateUser',<?php echo $user['id']; ?>);">Update</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $user['id']; ?>">Delete</button>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
        <tbody>
        </tbody>
    </table>
</div>