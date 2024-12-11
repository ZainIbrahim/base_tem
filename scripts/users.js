var SidebarModule = (function() {
    var link = ''
    var session_id = $('#session_id').val();
    // checking path for this user
    if (window.location.href.indexOf('ui') != -1) {
        parameters = window.location.href.slice(window.location.href.indexOf('ui') + 3);
        // .split('.')
        link = parameters;
        checking_actions(session_id, link);
    }
    var type = $('#type').val();
    if (type == 'Admin') {
        var row = ` <option value="0">Please Select Type</option>
        <option value="Admin">Admin</option>
        <option value="User">User</option>`;

        $('#user_type').html(row);
    } else {
        var row = ` <option value="0">Please Select Type</option>
        <option value="User">User</option>`;
        $('#user_type').html(row);
    }

    var btn_action = "INSERT";
    console.log("waw");

    $("#Insert").on("click", function() {
        document.getElementById("frm_users").reset();
        btn_action = "INSERT";
        var row = `
        <div id ="pass">
        <label for="password" class="control-label">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
        </div>`
        $("#row").html(row)
        show_modal();
    });

    function show_modal() {
        $("#mdl").modal('show');

    }
    $(document).on('click', "a.img", function(e) {
        e.preventDefault();
        $("#id").val($(this).attr('user_id'));
        $("#mdl_image").modal('show');
    });

    $(document).on('click', "a.Update", function(e) {
        e.preventDefault();
        var user_id = $(this).attr('user_id');
        btn_action = "update";
        fetch(user_id);
        show_modal();

    });
    $(document).on('click', 'a.Delete', function(e) {
        e.preventDefault();
        var id = $(this).attr('user_id');
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this User!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    del(id);
                } else {
                    Mystoast("Your Data is Save", "info")
                }
            });
    });

    // form submition
    $('#frm_users').on("submit", function(e) {
        e.preventDefault();
        var user_id = $("#user_id").val();
        var user_name = $("#user_name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var full_name = $("#full_name").val();
        var user_status = $("#user_status").val();
        var user_type = $("#user_type").val();
        var date = $("#date").val();
        if (user_status == '0') {
            alert("Please Select Status For This User");
            return;
        } else {
            if (btn_action == "INSERT") {
                var data = {
                    'action': 'insert',
                    'user_name': user_name,
                    'email': email,
                    'full_name': full_name,
                    'type': user_type,
                    'password': password,
                    'user_status': user_status,
                    'created_date': date

                };

            } else {
                var data = {
                    'action': 'update',
                    'user_id': user_id,
                    'user_name': user_name,
                    'email': email,
                    'full_name': full_name,
                    'type': user_type,
                    'user_status': user_status,
                    'created_date': date

                };

            }
            $.ajax({
                method: "POST",
                url: "../apis/usersAPI.php",
                data: data,
                dataType: "JSON",
                async: true,
                success: function(data) {
                    var status = data.status;
                    var message = data.message;
                    if (status == true) {
                        Mystoast(message, "success");
                        $('#mdl').modal('hide')
                        checking_actions(session_id, link);
                        document.getElementById('frm_users').reset();
                    }
                },
                error: function(data) {
                    $('#mdl').modal('hide')
                    Mystoast("Data is not saved due to the duplicate error", "error")
                }

            });

        }
    });

    //fuction load
    function load(update_action, delete_action) {
        $.ajax({
            method: "POST",
            url: "../apis/usersAPI.php",
            data: { 'action': "load" },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                if (status == true) {
                    var row = '';
                    message.forEach(function(item, i) {
                        row += "<tr>"
                        for (index in item) {
                            if (index == 'user_status') {
                                if (item['user_status'] == 'active') {
                                    row += "<td><span class='badge badge-success'>" + item[index] + "</span></td>";
                                } else {
                                    row += "<td><span class='badge badge-danger'>" + item[index] + "</span></td>";
                                }
                            } else if (index == 'type') {
                                if (item['type'] == 'Admin') {
                                    row += "<td><span class='badge badge-success'>" + item[index] + "</span></td>";
                                } else {
                                    row += "<td><span class='badge badge-danger'>" + item[index] + "</span></td>";
                                }
                            } else if (index == 'img_profile') {
                                var user_id = item['user_id'];
                                var image = '../uploads/' + item['img_profile'];

                                row += `<td width='10%'>
                                   
                                    <a href="#" class="img" user_id='` + item['user_id'] + `' >
                                    <img src='` + image + `' class=' img-circle'  width="40%">
                                    </a>
                                    </td>`;

                            } else {
                                row += "<td>" + item[index] + "</td>";
                            }



                        }

                        if (update_action == "Update" && delete_action == "Delete") {
                            row += `<td>
                            <a href="#" class=" btn btn-primary Update" user_id='` + item['user_id'] + `' >
                            <i class=" fa fa-edit"></i>
                            </a>`;
                            row += `&nbsp`;
                            row += `<a href="#" class=" btn btn-danger Delete" user_id='` + item['user_id'] + `' >
                        <i class=" fa fa-trash"></i>
                        </a>
                        </td>`;
                        } else if (update_action == 'Update') {
                            row += `<td>
                            <a href="#" class=" btn btn-primary Update" user_id='` + item['user_id'] + `' >
                            <i class=" fa fa-edit"></i>
                            </a>
                        </td>`;

                        } else if (delete_action == 'Delete') {
                            console.log("delete " + delete_action);
                            row += `<td> 
                            <a href="#" class=" btn btn-danger Delete" user_id='` + item['user_id'] + `' >
                            <i class=" fa fa-trash"></i>
                            </a>
                            </td>`;
                        } else {
                            $(".action").hide();
                        }



                        row += "</tr>";



                    });
                    $('#tbl_users tbody').html(row);
                    $('#tbl_users').dataTable();


                } else {
                    row += "<tr><td class=' text-center' colspan ='100%'>Data Not Found </td></tr>";
                    $('#tbl tbody').html(row);
                    $('#tbl').DataTable();
                }

            },
            error: function(data) {

            }

        });

    }


    //fetch function
    function fetch(user_id) {
        $.ajax({
            method: "POST",
            url: "../apis/usersAPI.php",
            data: { 'action': "fetch", 'id': user_id },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                if (status == true) {
                    $("#pass").remove();
                    $('#user_id').val(message['user_id']);
                    $('#user_name').val(message['user_name']);
                    $('#email').val(message['email']);
                    $('#user_type').val(message['user_type']);
                    $('#user_status').val(message['user_status']);
                    $('#date').val(message['created_date']);
                    $('#user_type').val(message['type']);
                    $('#full_name').val(message['full_name']);
                } else {
                    Mystoast(message, "error")

                }


            },
            error: function(data) {

            }

        });

    }

    //delete function
    function del(user_id) {
        $.ajax({
            method: "POST",
            url: "../apis/usersAPI.php",
            data: { 'action': 'del', 'user_id': user_id },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                if (status == true) {
                    Mystoast(message, "success");
                    checking_actions(session_id, link);


                } else {
                    Mystoast(message, "error")
                }

            },
            error: function(data) {

            }

        });
    }
    // checking actions for this user
    function checking_actions(user_id, link) {
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
                    var update_action = 'no';
                    var delete_action = 'no';
                    message.forEach(function(item, i) {
                        if (item['name'] == 'Update') {
                            update_action = item['name'];
                        } else if (item['name'] == 'Delete') {
                            delete_action = item['name'];
                        } else {
                            return;
                        }
                    });
                    load(update_action, delete_action)
                }
            },
            error: function(data) {

            }
        });
    }

    //image update form.....
    $('#img_update_frm').on("submit", function(e) {
        e.preventDefault();
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        var id = $('#id').val();
        fd.append('file', files);
        fd.append('id', id);
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
                    Mystoast(message, "success")
                    checking_actions(session_id, link);
                    fetch_profile();
                    $("#mdl_image").modal('hide');
                    document.getElementById('img_update_frm').reset();
                    $(".dropify-preview").css("display", "none");

                } else {
                    Mystoast(message, "error")

                }


            },
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
                    // $("#user_id").val(message['user_id']);
                    // console.log(message['user_name']);
                    var img = message['img_profile'];
                    document.getElementById("img_prof").src = "../uploads/" + img

                } else {
                    Mystoast(message, "error")

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