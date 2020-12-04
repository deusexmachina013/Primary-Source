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
{
    /* <tr scope="row">
      <td class="col-5">Jacob Dyer</td>
      <td class="col-3">2023</td>
      <td class="col-4">Reviewable</td>
    </tr> */
}
$(document).ready(function() {
  // Handle Administator Lookup
  $("#student-lookup").submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: 'pull_students.php',
      data: $(this).serialize(),
      dataType: "json",
      success: function(jsonObject) {
        var table = $("tbody");
        table.empty();
        for (var index in jsonObject) {
          var entry = jsonObject[index];

          console.log(entry); // DEBUG

          // Prune results by what's truly submitted.
          // Note: Not done in Query for testing purposes.
          if(entry.advisor_status == 2 ||
            (entry.advisor_status == 1 && entry.favorited == 1) ||
             entry.favorited == 1) {
            var printout = "<tr data-href='../student/create_plan.php?id=" + entry.id + "' scope='row'>";

            // Get basic data.
            printout += "<td class='col-5'>" 
                      + entry.first_name + " " + entry.last_name
                      + "</td>"
            printout += "<td class='col-3'>" + entry.class_year + "</td>"

            // Parse status code.
            printout += "<td class='col-4'>";
            switch(entry.advisor_status) {
              case "0": printout += "Unsubmitted"; break;
              case "1": printout += "Reviewable"; break;
              case "2": printout += "Accepted"; break;
              case "3": printout += "Rejected"; break;
            }
            printout += "</td></tr></a>";

            console.log(printout); // DEBUG

            table.append(printout);
          }
        }

        // Handle the clicking of dynamically generated links.
        $("tr[data-href]").click(function() {
            window.location = $(this).data("href");
        });
      },
      error: function(code, message) {
          console.log(code);
          console.log(message);
      }
    });
  });
});