$(document).ready(function() {
    load();

    //Load Priv function
    function load() {
        $.ajax({
            method: "POST",
            url: "../apis/user_privAPI.php",
            data: { 'action': "selection" },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                var li = '';
                var menu = '';
                if (status == true) {

                    message.forEach(function(item, i) {

                        if (menu != item['menu_name']) {
                            if (menu != '') {
                                li += `</ul></li>`;
                            }
                            li += `<li class="sidebar-item">
                            <a href="#` + item['menu_name'] + `" data-toggle="collapse" class="sidebar-link collapsed">
                                <i class="` + item['icon'] + ` "></i> <span class="align-middle">` + item['menu_name'] + `</span>
                            </a>
                            <ul id="` + item['menu_name'] + `" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">`;
                            menu = item['menu_name'];
                        }

                        li += ` <li class="sidebar-item"><a class="sidebar-link" href="` + item['link'] + `">` + item['sub_menu_name'] + `</a>
                        </li>`;

                    });
                    $("#sidbarnav").html(li);


                } else {
                    Mystoast(message, "info");

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


    // fetch method
    function fetch(user_id) {

        $.ajax({
            method: "POST",
            url: "../apis/user_privAPI.php",
            data: { "action": "fetch", "user_id": user_id },
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                $("input[type='checkbox']").prop('checked', false);

                if (status) {

                    message.forEach(function(item, i) {
                        $("input[type='checkbox'][name='menus[]'][value='" + item['menu_id'] + "']").prop('checked', true);
                        $("input[type='checkbox'][name='sub_menus[]'][value='" + item['sub_id'] + "']").prop('checked', true);
                        $("input[type='checkbox'][name='actions[]'][value='" + item['action_id'] + "']").prop('checked', true);
                    });
                }

            },
            error: function(data) {

            }
        });

    }

});