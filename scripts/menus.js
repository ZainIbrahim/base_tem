var SidebarModule = (function() {
    // LoadOnce();

    var link = ''
    var session_id = $('#session_id').val();
    // checking path for this user
    if (window.location.href.indexOf('ui') != -1) {
        parameters = window.location.href.slice(window.location.href.indexOf('ui') + 3);
        // .split('.')
        link = parameters;
        checking_actions(session_id, link);
    }
    var btn_action = "INSERT"
    $("#Insert").on("click", function() {
        document.getElementById("frm").reset();
        btn_action = "INSERT"
        show_modal();
        console.log("click");
    });
    //show model
    function show_modal() {
        $("#mdl").modal('show');

    }


    $(document).on('click', "a.Update", function(e) {
        e.preventDefault();
        var menu_id = $(this).attr('id');
        btn_action = "UPDATE";
        show_modal();
        fetch(menu_id);
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
                    Mystoast("Your Data is Save", "info")
                }
            });
    });
    // form_submition
    $('#frm').on("submit", function(e) {
        e.preventDefault();
        var menu_id = $("#menu_id").val();
        var name = $("#name").val();
        var icon = $("#icon").val();
        var date = $("#date").val();

        // console.log("Welcome");

        if (btn_action == "INSERT") {
            var data = {
                'action': 'insert',
                'name': name,
                'icon': "fa fa-" + icon,
                'created_date': date

            };

        } else {
            var data = {
                'action': 'update',
                'menu_id': menu_id,
                'name': name,
                'icon': icon,
                'created_date': date
            };

        }
        $.ajax({
            method: "POST",
            url: "../apis/menus_Api.php",
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
                Mystoast("Data is not saved due to the duplicate error", "error");
            }

        });



    });

    function load(update_action, delete_action) {
        $.ajax({
            method: "POST",
            url: "../apis/menus_Api.php",
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
                            <a href="#" class=" btn btn-primary Update" id='` + item['menu_id'] + `' >
                            <i class=" fa fa-edit"></i>
                            </a>`;
                            row += `&nbsp`;
                            row += `<a href="#" class=" btn btn-danger Delete" id='` + item['menu_id'] + `' >
                        <i class=" fa fa-trash"></i>
                        </a>
                        </td>`;
                        } else if (update_action == 'Update') {
                            row += `<td>
                            <a href="#" class=" btn btn-primary Update" id='` + item['menu_id'] + `' >
                            <i class=" fa fa-edit"></i>
                            </a>
                        </td>`;

                        } else if (delete_action == 'Delete') {
                            // console.log("delete " + delete_action);
                            row += `<td> 
                            <a href="#" class=" btn btn-danger Delete" id='` + item['menu_id'] + `' >
                            <i class=" fa fa-trash"></i>
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
    //fetch function
    function fetch(user_id) {
        $.ajax({
            method: "POST",
            url: "../apis/menus_Api.php",
            data: { 'action': "fetch", 'id': user_id },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                if (status == true) {
                    $('#menu_id').val(message['menu_id']);
                    $('#name').val(message['name']);
                    $('#icon').val(message['icon']);
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
            url: "../apis/menus_Api.php",
            data: { 'action': 'del', 'menu_id': id },
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

    function check_link(user_id, link) {
        $.ajax({
            method: "POST",
            url: "../apis/user_privAPI.php",
            data: {
                "action": "user_link_checking",
                "user_id": user_id,
                "link": link
            },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                if (status == true) {
                    // console.log(message);
                    // console.log(link);
                    // console.log(user_id);

                } else {
                    window.location = "error_page.php"
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
                var update_action = 'no';
                var delete_action = 'no';
                if (status == true) {
                    message.forEach(function(item, i) {
                        if (item['name'] == 'Update') {
                            update_action = item['name'];
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