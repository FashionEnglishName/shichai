
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

    $(".background-block").mouseover(function(){
        $(this).addClass("black-background");
    });
    $(".background-block").mouseout(function(){
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

    $('#edit-info').click(function(){
        $('#edit-info-modal').modal();
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
                if(data.status = "success"){
                    toastr.success("登陆成功！");
                    setTimeout(function(){
                        window.location.href = "/";
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
    $('#edit-info-form').submit(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#edit-info-form input[name="_token"]').val()
            }
        });
        var new_name = $('#edit-name').val();
        var id = $('#edit-info-user-id').val();

        $.ajax({
            url: "/users/" + id + "/edit-info",
            dataType: "json",
            type: 'patch',
            data: {
                'id': id,
                'name': new_name
            },
            success: function(data){
                toastr.success("已成功修改信息！");
                setTimeout(function(){
                    window.location.reload();
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
});