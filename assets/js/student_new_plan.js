$(document).ready(function () {
    $("body").on("click", '#new-plan-button', function(e) {
        var templateName = $("#form-template-plan-concentration").val();
        if(templateName != "") {
            $.ajax({
                type: "POST",
                url: 'api.php',
                data: {"operation": "newTemplatePlan", "data": {"templateName": templateName}},
                dataType: "json",
                success: function (jsonObject) {
                    // work with the results of the SQL query (JSON)
                    console.log(jsonObject);
                    jsonObject["id"];
                    window.location.href = '/student/create_plan.php?id=' + jsonObject["id"];
                },
                error: function (code, message) {
                    console.log(code);
                    console.log(message);
                }
            });
        }
        
    });
});