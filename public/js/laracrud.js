$(document).ready(function () {
    var t = $('#users_table').DataTable();
    ////----- Open the modal to CREATE a user -----////
    $('#btn-add').click(function () {
        $("#email").css({"border-color": ""});
        $("#password").css({"border-color": ""});
        $('#email-error').html("");
        $('#password-error').html("");
        $(".password_div").addClass("required");
        $('#modalFormData').trigger("reset");
        $('#userEditorModalLabel').html("Ajouter un employé");
        $('#btn-save').html("Ajouter");
        $('#btn-save').val("add");
        $('#userEditorModal').modal('show');
    });

    ////----- Open the modal to UPDATE a user -----////
    $('body').on('click', '.open-modal', function () {
        $("#email").css({"border-color": ""});
        $("#password").css({"border-color": ""});
        $('#email-error').html("");
        $('#password-error').html("");
        $(".password_div").removeClass("required");
        $('#modalFormData').trigger("reset");
        var user_id = $(this).val();
        $.get('users/' + user_id, function (data) {
            $('#userEditorModalLabel').html("Modifier l'employé");
            $('#user_id').val(data.user.id);
            $('#email').val(data.user.email);
            $('#first_name').val(data.user.first_name);
            $('#last_name').val(data.user.last_name);
            $('#role_id').val(data.user.role_id);
            $('#operation_id').val(data.user.operation_id);
            $('#supervisor_id').val(data.user.supervisor_id);
            $('#vocalcom_id').val(data.vocalcom);
            $('#phoenix_id').val(data.phoenix);
            $('#btn-save').html("Modifier");
            $('#btn-save').val("update");
            $('#userEditorModal').modal('show');
        })

    });

    // Clicking the save button on the open modal for both CREATE and UPDATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val(),
            email: $('#email').val(),
            role_id: $('#role_id').val(),
            supervisor_id: $('#supervisor_id').val(),
            operation_id: $('#operation_id').val(),
            vocalcom_id: $('#vocalcom_id').val(),
            phoenix_id: $('#phoenix_id').val(),
            password: $('#password').val(),
        };
        $('#email-error').html("");
        var state = $('#btn-save').val();
        var type = "POST";
        var user_id = $('#user_id').val();
        var ajaxurl = 'users';
        if (state == "update") {
            type = "PUT";
            ajaxurl = 'users/' + user_id;
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#email").css("border-color", "");
                $("#password").css("border-color", "");
                if (data.errors) {
                    if (data.errors.email) {
                        $('#email-error').html(data.errors.email[0]);
                        $("#email").addClass("border_red");
                        $("#email").css("border-color", "#e3342f");
                    }
                    if (data.errors.password) {
                        $('#password-error').html(data.errors.password[0]);
                        $("#password").addClass("border_red");
                        $("#password").css("border-color", "#e3342f");
                    }
                } else {

                    if (state == "add") {

                        if(data.user.role_id != 2){
                            $('#supervisor_id :nth-child(1)').after('<option value="'+data.user.id+'">'+data.user.first_name+' '+data.user.last_name+'</option>');
                        }


                        t.row.add([
                            (data.user.first_name == null && data.user.last_name == null) ? '-' :((data.user.first_name == null)?' ':data.user.first_name) + ' ' + ((data.user.last_name == null)?' ':data.user.last_name),
                            data.user.email,
                            data.user.display_name,
                            data.supervisor_name == null ? '-' : data.supervisor_name,
                            data.user.name == null ? '-' : data.user.name,
                            data.vocalcom == null ? '-' : data.vocalcom,
                            data.phoenix == null ? '-' : data.phoenix,
                            data.user.created_at,
                            '<td><button class="btn btn-info open-modal" value="' + data.user.id + '"><i class="fas fa-edit" aria-hidden="true"></i></button>&nbsp;' + '<button class="btn btn-danger delete-user" value="' + data.user.id + '"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>'
                        ]).node().id = 'user'+data.user.id;
                        t.draw(false);
                    } else {
                        //delete row
                        var row = t.row( '#user'+data.user.id );
                        row.remove().draw();
                        //add row
                        $("#supervisor_id option[value='"+data.user.id+"']").remove();
                        if(data.user.role_id != 2){
                            $('#supervisor_id :nth-child(1)').after('<option value="'+data.user.id+'">'+data.user.first_name+' '+data.user.last_name+'</option>');
                        }
                        t.row.add([



                            (data.user.first_name == null && data.user.last_name == null) ? '-' :((data.user.first_name == null)?' ':data.user.first_name) + ' ' + ((data.user.last_name == null)?' ':data.user.last_name),
                            data.user.email,
                            data.user.display_name,
                            data.supervisor_name == null ? '-' : data.supervisor_name,
                            data.user.name == null ? '-' : data.user.name,
                            data.vocalcom == null ? '-' : data.vocalcom,
                            data.phoenix == null ? '-' : data.phoenix,
                            data.user.created_at,
                            '<td><button class="btn btn-info open-modal" value="' + data.user.id + '"><i class="fas fa-edit" aria-hidden="true"></i></button>&nbsp;' + '<button class="btn btn-danger delete-user" value="' + data.user.id + '"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>'
                        ]).node().id = 'user'+data.user.id;
                        t.draw(false);
                    }
                    $('#modalFormData').trigger("reset");
                    $('#modalFormData2').trigger("reset");
                    $('#userEditorModal').modal('hide');
                }
                if (state == "add" && data.errors == null) {
                    $("#msg_success").html("l'employé a été ajouté avec succès");
                    $("#msg_success").show().delay(5000).fadeOut();
                }

                if (state == "update" && data.errors == null) {
                    $("#msg_success").html("l'employé a été modifié avec succès");
                    $("#msg_success").show().delay(5000).fadeOut();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    ////----- DELETE a user and remove from the page -----////
    $('body').on('click', '.delete-user', function () {
        $('#modalFormData2').trigger("reset");
        var user_id = $(this).val();
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(0)").text();
        $('#user_id2').val(user_id);
        $('#user_name2').html(col1);
        $('#userDeleteModal').modal('show');
    });

    $('#btn-cancel2').click(function () {
        $('#modalFormData').trigger("reset");
        $('#userDeleteModal').modal('hide');
    });
    $('#btn-cancel').click(function (event) {
        $('#modalFormData').trigger("reset");
        $('#userEditorModal').modal('hide');
    });

    $('#btn-delete').on('click',function () {
        var date_resignation=$('#date_resignation').val();
        var type=$('input[name=type]:checked', '#modal_user_delete').val();
        var reason=$('#reason').val();
        var user_id = $('#user_id2').val();

        if(date_resignation == ""){
            alert("date de demission/remerciement est obligatoire!");
            return false;
        }

        var formData = {
            date_resignation: date_resignation,
            type: type,
            reason: reason,
            user_id: user_id,
        };

        $('#userDeleteModal').modal('hide');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/users/user_delete',
            data: formData,
            dataType: 'json',
            success: function (data) {console.log(data);
                $( '#user'+user_id).remove();
                if (data.errors == null) {
                    $("#msg_success").html("l'employé a été supprimé avec succès");
                    $("#msg_success").show().delay(5000).fadeOut();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });


    //show password
    $('#eye_icon').click(function () {
        var myClass = $(this).attr("class");
        if(myClass === "far fa-eye"){
            $("#eye_icon").attr('class', 'far fa-eye-slash');
            $("#password").prop('type', 'text');
        }else{
            $("#eye_icon").attr('class', 'far fa-eye');
            $("#password").prop('type', 'password');
        }
    });

});
