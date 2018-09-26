(function () {
  
  var $moveAnimElts = $('.move-animable');
  var pageWidth = $(document).width();

  $moveAnimElts.css('transform', 'translateX('+pageWidth+'px'+')');

  console.log(document.readyState);
  
  
  document.addEventListener('load', function () {

  console.log('load'+document.readyState);
    

  });
})();