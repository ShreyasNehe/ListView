

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("table1");
  switching = true;

  while (switching) {
    
    switching = false;
    rows = table.rows;
   
    for (i = 1; i < (rows.length - 1); i++) {
     
      shouldSwitch = false;
      
      x = rows[i].getElementsByTagName("td")[n];
      y = rows[i + 1].getElementsByTagName("td")[n];
  
      if (x.innerHTML.toUpperCase() > y.innerHTML.toUpperCase()) {
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}

////////////////////////////////////////////////////////////


function checkTableRow(element,id) {
  // console.log("inside");
  var keyword=element;
  var table_3 = document.getElementById(id);
	var all_tr = table_3.getElementsByTagName("tr");
	for(var i=0; i<all_tr.length; i++)
  {
			var all_columns = all_tr[i].getElementsByTagName("td");
		  for(j=0;j<all_columns.length; j++)
      {
				if(all_columns[j]){
					var column_value = all_columns[j].textContent || all_columns[j].innerText;
					
					column_value = column_value.toUpperCase();
					if(column_value.indexOf(keyword) > -1){
						all_tr[i].style.display = ""; 
						break;
					}else{
						all_tr[i].style.display = "none";
					}
				}
			}
		}

  
}



 


function sortTable1(columnIndex) {
  console.log("hello");
  const table = document.getElementById("table1");
  const rows = Array.from(table.querySelectorAll("tbody tr"));
  
  rows.sort((a, b) => {
      const dateA = new Date(a.cells[columnIndex].textContent);//convert the date column 
      const dateB = new Date(b.cells[columnIndex].textContent);
      return dateA - dateB;
  });

  // Remove existing rows from the table
  rows.forEach(row => table.querySelector("tbody").removeChild(row));

  // Append sorted rows to the table
  rows.forEach(row => table.querySelector("tbody").appendChild(row));
}

