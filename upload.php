<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "sams");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process file upload
if (isset($_POST['uploadBtn'])) {
    $assignmentId = $_POST['assignmentId'];
    $file = $_FILES['fileUpload'];

    // File properties
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Check if a file with the same assignment ID already exists
    $checkQuery = "SELECT * FROM a_file WHERE a_id='$assignmentId'";
    $checkResult = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        // If a file with the same assignment ID exists, update the existing record
        $updateQuery = "UPDATE a_file SET a_upload='$fileName' WHERE a_id='$assignmentId'";
        if (mysqli_query($conn, $updateQuery)) {
            // Check if the directory exists and is writable
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            if (move_uploaded_file($fileTmpName, $uploadDir . $fileName)) {
                echo "<script>alert('File updated successfully');</script>";
            } else {
                echo "Error updating file.";
            }
        } else {
            echo "Error updating file: " . mysqli_error($conn);
        }
    } else {
        // If no file with the same assignment ID exists, insert a new record
        $insertQuery = "INSERT INTO a_file (a_id, a_upload) VALUES ('$assignmentId', '$fileName')";
        if (mysqli_query($conn, $insertQuery)) {
            // Check if the directory exists and is writable
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            if (move_uploaded_file($fileTmpName, $uploadDir . $fileName)) {
                echo "<script>alert('File uploaded successfully');</script>";
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Error uploading file: " . mysqli_error($conn);
        }
    }
}
?>


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
        <a href="studentpage.html">Home</a>
        <a href="upload.PHP">Submit Assignments</a>
           
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
                <th>File Upload</th>
            </tr>
        </thead>
        <tbody id="assignmentsTableBody">
            <?php
            // Include PHP code to fetch and display data from the database
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
                    echo "<td>";
                    // Check if a file is uploaded for this assignment
                    $checkQuery = "SELECT * FROM a_file WHERE a_id='" . $row['a_id'] . "'";
                    $checkResult = mysqli_query($conn, $checkQuery);
                    if (mysqli_num_rows($checkResult) > 0) {
                        // Display 'Submitted' label
                        echo "<span class='text-success'>Submitted</span>";
                    } else {
                        // Check if the current date is between start date and end date
                        $currentDate = date('Y-m-d');
                        if ($currentDate >= $row['a_s_date'] && $currentDate <= $row['a_e_date']) {
                            // Display upload form
                            echo "<form action='' method='post' enctype='multipart/form-data'>";
                            echo "<input type='file' name='fileUpload' id='fileUpload" . $row['a_id'] . "'>";
                            echo "<input type='hidden' name='assignmentId' value='" . $row['a_id'] . "'>";
                            echo "<input type='submit' name='uploadBtn' value='Upload'>";
                            echo "</form>";
                        } else {
                            // Display 'Submission closed' message
                            echo "<span class='text-danger'>Submission closed</span>";
                        }
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
