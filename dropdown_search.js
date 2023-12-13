
document.addEventListener("DOMContentLoaded", function ()
 {
     // Select all elements with the class "filter-select"
    const filterSelects = document.querySelectorAll(".filter-select");
    // Select the element with the class "pagination"
    //const paginationContainer = document.querySelector(".pagination");
    const table = document.querySelector("table tbody"); // Added this line to get the table element
    function populateFilterOptions() {
        fetch('filter_options.php')
            .then(response => response.json())
            .then(filterOptions => {
                filterSelects.forEach(select => {
                    const columnName = select.getAttribute('data-column-name');
                    const options = filterOptions[columnName];
    
                    // Remove existing options before adding new ones
                    select.innerHTML = '<option value="">All</option>';
    
                    // Keep track of unique options for each column
                    const uniqueOptions = new Set();
    
                    options.forEach(value => {
                        // Add only unique options
                        if (!uniqueOptions.has(value)) {
                            select.innerHTML += `<option value="${value}">${value}</option>`;
                            uniqueOptions.add(value);
                        }
                    });
                });
    
                // After populating filter options, apply initial filtering
                filterTable();
            })
            .catch(error => {
                console.error('Error fetching filter options:', error);
            });
    }
    
    populateFilterOptions();// Call the function to populate filter options when the DOM is loaded 

    filterSelects.forEach(select => {                                        
        select.addEventListener("change", function () {    // Add event listeners to filter dropdowns for the "change" event
            filterTable(); // When a filter dropdown changes, filter the table
        });
    });

    function filterTable() {
        const rows = table.getElementsByTagName("tr");  // Get all rows in the table body

        for (let i = 0; i < rows.length; i++) {   // Loop through each row
            const row = rows[i];
            const cells = row.getElementsByTagName("td");
            let rowVisible = true;

            filterSelects.forEach((select, index) => { // Loop through each filter dropdown
                const filterValue = select.value;
                const cellValue = cells[index].textContent;

                if (filterValue !== "" && cellValue !== filterValue) {// Check if the cell value matches the selected filter value
                    rowVisible = false;
                }
            });

            row.style.display = rowVisible ? "" : "none";// Set the display style of the row based on visibility
        }
    }

   
});
