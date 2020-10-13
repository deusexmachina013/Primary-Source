
// Based on a W3C Tutorial for similar functionality:
// https://www.w3schools.com/w3css/tryit.asp?filename=tryw3css_filters_table
function filterStudentPlans() {
	var input  = document.getElementById("admin-lookup");
  var filter = input.value.toUpperCase().replace(/\s+/g, '');
	var table	= document.getElementById("plan-table");
	var rows	= table.getElementsByTagName("tr");

	for(var i = 0; i < rows.length; i++) {
		var dataCells = rows[i].getElementsByTagName("td");

    // Go through every element and check the query against it.
    for(var j = 0; j < dataCells.length; j++) {
      var cell = (j > 0) ? dataCells[j] : dataCells[j].firstChild;
      var text = (cell.textContent || cell.innerText);
      
      text = text.toUpperCase().replace(/\s+/g, '');
      if(text.indexOf(filter) > -1) {
        rows[i].style.display = "";
        break;
      } else {
        rows[i].style.display = "none";
      }
		}
	}
}