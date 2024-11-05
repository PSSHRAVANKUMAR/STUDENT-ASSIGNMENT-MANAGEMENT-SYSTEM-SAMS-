<?php
// Start session to manage user login state
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "sams");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the login form is submitted
if (isset($_POST['login'])) {
    $s_user = $_POST['s_user'];
    $u_name = $_POST['u_name'];
    $u_password = $_POST['u_password'];

    // Sanitize inputs to prevent SQL injection
    $s_user = mysqli_real_escape_string($conn, $s_user);
    $u_name = mysqli_real_escape_string($conn, $u_name);
    $u_password = mysqli_real_escape_string($conn, $u_password);

    // Query to check if user exists with provided credentials
    $query = "SELECT * FROM `u_signin` WHERE s_user='$s_user' AND u_password='$u_password' AND u_name='$u_name'";
    $result = mysqli_query($conn, $query);

    // If a row is returned, the user exists
    if (mysqli_num_rows($result) == 1) {
        // Set session variables for logged-in user
        $_SESSION['username'] = $s_user;

        // Redirect based on user type
        if ($s_user == 'Student') {
            header("Location: studentpage.html"); // Redirect to student page
        } elseif ($s_user == 'Teacher') {
            header("Location: mainpage.html"); // Redirect to teacher page
        }
        exit();
    } else {
        // Display error message for invalid credentials
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Login</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="s_user">Select user </label>
                    <select id="s_user" name="s_user" class="form-control">
                        <option value="Student">Student</option>
                        <option value="Teacher">Teacher</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="u_name">Username</label>
                    <input type="text" class="form-control" id="u_name" name="u_name" required>
                </div>
                <div class="form-group">
                    <label for="u_password">Password</label>
                    <input type="password" class="form-control" id="u_password" name="u_password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="login">Login</button>
                <?php if (isset($error)) { ?>
                    <div class="text-danger"><?php echo $error; ?></div>
                <?php } ?>
            </form>
            <div class="mt-3">
                <p>If you are not registered, <a href="signin.php">register here</a>.</p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
