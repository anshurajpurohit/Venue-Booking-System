// Wait until the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Select all delete buttons
    const deleteButtons = document.querySelectorAll('.btn-danger');

    // Attach a confirmation popup to each delete button
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            // Confirmation message
            const confirmed = confirm('Are you sure you want to delete this user? This action cannot be undone.');
            
            // If user cancels, prevent the action
            if (!confirmed) {
                event.preventDefault();
            }
        });
    });
});
