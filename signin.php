<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "sams");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $userType = $_POST['user'];
    $username = $_POST['username'];
    $rollNumber = $_POST['Roll_Number'];
    $email = $_POST['Mail'];
    $password = $_POST['password'];

    $sql = "INSERT INTO u_signin (f_name, s_user, u_name, r_num, s_mail, u_password) 
            VALUES ('$fullname', '$userType', '$username', '$rollNumber', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Successfully signed up!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - SAMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
			background-image:url("https://images.unsplash.com/photo-1524169358666-79f22534bc6e?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxleHBsb3JlLWZlZWR8MTl8fHxlbnwwfHx8fHw%3D");
			background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-container {
            background-color: #000000;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(235, 15, 15, 0.1);
            width: 300px;
            text-align: center;
        }

        .signup-container h2 {
            color:#ffffff;
        }

        .form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }

        .form button {
            background-color: #4caf50;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .form button:hover {
            background-color: white;
        }

		.hgt{
		height: 45px;
		width: 300px;
		padding: 15px;	
		}
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up - Student Assignment Management System</h2>
        
        <div class="form">
            <form action="#" method="post">
                <input type="text" name="fullname" placeholder="Full Name" required>
                <label for="User">Choose a User:</label>
                <select id="user" name="user" class="hgt">
                    <option value="Student">Student</option>
                    <option value="Teacher">Teacher</option>
                </select>
                <input type="text" name="username" placeholder="Username" required>
                <input type="number" name="Roll_Number" placeholder="Roll Number" required>
                <input type="email" name="Mail" placeholder="Mail" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Sign Up</button>
            </form>
            <div class="mt-3">
                <p style= " color: white;">If user is already registerd <a href="login1.php">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
