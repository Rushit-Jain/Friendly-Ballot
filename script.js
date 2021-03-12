function validateFirstName () {
    document.getElementById('fname').value = document.getElementById('fname').value.trim();
    var fname = document.getElementById('fname').value;
    var fnameerr = document.getElementById('fnameerr');
    const regexpname = /^[a-zA-Z]+$/;
    //First name validation
    if(fname.length >= 3 && fname.length <=25 && regexpname.test(fname)) {
        document.getElementById('fname').style.border = "green 3px solid";
        fnameerr.style.color = "#ffffbd";
        fnameerr.innerHTML = "<i class='fa fa-check' aria-hidden='true'></i>"
        fnameerr.style.display = "inline";
        return true;
    }
    else if(fname === "" || fname.length < 3 || fname.length > 25) {
        document.getElementById('fname').style.border = "orange 2px solid";
        fnameerr.style.color = "orange";
        fnameerr.innerHTML = "<i class='fa fa-exclamation' style='padding-right:10px' aria-hidden='true'></i> First name must be at least 3 characters and at most 25 characters long.";
        fnameerr.style.display = "inline";
        return false;
    }
    else if(!regexpname.test(fname)) {
        document.getElementById('fname').style.border = "orange 2px solid";
        fnameerr.style.color = "orange";
        fnameerr.innerHTML = "<i class='fa fa-exclamation' style='padding-right:10px' aria-hidden='true'></i> First name must contain only alphabets.";
        fnameerr.style.display = "inline";
        return false;
    }   
}

function validateLastName () {
    document.getElementById('lname').value = document.getElementById('lname').value.trim();
    var lname = document.getElementById('lname').value;
    var lnameerr = document.getElementById('lnameerr');
    const regexpname = /^[a-zA-Z]+$/;
    //Last name validation
    if(lname.length >= 3 && lname.length <=25 && regexpname.test(lname)) {
        document.getElementById('lname').style.border = "green 3px solid";
        lnameerr.style.color = "#ffffbd";
        lnameerr.innerHTML = "<i class='fa fa-check' aria-hidden='true'></i>"
        lnameerr.style.display = "inline";
        return true;
    }
    else if(lname === "" || lname.length < 3 || lname.length > 25) {
        document.getElementById('lname').style.border = "orange 2px solid";
        lnameerr.style.color = "orange";
        lnameerr.innerHTML = "<i class='fa fa-exclamation' style='padding-right:10px' aria-hidden='true'></i> Last name must be at least 3 characters and at most 25 characters long.";
        lnameerr.style.display = "inline";
        return false;
    }
    else if(!regexpname.test(lname)) {
        document.getElementById('lname').style.border = "orange 2px solid";
        lnameerr.style.color = "orange";
        lnameerr.innerHTML = "<i class='fa fa-exclamation' style='padding-right:10px' aria-hidden='true'></i> Last name must contain only alphabets.";
        lnameerr.style.display = "inline";
        return false;
    }   
}

function validateUsername () {
    document.getElementById('username').value = document.getElementById('username').value.trim();
    var username = document.getElementById('username').value;
    var unameerr = document.getElementById('unameerr');
    const regexpuname = /^[a-zA-Z]+[0-9a-zA-Z_]+$/;
    if(username.length >= 6 && regexpuname.test(username)) {
        document.getElementById('username').style.border = "green 3px solid";
        unameerr.style.color = "#ffffbd";
        unameerr.innerHTML = "<i class='fa fa-check' aria-hidden='true'></i>";
        unameerr.style.display = "inline";
        return true;
    }
    else if(username.length < 6) {
        document.getElementById('username').style.border = "orange 2px solid";
        unameerr.style.color = "orange";
        unameerr.innerHTML = "<i class='fa fa-exclamation' style='padding-right:10px' aria-hidden='true'></i> Username must be at least 6 characters long.";
        unameerr.style.display = "inline";
        return false;
    }
    else if(!regexpuname.test(username)) {
        document.getElementById('username').style.border = "orange 2px solid";
        unameerr.style.color = "orange";
        unameerr.innerHTML = "<i class='fa fa-exclamation' style='padding-right:10px' aria-hidden='true'></i> Username must begin with an alphabet and can contain alphabets, numbers and underscores only.";
        unameerr.style.display = "inline";
        return false;
    }
}

