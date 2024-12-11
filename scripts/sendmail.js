$(document).ready(function() {

    // load();

    var btn_action = "INSERT"
    var token = '';
    if (window.location.href.indexOf('?') != -1) {
        var parameters = window.location.href.slice(window.location.href.indexOf('?') + 1).split('=');
        token = parameters[1];
    }
    if (token != "" && token != undefined) {
        $("#login-box").removeClass('visible');
        $("#reset-box").addClass('visible');
    }
    $("#reset").on("click", function(e) {
        var pass = $("#pass").val();
        var confirm = $("#confirm").val();
        if (pass == "") {
            Mystoast("Please Enter password !", "error");
            return;
        } else if (confirm == "") {
            Mystoast("Please Confirm password !", "error");
            return;
        } else if (pass != confirm) {
            Mystoast("Password does not Match !", "error");
            return;
        } else {
            $.ajax({
                method: "POST",
                url: "../apis/sendemailApi.php",
                data: {
                    'action': 'resetpassword',
                    'token': token,
                    'pass': pass
                },
                dataType: "JSON",
                async: true,
                success: function(data) {
                    var status = data.status;
                    var message = data.message;
                    if (status == true) {
                        Mystoast(message, "success");
                        $('#frm_reset')[0].reset();
                        pass.val("");
                        confirm.val("");
                    } else {
                        Mystoast(message, "error");
                    }

                },
                error: function(data) {
                    Mystoast("Data is not saved due to the duplicate error", "error");
                }

            });
        }
    });
    $("#forget").on("click", function(e) {
        var to = $("#email").val();
        if (to == "") {
            Mystoast("Please Enter Email !", "error");
            return;
        }
        $("#load").addClass("fa fa-spinner fa-spin");
        document.getElementById("forget").disabled = true;
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "../apis/sendemailApi.php",
            data: { 'action': 'requestforget', 'to': to },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                $("#load").removeClass("fa fa-spinner fa-spin");
                document.getElementById("forget").disabled = false;
                if (status == true) {
                    $("#email").val("");
                    Mystoast(message, "success");
                } else {
                    Mystoast(message, "error");
                }

            },
            error: function(data) {
                Mystoast("error accured Please try Again !", "error");
                $("#load").removeClass("fa fa-spinner fa-spin");
                document.getElementById("forget").disabled = false;
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