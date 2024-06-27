const previousBtn = document.querySelector(".previousBtn");
const nextBtn = document.querySelector(".nextBtn");
const content = [...document.querySelectorAll(".content_c")];
const bullets = [...document.querySelectorAll(".step")];

const MAX_STEPS = 4;
let currentStep = 1;
let flag = true;

// // /*next Btn 000*/
// nextBtn.addEventListener("click", () => {
// 	  /*check user select Address Or Add New Addess */
//     if (currentStep == 2) {
//         if ($(".glutenRadio:checked").length == 0) {
//             alert("Pless Select Your Mehods");
//             flag = false;
//             console.log(flag , 'if methods');
//             return false;
//         }
//         if ($(".onlineOptionRadio").is(":checked")) {
//             console.log(flag , 'online checked');
//             flag =false;
//             alert('error');
//             if ($(".addressRowOption").length == 0) {
//                 alert("Du må legg leveringsadresse.");
//                 flag = false;
//                 return false;
//             } else if ($(".addressRowOption input:checked").length == 0) {
//                 alert("Pless Select Your Address");
//                 flag = false;
//                 return false;
//             } else {
//                 flag = true;
//             }
//         }
//         if(flag)
//         {
//             nextBtn.classList.add('d-none');
//         }
//     }
//
//     if (currentStep == 3) {
//         flag= false;
//         if ($(".glutenRadio2:checked").length == 0) {
//             alert("Pless Select Your Payments");
//             flag = false;
//             return false;
//         } else {
//             flag = true;
//         }
//     }
//     /*end check Address */
//
//   bullets[currentStep - 1].classList.add("is-complete");
//   bullets[currentStep - 1].classList.remove("is-active");
//   content[currentStep - 1].classList.remove("is-active");
//   bullets[currentStep].classList.add("is-active");
//   content[currentStep].classList.add("is-active");
//   console.log("before", currentStep);
//
//   if (flag == true || currentStep< 5) {
//     currentStep += 1;
//     previousBtn.classList.add('d-inline-block');
//         console.log(currentStep);
//     /*Prev Btn */
//     previousBtn.disabled = false;
//     if (currentStep === MAX_STEPS) {
//       nextBtn.disabled = true;
//       console.log("fisnish", MAX_STEPS);
//       bullets[MAX_STEPS - 1].classList.add("is-complete");
//       nextBtn.classList.add('d-none');
//       previousBtn.classList.remove('d-inline-block');
//       previousBtn.classList.add('d-none');
//     }
//
//
//     if (currentStep > 1) {
//       $("html, body").animate({ scrollTop: 0 }, "slow");
//       $(".invoiceC").css("display", "none");
//       $(".wrapC").addClass("col-lg-12");
//       $(".wrapC").removeClass("col-lg-8");
//
//     }
//
//   }
//
//
//
//
// });
//
// /*back Btn */
// previousBtn.addEventListener("click", () => {
//   bullets[currentStep - 1].classList.remove("is-complete");
//   bullets[currentStep - 1].classList.remove("is-active");
//   content[currentStep - 1].classList.remove("is-active");
//
//   bullets[currentStep - 2].classList.remove("is-complete");
//   bullets[currentStep - 2].classList.add("is-active");
//   content[currentStep - 2].classList.add("is-active");
//   $("html, body").animate({ scrollTop: 0 }, "slow");
//   currentStep -= 1;
//   nextBtn.disabled = false;
//
//   if (currentStep == 1) {
//     console.log(currentStep);
//     $("html, body").animate({ scrollTop: 0 }, "slow");
//     $(".invoiceC").css("display", "block");
//     $(".wrapC").removeClass("col-lg-12");
//     $(".wrapC").addClass("col-lg-8");
//     previousBtn.classList.remove('d-inline-block');
//   }
// });

/*Go Step 3 */
function PaymentStep() {
  currentStep = 3;
  bullets[0].classList.remove("is-active");
  bullets[0].classList.add("is-complete");
  bullets[1].classList.add("is-complete");

  content[0].classList.remove("is-active");
  content[1].classList.remove("is-active");

  bullets[2].classList.add("is-active");
  content[2].classList.add("is-active");
}

