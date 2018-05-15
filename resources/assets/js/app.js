
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });

$(function(){

    $(".background-block:not(.black-background-selected)").mouseover(function(){
        $(this).addClass("black-background");
    });
    $(".background-block:not(.black-background-selected)").mouseout(function(){
        $(this).removeClass("black-background");
    });

    $('#signUp').click(function(){
        $('#signup-modal').modal();
    });

    $('#login').click(function(){
       $('#login-modal').modal();
    });

    $('#login-img').click(function(){
        $('#login-modal').modal();
    });

    $('#edit-password-toggle').click(function(){
        $('#edit-password-modal').modal();
    });

    //注册
    $('#signup-form').submit(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#signup-form input[name="_token"]').val()
            }
        });
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();

        $.ajax({
            url: '/users',
            type: 'post',
            dataType: 'json',
            data: {
                name: name,
                email: email,
                password: password,
                password_confirmation: password_confirmation
            },
            success: function(data){
                var id = data.id;
                var url = "users/" + id;
                window.location.href = url;
                toastr.success("注册成功!");
            },
            error: function(data){
                console.log(data);
                var errors = data.responseJSON.errors;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                toastr.error( errorsHtml , "Error " + data.status);
            }

        });
    });

    //登陆
    $("#login-form").submit(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#login-form input[name="_token"]').val()
            }
        });
        var email = $("#login-email").val();
        var password = $("#login-password").val();
        if($("#remember").val() == "on"){
            remember  = true;
        }else {
            remember = false;
        }

        $.ajax({
            url: "/login",
            type: "post",
            dataType: 'json',
            data: {
                email: email,
                password: password,
                remember: remember
            },
            success: function(data){
                if(data.status === "success"){
                    toastr.success("登陆成功！");
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error(data.error);
                }

            },
            error: function(data){
                var errors = data.responseJSON.errors;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                toastr.error( errorsHtml , "Error " + data.status);
            }
        });

    });

    //修改信息
    // $('#edit-info-form').submit(function(e){
    //     e.preventDefault();
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('#edit-info-form input[name="_token"]').val()
    //         }
    //     });
    //     var new_name = $('#name-field').val();
    //     var age = $('#age-field').val();
    //     var gender = $('input[name="gender"]:checked').val();
    //     var province_id = $('#province-field').val();
    //     var city_id = $('#city-field').val();
    //     var occupation_id = $('#occupation-field').val();
    //     var avatar = document.getElementById('avatar-input').files[0];
    //     console.log(avatar);
    //     console.log(new_name);
    //
    //     var options = {
    //       beforeSubmit: function(formData){
    //         var qurry_string = $.param(formData);
    //         alert(qurry_string);
    //       },
    //       type: 'patch'
    //     };
    //
    //     $(this).ajaxSubmit(options);
    //
    //
    //     // $.ajax({
    //     //     url: "edit-info",
    //     //     dataType: "json",
    //     //     type: 'patch',
    //     //     contentType: 'multipart/form-data',
    //     //     processData: false,
    //     //     data: {
    //     //         'name': new_name,
    //     //         'age': age,
    //     //         'gender': gender,
    //     //         'province_id': province_id,
    //     //         'city_id': city_id,
    //     //         'occupation_id': occupation_id,
    //     //         'avatar': avatar
    //     //     },
    //     //     success: function(data){
    //     //         toastr.success("已成功修改信息！");
    //     //         setTimeout(function(){
    //     //             window.location.reload();
    //     //         }, 1000);
    //     //     },
    //     //     error: function(data){
    //     //         var errors = data.responseJSON.errors;
    //     //         var errorsHtml= '';
    //     //         $.each( errors, function( key, value ) {
    //     //             errorsHtml += '<li>' + value[0] + '</li>';
    //     //         });
    //     //         toastr.error( errorsHtml , "Error " + data.status);
    //     //     }
    //     // });
    //
    // });



    $("#edit-password-form").submit(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#edit-password-form input[name="_token"]').val()
            }
        });
        var password = $("#edit-password").val();
        var password_confirmation = $("#edit-password-confirmation").val();
        var id = $("#edit-password-user-id").val();

        $.ajax({
            'url': '/users/' + id + '/edit-password',
            'type': 'patch',
            'dataType': 'json',
            'data': {
                'password': password,
                'password_confirmation': password_confirmation
            },
            success: function(data){
                toastr.success("已成功修改密码！请重新登陆");
                setTimeout(function(){
                    window.location.href = "/";
                }, 1000);
            },
            error: function(data){
                var errors = data.responseJSON.errors;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                toastr.error( errorsHtml , "Error " + data.status);
            }

        });
    });

    $("#province-field").change(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#edit-info-form input[name="_token"]').val()
            }
        });
        $.ajax({
            url: "location",
            type: "post",
            dataType: "json",
            data: {
                "first": $("#province-field").val()
            },
            success: function(data){
                $("#city-field").empty();
                $.each(data,function(index,array){
                    var option = "<option value='" + array['id'] + "'>" + array['name'] + "</option>";
                    $("#city-field").append(option);
                });
            }
        });
    });

    $("#add-firewood-form").submit(function(e){
        e.preventDefault();

        $id = $("#user-id-for-firewood").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#add-firewood-form input[name="_token"]').val()
            }
        });

        $.ajax({
            url: "/users/" + $id + "/add_firewood",
            type: "post",
            dataType: "json",
            success: function(data){
                $.getJSON('/users/' + $id + '/check_firewood', null, function(data){
                    toastr.success("成功充值！您有 " + data.firewood + " 根柴火");
                    if(window.location.href === 'http://shichai.test/users/' + $id ){
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    }
                });
            }

        });
    });

    $("#check-firewood-toggle").click(function(){
        $firewood_count = $('#firewood_count').val();
        toastr.info("还有 " + $firewood_count + " 根柴火");
    });

    $('.follow').click(function(){
        $('.follow-form').submit();
    });

    $('.unfollow').click(function(){
        $('.unfollow-form').submit();
    });

    $('.collect').click(function(){
        $('.collect-form').submit();
    });

    $('.uncollect').click(function(){
        $('.uncollect-form').submit();
    });

    $('.purchase').click(function(){
        $('#purchase-modal').modal();
    });

    $('.ignite').click(function(){
        $('.ignite-form').submit();
    });

    $('#logout-form-button').click(function(){
       $("#logout-form").submit();
    });
    $('#add-firewood-form-button').click(function(){
        $('#add-firewood-form').submit();
    });
    $('#card-uncollect-button').click(function(){
        $('.uncollect-form').submit();
    })
    $('#clear-all-notifications-button').click(function(){
        $('#clear-all-notifications-form').submit();
    });
    $('.refund').click(function(){
        $('#refund-form').submit();
    });

    $('#edit-avatar').click(function(){
        $('#edit-avatar-modal').modal();
    });
    $('#edit-info-form-submit').click(function(){
        $("#edit-info-form").submit();
    });
    $('#edit-article-form-submit').click(function(){
        $("#edit-article-form").submit();
    });
    $('#edit-tutorial-form-submit').click(function(){
        $("#edit-tutorial-form").submit();
    });

    //  添柴选择柴火数量
    $('.btn-firewoodRadio').click(function (e){
        e.preventDefault();
        var i = this.id.substr(this.id.length - 1);
        var array = ['1', '2', '3', '4'];
        for(var n = 0; n < 4; n++){
            if(array[n] === i) {
                // array.splice(n, 1);
            }
            else {
                var radioId = '#firewoodRadio' + array[n];
                $(radioId).removeAttr('checked');
                var btnId = '#btn-firewoodRadio' + array[n];
                $(btnId).removeClass('checked');
            }
        }
        var radio = '#firewoodRadio' + i;
        $(radio).attr('checked','checked');
        var btn = '#btn-firewoodRadio' + i;
        $(btn).addClass('checked');
    });

    $('#purchase-submit-button').click(function (e){
        e.preventDefault();
        $('#purchase-form').submit();
    });

    //  tutorials.index
    $('.ignited').mouseover(function(){
        $(this).children(".text-toggle").hide();
        $(this).children("a").show();
    });
    $('.ignited').mouseout(function(){
        $(this).children(".text-toggle").show();
        $(this).children("a").hide();
    });

    $('.can-be-ignited').mouseover(function(){
        $(this).children(".text-toggle").hide();
        $(this).children("a").show();
    });
    $('.can-be-ignited').mouseout(function(){
        $(this).children(".text-toggle").show();
        $(this).children("a").hide();
    });



});

