/*Lazy Loader For Speed Up Website */


  // response callback function
    // best practice for working with Zepto
    $('.lazy').lazy({
      successLoader: function(element, response) {
          response(true);
      },
      errorLoader: function(element, response) {
          response(false);
      }
  });

  $(function() {
    $('.lazy').lazy({
        // loads instantly
        customLoaderName: function(element) {
            element.load();
        },

        // embed a youtube video


        // loads with a five seconds delay
        asyncLoader: function(element) {
            setTimeout(function() {
                element.load()
            }, 5000);
        },

        // always fail
        errorLoader: function(element) {
            element.error();
        }
    });
});


/*color theme */

document.documentElement.style.setProperty(
  "--color",
  localStorage.getItem("pageColor")
);
document.documentElement.style.setProperty(
  "--bg-color",
  localStorage.getItem("pageColor2")
);


const colors = document.querySelectorAll(".colors");
console.log(document.documentElement.style.getPropertyValue('--bg-color'));

if(document.documentElement.style.getPropertyValue('--bg-color') == '#eaeaea63')
{
  $('body').removeClass('lighed');
  $('body').addClass('darked');
}
else if(document.documentElement.style.getPropertyValue('--bg-color') == '#2b2a2a78'){
  $('body').removeClass('darked');
  $('body').addClass('lighed');
}
else{
  $('body').removeClass('darked');
  $('body').addClass('lighed');
  document.documentElement.style.setProperty("--color", '#fff');
  document.documentElement.style.setProperty("--bg-color", '#2b2a2a78');

  localStorage.setItem("pageColor", '#fff');
  localStorage.setItem("pageColor2",  '#2b2a2a78');
}




colors.forEach(function (color) {
  console.log(color);
  color.addEventListener("click", function () {
    if(color.classList.contains('darkk'))
    {
      $('body').removeClass('lighed');
     $('body').addClass('darked');

     console.log('cliked dark');
     $('.uk-navbar-container').removeClass('DarkNav');
     $('.uk-navbar-container').addClass('lightNav');
    }
    else{
      $('body').removeClass('darked');

      $('body').addClass('lighed');
      $('.uk-navbar-container').addClass('DarkNav');
     $('.uk-navbar-container').removeClass('lightNav');
      console.log('cliked light');
    }
    let hex = color.dataset.color;
    let hex2= color.dataset.color2;
    //console.log(color.dataset.color2);
    document.documentElement.style.setProperty("--color", hex);
    document.documentElement.style.setProperty("--bg-color", hex2);

    localStorage.setItem("pageColor", color.dataset.color);
    localStorage.setItem("pageColor2", color.dataset.color2);
  });
});



/*end */

/* cursor move */
var cursor = $(".cursor"),
  follower = $(".cursor-follower");

var posX = 0,
  posY = 0;

var mouseX = 0,
  mouseY = 0;

TweenMax.to({}, 0.016, {
  repeat: -1,
  onRepeat: function () {
    posX += (mouseX - posX) / 9;
    posY += (mouseY - posY) / 9;

    TweenMax.set(follower, {
      css: {
        left: posX - 12,
        top: posY - 12,
      },
    });

    TweenMax.set(cursor, {
      css: {
        left: mouseX,
        top: mouseY,
      },
    });
  },
});

$(document).on("mousemove", function (e) {
  mouseX = e.clientX;
  mouseY = e.clientY;
});

$(".link").on("mouseenter", function () {
  cursor.addClass("active");
  follower.addClass("active");
});
$(".link").on("mouseleave", function () {
  cursor.removeClass("active");
  follower.removeClass("active");
});

/*end */


$(window).ready(function(){
    $("#loader").fadeTo(1000,1).fadeOut(2000);
 });






 /*navba color Dark - light */
 $(function(){
  $(window).scroll(function(){
    if($('body').hasClass('darked'))
    {
      if(window.scrollY > 150)
      {
        $('.uk-navbar-container').addClass('lightNav');
      }
      else{
        $('.uk-navbar-container').removeClass('lightNav');
      }
      console.log('darked');
    }
    else{
      if(window.scrollY > 150)
      {
        $('.uk-navbar-container').addClass('DarkNav');
      }
      else{
        $('.uk-navbar-container').removeClass('DarkNav');
      }
      console.log('light');
    }

  });
});

 /*end*/
/*#f0e7e79c*/
//background-color: #fffafae6;

function msg()
{
    Toastify({
        text: "The item has been added to the cart Successfully",
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        positionLeft: true, // `true` or `false`
        backgroundColor: "linear-gradient(to right, #96c93d, #96c93d)"
    }).showToast();
}
