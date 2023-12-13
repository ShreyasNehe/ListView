<?php

require "./connection.php";

// Fetch the table columns you want to generate filters for

$tableName = "list_view"; // Replace with your table name

$columns = [
  
    'Invoice Id',
    'Status',
    'Company',
    'Location',
    'Due Date',
    'Last Connected',
    'Currency',
    'Amount',
];

// Create an  array to store filter options for each column
$filterOptions = [];

// Loop through columns and fetch all unique values from the entire table
foreach ($columns as $column) {
    $query = "SELECT DISTINCT `$column` FROM $tableName";
    $result = mysqli_query($conn, $query);

    if ($result) {  //check if the query is working
        $options = [];     // initializing  option values  array to store unique value for each column
        while ($row = mysqli_fetch_assoc($result)) {
            $options[] = $row[$column];
        }
        mysqli_free_result($result);
        $filterOptions[$column] = $options;
    } 

    else {
        
        // Handle the case when the query fails
        $filterOptions[$column] = [];
    }
}

// Close the database connection
mysqli_close($conn);

// Return the filter options as JSON
header('Content-Type: application/json');
echo json_encode($filterOptions);
