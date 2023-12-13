<?php
// Include your database connection script
require "connection.php";

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $invoiceId = mysqli_real_escape_string($conn, $_POST['invoiceId']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $dueDate = mysqli_real_escape_string($conn, $_POST['dueDate']);
    $lastConnected = mysqli_real_escape_string($conn, $_POST['lastConnected']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);

    // SQL query to insert data into the database
    $sql = "INSERT INTO list_view (`Invoice Id`, Status, Company, Location, `Due Date`, `Last Connected`, Currency, Amount) 
    VALUES ('$invoiceId', '$status', '$company', '$location', '$dueDate', '$lastConnected', '$currency', '$amount')";

    // Perform the query
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        header("Location: index2.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect to the form page if the form is not submitted
    header("Location: index2.php");
    exit();
}
?>
