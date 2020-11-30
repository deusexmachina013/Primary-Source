/*
// Based on a W3C Tutorial for similar functionality:
// https://www.w3schools.com/w3css/tryit.asp?filename=tryw3css_filters_table
function displayByClassAndQuery(query, selectedClass) {
  var filter = query.toUpperCase().replace(/\s+/g, '');
  var selectedElements = document.getElementsByClassName(selectedClass);

  for (var i = 0; i < selectedElements.length; i++) {
    var element = selectedElements[i];
    var elementContents = element.innerText.toUpperCase().replace(/\s+/g, '');

    if (elementContents.indexOf(filter) > -1) {
      element.style.display = "";
    } else {
      element.style.display = "none";
    }
  }
}

$(document).ready(function() {
  // Automatically set searchbar inputs up with the display function.
  $("input[class$='-searchbar']").keyup(function() {
    // Get the class of objects to filter.
    // NOTE: Going assumption is search by one, not multiple classes.
    var classToFilterBy = "";
    var searchbarClasses = this.classList;
    for (var i = 0; i < searchbarClasses.length; i++) {
      var filterIndex = searchbarClasses[i].indexOf("-searchbar");
      if (filterIndex != -1) {
        classToFilterBy = searchbarClasses[i].substring(0, filterIndex);
        break;
      }
    }

    // Perform the display filter.
    displayByClassAndQuery(this.value, classToFilterBy);
  });
});
*/

// TODO: Make it so that dropdown selection determines what
// the example text reads!
// If by status: "Ex: 'Approved', 'None', 'Reviewable'."

/// AJAX to PHP pull.
$("#student-lookup").submit(function(e) {
  e.preventDefault();
  $.ajax({
    type: "GET",
    url: 'pull_students.php',
    dataType: "json",
    success: function(response) {
      var jsonData = JSON.parse(response);
    }
  });
});