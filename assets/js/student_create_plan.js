$(document).ready(function() {
  

    //https://stackoverflow.com/questions/19878051/pressing-enter-leaves-contenteditable-box
    $("#semester-row").on("keydown", '.course-editable', function(e){
        var key = e.keyCode || e.charCode;
        if(key == 13) {
            $(this).blur();
        }
    });

    $("#semester-row").on('focusout', '.course-editable', function(e) {
        var code = $(this).parent();
        var course = code.parent();
        var prefix = code.find(".course-prefix").first().text();
        var number = code.find(".course-number").first().text();
        if(prefix.length == 4 && number.length == 4 && /^\d+$/.test(number)) {
            $.ajax({
                type: "POST",
                url: "api.php",
                data: {"get_course": true,
                       "prefix": prefix,
                       "number": number},
                success: function (data) {
                    console.log(data);
                    data = JSON.parse(data);
                    console.log(data);
                    if("name" in data) {
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
    
    console.log($('#schedule-config-nav').find("button").each(function() {
        $(this).click(function() {
            var target = $("#plan-config-" + $(this).text().toLowerCase());
            if(target) {
                $(this).parent().parent().find(".active").each(function() {
                    $(this).removeClass("active");
                });
                $("#schedule-config-container").children("div").each(function() {
                    $(this).css("display", "none");
                });
                target.css("display", "block");
                $(this).addClass("active");
            }
        });
    }));

    $("#toggle-config-button").click(function() {
        var scheduleConfig = $("#schedule-config");
        var semesters = $("#semester-row").children();
        if(scheduleConfig.css("display") === "none") {
            scheduleConfig.css("display", "block");
            semesters.each(function() {
                $(this).removeClass("col-md-6");
                $(this).addClass("col-md-12");
            });
        } else {
            scheduleConfig.css("display", "none");
            semesters.each(function() {
                $(this).removeClass("col-md-12");
                $(this).addClass("col-md-6");
            });
        }
    });

    $('#add-course-form').submit(function(e) {
        e.preventDefault(); // prevent from refreshing
        $.ajax({
            type: "POST",
            url: 'search-course.php',
            data: $(this).serialize(),
            dataType: "json",
            success: function(jsonObject) {
                console.log(jsonObject);
                // work with the results of the SQL query (JSON)
                var table = $(".search-results-body");
                table.empty();
                for (var index in jsonObject) {
                  var entry = jsonObject[index];
        
                  console.log(entry); // DEBUG
                    var printout = "<tr scope='row'>";
        
                    // Get basic data.
                    printout += "<td class='col-5 search-results'>"
                            + entry.prefix + "-" + entry.number + " " + entry.name
                            + "</td><td class='col-5 search-results'><i id='" + entry.id + "' class='ri-add-circle-line'></i></td>";
                
                    printout += "</tr>";
        
                    console.log(printout); // DEBUG
        
                    table.append(printout);
                    // }
                }
            },
            error: function(code, message) {
                console.log(code);
                console.log(message);
            }
        });
    });

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    // });

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    // });

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    // });

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\

    // $(document).on("click", ".add-course-button", function() {
    //     $(this).parent().before('<div class="row semester-course">\
    //     <div class="col-md-1 course-status"><span class="dot dot-red"></span></div>\
    //     <div class="col-md-5 course-title"></div>\
    //     <div class="col-md-3 course-code"><span class="course-editable course-prefix" contenteditable=true>AAAA</span>-<span class="course-editable course-number" contenteditable=true>0000</span></div>\
    //     <div class="col-md-1 course-credits">4</div>\
    //     <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>\
    //     </div>');
    // });

    $(document).on("click", ".course-trash-button",function() {
        $(this).parent().parent().remove();
    });  
    
    // $( function() {
    //     $( "#sortable1, #sortable2" ).sortable({
    //         connectWith: ".connectedSortable",
    //         helper: 'clone',
    //         appendTo: 'body',
    //         zIndex: 10000
    //     }).disableSelection();
    // });

});