<?php

include "config.php";
// Check if form is submitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST["employee_id"];
    $employee_name = $_POST["employee_name"];
    $global_table_id = $_POST["global_table_id"];
  
    $sql1 = "INSERT INTO employee (employee_id, employee_name,global_table_id) 
            VALUES ('$employee_id', '$employee_name', '$global_table_id')";
    if($conn->query($sql1) === TRUE) {
        echo "New record created successfully";
        // header("Location: core_view_fetch.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



//data fetch from database
$sql2 = "SELECT * FROM employee where is_active=1";
$result = $conn->query($sql2); 
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr> <th>id</th>   <th>EmployId</th>   <th>Employee Nmae</th>   <th>Global-Table-Id</th>    <th>Is Active</th>     <th>Inserted By</th>   <th>Insert-Date</th>  <th>Update By</th>   <th>Update-Date</th>   <th>Action</th>  <th>Update</th>  </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['employee_id']."</td>";
            echo "<td>".$row['employee_name']."</td>";
            echo "<td>".$row['global_table_id']."</td>";
            echo "<td>".$row['is_active']."</td>";
            echo "<td>".$row['insert_by']."</td>";
            echo "<td>".$row['insert_date']."</td>";
            echo "<td>".$row['update_by']."</td>";
            echo "<td>".$row['update_date']."</td>";
            // echo "<td><a href=\"query.php?id=".$row['id']."\">x</a></td>";
            echo "<td><a href='".$_SERVER['PHP_SELF']."?action=delete&id=".$row['id']."'>x</a></td>";
            // echo "<td><a href='".$_SERVER['PHP_SELF']."?action=edit&id=".$row['id']."'>x</a></td>";
            echo "<td><a href='edit_record_form.php?action=edit&id=".$row['id']."'>edit</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}else{
    echo "0 results";
}





// delete row and set is_active to zero in the database
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    echo "ailoi tu";
    // Get the ID of the row to delete
    $id = $_GET['id'];
    // Perform deletion
    $sql_delete = "UPDATE employee SET is_active = 0 WHERE id = $id";
    if ($conn->query($sql_delete) === TRUE) {
        // If deletion is successful, redirect to the same page to refresh the table
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        // If there's an error, print the error message
        echo "Error deleting record: " . $conn->error;
    }
}







$conn->close();
?>