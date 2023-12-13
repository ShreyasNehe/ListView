<?php
// Assuming you have a database connection here
require "./connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the rows to delete from the AJAX request
    $rowsToDelete = json_decode($_POST["rowsToDelete"]);

    if (!empty($rowsToDelete)) {
        // Construct your SQL query to delete the rows
        $placeholders = implode(",", array_fill(0, count($rowsToDelete), "?"));
        $sql = "DELETE FROM list_view WHERE `Invoice Id` IN ($placeholders)";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error in prepare(): " . $conn->error);
        }

        // Bind parameters
        $types = str_repeat('s', count($rowsToDelete));
        $stmt->bind_param($types, ...$rowsToDelete);

        // Execute the statement
        $result = $stmt->execute();

        if ($result === false) {
            die("Error in execute(): " . $stmt->error);
        }

        // Provide a response to the client
        echo "Rows deleted successfully!";
    } else {
        echo "No rows selected for deletion.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
