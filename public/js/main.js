$(document).ready(function () {
    $('#number_category').val(0);
});


$(document).on('click', '.btn-add-category', function () {
    event.preventDefault();
    var number_category = $('#number_category').val();
    var number_category_next = parseInt(number_category) + 1;


    var input = '<div class="category-elment"><div class="row"><div class="col-sm-2"></div><div class="col-sm-8 new-category-input"><input type="text" class="form-control" name="category' + number_category_next + '[]" placeholder="Saisir nom de catégorie" value="" required></div><div id="div-action-id-' + number_category_next + '" class="col-sm-2 action_btn"><a href="#" id="delete-category' + number_category_next + '" class="btn btn-danger btn-xs btn-delete-category"><i class="fas fa-minus"></i></a>&nbsp; <a href="#" class="btn btn-primary btn-xs btn-add-category" id="add-category' + number_category_next + '"><i class="fas fa-plus"></i></a></div></div><div id="div_add_sub_category' + number_category_next + '"><div class="row"><div class="col-sm-4"></div><div class="col-sm-4 new-category-input"><input type="text" class="form-control" name="sub_category' + number_category_next + '[]" placeholder="Saisir nom de sous-catégorie" value="" required></div><div id="div-sub-action-id-'+number_category_next+'" class="col-sm-4 sub-action_btn"><a id="btn-add-subcategory' + number_category_next + '" href="" class="btn btn-primary btn-xs btn-add-subcategory" data-category-id="' + number_category_next + '"> <i class="fas fa-plus"></i> </a></div> </div></div></div>';
    $(".new-category").append(input);


    //$( "#add-category"+number_category ).remove();

    $("#" + $(this).attr("id")).remove();
    $('#number_category').val(number_category_next);

});

$(document).on('click', '.btn-add-subcategory', function () {
    event.preventDefault();
    var category = $(this).attr('data-category-id');
    $('#'+$(this).attr('id')).remove();
    //$("#delete-category" + div_id).remove();
    var input2 = '<div class="row"><div class="col-sm-4"></div><div class="col-sm-4 new-category-input"><input type="text" class="form-control" name="sub_category' + category + '[]" placeholder="Saisir nom de sous-catégorie" value="" required></div><div class="col-sm-4 sub-action_btn"><a href="#" class="btn btn-danger btn-xs delete-subcategory"><i class="fas fa-minus"></i></a>&nbsp;<a id="btn-add-subcategory'+category+'" href="" class="btn btn-primary btn-xs btn-add-subcategory" data-category-id="'+category+'"><i class="fas fa-plus"></i></a>&nbsp;</div></div>';
    //$( this ).closest('.category-elment').append(input2);
    $("#div_add_sub_category" + category).append(input2);
});


$(document).on('click', '.delete-subcategory', function () {
    event.preventDefault();
    var category=$(this).parent().parent().parent().attr('id').substr(20);
    var button_add='<a id="btn-add-subcategory'+category+'" href="" class="btn btn-primary btn-xs btn-add-subcategory" data-category-id="'+category+'"><i class="fas fa-plus"></i></a>';
        if($(this).next().length){
            $(button_add).appendTo($(this).parent().parent().prev().children('.sub-action_btn'));
        }

    $(this).parents('.row').remove();

});

$(document).on('click', '.btn-delete-category', function () {
    event.preventDefault();
    var div_id = $(this).attr("id").substr(15);
    var add_div_id = 'add-category' + div_id;
    var i = 0;


    if ($("#" + add_div_id).length) {
        while (i < div_id) {
            div_id--;
            if ($("#div-action-id-" + div_id).length) {
                var input3 = '<a href="#" class="btn btn-primary btn-xs btn-add-category" id="add-category' + div_id + '"><i class="fas fa-plus"></i></a>';
                $("#div-action-id-" + div_id).append(input3);
                if ($('.category-elment').length == 2) {
                    $("#delete-category" + div_id).remove();
                }

                break;
            }

        }
    }

    $(this).parents('.category-elment').remove();
});



//delete operation
$('#operations-list').on('click','.delete-operation',function(){
    $('#modalFormData').trigger("reset");
    var operation_id = $(this).val();
    $('#operation_id').val(operation_id);
    var currentRow = $(this).closest("tr");
    var col1 = currentRow.find("td:eq(0)").text();
    $('#operation_name').html(col1);
    $('#operationDeleteModal').modal('show');
});

$('#btn-cancel-operation').click(function () {
    $('#modalFormData').trigger("reset");
    $('#operationDeleteModal').modal('hide');
});

