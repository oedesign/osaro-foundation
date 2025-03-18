// Purpose: Handle contact form submission using AJAX
document.getElementById("contact-form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form from refreshing the page

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let subject = document.getElementById("subject").value.trim();
    let message = document.getElementById("message").value.trim();
    let formResult = document.getElementById("form-result");

    if (name === "" || email === "" || subject === "" || message === "") {
        formResult.innerHTML = '<div class="alert alert-danger">All fields are required.</div>';
        return;
    }

    // Basic Email Validation
    let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email)) {
        formResult.innerHTML = '<div class="alert alert-danger">Enter a valid email address.</div>';
        return;
    }

    // Prepare data to send
    let formData = new FormData(this);

    // Send data using AJAX
    fetch("php/contact.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        formResult.innerHTML = '<div class="alert alert-success">' + data + '</div>';
        document.getElementById("contact-form").reset(); // Clear the form
    })
    .catch(error => {
        formResult.innerHTML = '<div class="alert alert-danger">Error submitting form. Try again later.</div>';
    });
});

    
