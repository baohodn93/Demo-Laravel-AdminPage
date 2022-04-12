$(document).ready(function() {
    /* Edit user */
    // $('.edit-btn').click(function() {
    //     const id = $(this).attr('data-id');
    //     console.log(id);
    //     $.ajax({
    //         url: 'edit/' + id,
    //         type: 'GET',
    //         data: {
    //             "id": id
    //         },
    //         success: function(data) {
    //             console.log(data);
    //             $('#fullname').val(data.fullname);
    //             $('#email').val(data.email);
    //             $('#phone').val(data.phone);
    //             $('#address').val(data.address);
    //             $('#username').val(data.username);
    //         }
    //     })
    // });

    // $('#staffEditForm').submit(function(e){
    //     e.preventDefault();
    //     var id = $(this).attr('data-id');
    //     var fullname = $('#fullname').val();
    //     var phone = $('#phone').val();
    //     var email = $('#email').val();
    //     var address = $('#address').val();
    //     var gender = $('#gender').val();
    //     var password = $('#password').val();
    //     var _token=$("input[name=_token]").val();
    //     $.ajax({
    //         url:'edit/' + id,
    //         type: 'PUT',
    //         data:{
    //             id:id,
    //             fullname:fullname,
    //             phone:phone,
    //             email:email,
    //             address:address,
    //             gender:gender,
    //             password:password,
    //             _token:_token
    //         },
    //         success:function(response){
    //             $('#sid'+response.id + 'td:nth-child(1)').text(response.fullname);
    //             $('#sid'+response.id + 'td:nth-child(1)').text(response.email);
    //             $('#sid'+response.id + 'td:nth-child(1)').text(response.address);
    //             $('#sid'+response.id + 'td:nth-child(1)').text(response.phone);
    //             $('#sid'+response.id + 'td:nth-child(1)').text(response.gender);
    //         }
    //     })

    // });
    /* Add user */
    // $('#staffAdd').submit(function(e){
    //     e.preventDefault();
    //     var role_id = $("input[name=level]").val();
    //     var username = $("input[name=username]").val();
    //     var email = $("input[name=email]").val();
    //     var password = $("input[name=password]").val();
    //     var _token=$("input[name=_token]").val();

    //     $.ajax({
    //         url:"add/",
    //         type:"POST",
    //         data:{
    //             email:email,
    //             username:username,
    //             password:password,
    //             role_id:role_id,
    //             _token:_token
    //         },
    //         success:function(response){
    //             // console.log(response);
    //             if(response == true){
    //                 alert('追加しました。');
    //                 $('#addModal').modal('toggle');
    //                 $('#staffAdd')[0].reset();
    //             }
    //         }
    //     });
    // })
    $('.csv-export').click(function() {
        var _ok = confirm("CSVファイルをダウンロードします。");
        if (_ok) {
            $.ajax({
                url: 'csv-export',
                type: 'GET',
            })
            document.getElementById("successful_mes").innerHTML = "Dowload CSV Thanh Cong";
        }
    });
});
