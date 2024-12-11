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
    Fill();
    var btn_action = "INSERT";

    $("#Insert").on("click", function() {
        document.getElementById("frm").reset();
        btn_action = "INSERT"
        show_modal();
    });


    function show_modal() {
        $("#mdl").modal('show');
    }

    $(document).on('click', "a.Update", function(e) {
        e.preventDefault();
        var action_id = $(this).attr('id');
        btn_action = "UPDATE";
        show_modal();
        fetch(action_id);

    });

    $(document).on('click', 'a.Delete', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
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
                    Mystoast("Your Data is Save", "info");
                }
            });
    });

    //form submition
    $('#frm').on("submit", function(e) {
        e.preventDefault();
        var action_id = $("#action_id").val();
        var name = $("#name").val();
        var sub_id = $("#sub_id").val();
        var date = $("#date").val();
        if (name == '0') {
            alert("Please Select Action");
            return;
        } else if (sub_id == '0') {
            alert("Please Select Page");
            return;
        } else {
            if (btn_action == "INSERT") {
                var data = {
                    'action': 'insert',
                    'name': name,
                    'sub_id': sub_id,
                    'created_date': date

                };

            } else {
                var data = {
                    'action': 'update',
                    'action_id': action_id,
                    'name': name,
                    'sub_id': sub_id,
                    'created_date': date

                };

            }
            $.ajax({
                method: "POST",
                url: "../apis/actions_Api.php",
                data: data,
                dataType: "JSON",
                async: true,
                success: function(data) {
                    var status = data.status;
                    var message = data.message;
                    if (status == true) {
                        Mystoast(message, "success");
                        checking_actions(session_id, link);
                        $('#mdl').modal('hide')


                    } else {
                        Mystoast(message, "error");

                    }

                },
                error: function(data) {
                    $('#mdl').modal('hide')
                    Mystoast("Error accured due to duplicate", "error");
                }

            });
        }





    });
    // fuction load
    function load(update_action, delete_action) {
        $.ajax({
            method: "POST",
            url: "../apis/actions_Api.php",
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
                            row += "<td>" + item[index] + "</td>";
                        }
                        if (update_action == "Update" && delete_action == "Delete") {
                            row += `<td>
                            <a href="#" class=" btn btn-primary Update" id='` + item['action_id'] + `' >
                            <i class=" fa fa-edit">Edit</i>
                            </a>`;
                            row += `&nbsp`;
                            row += `<a href="#" class=" btn btn-danger Delete" id='` + item['action_id'] + `' >
                        <i class=" fa fa-trash">del</i>
                        </a>
                        </td>`;
                        } else if (update_action == 'Update') {
                            row += `<td>
                            <a href="#" class=" btn btn-primary Update" id='` + item['action_id'] + `' >
                            <i class=" fa fa-edit">Edit</i>
                            </a>
                        </td>`;

                        } else if (delete_action == 'Delete') {
                            console.log("delete " + delete_action);
                            row += `<td> 
                            <a href="#" class=" btn btn-danger Delete" id='` + item['action_id'] + `' >
                            <i class=" fa fa-trash">del</i>
                            </a>
                            </td>`;
                        } else {
                            $(".action").hide();
                        }


                        row += "</tr>";



                    });
                    $('#tbl tbody').html(row);
                    $('#tbl').DataTable();
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

    // fill username
    function Fill() {
        $("#sub_id").html('');
        $.ajax({
            method: "POST",
            url: "../apis/actions_Api.php",
            data: { "action": "fill" },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                var options = '';

                if (status == true) {
                    options += "<option value='0'>" + "Please Select Action" + "</option>";

                    message.forEach(function(item, i) {

                        options += `<option value="` + item['sub_id'] + `"> ` + item['name'] + `</option>`;

                    });

                    $("#sub_id").html(options);

                }

            },
            error: function(data) {

            }
        });

    }

    //fetch function
    function fetch(action_id) {
        $.ajax({
            method: "POST",
            url: "../apis/actions_Api.php",
            data: { 'action': "fetch", 'action_id': action_id },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                if (status == true) {
                    $('#action_id').val(message['action_id']);
                    $('#name').val(message['name']);
                    $('#sub_id').val(message['sub_id']);
                    $('#date').val(message['created_date']);


                } else {
                    Mystoast(message, "warning");

                }


            },
            error: function(data) {

            }

        });

    }

    //delete function
    function del(id) {
        $.ajax({
            method: "POST",
            url: "../apis/actions_Api.php",
            data: { 'action': 'del', 'action_id': id },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                if (status == true) {
                    window.scroll(0, 0);
                    Mystoast(message, "success");
                    checking_actions(session_id, link);


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
    // fuction checking_actions
    function checking_actions(user_id, link) {
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
                var update_action = 'no';
                var delete_action = 'no';
                if (status == true) {
                    message.forEach(function(item, i) {
                        if (item['name'] == 'Update') {
                            update_action = item['name'];
                            console.log("Update" + update_action);
                        } else if (item['name'] == 'Delete') {
                            delete_action = item['name'];

                        } else {
                            return;
                        }
                    });
                    load(update_action, delete_action);
                } else {
                    // window.location = "no_premission.php"
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