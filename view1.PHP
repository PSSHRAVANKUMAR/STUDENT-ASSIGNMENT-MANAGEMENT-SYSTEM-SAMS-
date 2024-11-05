<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Assignment Management System</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    .btn-action {
        margin-right: 5px;
    }

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

    <h2 class="mb-4">Student Assignment Management System</h2>

    <!-- Assignments Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Topic</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="assignmentsTableBody">
            <?php
            // Include PHP code to fetch and display data from the database
            $conn = mysqli_connect("localhost", "root", "", "sams");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $query = "SELECT * FROM c_assign";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['a_topic'] . "</td>";
                    echo "<td>" . $row['a_class'] . "</td>";
                    echo "<td>" . $row['a_sub'] . "</td>";
                    echo "<td>" . $row['a_s_date'] . "</td>";
                    echo "<td>" . $row['a_e_date'] . "</td>";
                    echo "<td>
                        <a href='edit.php?edit=" . $row['a_id'] . "' class='btn btn-primary btn-action'>Edit</a>
                        <a href='delete.php?del=" . $row['a_id'] . "' class='btn btn-danger btn-action'>Delete</a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No assignments found.</td></tr>";
            }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
