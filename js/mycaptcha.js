(function ($) {
$.fn.essentialCaptcha = function () {
var a = Math.ceil(Math.random() * 10),
b = Math.ceil(Math.random() * 10),
span = $(‘What is ‘+ a + ‘ + ‘ + b +’?:’),
textbox = $(”),
isHuman = function () {
return a + b === parseInt(textbox.val());;
},
reset = function () {
a = Math.ceil(Math.random() * 10);
b = Math.ceil(Math.random() * 10);
span = span.html(‘What is ‘ + a + ‘ + ‘ + b + ‘? ‘);
textbox.val(”);
};
this.prepend(textbox);
this.prepend(span);
return {
isHuman: isHuman,
reset: reset
};
};
})(jQuery);

Html…

usage…

var captcha=$(“#Captcha”).essentialCaptcha();

be intelligent after each wrong answer reset again….

if (!captcha.isHuman()) {
displayErrorInfo(“Please answer question correctly.”);
captcha.reset();
return false;
}// JavaScript Document