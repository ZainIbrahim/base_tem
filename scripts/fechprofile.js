var SidebarModule = (function() {
    //fetch function
    fetch_profile();

    function fetch_profile() {
        $.ajax({
            method: "POST",
            url: "../apis/usersAPI.php",
            data: { 'action': "fetch_profile_img" },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;

                if (status == true) {
                    // $('#password').val(message['password']);
                    $("#user_id").val(message['user_id']);
                    // console.log(message['user_name']);
                    var img = message['img_profile'];
                    document.getElementById("img_prof").src = "../uploads/" + img;
                } else {
                    alert(message);

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