document.addEventListener("DOMContentLoaded", function () {
  const columnCheckboxes = document.querySelectorAll(".column-checkbox");
  const filterSelects = document.querySelectorAll(".filter-select");
  const searchBox = document.querySelector(".search_box");
  const tableBody = document.getElementById("tableBody");
  const paginationContainer = document.querySelector(".pagination");
  const itemsPerPage = 5; // Number of items to display per page
  let currentPage = 1;

  // Use the JavaScript array 'allData' for client-side operations
  let filteredData = [...allData]; // Copy allData initially
        console.log(filteredData);
  // Object to store the visibility status of each column
  let columnVisibility = {};
    
  document.querySelectorAll(".SearchbarIndi").forEach((searchInput) => {
    searchInput.addEventListener("input", function () {
      const columnIndex = parseInt(this.dataset.columnIndex);
  console.log(columnIndex);
      if (!isNaN(columnIndex) && columnIndex > 0) {
        const searchTerm = this.value.toLowerCase().trim();
        filterDataByColumn(columnIndex, searchTerm);
        renderTable(filteredData);
        updatePaginationButtons();
      }
    });
  });

    function filterDataByColumn(columnIndex, searchTerm) {
    filteredData = allData.filter((row) => {
      // Skip the first column (index 0)
      const cellValue = row[Object.keys(row)[columnIndex-1]];
      const textValue = cellValue ? cellValue.toLowerCase() : "";
      return textValue.includes(searchTerm);
    });
  }
  
  document.querySelectorAll(".filter-select").forEach((select) => {
    select.addEventListener("change", function () {
      filterAndSearchTable(); // Combine filter and search logic
    });
  });

  function filterAndSearchTable() {
    const searchValue = searchBox.value.toLowerCase();

    // Apply search to the filteredData
    filteredData = allData.filter((row) => {
      const matchesSearch = Object.values(row).some((value) => {
        if (typeof value === "string") {
          return value.toLowerCase().includes(searchValue);
        } else if (typeof value === "boolean") {
          return value === row.isSelected;
        }
        return false;
      });

      return matchesSearch;
    });

    // Apply filters to the filteredData
    filterTable();

    // Render the table with the updated filtered data
    renderTable(filteredData);

    // Update column visibility along with rendering the table
    updateColumnVisibility();
  }


  

  // Set initial visibility state for each column
  columnCheckboxes.forEach((checkbox, index) => {
    columnVisibility[index] = checkbox.checked;
    toggleColumn(index, checkbox.checked);

    checkbox.addEventListener("change", function () {
      // Update column visibility state
      columnVisibility[index] = this.checked;

      // Toggle column visibility
      toggleColumn(index, this.checked);

      // Update the table after toggling column visibility
      filterTable();
    });
  });

  // Event listener for search
  document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault();
    filterTable(); // Apply filters after search
    paginate(1); // Reset to the first page after search
  });

  // Event listener for filters
  filterSelects.forEach((select) => {
    select.addEventListener("change", function () {
      filterTable();
    });
  });

  function removeRowFromData(invoiceId) {
    allData = allData.filter((row) => row["Invoice Id"] !== invoiceId);
  }

  function deleteRow(invoiceId) {
    // Perform backend deletion logic here

    // Remove the row from the frontend data
    removeRowFromData(invoiceId);

    // Filter and render the table with updated data
    filterTable();
  }

  function filterTable() {
    const filterConditions = Array.from(filterSelects).reduce(
      (conditions, select) => {
        const columnName = select.getAttribute("data-column-name");
        const filterValue = select.value;
        if (filterValue !== "") {
          conditions[columnName] = filterValue;
        }
        return conditions;
      },
      {}
    );

    const searchValue = searchBox.value.toLowerCase();

    // Filter and search
    filteredData = allData.filter((row) => {
      // Check if all filter conditions are satisfied for the row
      const matchesFilters = Object.entries(filterConditions).every(
        ([columnName, filterValue]) => row[columnName] === filterValue
      );

      // Check if any value in the row matches the search term
      const matchesSearch = Object.values(row).some((value) => {
        if (typeof value === "string") {
          return value.toLowerCase().includes(searchValue);
        } else if (typeof value === "boolean") {
          return value === row.isSelected; // Use the isSelected property for boolean values
        }
        return false; // Ignore other types
      });

      return matchesSearch && matchesFilters;
    });

    renderTable(filteredData); // Render the table with the filtered data
    updateColumnVisibility(); // Update column visibility along with rendering the table
    paginate(1); // Reset to the first page after filtering
  }

  function renderTable(data) {
    // Clear existing table rows
    tableBody.innerHTML = "";

    // Render the table with the filtered data
    const startIdx = (currentPage - 1) * itemsPerPage;
    const endIdx = startIdx + itemsPerPage;
    const pageData = data.slice(startIdx, endIdx);

    // Loop through the pageData and create table rows
    pageData.forEach((row) => {
      const tr = document.createElement("tr");

      // Add a checkbox as the first cell in each row
      const checkboxCell = document.createElement("td");
      const checkbox = document.createElement("input");
      checkbox.type = "checkbox";
      checkbox.checked = row.isSelected || false; // Assume there's a property "isSelected" in your data
      checkbox.addEventListener("change", function () {
        row.isSelected = this.checked; // Update the data array with the new checkbox state
      });
      checkboxCell.appendChild(checkbox);
      tr.appendChild(checkboxCell);

      // Loop through the entries of the current row and create table cells
      Object.entries(row).forEach(([key, value], index) => {
        const td = document.createElement("td");

        if (index < columnCheckboxes.length - 1) {
          // Skip the last column (boolean values column)
          if (typeof value === "boolean") {
            // For boolean values, create a checkbox and handle the checked state
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.checked = value;
            checkbox.addEventListener("change", function () {
              row[key] = this.checked; // Update the data array with the new checkbox state
            });
            td.appendChild(checkbox);
          } else {
            td.textContent = value; // Set the text content of the cell to the current value
          }

          tr.appendChild(td); // Append the cell to the current row
        }
      });

      // Append the row to the table body
      tableBody.appendChild(tr);
    });

    updateColumnVisibility(); // Update column visibility after rendering
    updatePaginationButtons(); // Update the pagination buttons
  }

  function toggleColumn(columnIndex, isVisible) {
    const headerCells = document
      .getElementById("table1")
      .querySelector("thead tr").cells;

    // Update the visibility status of the column
    columnVisibility[columnIndex] = isVisible;

    // Update the column visibility
    if (isVisible) {
      headerCells[columnIndex].classList.remove("hidden-column");
      document
        .querySelectorAll(`#table1 tbody tr td:nth-child(${columnIndex + 1})`)
        .forEach((cell) => cell.classList.remove("hidden-column"));
    } else {
      headerCells[columnIndex].classList.add("hidden-column");
      document
        .querySelectorAll(`#table1 tbody tr td:nth-child(${columnIndex + 1})`)
        .forEach((cell) => cell.classList.add("hidden-column"));
    }
  }

  function toggleSelectedColumn() {
    const dropdown = document.getElementById("columnDropdown");
    const selectedColumnIndex = parseInt(dropdown.value);
    if (selectedColumnIndex !== -1) {
      toggleColumn(selectedColumnIndex, !columnVisibility[selectedColumnIndex]); // Toggle the visibility of the selected column
    }
  }

  function updateColumnVisibility() {
    // Update the visibility of each column based on the current state
    columnCheckboxes.forEach((checkbox, index) => {
      toggleColumn(index, checkbox.checked);
    });
  }

  function paginate(page) {
    currentPage = page;
    renderTable(filteredData); // Render the table with the current page's data
    updatePaginationButtons(); // Update the pagination buttons
  }

  function updatePaginationButtons() {
    const totalItems = filteredData.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const paginationButtonsContainer = document.querySelector(".pagination");

    // Clear existing buttons
    paginationButtonsContainer.innerHTML = "";

    // Create and append pagination buttons
    for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement("li"); // Create a list item element
      const a = document.createElement("a"); // Create an anchor element for the page link

      a.href = "#"; // Set the href attribute to "#" (can be updated with actual links)
      a.textContent = i; // Set the text content of the link to the page number
      a.addEventListener("click", function () {
        paginate(i); // Call the paginate function with the selected page number
      });

      if (i === currentPage) {
        a.classList.add("active"); // Add the "active" class to the link if it corresponds to the current page
      }

      li.appendChild(a); // Append the list item to the pagination container
      paginationButtonsContainer.appendChild(li);
    }
  }



  // Initial rendering of the table
  renderTable(allData);
  updatePaginationButtons();
});