$('#btn-delete-operation').click(function () {
    var t = $('#operations_table').DataTable();
    var operation_id = $('#operation_id').val();
    $('#operationDeleteModal').modal('hide');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: 'operations/' + operation_id,
        success: function (data) {
            t.row( '#operation'+operation_id ).remove().draw();
            if (data.errors == null) {
                $("#msg_success_operation").html("l'operation a été supprimé avec succès");
                $("#msg_success_operation").show().delay(5000).fadeOut();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});


$('.create-operation').on('click',function () {
    $('#operation').val('');
    $('#operationAddModal').modal('show');
});

// Clicking the save button on the open modal for both CREATE and UPDATE
$("#btn-add-operation").click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = {
        operation: $('#operation').val(),
        operation_type: $('#operation_type').val(),
    };
    //var state = $('#btn-save').val();
    var type = "POST";
    //var user_id = $('#user_id').val();
    var ajaxurl = 'operations';
    /*if (state == "update") {
        type = "PUT";
        ajaxurl = 'users/' + user_id;
    }*/
    var t = $('#operations_table').DataTable();
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        dataType: 'json',
        success: function (data) {
            t.row.add([
                data.operation.id,
                data.operation.name,
                data.date_creation,
                "<span class=\"badge badge-pill badge-success\">Activer</span>",
                data.operation_type,
                '<button class="btn btn-success open_modal-link" value="'+data.operation.id+'"><i class="fas fa-link" aria-hidden="true"></i>\n' +
                '                            Attacher\n' +
                '                        </button>' +
                    '<button><a href="operations/etat/desactiver/'+data.operation.id+'" class=" fas fa-times" title="desactiver cet operation " style="color:red; font-size: 20px; padding-right: 13px;"></a></button>\n'+
                '<button class="btn btn-danger delete-operation" value="'+data.operation.id+'"><i class="fa fa-trash" aria-hidden="true"></i>\n' +
                '                        </button>' 

                ]).node().id = 'operation'+data.operation.id;
            t.draw(false);
            $('#operationAddModal').modal('hide');
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$("#btn-cancel-add-operation").click(function (e) {
    $('#modalAddFormData').trigger("reset");
    $('#operationAddModal').modal('hide');
});


//delete grille ecoute
$('.delete-grid_listen').click(function(){
    $('#modalDeleteGridFormData').trigger("reset");
    var grid_listen_id = $(this).val();
    $('#grid_listen_id').val(grid_listen_id);
    var currentRow = $(this).closest("tr");
    var col1 = currentRow.find("td:eq(0)").text();
    $('#grid_listen_name').html(col1);
    $('#operationDeleteGridModal').modal('show');
});
$('.delete-grid_listen2').click(function(){
    $('#modalDeleteGridFormData2').trigger("reset");
    var grid_listen_id = $(this).val();
    $('#grid_listen_id2').val(grid_listen_id);
    var currentRow = $(this).closest("tr");
    var col1 = currentRow.find("td:eq(0)").text();
    $('#grid_listen_name2').html(col1);
    $('#operationDeleteGridModal2').modal('show');
});

$('.delete-grid_listen3').click(function(){
    $('#modalDeleteGridFormData3').trigger("reset");
    var grid_listen_id = $(this).val();
    $('#grid_listen_id3').val(grid_listen_id);
    var currentRow = $(this).closest("tr");
    var col1 = currentRow.find("td:eq(0)").text();
    $('#grid_listen_name3').html(col1);
    $('#operationDeleteGridModal3').modal('show');
});


$('#btn-delete-grid').click(function () {
    var t = $('#grid_listens_table').DataTable();
    var grid_listen_id = $('#grid_listen_id').val();
    $('#operationDeleteGridModal').modal('hide');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: '/operations/grid_listens_delete/' + grid_listen_id,
        success: function (data) {
            t.row( '#grid_listen'+grid_listen_id ).remove().draw();
            if (data.errors == null) {
                $("#msg_success_grid_listen").html("Grille écoute a été supprimé avec succès");
                $("#msg_success_grid_listen").show().delay(5000).fadeOut();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$('#btn-delete-grid2').click(function () {
    var t = $('#grid_listens_table').DataTable();
    var grid_listen_id = $('#grid_listen_id2').val();
    $('#operationDeleteGridModal2').modal('hide');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: '/operations/grid_listens_delete2/' + grid_listen_id,
        success: function (data) {
            t.row( '#grid_listen2_'+grid_listen_id ).remove().draw();
            if (data.errors == null) {
                $("#msg_success_grid_listen").html("Grille écoute a été supprimé avec succès");
                $("#msg_success_grid_listen").show().delay(5000).fadeOut();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$('#btn-delete-grid3').click(function () {
    var t = $('#grid_listens_table').DataTable();
    var grid_listen_id = $('#grid_listen_id3').val();
    $('#operationDeleteGridModal3').modal('hide');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: '/operations/grid_listens_delete3/' + grid_listen_id,
        success: function (data) {
            t.row( '#grid_listen3_'+grid_listen_id ).remove().draw();
            if (data.errors == null) {
                $("#msg_success_grid_listen").html("Grille écoute a été supprimé avec succès");
                $("#msg_success_grid_listen").show().delay(5000).fadeOut();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});


//link operation avec grille écoute
$('#operations-list').on('click','.open_modal-link',function () {
    $('#modalLinkFormData').trigger("reset");
    var id=$(this).val();


    $.get('/operations/get_grid/' + id, function (data) {
        operation_grid_listen_id=data.operation_grid_listen_id;
        $("input[name='link'][value='"+operation_grid_listen_id+"']").prop('checked', true);
    });


    $('#opertation_id_hidden').val(id);
    $('#operationLinkModal').modal('show');

});
$('.open_modal-link3').click(function () {
    $('#modalLinkFormData3').trigger("reset");
    var id=$(this).val();


    $.get('/operations/get_grid2/' + id, function (data) {
        operation_grid_listen_id=data.operation_grid_listen_id;
        $("input[name='link3'][value='"+operation_grid_listen_id+"']").prop('checked', true);
    });


    $('#opertation_id_hidden3').val(id);
    $('#operationLinkModal3').modal('show');

});

//
$('#btn-link-operation').click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var operation_id=$('#opertation_id_hidden').val();
    var grid_listen_id=$("input[name='link']:checked").val();
    var type_grille=$('#operationLinkModal').find('input[name="link"]:checked').data("type_grille");
    var formData = {
        operation_id: operation_id,
        grid_listen_id: grid_listen_id,
        type_grille:type_grille,
    };
    var type = "POST";
    var ajaxurl = '/operations/link';

    var t = $('#operations_table').DataTable();
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        dataType: 'json',
        success: function (data) {
            $('#operationLinkModal').modal('hide');
            if (data.errors == null) {
                $("#msg_success_operation").html("Linked avec succés");
                $("#msg_success_operation").show().delay(5000).fadeOut();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$('#btn-link-operation3').click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var operation_id=$('#opertation_id_hidden3').val();
    var grid_listen_id=$("input[name='link3']:checked").val();
    var type_grille=$('#operationLinkModal3').find('input[name="link3"]:checked').data("type_grille");
    var formData = {
        operation_id: operation_id,
        grid_listen_id: grid_listen_id,
        type_grille:type_grille,
    };
    var type = "POST";
    var ajaxurl = '/operations/link2';

    var t = $('#operations_table').DataTable();
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        dataType: 'json',
        success: function (data) {
            $('#operationLinkModal3').modal('hide');
            if (data.errors == null) {
                $("#msg_success_operation").html("Linked avec succés");
                $("#msg_success_operation").show().delay(5000).fadeOut();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});


$("#btn-cancel-link-operation").click(function (e) {
    $('#modalLinkFormData').trigger("reset");
    $('#operationLinkModal').modal('hide');
});
$("#btn-cancel-link-operation3").click(function (e) {
    $('#modalLinkFormData3').trigger("reset");
    $('#operationLinkModal3').modal('hide');
});


////----- DELETE a call and remove from the page -----////
$('body').on('click', '.delete-call', function () {
    $('#modalFormDatacall').trigger("reset");
    var call_id = $(this).val();
    var currentRow = $(this).closest("tr");
    var col1 = currentRow.find("td:eq(0)").text();
    $('#call_id2').val(call_id);
    $('#call_name2').html(call_id);
    $('#callDeleteModal').modal('show');
});

$('#btn-cancel-delete-call').click(function () {
    $('#modalFormDatacall').trigger("reset");
    $('#callDeleteModal').modal('hide');
});

$('#btn-delete-call').click(function () {
    var t = $('#calls_table').DataTable();
    var call_id = $('#call_id2').val();
    $('#callDeleteModal').modal('hide');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: 'calls/' + call_id,
        success: function (data) {
            t.row( '#call'+call_id ).remove().draw();
            if (data.errors == null) {
                $("#msg_success_call").html("l'écoute a été supprimé avec succès");
                $("#msg_success_call").show().delay(5000).fadeOut();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});


///----- DELETE a call and remove from the page -----////
$('body').on('click', '.delete-reception', function () {
    $('#modalFormDatareception').trigger("reset");
    var reception_id = $(this).val();
    var currentRow = $(this).closest("tr");
    var col1 = currentRow.find("td:eq(0)").text();
    $('#reception_id2').val(reception_id);
    $('#reception_name2').html(reception_id);
    $('#receptionDeleteModal').modal('show');
});

$('#btn-cancel-delete-reception').click(function () {
    $('#modalFormDatareception').trigger("reset");
    $('#receptionDeleteModal').modal('hide');
});

$('#btn-delete-reception').click(function () {
    var t = $('#receptions_table').DataTable();
    var reception_id = $('#reception_id2').val();
    $('#receptionDeleteModal').modal('hide');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: 'receptions/' + reception_id,
        success: function (data) {
            t.row( '#reception'+reception_id ).remove().draw();
            if (data.errors == null) {
                $("#msg_success_reception").html("l'écoute a été supprimé avec succès");
                $("#msg_success_reception").show().delay(5000).fadeOut();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});



$( "#secondes" ).keyup(function() {
    if($(this).val()>59){
        $(this).val('59');
    }
});

$(".secondes" ).keyup(function() {
    if($(this).val()>59){
        $(this).val('59');
    }
});

/*$(document).ready(function(){
    $('input[type=submit]').attr('disabled',true);
    $('button[type=submit]').attr('disabled',true);
    $('input[]').keyup(function(){
        if($(this).val().length !=0)
            $('.sendButton').attr('disabled', false);
        else
            $('.sendButton').attr('disabled',true);
    });
});*/
