$(document).ready(function() {
  

    //https://stackoverflow.com/questions/19878051/pressing-enter-leaves-contenteditable-box
    $(".course-editable").on("keydown", function(e){
        var key = e.keyCode || e.charCode;
        if(key == 13) {
            $(this).blur();
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

    $(document).on("click", ".add-course-button", function() {
        $(this).parent().before('<div class="row semester-course">\
        <div class="col-md-1 course-status"><span class="dot"></span></div>\
        <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>\
        <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>\
        <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>\
        <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>\
        </div>');
    });

    $(document).on("click", ".course-trash-button",function() {
        $(this).parent().parent().remove();
    });  
    
    $( function() {
        $( "#sortable1, #sortable2" ).sortable({
            connectWith: ".connectedSortable",
            helper: 'clone',
            appendTo: 'body',
            zIndex: 10000
        }).disableSelection();
    });

});