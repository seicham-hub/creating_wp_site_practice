function hamburger() {
  document.getElementById('line1').classList.toggle('line_1');
  document.getElementById('line2').classList.toggle('line_2');
  document.getElementById('line3').classList.toggle('line_3');
  document.getElementById('navigation').classList.toggle('in');
}

let hamburger1 = document.getElementById('hamburger');

hamburger1.addEventListener('click' , function () {
  hamburger();
} );


$(function(){
  $('#navigation a[href]').on('click', function(event) {
        $('#hamburger').trigger('click');
    });
});
