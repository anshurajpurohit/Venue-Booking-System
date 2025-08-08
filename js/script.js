// Navigation and Scrolling
document.addEventListener("DOMContentLoaded", function() {
    console.log("JavaScript Loaded!");
});

// Slider Functionality (for home page slider)
let slideIndex = 0;
showSlides();

function showSlides() {
    let slides = document.getElementsByClassName("slider-image");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex-1].style.display = "block";
    setTimeout(showSlides, 3000); // Change slide every 3 seconds
}

// Form Validation
function validateForm() {
    let requiredInputs = document.querySelectorAll('input[required]');
    for (let i = 0; i < requiredInputs.length; i++) {
        if (requiredInputs[i].value.trim() === "") {
            alert("Please fill all required fields.");
            return false;
        }
    }
    return true;
}

// Payment Handling Example
function processPayment() {
    let amount = document.getElementById('amount').value;
    if (isNaN(amount) || amount <= 0) {
        alert('Please enter a valid amount.');
        return false;
    }
    alert('Payment Successful! Amount: ' + amount);
    return true;
}

// Confirmation Dialogs for Deleting/Cancelling Actions
document.querySelectorAll('.confirm-action').forEach(item => {
    item.addEventListener('click', event => {
        if (!confirm("Are you sure? This action cannot be undone.")) {
            event.preventDefault();
        }
    });
});


// script.js
document.addEventListener('DOMContentLoaded', function() {
    const navbarLinks = document.querySelector('.navbar-links');
    const adminNavbarLinks = document.querySelector('.admin-navbar-links');
    
    document.querySelector('.navbar-logo').addEventListener('click', function() {
        navbarLinks.classList.toggle('show');
    });

    document.querySelector('.admin-navbar-logo').addEventListener('click', function() {
        adminNavbarLinks.classList.toggle('show');
    });
});


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


// Example of mobile-friendly navigation toggle
document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('nav ul');

    if (navToggle) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
        });
    }
});


// JavaScript to handle sidebar toggle
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.querySelector('.sidebar-toggle');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        });
    }
});
