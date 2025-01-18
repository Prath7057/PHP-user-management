$(document).ready(function () {
    //
    $('#userTable').DataTable();
    //
});
function openUserForm(panelName, id) {
   let confirmBox;
    if (panelName == 'UpdateUser') {
         confirmBox = confirm('Do You Really Want to Update This User ?');
    }
    var url = "./include/openUserForm.php?panelName=" + encodeURIComponent(panelName);
    //
    if (id) {
        url += "&id=" + encodeURIComponent(id);
    }
    //
    if ((confirmBox && panelName == 'UpdateUser') || panelName == 'AddUser') {
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                $("#contents").html(response);
                initializeInputFields();
                document.getElementById('name').focus();
            },
            error: function (xhr, status, error) {
                console.error("Error loading user form:", error);
            }
        });
    }    
    //
}
//
function initializeInputFields() {
    const inputFields = document.querySelectorAll("input, button, select");
    //
    inputFields.forEach((field) => {

        field.addEventListener("keydown", handleKeyboardNavigation);
    });
    //
    function handleKeyboardNavigation(event) {
        const currentField = event.target;
        const currentIndex = Array.from(inputFields).indexOf(currentField);
        if (event.key === "Enter" && currentField.type != 'submit') {
            event.preventDefault();
            const nextField = inputFields[currentIndex + 1];
            if (nextField) {
                nextField.focus();
            }
        }
        if (event.key === "Backspace" && currentField.value.length === 0) {
            const previousField = inputFields[currentIndex - 1];
            if (previousField) {
                previousField.focus();
            }
        }
    }
}
//
function submitUserForm() {
    //
    let isValid = true;
    //
    const nameField = document.getElementById('name');
    if (!nameField.value.trim()) {
        isValid = false;
        alert('Please Enter Your Name!');
    }

    const genderField = document.getElementById('gender');
    if (!genderField.value) {
        isValid = false;
        alert('Please Select Gender!');
    }

    const mobileField = document.getElementById('mobile');
    if (!mobileField.value.match(/^[0-9]{10}$/)) {
        isValid = false;
        alert('Please Enter A valid 10-Digit Mobile No.');
    }

    const emailField = document.getElementById('email');
    if (!emailField.value.match(/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/)) {
        isValid = false;
        alert('Please Valid E-mail Id.');
    }

    if (!isValid) {
        return;
    }

    const formData = new FormData(document.getElementById('userForm'));
    //
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", 'include/submitUserForm.php', true);
    //
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.getElementById("contents").innerHTML = xmlhttp.responseText;
            $('#userTable').DataTable();
        }
    };
    xmlhttp.send(formData);
}
//
function deleteUser(id) {
    let confirmBox = confirm('Do You Really Want to Delete This User ?');
    if (confirmBox) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("contents").innerHTML = xmlhttp.responseText;
                $('#userTable').DataTable();
            }
        };
        xmlhttp.open("POST", "include/deleteUser.php?id=" + id, true);
        xmlhttp.send();
    }
}
//
function viewUser(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("contents").innerHTML = xmlhttp.responseText;
            $('#userTable').DataTable();
        }
    };
    xmlhttp.open("POST", "include/viewUser.php?id=" + id, true);
    xmlhttp.send();
}
//
function openUserList() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("contents").innerHTML = xmlhttp.responseText;
            $('#userTable').DataTable();
        }
    };
    xmlhttp.open("POST", "include/openUserList.php", true);
    xmlhttp.send();
}
//