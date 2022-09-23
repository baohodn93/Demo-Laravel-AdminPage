$('#btnSendSub').click(function(){
    var txtEmailSub = $('#txtEmailSub').val();
    var reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var _token=$("input[name=_token]").val();

    //Check validateEmail
    if(reg.test(txtEmailSub) == false)
    {
        alert("Valid email address!");
        return true;
    }
    
    $.ajax({
            type:"POST",
            url: "/sign-up-to-promotions",
            data:{
                txtEmailSub:txtEmailSub,
                _token:_token
                },
                success:function(data){
                    // alert(data);
                    if(data == 'error_exit_email'){
                        alert('Email exists。Please enter another email');
                    }else if(data == 'success'){
                        alert('Email registered');
                    }
                }
        });
});