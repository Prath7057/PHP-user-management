$(document).ready(function () {
    //
    $('#userTable').DataTable();
    //
});
function openUserForm(panelName, id) {

    var url = "./include/openUserForm.php?panelName=" + encodeURIComponent(panelName);
    //
    if (id) {
        url += "&id=" + encodeURIComponent(id);
    }
    //
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
        alert('Please enter your name.');
    }

    const genderField = document.getElementById('gender');
    if (!genderField.value) {
        isValid = false;
        alert('Please select your gender.');
    }

    const mobileField = document.getElementById('mobile');
    if (!mobileField.value.match(/^[0-9]{10}$/)) {
        isValid = false;
        alert('Please enter a valid 10-digit mobile number.');
    }

    const emailField = document.getElementById('email');
    if (!emailField.value.match(/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/)) {
        isValid = false;
        alert('Please enter a valid email address.');
    }

    // if (!isValid) {
    //     return;
    // }

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