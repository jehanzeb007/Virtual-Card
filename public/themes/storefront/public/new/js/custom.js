jQuery(document).ready(function ($) {

    $('a[data-toggle="copytext"]').tooltip({
        //animated: 'fade',
        placement: 'bottom',
        //trigger: 'click',
        
    });

    var mySwiper = new Swiper('.swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },
    });

    $('.qrView i').click(function () {
        $('.qrView').hide('slow');
        $('body').css('overflow', 'auto');
    });

    $('.qrClick').click(function () {
        $('.qrView').show('slow');
        $('body').css('overflow', 'hidden');
    });

    $('.registerOpen').click(function () {
        $('.registerIntro').hide();
        $('.register-wrapper').show();
        $('.registerForm').show();
        $('.loginForm').hide();
    });

    $('.loginOpen').click(function () {
        $('.registerIntro').hide();
        $('.register-wrapper').show();
        $('.loginForm').show();
        $('.registerForm').hide();
    });

    $('.backIntro').click(function () {
        $('.registerIntro').show();
        $('.register-wrapper').hide();
    });

    if ($('.registerForm .has-error').length > 0) {
        $('.registerOpen').trigger('click');
        $('.loginForm .has-error-login .error-message').hide();
    }

    $("#phone, #job_phone, #whatsapp, #customer-phone, #customer-phone").intlTelInput({
        nationalMode: false,
        initialCountry: "auto",
        preferredCountries: [ 'us', 'es', 'do']
    });


    /* Custom validation */

    $(".btn.next-step, .payment-tab a").click(function (e) {

        var errors = 0;
        $(".error-message").remove();
        $(".form-group ").removeClass("has-error");

        if(!$('#customer-email').val()) {
            errors++;
            $("#customer-email").after('<span class="error-message customMessage">The Email is required.</span>');
        }

        if(!$('#billing-last-name').val()) {
            errors++;
            $("#billing-last-name").after('<span class="error-message customMessage">The Last name is required.</span>');
        }

        if(!$('#billing-first-name').val()) {
            errors++;
            $("#billing-first-name").after('<span class="error-message customMessage">The First name is required.</span>');
        }

        if(!$('#billing-address-1').val()) {
            errors++;
            $("#billing-address-1").after('<span class="error-message customMessage">The address is required.</span>');
        }

        if(!$('#billing-city').val()) {
            errors++;
            $("#billing-city").after('<span class="error-message customMessage">The city is required.</span>');
        }

        if(!$('#billing-zip').val()) {
            errors++;
            $("#billing-zip").after('<span class="error-message customMessage">The Postcode / ZIP is required.</span>');
        }

        if(!$('#billing-state').val()) {
            errors++;
            $("#billing-state").after('<span class="error-message customMessage">The State / Province is required.</span>');
        }

        if(!$('#billing-country').val()) {
            errors++;
            $("#billing-country").after('<span class="error-message customMessage">The Country is required.</span>');
        }

        if(!$('#password').val() && $('#password').length > 0) {
            errors++;
            $("#password").after('<span class="error-message customMessage">The password is required.</span>');
        }

        if($('.ship-to-a-different-address').hasClass('clicked')) {
            if(!$('#shipping-first-name').val()) {
                errors++;
                $("#shipping-first-name").after('<span class="error-message customMessage">The first name is required.</span>');
            }

            if(!$('#shipping-last-name').val()) {
                errors++;
                $("#shipping-last-name").after('<span class="error-message customMessage">The last name is required.</span>');
            }

            if(!$('#shipping-address-1').val()) {
                errors++;
                $("#shipping-address-1").after('<span class="error-message customMessage">The address is required.</span>');
            }

            if(!$('#shipping-city').val()) {
                errors++;
                $("#shipping-city").after('<span class="error-message customMessage">The city is required.</span>');
            }

            if(!$('#shipping-zip').val()) {
                errors++;
                $("#shipping-zip").after('<span class="error-message customMessage">The Postcode / ZIP is required.</span>');
            }

            if(!$('#shipping-country').val()) {
                errors++;
                $("#shipping-country").after('<span class="error-message customMessage">The country is required.</span>');
            }

            if(!$('#shipping-state').val()) {
                errors++;
                $("#shipping-state").after('<span class="error-message customMessage">The State / Province is required.</span>');
            }
        }

        if(errors > 0) {
            $(".prev-step").trigger('click');
            $(".payment-tab").addClass("disabled");
        } else {
            $(".payment-tab").removeClass("disabled");
        }
    });

    $('.connect input').focus(function () {
        $(this).siblings('.url').children('p').show();
        $(this).siblings('.url').children('p').children('span').html($(this).val());
    }).focusout(function() {
        $(this).siblings('.url').children('p').hide();
    });

    $('.connect input').on('keyup keypress blur change', function () {
        $(this).siblings('.url').children('p').children('span').html($(this).val());
    });

    // $('[data-toggle="popover"]').popover({
    //     container: 'body'
    // });


    $(document).mouseup(function(e)
    {
        var container = $(".infoPop span");
        var target = $(".infoPop .info");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            target.hide();
        }
    });

    $('.infoPop span').click(function() {
        !$('.infoPop .info').not($(this).siblings('.info')).hide();
        $(this).siblings('.info').toggle();
    });

    function tog(v){return v?'addClass':'removeClass';}
    $(document).on('input', '.clearable', function(){
        $(this)[tog(this.value)]('x');
    }).on('mousemove', '.x', function( e ){
        $(this)[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');
    }).on('touchstart click', '.onX', function( ev ){
        ev.preventDefault();
        $(this).removeClass('x onX').val('').change();
    });

    $('input.clearable').focus(function() {
        if($(this).val().length > 0) {
            $(this)[tog(this.value)]('x');
        }
    });

    $("#job_phone").click(function() {
        if($("#job_phone").val() == ""){
            $("#job_phone").val("+1");
        }
    });

    $("#phone").click(function() {
        if($("#phone").val() == ""){
            $("#phone").val("+1");
        }
    });

    $("#whatsapp").click(function() {
        if($("#whatsapp").val() == ""){
            $("#whatsapp").val("+1");
        }
    });

});

