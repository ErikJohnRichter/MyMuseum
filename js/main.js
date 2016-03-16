$(document).ready(function($){
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
});




/*$(document).ready(function($){
  $("#grid").masonry({
    columnWidth: 150,
    itemSelector: ".item",
    gutter: 15
  });
});*/