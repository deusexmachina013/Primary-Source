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
    $("#student-lookup").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'pull_students.php',
            data: $(this).serialize(),
            dataType: "json",
            success: function(jsonObject) {
                for (var index in jsonObject) {
                    var search = $(this)[0].data;
                    var approved = "Approved";
                    var unsubmitted = "Unsubmitted";
                    var reviewed = "Reviewed";
                    var rejected = "Rejected";
                    var entry = jsonObject[index];
                    var name = "<td class='col-5'>" + entry.first_name + " " + entry.last_name + "</td>";
                    var year = "<td class='col-3'>" + entry.class_year + "</td>";
                    var rowEntry = "<tr scope='row'>" + name + year;
                    var option = $("#student-search-dropdown option:selected").text();
                    console.log(option);
                    if (entry.advisor_validated == 2) {
                        rowEntry += "<td class='col-4'>" + approved + "</td>";
                    } else if (entry.favorited == 1) {
                        if (entry.advisor_validated == 0) {
                            rowEntry += "<td class='col-4'>" + unsubmitted + "</td>";
                        } else if (entry.advisor_validated == 1) {
                            rowEntry += "<td class='col-4'>" + reviewed + "</td>";
                        } else if (entry.advisor_validated == 3) {
                            rowEntry += "<td class='col-4'>" + rejected + "</td>";
                        }
                    }
                    rowEntry += "</tr>";
                    if (option == "Student Name") {
                        search = search.replace('student-search-dropdown=student_name&search-bar=', '');
                        search = search.toLowerCase();
                        fName = entry.first_name.toLowerCase();
                        lName = entry.last_name.toLowerCase();
                        if (fName.includes(search) || lName.includes(search)) {
                            $("tbody").append(rowEntry);
                        }
                    } else if (option == "Cohort Year") {
                        search = search.replace('student-search-dropdown=class_year&search-bar=', '');
                        if (entry.class_year.includes(search)) {
                            $("tbody").append(rowEntry);
                        }
                    } else if (option == "Status") {
                        search = search.replace('student-search-dropdown=plan_status&search-bar=', '');
                        search = search.toLowerCase();
                        approved = approved.toLowerCase();
                        unsubmitted = unsubmitted.toLowerCase();
                        reviewed = reviewed.toLowerCase();
                        rejected = rejected.toLowerCase();
                        if (approved.includes(search)) {
                            $("tbody").append(rowEntry);
                        } else if (unsubmitted.includes(search)) {
                            $("tbody").append(rowEntry);
                        } else if (reviewed.includes(search)) {
                            $("tbody").append(rowEntry);
                        } else if (rejected.includes(search)) {
                            $("tbody").append(rowEntry);
                        }
                    }
                }
            },
            error: function(code, message) {
                console.log(code);
                console.log(message);
            }
        });
    });
});