/*label step 3 selected */
$(".glutenRadio:checked").parents(".labl").addClass("showBadge");
$(".glutenRadio").on("click", function () {
  $(".glutenRadio").parents(".labl").removeClass("showBadge");
  $(this).parents(".labl").addClass("showBadge");
});

/*label step 4 selected */
$(".glutenRadio2:checked").parents(".labl").addClass("showBadge");
$(".glutenRadio2").on("click", function () {
  $(".glutenRadio2").parents(".labl").removeClass("showBadge");
  $(this).parents(".labl").addClass("showBadge");
});


/*counter Cart plus Munis */

$('.plus').on('click', function (e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('.number').find('input');
    var priceValue = $(this).parents('.wrap_price').find('.numTop').attr("item-price");
    var price = $(this).parents('.wrap_price').find('.numTop');
    var delPrice = $(this).parents('.wrap_price').find('#delprice');
    var value = parseInt($input.val());

    if (value < 100) {
        value = value + 1;
    } else {
        value = 100;
    }

    $input.val(value);
    load_ajax_cart($(this).data('id'),value);
    // price.text( Number(priceValue * $input.val()).toFixed(2));
    // delPrice.text( Number((priceValue*1.5) * $input.val()).toFixed(2));

});

$('.minus').on('click', function (e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('.number').find('input');
    var priceValue = $(this).parents('.wrap_price').find('.numTop').attr("item-price");
    var price = $(this).parents('.wrap_price').find('.numTop');
    var delPrice = $(this).parents('.wrap_price').find('#delprice');
    var value = parseInt($input.val());

    if (value > 2) {
        value = value - 1;
    } else {
        value = 1;
    }

    $input.val(value);
    load_ajax_cart($(this).data('id'),value);
    // price.text( Number(priceValue * $input.val()).toFixed(2));
    // delPrice.text( Number((priceValue*1.5) * $input.val()).toFixed(2));
});

/*end Cart Plus munis */





function load_ajax_cart(id,counter){

    $.request('onUpdateCart', {
        data: { quantity: counter , item_id: id },
        update: {'cart/cart_summary':'#cart_summary','cart/cart_summary_mobile':'#cart_summary_mobile','cart/header':'.cart_header'}
    });
}

/*Check Radio buttoon */
$(".student").click(function () {
  console.log("std");
  $(".threeRadio").addClass("hideOption");
  $(".nyAddress").addClass("hideOption");
  $(".threeRadio").removeClass("showOption");
  $(".nyAddress").removeClass("showOption");

  $(".student_info").removeClass("hideOption");
  $(".student_info").addClass("showOption");
});
$(".online").click(function () {
  console.log("online");
  $(".threeRadio").removeClass("hideOption");
  $(".nyAddress").removeClass("hideOption");
  $(".threeRadio").addClass("showOption");
  $(".nyAddress").addClass("showOption");
  $(".student_info").removeClass("showOption");
  $(".student_info").addClass("hideOption");
});
$(".hand").click(function () {
	$(".payments").removeClass("showOption");
  $(".payments").addClass("hideOption");
  $(".textAreaStep3").removeClass("hideOption");
  $(".textAreaStep3").addClass("showOption");
});
$(".visa").click(function () {
  $(".payments").removeClass("hideOption");
  $(".payments").addClass("showOption");

  $(".textAreaStep3").removeClass("showOption");
  $(".textAreaStep3").addClass("hideOption");
});

$(".add_address").click(function () {
  $(".addres").toggle("hideOption_toggle");
});

/* = == = = ==  extra in CartPage  = = == = === */
$(".status div").on("click", function () {
  $(this).toggleClass("deleteImg plusImg");
  $(this).parents(".box_Extra").toggleClass("selected");
});
function GoStep4() {
    currentStep = 3;
    bullets[0].classList.remove("is-active");
    bullets[0].classList.add("is-complete");
    bullets[1].classList.add("is-complete");
    bullets[2].classList.add("is-complete");
    content[0].classList.remove("is-active");
    content[1].classList.remove("is-active");
    content[2].classList.remove("is-active");
    previousBtn.classList.add('d-none');
    nextBtn.classList.add('d-none');
    $(".wrapC").addClass("col-lg-12");
    $(".wrapC").removeClass("col-lg-8");
    $(".invoiceC").css("display", "none");
    bullets[3].classList.add("is-active");
    content[3].classList.add("is-active");


}
