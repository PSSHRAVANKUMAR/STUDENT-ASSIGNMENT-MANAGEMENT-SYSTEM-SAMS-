<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "sams");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve data from the database
$query = "SELECT u_signin.u_name AS username, u_signin.r_num AS roll_number, a_file.a_upload AS file_name FROM u_signin JOIN a_file ON u_signin.a_id = a_file.a_id";
$result = mysqli_query($conn, $query);

// Check for errors in query execution
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Submissions</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
	 nav {
            background-color: #000000;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
        }

</style>
</head>
<body>
<nav>
        <div>
            <a href="mainpage.html">Home</a>
            <a href="c_assign1.PHP">Create Assignments</a>
            <a href="view1.PHP">View Assignment</a>
            <a href="submitted.php">submitted</a>
        </div>
</nav>

<div class="container mt-5">
    <h2>Submissions</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Username</th>
                <th>Roll Number</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['roll_number'] . "</td>";
                    echo "<td><a href='uploads/" . $row['file_name'] . "' download>" . $row['file_name'] . "</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No submissions found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
