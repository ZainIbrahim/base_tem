var SidebarModule = (function() {
    fetch_profile();
    $('#frm_edit_profile_content').on("submit", function(e) {
        e.preventDefault();
        var password = $('#password').val();
        var user_id = $("#id").val();

        var post = {
            'action': 'update_prof_content',
            'user_id': user_id,
            'password': password,

        };
        swal({
                title: "Are you sure?",
                text: "To Change Your password!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "../apis/usersAPI.php",
                        method: "POST",
                        data: post,
                        dataType: "JSON",
                        async: true,
                        success: function(data) {
                            var status = data.status;
                            var message = data.message;
                            if (status == true) {
                                Mystoast(message, "success");
                                $("#frm_edit_profile_content")[0].reset();
                                fetch_profile_content();

                            } else {
                                Mystoast(message, "error");

                            }

                        },
                        error: function(data) {
                            alert(data.message);

                        }

                    });
                } else {
                    Mystoast("Your Pass is not changed", "info")
                }
            });


    });
    //image update form.....
    $('#img_update_frm').on("submit", function(e) {
        e.preventDefault();
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        var user_id = $('#id').val();
        fd.append('file', files);
        fd.append('id', user_id);
        fd.append('action', 'img');

        $.ajax({
            url: '../apis/usersAPI.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                if (status) {
                    Mystoast(message, "success");
                    document.getElementById("img_update_frm")[0].reset;
                    $(".dropify-preview").css("display", "none");
                    fetch_profile();
                } else {
                    Mystoast(message, "error");

                }


            },
        });

    });
    //fetch function
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
                    document.getElementById("prof_image").src = "../uploads/" + img;
                    document.getElementById("img_prof").src = "../uploads/" + img;




                } else {
                    Mystoast(message, "info");

                }


            },
            error: function(data) {

            }

        });

    }

    function fetch_profile_content() {
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
                    $('#password').val(message['password']);

                } else {
                    Mystoast(message, "error");

                }


            },
            error: function(data) {

            }

        });

    }

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
    //image prev
    // $('#file').on("change", function() {
    //     var fileObject = this.files[0];
    //     var fileReader = new FileReader();
    //     fileReader.readAsDataURL(fileObject);
    //     fileReader.onload(function() {
    //         var result = fileReader.result;
    //         $('#prev').attr("src");

    //     });

    // });

    return {
        //main function to initiate the module
        init: function() {
            handleValidation();
        },
    };
})();