/*Validate instagram input*/
$("#instagram").keypress(function(event) {
    var character = String.fromCharCode(event.keyCode);
    return isValid(character);     
});

/*Validate instagram input*/
$("#twitter").keypress(function(event) {
    var character = String.fromCharCode(event.keyCode);
    return isValid(character);     
});

/*Validate instagram input*/
$("#snapchat").keypress(function(event) {
    var character = String.fromCharCode(event.keyCode);
    return isValid(character);     
});


function isValid(str) {
    return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
}

function getlink() {
    var aux = document.createElement("input");
    aux.setAttribute("value",window.location.href);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);
}

$(document).on('click', function(e) {
    if ( e.target.id != 'job_phone' ) {
        if($("#job_phone").val() == "+1"){
            $("#job_phone").val("");
        }
    }
    if ( e.target.id != 'phone' ) {
        if($("#phone").val() == "+1"){
            $("#phone").val("");
        }
    }
    if ( e.target.id != 'whatsapp' ) {
        if($("#whatsapp").val() == "+1"){
            $("#whatsapp").val("");
        }
    }
});

function copyToClipboard(element) {
  document.execCommand("copy");  
  var text = document.querySelector(element).textContent;
  navigator.clipboard.writeText(text);
}

/*Form validation*/
function validate(button){
    //onclick with this in button type="button"
    $(button).prop('disabled', true);
    var validated = true; 
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    
    // Validate inputs and selects
    $('.required').each(function(){
        if($(this).val() == "" || $(this).val() == null){
            $(this).css('border', '1px solid red');

            //Label bellow of input with -> style="display: none"
            $(this).closest('div').find('label').css({
                "display": "block"
            }); 
            alert('Hola');

            validated = false;
        } else {
            $(this).css('border', '');

            $(this).closest('div').find('label').css({
                "display": "none"
            }); 
        }
    });
    // Validate length format
    $('.required_length').each(function(){
        var length = $(this).data('length');
        if($(this).val() == "" || $(this).val().length != length){
            $(this).css('border', '1px solid red');
            validated = false;
        } else {
            $(this).css('border', '');
        }
    });
    // Validate email format
    $('.required_email').each(function(){
        if(!regex.test($(this).val())){
            $(this).css('border', '1px solid red');

            //Label bellow of input with -> style="display: none"
            $(this).closest('div').find('label').css({
                "display": "block"
            }); 

            validated = false;
        } else {
            $(this).css('border', '');

            $(this).closest('div').find('label').css({
                "display": "none"
            }); 
        }
    });
    // Validate checkboxes
    $('.required_checkbox').each(function(){
        if(!$(this).is(':checked')){
            $(this).parent().css('border', '1px solid red');
            validated = false;
        } else {
            $(this).parent().css('border', '');
        }
    });
     if(validated){

        //Ajax Request
        $('#contactForm').request('onSaveContactForm', {
        
            data: $('#contactForm').serialize(),
            
            success:function(data){
                $('#contact-alert').css('display','block');
             }
        }); 

        // Do something on success validation
        $(button).prop('disabled', false);

    } else {
        // Do something on failed validation
        $(button).prop('disabled', false);
    } 
}