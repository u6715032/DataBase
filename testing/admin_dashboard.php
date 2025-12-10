<?php
session_start();
// Security Check: If not logged in OR not an admin, kick them out
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginPage.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/styles/loginPage.css" />
    <style>
        body {
            background: linear-gradient(180deg, #eef2ff 0%, #f6f8fb 100%);
        }
        .dashboard-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .dashboard-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 30px rgba(16,24,40,0.08);
            border: 1px solid rgba(15,23,42,0.04);
        }
        h1 { color: #0f172a; margin-top: 0; }
        p { color: #6b7280; line-height: 1.6; }
        .btn { display: inline-block; margin-top: 20px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-card">
            <h1>Welcome Admin, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <p>Here you can manage Books, Members, and Loans.</p>
            <ul>
                <li>Manage Users</li>
                <li>Manage Books</li>
                <li>View Reports</li>
                <li>System Settings</li>
            </ul>
            <a class="btn" href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>