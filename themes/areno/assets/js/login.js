/*global $, document, window, setTimeout, navigator, console, location*/
$(document).ready(function () {

    'use strict';

    var usernameError = true,
        emailError    = true,
        passwordError = true,
        passConfirm   = true;
    let username = document.getElementById('username'),
        email = document.getElementById('email'),
        Passwords = document.getElementById('password'),
        passwordCon = document.getElementById('passwordCon');



    // Label effect
    $('input').focus(function () {

        $(this).siblings('label').addClass('active');
    });

    // Form validation
    $('input').blur(function () {

        // User Name
        if ($(this).hasClass('username')) {
            if ($(this).val().length === 0) {
                $(this).siblings('span.error').text('Please type your user name').fadeIn().parent('.user-box').addClass('hasError');
                usernameError = true;
            } else if ($(this).val().length > 1 && $(this).val().length <= 6) {
                $(this).siblings('span.error').text('Please type at least 6 characters').fadeIn().parent('.user-box').addClass('hasError');
                usernameError = true;
            }
            else {
                $(this).siblings('.error').text('').fadeOut().parent('.user-box').removeClass('hasError');
                usernameError = false;
            }
        }
        // Email
        if ($(this).hasClass('email')) {
            if ($(this).val().length == '') {
                $(this).siblings('span.error').text('Please type your email address').fadeIn().parent('.user-box').addClass('hasError');
                emailError = true;
            }else if (!isValidEmailAddress($(this).val())) {
                $(this).siblings('span.error').text('Invalid Email').fadeIn().parent('.user-box').addClass('hasError');
                emailError = true;
            }
             else {
                $(this).siblings('.error').text('').fadeOut().parent('.user-box').removeClass('hasError');
                emailError = false;
            }
        }


            // User Name
            if ($(this).hasClass('mbile')) {
                if ($(this).val().length === 0) {
                    $(this).siblings('span.error').text('Please type your Mobile').fadeIn().parent('.user-box').addClass('hasError');
                    usernameError = true;
                } else if ($(this).val().length > 1 && $(this).val().length <= 6) {
                    $(this).siblings('span.error').text('Please type valid Mobile').fadeIn().parent('.user-box').addClass('hasError');
                    usernameError = true;
                }
                else {
                    $(this).siblings('.error').text('').fadeOut().parent('.user-box').removeClass('hasError');
                    usernameError = false;
                }
            }

             // User Name
             if ($(this).hasClass('Firmanavn')) {
                if ($(this).val().length === 0) {
                    $(this).siblings('span.error').text('Please type your Firmanavn').fadeIn().parent('.user-box').addClass('hasError');
                    usernameError = true;
                }
                else {
                    $(this).siblings('.error').text('').fadeOut().parent('.user-box').removeClass('hasError');
                    usernameError = false;
                }
            }

             // User Name
             if ($(this).hasClass('Org')) {
                if ($(this).val().length === 0) {
                    $(this).siblings('span.error').text('Please type your Org.nr').fadeIn().parent('.user-box').addClass('hasError');
                    usernameError = true;
                }
                else {
                    $(this).siblings('.error').text('').fadeOut().parent('.user-box').removeClass('hasError');
                    usernameError = false;
                }
            }


        // PassWord
        if ($(this).hasClass('pass')) {
            if ($(this).val().length < 8) {
                $(this).siblings('span.error').text('Please type at least 8 charcters').fadeIn().parent('.user-box').addClass('hasError');
                passwordError = true;
            } else {
                $(this).siblings('.error').text('').fadeOut().parent('.user-box').removeClass('hasError');
                passwordError = false;
            }
        }

        // PassWord confirmation
        if ($('.pass').val() !== $('.passConfirm').val()) {
            $('.passConfirm').siblings('.error').text('Passwords don\'t match').fadeIn().parent('.user-box').addClass('hasError');
            passConfirm = true;
        } else {
            $('.passConfirm').siblings('.error').text('').fadeOut().parent('.user-box').removeClass('hasError');
            passConfirm = false;
        }

        // label effect
        if ($(this).val().length > 0) {
            $(this).siblings('label').addClass('active');
        } else {
            $(this).siblings('label').removeClass('active');
        }
    });


    function isValidEmailAddress(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
      }


    //submit validation
    $(".signup-form").submit(function (e) {
        var validationFailed=true;
       if(usernameError==true || emailError==true || passwordError==true || passConfirm ==true)
       {
        validationFailed=true;
       }
       else
       {
        validationFailed=false;
       }

       if (validationFailed) {
           e.preventDefault();
           return false;
        }

     });

});

function onlyNumberKey(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
    }
/*scroll Login page */
/*
$(document).ready(function() { $('html, body').animate({
    scrollTop: $("#formHolder").offset().top
}, 2500);
});
*/


$('.nyKonto').on('click',function(){
    $("#loader").fadeTo(10,1).fadeOut(2000);
    $('.register').fadeIn();
    $('.loginnn').fadeOut();
    $('.resetPass').fadeOut();
  });

  $('.existAccount').on('click',function(){
    $("#loader").fadeTo(10,1).fadeOut(2000);
    $('.loginnn').fadeIn();
    $('.register').fadeOut();
    $('.resetPass').fadeOut();
  });
  $('.forgotPass').on('click',function(){
    $("#loader").fadeTo(10,1).fadeOut(2000);
    $('.resetPass').fadeIn();
    $('.loginnn').fadeOut();
    $('.register').fadeOut();
  });





  let typeAccount = document.querySelectorAll('.typeAcc');
  typeAccount.forEach((node,index)=>{
  node.addEventListener('click' , ()=>{
      typeAccount.forEach(e => e.classList.remove('active'));
      node.classList.add('active');
      if(index==0)
      {
          console.log('account person');
          $('.company1').css('display','none');
          $(".company1 input").prop('required', false);
          document.getElementById("role_account").value = "user";
      }
      else if(index==1){
          console.log('account company');
          $('.company1').css('display','block');
          $(".company1 input").prop('required', true);
          document.getElementById("role_account").value = "company";
      }
  });
  });
