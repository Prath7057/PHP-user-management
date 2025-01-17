<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <ul class="nav justify-content-start">
            <li class="nav-item">
                <button type="button" class="btn btn-outline-info">HOME</button>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-outline-primary ms-2"
                    onclick="openUserForm('AddUser','');">ADD USER</button>
            </li>
        </ul>
    </div>
    <div id="contents">
       <?php
       include 'include/openUserList.php';
       ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script/script.js"></script>
</body>

</html>