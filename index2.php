<?php
// session_start();
require "./connection.php";

// Fetch all data from the database
$sql = "SELECT `Invoice Id`, `Status`, `Company`, `Location`, `Due Date`, `Last Connected`, `Currency`, `Amount` FROM list_view";
$result = mysqli_query($conn, $sql);

// Store all data in a PHP array
$dataArray = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dataArray[] = $row;
}

// Convert PHP array to JavaScript array
echo "<script>";
echo "const allData = " . json_encode($dataArray) . ";";
echo "</script>";
?>


<!DOCTYPE html>
<html>

<head>
    <title>List View Project</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e5f83b95ee.js" crossorigin="anonymous"></script>
    <script src="./dropdown_search.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="./neww.js"></script>

    <!-- ////////////////////////////// -->

    <style>
        /* Your existing CSS styles here */
        .hidden-column {
            display: none;
        }
    </style>



</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">List View</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
            <ul class="navbar-nav me-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="visually-hidden">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Search Form -->

    <form method="POST" action="./index2.php">
        <input type="text" class="search_box" name="search_box" value="" style="width: 100%; border: 1px solid #ccc;">

        <button type="submit">Search</button>
        <a href="./index2.php">Clear Search</a>
    </form>

    <br>

    <!-- Add a dropdown button -->

    <?php
    require "./connection.php";
    // Fetch column names from the database
    $sql = "SHOW COLUMNS FROM list_view";
    $result = mysqli_query($conn, $sql);

    // Store column names in an array
    $columns = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $columns[] = $row['Field'];
    }



    ?>

  

    <div class="hello" id='item'>
        <br>
        <?php
        // Iterate over the fetched column names to generate checkboxes

        foreach ($columns as $column) {

            echo '<label for="colCheckbox' . $column . '"><h4>' . $column . ' ' . "   " . '</h4></label>  ';
            echo '<input type="checkbox" id="colCheckbox' . $column . '" class="column-checkbox" checked> &nbsp &nbsp';
        }
        ?>
    </div>

    <br>



    <div class="content">
        <!-- Table with Sorting and Filtering Controls -->

        <form action="" method="POST">
            <table id="table1" data-role="table" data-mode="columntoggle" class="ui-responsive" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn- text="Columns to display... " data-column-popup-theme="a">

                <!-- <colgroup id="colgroup"> -->
                <thead>

                    <!-- Added  table column headers with sorting and filtering controls -->

                    <th>
                        <button id="togglebtn" type="button" onclick="togglediv('item')" class='tgl' style="font-size:21px;">
                            <i class="fa fa-gear"></i>
                       
                    </th>

                    <!-- <input type="checkbox" id="select-all"> -->

                    <th colindex="0" type="number" id="invoiceid_col_head" name="InvoiceId" id="filter-invoice-id" data-column="0" data-priority="1">
                        </button>Invoice ID <button type="button" id="sorty-0" class="sort-button" onclick="sortTable(1)"> <i class="fas fa-sort"></i>
                        </button>
                        <select class="filter-select" data-column-name="Invoice Id" style="font-family:sans-serif; position: relative; top: 5px;">
                        </select>
                        <input type="text" data-column-index="1" class="SearchbarIndi" id="search-Invoice ID" placeholder="Search">
                    </th>

                    <th colindex="1" type="string" id="status_col_head" name="Status" id="filter-Status" data-column="1">
                        Status <button type="button" class="sort-button" onclick="sortTable(2)"> <i class="fas fa-sort"></i></button>
                        <select class="filter-select" data-column-name="Status" data-column-index="2" style="font-family:sans-serif; position: relative; top: 5px;"></select>
                        <input type="text" data-column-index="2" class="SearchbarIndi" id="search-status" placeholder="Search">
                    </th>

                    <th colindex="2" type="string" id="company_col_head" name="Company" id="filter-Company">
                        Company <button type="button" class="sort-button" onclick="sortTable(3)"> <i class="fas fa-sort"></i></button>
                        <select class="filter-select" data-column-name="Company" data-column-index="3" style="font-family:sans-serif; position: relative; top: 5px;"></select>
                        <input type="text" data-column-index="3" class="SearchbarIndi" id="search-company" placeholder="Search">
                    </th>

                    <th colindex="3" type="string" id="location_col_head" name="Location" id="filter-Location">
                        Location <button type="button" class="sort-button" onclick="sortTable(4)"> <i class="fas fa-sort"></i></button>
                        <select class="filter-select" data-column-name="Location" data-column-index="4" style="font-family:sans-serif; position: relative; top: 5px;"></select>
                        <input type="text" data-column-index="4" class="SearchbarIndi" id="search-location" placeholder="Search">
                    </th>

                    <th colindex="4" type="date" id="duedate_col_head" name="DueDate" id="filter-DueDate" data-column="0">
                        Due Date <button type="button" class="sort-button" onclick="sortTable(5)"> <i class="fas fa-sort"></i></button>
                        <select class="filter-select" data-column-name="Due Date" data-column-index="5" style="font-family:sans-serif; position: relative; top: 5px;"></select>
                        <input type="text" data-column-index="5" class="SearchbarIndi" id="search-due-date" placeholder="Search">
                    </th>

                    <th colindex="5" type="date" id="lastconnected_col_head" name="LastConnected" id="filter-LastConnected">
                        Last Connected<button type="button" class="sort-button" onclick="sortTable(6)"> <i class="fas fa-sort"></i></button>
                        <select class="filter-select" data-column-name="Last Connected" data-column-index="6" style="font-family:sans-serif; position: relative; top: 5px;"></select>
                        <input type="text" data-column-index="6" class="SearchbarIndi" id="search-last-connected" placeholder="Search">
                    </th>

                    <th colindex="6" type="string" id="currency_col_head" name="Currency" id="filter-Currency">
                        Currency <button type="button" class="sort-button" onclick="sortTable(7)"> <i class="fas fa-sort"></i></button>
                        <select class="filter-select" data-column-name="Currency" data-column-index="7" style="font-family:sans-serif; position: relative; top: 5px;"></select>
                        <input type="text" data-column-index="7" class="SearchbarIndi" id="search-currency" placeholder="Search">
                    </th>

                    <th colindex="7" type="number" id="amount_col_head" name="Amount" id="filter-Amount">
                        Amount<button type="button" class="sort-button" onclick="sortTable(8)"> <i class="fas fa-sort"></i></button>
                        <select class="filter-select" data-column-name="Amount" data-column-index="8" style="font-family:sans-serif; position: relative; top: 5px;"></select>
                        <input type="text" data-column-index="8" class="SearchbarIndi" id="search-amount" placeholder="Search ">
                    </th>

                </thead>
                <!-- </colgroup> -->
                <!-- Add more buttons for other columns -->


                <tbody id="tableBody">

                    <?php


                    if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                    ?>
                            <tr>


                                <td><input type="checkbox"></td>
                                <td><?= isset($row['Invoice Id']) ? $row['Invoice Id'] : ''; ?></td>
                                <td><?= isset($row['Status']) ? $row['Status'] : ''; ?></td>
                                <td><?= isset($row['Company']) ? $row['Company'] : ''; ?></td>
                                <td><?= isset($row['Location']) ? $row['Location'] : ''; ?></td>
                                <td><?= isset($row['Due Date']) ? $row['Due Date'] : ''; ?></td>
                                <td><?= isset($row['Last Connected']) ? $row['Last Connected'] : ''; ?></td>
                                <td><?= isset($row['Currency']) ? $row['Currency'] : ''; ?></td>
                                <td><?= isset($row['Amount']) ? $row['Amount'] : ''; ?></td>

                            </tr>
                    <?php


                        }
                    }
                    ?>

                </tbody>
            </table>
        </form>

    </div>
    <!-- Pagination -->

    <div class="pagination">
        <!-- <?php
                if ($page > 1) {
                    echo "<a href='./index2.php?page=" . ($page - 1) . "'>Previous</a>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        echo "<a class='active' href='./index2.php?page=$i'>$i</a>";
                    } else {
                        echo "<a href='./index2.php?page=$i'>$i</a>";
                    }
                }

                if ($page < $total_pages) {
                    echo "<a href='./index2.php?page=" . ($page + 1) . "'>Next</a>";
                }
                ?> -->
    </div>

    <?php
    // Close the database connection
    mysqli_close($conn);
    ?>


    <button onclick="deleteRows()" class="btn btn-danger">Delete</button>
    <!-- //button to add a new row to the database -->
    <button id="AddNew"><a href="add_new_row.php">Add New</a></a></button>

    </head>
    <!-- JavaScript Libraries -->

  
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/e5f83b95ee.js" crossorigin="anonymous"></script>
    <!-- <script src="./script2.js"></script> -->

    <script src="./dropdown_search.js"></script>
    <script src="./script_form.js"></script>
  


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>



    <script>
    // Object to store current sort orders for each column
    let sortOrders = {};

    // Function to sort the table based on the selected column
    function sortTable(columnIndex) {
        // Skip sorting for the first column
        if (columnIndex === 0) {
            return;
        }

        // Variables for table and sorting logic
        let table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;

        // Get the table element by its ID
        table = document.getElementById("table1");

        // Initialize the sorting logic
        switching = true;
        dir = "asc"; // Default sort direction is ascending

        // Toggle sort order (asc/desc) for the selected column
        if (sortOrders[columnIndex] === "asc") {
            sortOrders[columnIndex] = "desc";
        } else {
            sortOrders[columnIndex] = "asc";
        }

        // Continue sorting until no more switches are needed
        while (switching) {
            switching = false;
            rows = table.rows;

            // Iterate through rows (skipping the header row)
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                // Get the values of the two cells to be compared
                x = rows[i].getElementsByTagName("TD")[columnIndex];
                y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

                // Extract and normalize values for comparison
                let xValue = x.getAttribute("type") === "number" ? parseFloat(x.innerHTML) : x.innerHTML;
                let yValue = y.getAttribute("type") === "number" ? parseFloat(y.innerHTML) : y.innerHTML;

                // Check if a switch is needed based on the sort order and values
                if ((dir === "asc" && xValue > yValue) || (dir === "desc" && xValue < yValue)) {
                    shouldSwitch = true;
                    break;
                }
            }

            // If a switch is needed, perform the switch and update switch count
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                // If no switches were made and sorting was in ascending order, switch to descending
                if (switchcount === 0 && dir === "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>


    <script src="./dropdown_search.js"></script>
    <script src="./neww.js"></script>

  

    <script>
    

        function togglediv(id) {
            var div = document.getElementById(id);
            div.style.display = div.style.display == "none" ? "block" : "none";
        }
        // }  });
    </script>

    
    <script>
        function deleteRows() {
            var table = document.getElementById('table1');
            var rowsToDelete = [];

            for (var i = 1; i < table.rows.length; i++) {
                var chk = table.rows[i].cells[0].childNodes[0];
                if (chk.checked) {
                    rowsToDelete.push(table.rows[i].cells[1].innerText); // Assuming the ID is in the second cell
                }
            }
            console.log(rowsToDelete);
            if (rowsToDelete.length === 0) {
                alert("Please select the row(s) that you want to delete.");
                return;
            }

            // Send an AJAX request to the server to delete rows
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_rows.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // alert(xhr.responseText); // Display the response from the server

                    // Remove the selected rows from the HTML table
                    for (var i = 1; i < table.rows.length; i++) {
                        var chk = table.rows[i].cells[0].childNodes[0];
                        if (chk.checked) {
                            table.deleteRow(i);
                            i--; // Decrement i to adjust for the removed row   
                            location.reload();
                        }
                    }
                }
            };

            xhr.send("rowsToDelete=" + JSON.stringify(rowsToDelete));
        }
    </script>
 
</body>

</html>