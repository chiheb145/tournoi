let texts={
    placeholder:"Tapez votre mot de passe",
    wrong:"Mauvais mot de passe",
    error:"Erreur",
    button:"S'identifier"
};
let posterror=()=>{
    swal({
        title:texts.error,
        icon:"error"
    });
};
function isAuth(callback){
    $.get("/isAuth").done(function (data) {
        if(data.csrf!==csrf) update_csrf(data.csrf);
        if (data.logged) {
            if (callback) callback();
        }else{
            askPassword(callback);
        }
    }).fail(()=>posterror());
}
function askPassword(callback){
    swal({
        title: user_check.name,
        icon:user_check.photo,
        content: {
            element: "input",
            attributes: {
                placeholder: texts.placeholder,
                type: "password"
            },
        },
        button: {
            text: texts.button,
            closeModal: false,
        }
    })
        .then(password => {
            if(password){
                $.post("/ajaxlogin",
                    {
                        email:user_check.email,
                        password,
                    }
                ).done(data=> {
                    if(data.logged){
                        swal.stopLoading();
                        swal.close();
                        if (callback) callback();
                    }else{
                        swal({
                            title:texts.wrong,
                            icon:"warning",
                            timer: 1000,
                        });
                    }
                }).fail(()=>posterror());
            }else{
                swal.close();
            }
        });
}
function update_csrf(newcsrf){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': newcsrf
        }
    });
    $("input[name='_token']").val(newcsrf);
}
let csrf=$('meta[name="csrf-token"]').attr('content');
update_csrf(csrf);
$("form").submit(function (event) {

       /* var isValid = true;
        $('.form-field').each(function() {
            if ( $(this).val() === '' )
                isValid = false;
        });
        return isValid;*/




    let _this=this;
    event.preventDefault();
    isAuth(function () {
        $(_this).unbind('submit').submit();
    });
});
