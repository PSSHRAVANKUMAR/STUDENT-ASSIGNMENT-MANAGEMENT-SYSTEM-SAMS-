<?php
// Check if edit parameter is set and numeric
if(isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    
    // Fetch data from database based on the edit_id
    $conn = mysqli_connect("localhost", "root", "", "sams");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Escape the edit_id to prevent SQL injection
    $edit_id = mysqli_real_escape_string($conn, $edit_id);
    $query = "SELECT * FROM c_assign WHERE a_id = $edit_id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    // Check if a row is found
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        // If no row is found, redirect back to the main page or handle it accordingly
        header("view1.php");
        exit();
    }
    mysqli_close($conn);
} else {
    // If edit parameter is not set or not numeric, redirect back to the main page or handle it accordingly
    header("view1.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Assignment</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Assignment</h2>
    <form method="post" action="update.php">
        <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
        <div class="form-group">
            <label for="topic">Topic:</label>
            <input type="text" class="form-control" id="topic" name="topic" value="<?php echo isset($row['a_topic']) ? $row['a_topic'] : ''; ?>">

		<label for="class">Class:</label>
		  <select class="form-control" id="class" name="class" required value="<?php echo isset($row['a_class']) ? $row['a_class'] : ''; ?>">
            <option value="">Select a class</option>
            <option value="BSC MECS A">BSC MECS A</option>
            <option value="BSC MECS B">BSC MECS B</option>
            <option value="BSC MSCS A">BSC MSCS A</option>
            <option value="BSC MSCS B">BSC MSCS B</option>
            <option value="BSC MPCS A">BSC MPCS A</option>
            <option value="BSC MPCS B">BSC MPCS B</option>
            <option value="BSC HDS">BSC HDS</option>
            
        </select><br><br>

		<label for="subject">Subject:</label>
		<input type="text" class="form-control" id="subject" name="subject" value="<?php echo isset($row['a_sub']) ? $row['a_sub'] : ''; ?>"><br><br>

		<label for="start_date">Start Date:</label>
		<input type="date" id="start_date" name="s_date" required onchange="setMinEndDate()" value="<?php echo isset($row['a_s_date]']) ? $row['a_s_date'] : ''; ?>">			<br><br>
		
		<label for="end_date">End Date:</label>
        	<input type="date" id="end_date" name="e_date" required><br><br>	


	</div>
        <!-- Add other form fields here -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<script>
function setMinEndDate() {
    var startDate = document.getElementById("start_date").value;
    document.getElementById("end_date").min = startDate;
}
</script>
</body>
</html>

