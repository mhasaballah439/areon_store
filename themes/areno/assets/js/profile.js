const items = document.getElementsByClassName('navigation__item');
const tabs = document.getElementsByClassName('tabsProfile');
Array.from(items).forEach((item, index) => {
  item.addEventListener('click', e => {
      console.log('clicked');
    document.querySelector('.navigation__item.active').classList.remove('active');
          $(".tabsProfile.active").removeClass('active');
          tabs[index].classList.add('active');
          items[index].classList.add('active');
          setTimeout(()=>{
            Autoclose();
           },300)
  });
});




const $menu = $('.box');

$(document).mouseup(e => {
   if (!$menu.is(e.target) // if the target of the click isn't the container...
   && $menu.has(e.target).length === 0) // ... nor a descendant of the container
   {
     $menu.removeClass('openBox');
  }
 });


 function Autoclose(){
    $menu.removeClass('openBox');
  }

$('.openSide').on('click', () => {
  $menu.toggleClass('openBox');
});



/*validate Mobile */
/*Timeer Down In mobile Tabs*/

/*Timer Down*/


var secondsRemaining;
var intervalHandle;
var timercode = document.getElementById('timercode');
let restart= document.getElementById("resendCode");
let ActiveBtn = document.getElementById('ActiveBtn1');
let inputTextCodeNotNull = document.getElementById('textnumber2');

function resetPage(){
  restart.style.display = "block";
  document.getElementById('phone').disabled = false;
}
function tick(){
	// grab the h1
	var timeDisplay = document.getElementById("time");
	// turn the seconds into mm:ss
	var min = Math.floor(secondsRemaining / 60);
	var sec = secondsRemaining - (min * 60);
	//add a leading zero (as a string value) if seconds less than 10
	if (sec < 10) {
		sec = "0" + sec;
	}
	// concatenate with colon
	var message = min.toString() + ":" + sec;
	// now change the display
	timeDisplay.innerHTML = message;
	// stop is down to zero
	if (secondsRemaining === 0){
		clearInterval(intervalHandle);
		resetPage();
	}
	//subtract from seconds remaining
	secondsRemaining--;
}
function startCountdown(){
	// get countents of the "minutes" text box
	var minutes = 0.2;
	// how many seconds
	secondsRemaining = minutes * 60;
	// have to make it into a variable so that you can stop the interval later!!!
    intervalHandle = setInterval(tick, 1000);
    //when click Active code and input box not null then show pop up and clear timer from page
    ActiveBtn.onclick= ()=>{
        if(inputTextCodeNotNull.value!='')
        {
            console.log('value',inputTextCodeNotNull.value);
            clearInterval(intervalHandle);
            ActiveBtn.setAttribute('data-target','#myModal');
            timercode.style.display='none';
        }

    }
	document.getElementById("resendCode").style.display = "none";
}

/*Active Red => send sms btn*/
const  smsBtn = document.getElementById('smsBtn').onclick= ()=>{
    document.getElementById('phone').disabled = true;
    startCountdown();
    timercode.style.display='flex';
    console.log('run');
    }

    //when click resend code or change mobile
restart.onclick=()=>{
    startCountdown();
    document.getElementById('phone').disabled = true;
}






/*validate Mobile */
var input = document.querySelector("#phone"),
        errorMsg = document.querySelector("#error-msg"),
        validMsg = document.querySelector("#valid-msg");
      // here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Ugyldig nummer", "Ugyldig landskode", "For kort", "For langt ", "Ugyldig nummer","Ugyldig nummer"];

// initialise plugin
var iti = window.intlTelInput(input, {
separateDialCode: false,
  preferredCountries:["no"],
  hiddenInput: "full",
  utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.3/build/js/utils.js",
});


var reset = function() {
  input.classList.remove("error");
  errorMsg.innerHTML = "";
  errorMsg.classList.add("hide");
  validMsg.classList.add("hide");
};

var number = $('#phone');
number.on('keyup', function() {
  reset();
    if ($(this).val() == 0)
    {
      console.log('Changed.');
      $("#smsBtn").attr("disabled", true);
      errorMsg.classList.add("hide");
      validMsg.classList.add("hide");
      input.classList.remove('isValid');
    }
   else
    {
      if (iti.isValidNumber()) {
        validMsg.classList.remove("hide");
        $("#smsBtn").attr("disabled", false);
        errorMsg.classList.add("hide");
        input.classList.add('isValid');
        }
         else {
        $("#smsBtn").attr("disabled", true);
        input.classList.add("error");
        input.classList.remove('isValid');
        var errorCode = iti.getValidationError();
        if(errorCode == -99)
        {
        errorMsg.innerHTML = errorMap[2];
        }
        else{
        errorMsg.innerHTML = errorMap[errorCode];
        }

        console.log(errorCode);
        errorMsg.classList.remove("hide");
        validMsg.classList.add("hide");
        }
      console.log('Changed.2');
     }
    });



/*end validate Mobile */
/*end */
/*end validate Mobile */