function validatePassword () {
    document.getElementById('password').value = document.getElementById('password').value.trim();
    validateCnfPassword();
    var password = document.getElementById('password').value;
    var passworderr = document.getElementById('passworderr');
    const regexppassword = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,}$/;
    //Password validation
    if(regexppassword.test(password)) {
        document.getElementById('password').style.border = "green 3px solid";
        passworderr.style.color = "#ffffbd";
        passworderr.innerHTML = "<i class='fa fa-check' aria-hidden='true'></i></br>";
        passworderr.style.display = "inline";
        return true;
    }
    else {
        document.getElementById('password').style.border = "orange 2px solid";
        passworderr.style.color = "orange";
        passworderr.innerHTML = "<i class='fa fa-exclamation' style='padding-right:10px' aria-hidden='true'></i> Password must be at least 6 characters long and must contain at least one number and special character.";
        passworderr.style.display = "inline";
        return false;
    }
}

function validateCnfPassword () {
    document.getElementById('cnfpwd').value = document.getElementById('cnfpwd').value.trim();
    var cnfpwd = document.getElementById('cnfpwd').value;
    var cnfpwderr = document.getElementById('cnfpwderr');
    var password = document.getElementById('password').value;
    const regexppassword = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,}$/;
    //Confirm password validation
    if(regexppassword.test(password) && password === cnfpwd) {
        document.getElementById('cnfpwd').style.border = "green 3px solid";
        cnfpwderr.style.color = "#ffffbd";
        cnfpwderr.innerHTML = "<i class='fa fa-check' aria-hidden='true'></i></br>";
        cnfpwderr.style.display = "inline";
        return true;
    }
    else if(!regexppassword.test(password)) {
        document.getElementById('cnfpwd').style.border = "orange 2px solid";
        cnfpwderr.style.color = "orange";
        cnfpwderr.innerHTML = "<i class='fa fa-exclamation' style='padding-right:10px' aria-hidden='true'></i> Password does not follow the norms.";
        cnfpwderr.style.display = "inline";
        return false;
    }
    if(password !== cnfpwd) {
        document.getElementById('cnfpwd').style.border = "orange 2px solid";
        cnfpwderr.style.color = "orange";
        cnfpwderr.innerHTML = "<i class='fa fa-exclamation' style='padding-right:10px' aria-hidden='true'></i> Passwords do not match.";
        cnfpwderr.style.display = "inline";
        return false;
    }
}

function validateEmail () {
    document.getElementById('email').value = document.getElementById('email').value.trim();
    var email = document.getElementById('email').value;
    var emailerr = document.getElementById('emailerr');
    const regexpemail = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,7}$/i;
    //Email validation
    if(regexpemail.test(email)) {
        document.getElementById('email').style.border = "green 3px solid";
        emailerr.style.color = "#ffffbd";
        emailerr.innerHTML = "<i class='fa fa-check' aria-hidden='true'></i>";
        emailerr.style.display = "inline";
        return true;
    }
    else {
        document.getElementById('email').style.border = "orange 2px solid";
        emailerr.style.color = "orange";
        emailerr.innerHTML = "<i class='fa fa-exclamation' style='padding-right:10px' aria-hidden='true'></i> Invalid email address.";
        emailerr.style.display = "inline";
        return false;
    }
}

function onValid() {
    if(validateFirstName() && validateLastName() && validateUsername() && validatePassword() && validateCnfPassword() && validateEmail()) {
        document.getElementById('submitsignup').disabled = false;
    }
    else {
        document.getElementById('submitsignup').disabled = true;
    }
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('.anime').fadeIn(4000);
  });
  
  var divdemo = $(".demo");
  // console.log(divdemo.length);
  var current=0;
  $('#down').on('click',function(e){
  
          // console.log(current);
          $(divdemo[current]).fadeIn(3000);
          current= current + 1;
          if(current == divdemo.length){
              $('#down').css('display','none');
          }
          $('.ui-tooltip').css('display','none');
      e.stopPropagation();
  });
  
    $('.slider').slick({
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
  
    $( function() {
      $( document ).tooltip({
        position: {
          my: "center bottom-20",
          at: "center top",
          using: function( position, feedback ) {
            $( this ).css( position );
            $( "<div>" )
              .addClass( "arrow" )
              .addClass( feedback.vertical )
              .addClass( feedback.horizontal )
              .appendTo( this );
          }
        }
      });
    });
let url = window.location.href;
let len = url.split("/");
let page = len[len.length-1];
let element;
if (page == 'index.php') {
    element = document.getElementById('home-link');
}
if (page == 'aboutus.php') {
    element = document.getElementById('about-link');
}
if (page == 'contactus.php') {
    element = document.getElementById('contact-link');
}
if (element != undefined) {
    element.classList.add('link-select');
}