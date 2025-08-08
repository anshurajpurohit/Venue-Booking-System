<!-- admin_navbar.php -->
<nav class="admin-navbar">
    <div class="admin-navbar-container">
        <a href="dashboard.php" class="admin-navbar-logo">Admin Panel</a>
        <ul class="admin-navbar-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="add_category.php">Add Category</a></li>
            <li><a href="view_category.php">View Categories</a></li>
            <li><a href="add_venue.php">Add Venue</a></li>
            <li><a href="view_venue.php">View Venues</a></li>
            <li><a href="booking_management.php">Manage Bookings</a></li>
            <li class="dropdown">
                <a href="report_page.php" class="dropbtn">View Reports</a>
                <div class="dropdown-content">
                    <a href="booking_report.php">Booking Report</a>
                    <a href="payment_report.php">Payment Report</a>
                    <a href="feedback_report.php">Feedback Report</a>
                </div>
            </li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="logout.php" onclick="return confirm('Are you sure you want to logout?');">Logout</a></li>
        </ul>
    </div>
</nav>

<style>
    /* Navbar Styles */
    .admin-navbar {
        background-color: #343a40;
        padding: 15px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .admin-navbar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Logo */
    .admin-navbar-logo {
        color: #f8f9fa;
        font-size: 1.5rem;
        font-weight: bold;
        text-decoration: none;
    }

    /* Navbar Links */
    .admin-navbar-links {
        list-style-type: none;
        display: flex;
        gap: 20px;
    }

    .admin-navbar-links a {
        color: #f8f9fa;
        text-decoration: none;
        font-size: 1rem;
        padding: 10px 9px;
        border-radius: 8px;
        transition: background-color 0.3s, color 0.3s;
    }

    .admin-navbar-links a:hover {
        background-color: #495057;
        color: #f8f9fa;
    }

    /* Dropdown Styles */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #ffffff;
        border-radius: 8px;
        min-width: 200px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        top: 50px;
    }

    .dropdown-content a {
        color: #343a40;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        transition: background-color 0.3s;
        border-radius: 5px;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Logout Button */
    .admin-navbar-links li:last-child a {
        background-color: #dc3545;
        color: #ffffff;
        transition: background-color 0.3s ease;
    }

    .admin-navbar-links li:last-child a:hover {
        background-color: #c82333;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .admin-navbar-container {
            flex-direction: column;
            align-items: flex-start;
        }

        .admin-navbar-links {
            flex-direction: column;
            gap: 10px;
        }

        .admin-navbar-links a {
            padding: 10px 15px;
            width: 100%;
        }
    }
</style>
