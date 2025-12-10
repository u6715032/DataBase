<?php
session_start();
// Security Check: If not logged in OR not a regular user, kick them out
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: loginPage.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Member Home</title>
    <link rel="stylesheet" href="/styles/loginPage.css" />
    <style>
        body {
            background: linear-gradient(180deg, #eef2ff 0%, #f6f8fb 100%);
        }
        .home-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .home-card {
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
    <div class="home-container">
        <div class="home-card">
            <h1>Welcome Member, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <p>You can perform the following actions:</p>
            <ul>
                <li>Search and Browse Books</li>
                <li>View Your Loan History</li>
                <li>Reserve Books</li>
                <li>Update Your Profile</li>
            </ul>
            <a class="btn" href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
