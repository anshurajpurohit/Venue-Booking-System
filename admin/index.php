<?php 
session_start();

// Default username and password
$defaultUsername = 'admin';
$defaultPassword = 'admin123';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $defaultUsername && $password === $defaultPassword) {
        $_SESSION['admin'] = $username; 
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Incorrect username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <style>
        body {
           
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: fadeIn 0.7s ease-in-out;
        }
        .card-header {
            background-color: #2575fc;
            color: #fff;
            padding: 1.2rem 1.5rem;
            text-align: center;
        }
        .card-header h4 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }
        .card-body {
            padding: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 8px rgba(106, 17, 203, 0.2);
        }
        .btn {
            background-color: #6a11cb;
            border: none;
            color: #fff;
            padding: 0.75rem;
            border-radius: 8px;
            width: 100%;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #4e0f9d;
        }
        .alert {
            margin-bottom: 1.5rem;
            text-align: center;
            padding: 0.75rem;
            font-size: 0.9rem;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h4>Admin Login</h4>
        </div>
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
