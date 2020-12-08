
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

                    // console.log(entry); // DEBUG

                    // Prune results by what's truly submitted.
                    // Note: Not done in Query for testing purposes.
                    if (entry.advisor_status > 0) {
                        var printout = "<tr data-href='student_plan_admin.php?id=" + entry.id + "' scope='row'>";

                        // Get basic data.
                        printout += "<td class='col-5'>" +
                            entry.first_name + " " + entry.last_name +
                            "</td>"
                        printout += "<td class='col-3'>" + entry.class_year + "</td>"

                        // Parse status code.
                        printout += "<td class='col-4'>";
                        switch (entry.advisor_status) {
                            case "0":
                                printout += "Unsubmitted";
                                break;
                            case "1":
                                printout += "Submitted";
                                break;
                            case "2":
                                printout += "Approved";
                                break;
                            case "3":
                                printout += "Unapproved";
                                break;
                        }
                        printout += "</td></tr></a>";

                        // console.log(printout); // DEBUG

                        table.append(printout);
                    }
                }

            },
            error: function(code, message) {
                console.log(code);
                console.log(message);
            }
        });
    });
    $(document).on("click", "tr[data-href]", function() {
      window.location = $(this).data("href");
    });
});