$(document).ready(function() {
    $('#user_name').on("keyup", function() {
        $(this).val($(this).val().replace(/[^A-z,0-9\.]+/g, ""));
    });
    $('#password').on("keyup", function() {
        $(this).val($(this).val().replace(/[^A-z,0-9\.]+/g, ""));
    })
    $("#frm_login").on("submit", function(e) {
        e.preventDefault();
        var user_name = $("#user_name").val();
        var password = $("#password").val();
        var data = {
            "action": "login",
            "user_name": user_name,
            "password": password

        };
        $.ajax({
            method: "POST",
            url: "../apis/usersAPI.php",
            data: data,
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                if (status) {
                    if (message == 'blocked') {
                        Mystoast("You are blocked user please contact the admin!", "error");
                    } else {
                        window.location = "../ui/index.php";
                    }

                } else {
                    Mystoast(message, "error");
                }

            },
            error: function(data) {
                $('#exampleModal').modal('hide')
                Mystoast("Error occured Please try again later !", "error")
            }

        });

    });
    // toaster
    function Mystoast(message, type) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "100",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "show",
            "hideMethod": "hide"
        };
        if (type == "success")
            toastr.success(message);
        else if (type == "error")
            toastr.error(message);
        else if (type == "warning")
            toastr.warning(message);
        else if (type == "info")
            toastr.info(message);
    }
});