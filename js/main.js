/*$(document).ready(function($){
  var $container = $("#grid");
  // initialize Masonry after all images have loaded  
  $container.imagesLoaded( function() {
    $container.masonry({
      columnWidth: 150,
      itemSelector: ".item",
      isFitWidth: true,
      gutter: 10
    });
  });
});*/

$(window).load(function(){
    $('#page-loader').fadeOut(500);
  }); 

$(document).ready(function($){
  if ($(window).width() > 1200) {
    $('.exhibit-modal').addClass('desktopModal');
  }
});

/*$(document).ready(function($){
  if ($(window).width() > 1200) {
    $('.dropdown').addClass('dropdownPc');
  }
});*/

$(document).ready(function($){
  var $container = $("#grid");
  if ($(window).width() < 321) {
  // initialize Masonry after all images have loaded
  $container.imagesLoaded( function() {
    $container.masonry({
      columnWidth: 150,
      itemSelector: ".item",
      isFitWidth: true,
      gutter: 5
    });
  });
}
else if ($(window).width() < 801) {
  // initialize Masonry after all images have loaded  
  $container.imagesLoaded( function() {
    $container.masonry({
      columnWidth: 170,
      itemSelector: ".item",
      isFitWidth: true,
      gutter: 10
    });
  });
}
else if ($(window).width() < 1025) {
  // initialize Masonry after all images have loaded  
  $container.imagesLoaded( function() {
    $container.masonry({
      columnWidth: 140,
      itemSelector: ".item",
      isFitWidth: true,
      gutter: 8
    });
  });
}
else {
$container.imagesLoaded( function() {
    $container.masonry({
      columnWidth: 150,
      itemSelector: ".item",
      isFitWidth: true,
      gutter: 7
    });
  });

}
});

var modalVerticalCenterClass = ".modal-center";
function centerModals($element) {
    var $modals;
    if ($element.length) {
        $modals = $element;
    } else {
        $modals = $(modalVerticalCenterClass + ':visible');
    }
    $modals.each( function(i) {
        var $clone = $(this).clone().css('display', 'block').appendTo('body');
        var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
        top = top > 0 ? top : 0;
        $clone.remove();
        $(this).find('.modal-content').css("margin-top", top);
    });
}
$(modalVerticalCenterClass).on('show.bs.modal', function(e) {
    centerModals($(this));
});
$(window).on('resize', centerModals);

/*$(document).ready(function($){
  $("#grid").masonry({
    columnWidth: 150,
    itemSelector: ".item",
    gutter: 15
  });
});*/




/*$(document).ready(function($){
  $("#grid").masonry({
    columnWidth: 150,
    itemSelector: ".item",
    gutter: 15
  });
});*/