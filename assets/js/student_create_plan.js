$(document).ready(function () {

    //https://stackoverflow.com/questions/19878051/pressing-enter-leaves-contenteditable-box
    $("#semester-row").on("keydown", '.course-editable', function (e) {
        var key = e.keyCode || e.charCode;
        if (key == 13) {
            $(this).blur();
        }
    });

    $("body").on("click", '#save-button', function(e) {
        var searchParams = new URLSearchParams(window.location.search);
        if(!searchParams.has("id")) {
            return;
        }
        var id = searchParams.get("id");
        var plans = {}
        plans["name"] = $("#plan-name-star").find(".plan-name-editable").first().text().trim();
        plans["favorited"] = $("#star").children().first().hasClass("ri-star-s-fill");
        plans["id"] = id;
        plans["semesters"] = []
        plans["notes"] = $('#text-area-notes').text();
        $("#semester-row").children().each(function() {
            var individual_plan = {};
            individual_plan["name"] = $(this).find(".semester-title").first().text().trim();
            individual_plan["courses"] = []
            $(this).find(".semester-course").each(function () {
                individual_plan["courses"].push({"prefix": $(this).find(".course-prefix").first().text().trim(), 
                                      "number": $(this).find(".course-number").first().text().trim(),
                                      "credit": $(this).find(".course-credits").first().text().trim()});
            });
            plans["semesters"].push(individual_plan);
        });
        console.log(plans)
        $.ajax({
            type: "POST",
            url: 'api.php',
            data: {"operation": "save", "data": plans},
            dataType: "json",
            success: function (jsonObject) {
                // work with the results of the SQL query (JSON)
                // console.log(jsonObject);
            },
            error: function (code, message) {
                console.log(code);
                console.log(message);
            }
        });
    });

    $("#semester-row").on('focusout', '.course-editable', function (e) {
        var code = $(this).parent();
        var course = code.parent();
        var prefix = code.find(".course-prefix").first().text();
        var number = code.find(".course-number").first().text();
        if (prefix.length == 4 && number.length == 4 && /^\d+$/.test(number)) {
            $.ajax({
                type: "POST",
                url: "api.php",
                data: {
                    "get_course": true,
                    "prefix": prefix,
                    "number": number
                },
                success: function (data) {
                    console.log(data);
                    data = JSON.parse(data);
                    console.log(data);
                    if ("name" in data) {
                        course.find(".course-status").first().children().first().removeClass("dot-red");
                        course.find(".course-status").first().children().first().addClass("dot-green");
                        course.find(".course-title").first().text(data["name"]);
                    } else {
                        course.find(".course-status").first().children().first().removeClass("dot-green");
                        course.find(".course-status").first().children().first().addClass("dot-red");
                        course.find(".course-title").first().text("");
                    }
                }
            });
        } else {
            course.find(".course-status").first().children().first().removeClass("dot-green");
            course.find(".course-status").first().children().first().addClass("dot-red");
            course.find(".course-title").first().text("");
        }
    });

    $('#schedule-config-nav').find("button").each(function () {
        $(this).click(function () {
            var target = $("#plan-config-" + $(this).text().toLowerCase());
            if (target) {
                $(this).parent().parent().find(".active").each(function () {
                    $(this).removeClass("active");
                });
                $("#schedule-config-container").children("div").each(function () {
                    $(this).css("display", "none");
                });
                target.css("display", "block");
                $(this).addClass("active");
            }
        });
    });

    $("#toggle-config-button").click(function () {
        var scheduleConfig = $("#schedule-config");
        var semesters = $("#semester-row").children();
        if (scheduleConfig.css("display") === "none") {
            scheduleConfig.css("display", "block");
            semesters.each(function () {
                $(this).removeClass("col-md-6");
                $(this).addClass("col-md-12");
            });
        } else {
            scheduleConfig.css("display", "none");
            semesters.each(function () {
                $(this).removeClass("col-md-12");
                $(this).addClass("col-md-6");
            });
        }
    });

    $('#add-course-form').submit(function (e) {
        e.preventDefault(); // prevent from refreshing
        $.ajax({
            type: "POST",
            url: 'search-course.php',
            data: $(this).serialize(),
            dataType: "json",
            success: function (jsonObject) {
                // work with the results of the SQL query (JSON)
                var table = $(".search-results-body");
                table.empty();
                for (var index in jsonObject) {
                    var entry = jsonObject[index];

                    var printout = "<tr scope='row'>";

                    // Get basic data.
                    printout += "<td class='col-5 search-results'>"
                        + entry.prefix + "-" + entry.number + " " + entry.name
                        + "</td><td class='col-5 search-results'><i id='" + entry.id + "' class='ri-add-circle-line'></i></td>";

                    printout += "</tr>";

                    table.append(printout);
                }
            },
            error: function (code, message) {
                console.log(code);
                console.log(message);
            }
        });
    });

    $(document).on("click", ".course-trash-button", function () {
        $(this).parent().parent().remove();
    });
});