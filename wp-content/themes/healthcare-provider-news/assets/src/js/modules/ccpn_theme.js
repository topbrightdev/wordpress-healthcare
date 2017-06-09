var HPN_Theme = (function($) {


  var init = function() {
    menuToggle();
    searchToggle();
  };


  var menuToggle = function() {
    
    var mainMenuOpenButton = $('#mainMenuOpenButton');
    var mainMenuCloseButton = $('#mainMenuCloseButton');

    $(mainMenuOpenButton).on('click', function(){
      $('body').toggleClass('menu-visible');
    });

    $(mainMenuCloseButton).on('click', function(){
      $('body').toggleClass('menu-visible');
    });

  };


  var searchToggle = function() {
    
    var searchToggleButton = $('#search-toggle-button');
    var searchForm = $('#search-form');

    $(searchToggleButton).on('click', function(){
      
      $(searchForm).slideToggle(function(){});

    });

  };


  return {
    init: init
  };

})(jQuery);