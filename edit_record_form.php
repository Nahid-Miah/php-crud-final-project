<?php

include "config.php";

// Check if form is submitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if it's an update request
    if(isset($_POST["update_id"])) {
        $update_id = $_POST["update_id"];
        $employee_id = $_POST["employee_id"];
        $employee_name = $_POST["employee_name"];
        $global_table_id = $_POST["global_table_id"];

        // Update the record in the database
        $sql_update = "UPDATE employee SET employee_id='$employee_id', employee_name='$employee_name', global_table_id='$global_table_id' WHERE id=$update_id";
        if($conn->query($sql_update) === TRUE) {
            echo "Record updated successfully";
            header("Location: query.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } 
}

// Edit record form
if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    $sql_fetch = "SELECT * FROM employee WHERE id=$edit_id";
    $result_fetch = $conn->query($sql_fetch);
    if($result_fetch->num_rows > 0) {
        $row = $result_fetch->fetch_assoc();
        $employee_id = $row['employee_id'];
        $employee_name = $row['employee_name'];
        $global_table_id = $row['global_table_id'];
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Employee</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <h2>Edit Record</h2>
                <input type="hidden" name="update_id" value="<?php echo $edit_id; ?>">
                <div class="form-group">
                    <label for="employee_id">Employee ID:</label>
                    <input type="text" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>">
                </div>
                <div class="form-group">
                    <label for="employee_name">Employee Name:</label>
                    <input type="text" name="employee_name" id="employee_name" value="<?php echo $employee_name; ?>">
                </div>
                <div class="form-group">
                    <label for="global_table_id">Global Table ID:</label>
                    <input type="text" name="global_table_id" id="global_table_id" value="<?php echo $global_table_id; ?>">
                </div>
                <button type="submit" class="submit-btn">Update</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Record not found";
    }
} else {
    // Display your other HTML content here
}

?>
