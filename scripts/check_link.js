var SidebarModule = (function() {

    $('#print').hide();
    $('#export').hide();
    $('#Insert').hide();
    // getting current page link
    if (window.location.href.indexOf('ui') != -1) {
        parameters = window.location.href.slice(window.location.href.indexOf('ui') + 3);
        var link = parameters;
        var user_id = $('#session_id').val();
        $.ajax({
            method: "POST",
            url: "../apis/user_privAPI.php",
            data: {
                "action": "check_link",
                "user_id": user_id,
                "link": link
            },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                if (status == true) {
                    //user granted
                } else {
                    if (link == 'profile_page' || link == 'index') {} else {
                        window.location = "../ui/error_page.php";
                        console.log("Worong usser");
                    }
                }
            },
            error: function(data) {}
        });
        // checking actions for this user
        $.ajax({
            method: "POST",
            url: "../apis/user_privAPI.php",
            data: {
                "action": "user_action_auth_checking",
                "user_id": user_id,
                "link": link
            },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                if (status == true) {
                    message.forEach(function(item, i) {
                        if (item['name'] == "Insert" || item['name'] == 'print' || item['name'] == 'export') {
                            var action = item['name'];
                            // var targeting = "$(#" + action + ")";
                            $('#' + action).toggle();


                        }




                    });

                }
            },
            error: function(data) {

            }
        });


    }
    return {
        //main function to initiate the module
        init: function() {
            handleValidation();
        },
    };
})();