<?php
session_start();

// 1. Database Connection Configuration
$host = "localhost";
$port = "5432";
$dbname = "LibraryManagement"; // CHANGE THIS to your actual DB name
$user = "postgres";             // Default pgAdmin user
$password = ""; // CHANGE THIS to your pgAdmin password

// 2. Connect to PostgreSQL
$conn_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";
$dbconn = pg_connect($conn_string);

if (!$dbconn) {
    die("Connection failed: " . pg_last_error());
}

// 3. Process the Form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize inputs to prevent basic hacks
    $username = htmlspecialchars($_POST['username']);
    $password_input = $_POST['password'];

    // 4. Query the database for the user
    // We use parameters ($1) to prevent SQL Injection
    $query = "SELECT * FROM users WHERE username = $1";
    $result = pg_query_params($dbconn, $query, array($username));

    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        
        // 5. Verify Password
        // NOTE: For a real project, use: if (password_verify($password_input, $row['password']))
        // For this simple example matching the SQL insert above, we check plain text:
        if ($password_input === $row['password']) {
            
            // Login Success! Set Session Variables
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // 6. Redirect based on Role
            switch ($row['role']) {
                case 'admin':
                    header("Location: admin_dashboard.php");
                    break;
                case 'staff':
                    header("Location: staff_dashboard.php");
                    break;
                case 'user':
                    header("Location: user_home.php");
                    break;
                default:
                    echo "Role not recognized.";
            }
            exit();
        } else {
            echo "<script>alert('Invalid Password!'); window.location.href='index.html';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location.href='index.html';</script>";
    }
}
?>