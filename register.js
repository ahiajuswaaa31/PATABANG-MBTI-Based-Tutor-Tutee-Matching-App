document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('register-button').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get form data
        var form = document.getElementById('tutee-registration-form');
        var formData = new FormData(form);

        // Validate form data (basic example)
        if (!validateForm(formData)) {
            alert("Please fill out all required fields.");
            return;
        }

        // Create an XMLHttpRequest to send the data
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'register.php', true); // Change to the correct PHP file for handling the registration
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Handle success response
                alert("Registration successful!");
                form.reset(); // Reset the form
            } else {
                // Handle error response
                alert("Error saving data: " + xhr.responseText);
            }
        };
        xhr.send(formData); // Send the form data
    });
});

// Function to validate form data
function validateForm(formData) {
    for (var pair of formData.entries()) {
        if (!pair[1]) { // If any field is empty
            return false;
        }
    }
    return true; // All fields are filled
}