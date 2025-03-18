// contact form submission using fetch API
document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevents default form submission

        let formData = new FormData(this);

        fetch("contact.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Show response from PHP (success/error)
            this.reset(); // Reset form fields
        })
        .catch(error => console.error("Error:", error));
    });
});

