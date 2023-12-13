document.addEventListener("DOMContentLoaded", function () {
  const filterSelects = document.querySelectorAll(".filter-select");

  function populateUniqueValues(columnIndex) {
      const uniqueValues = new Set();
      document.querySelectorAll(`td:nth-child(${columnIndex + 1})`).forEach((cell) => {
          uniqueValues.add(cell.textContent);
      });

      const select = filterSelects[columnIndex];
      select.innerHTML = '<option value="">All</option>';
      uniqueValues.forEach((value) => {
          select.innerHTML += `<option value="${value}">${value}</option>`;
      });
  }

  filterSelects.forEach((select, index) => {
      populateUniqueValues(index);
      select.addEventListener("change", filterTable);
  });document.addEventListener("DOMContentLoaded", function () {
    const filterSelects = document.querySelectorAll(".filter-select");
    const paginationContainer = document.querySelector(".pagination");

    function populateFilterOptions() {
        fetch('filter_options.php')
            .then(response => response.json())
            .then(filterOptions => {
                filterSelects.forEach(select => {
                    const columnName = select.getAttribute('data-column-name');
                    const options = filterOptions[columnName];

                    select.innerHTML = '<option value="">All</option>';
                    options.forEach(value => {
                        select.innerHTML += `<option value="${value}">${value}</option>`;
                    });
                });

                // After populating filter options, apply initial filtering and pagination
                filterTable();
            })
            .catch(error => {
                console.error('Error fetching filter options:', error);
            });
    }

    populateFilterOptions();

    filterSelects.forEach(select => {
        select.addEventListener("change", function () {
            filterTable();
            updatePagination();
        });
    });

    function filterTable() {
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const cells = row.getElementsByTagName("td");
            let rowVisible = true;

            filterSelects.forEach((select, index) => {
                const filterValue = select.value;
                const cellValue = cells[index].textContent;

                if (filterValue !== "" && cellValue !== filterValue) {
                    rowVisible = false;
                }
            });

            row.style.display = rowVisible ? "" : "none";
        }
    }

    function updatePagination() {
        const selectedFilters = Array.from(filterSelects).reduce((filters, select) => {
            const columnName = select.getAttribute('data-column-name');
            const filterValue = select.value;
            filters[columnName] = filterValue;
            return filters;
        }, {});

        // Get the current page number
        const currentPage = paginationContainer.querySelector('.active').textContent;

        // Call the server with the selected filters and current page number
        fetch(`your_pagination_script.php?page=${currentPage}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(selectedFilters),
        })
            .then(response => response.text())
            .then(data => {
                // Replace the table content with the new data from the server
                table.innerHTML = data;
            })
            .catch(error => {
                console.error('Error updating pagination:', error);
            });
    }
});




    function filterTable() {
        const table = document.getElementById("table1");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            const cells = row.getElementsByTagName("td");
            let rowVisible = true;

            for (let j = 0; j < filterSelects.length; j++) {
                const filterSelect = filterSelects[j];
                const filterValue = filterSelect.value;
                const cellValue = cells[j].textContent;

                if (filterValue && cellValue !== filterValue) {
                    rowVisible = false;
                    break;
                }
            }

            row.style.display = rowVisible ? "" : "none";
        }
    }

    filterSelects.forEach((select) => {
        select.addEventListener("change", filterTable);
    });
});

