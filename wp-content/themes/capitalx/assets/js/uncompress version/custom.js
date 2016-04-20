var App = (function(window){
  "use strict";
  var _this = null;
  var cacheCollection = {};
  return {
    init : function(){
      _this = this;

      /* Blank color strip */
      this.SectionBlankStrip();

      /* Contact Accordian */
      this.ContactAccordian();

      /* Our Services */
      this.OurServies();

      /* Review List */
      this.ReviewList();

      /* News Slide Show */
      this.NewsSlideShow();
      
      /* Price Text Height */
      this.PriceTextHeight();

      /* Circle Counter */
      this.CircleCounter();
     
      /* Contact Form */
      this.ContactForm();

      /* Color Customizer */
      this.ColorSelector();
      this.ColorCustomizer();

      /* Client Logo */
      this.ClientLogo();

      /* HomeSlider */
      var ash = $('#a-home_slider');
      if (ash.length > 0){
        ash.bxSlider({ 
          controls: true,
          auto: true,
          mode : "fade",
          pager : false,
          speed: 1500
        });
      }
      var ahvs = $('#a-home_video_slider');  
      if (ahvs.length > 0){
        ahvs.bxSlider({ 
          controls: true,
          auto: false,
          mode : "fade",
          pager : false,
          speed: 1500,
          video: true,
          useCSS: false 
        });
      }

      /* Video Popup */
      var av = $('.c-video_pop');
      if (av.length > 0) {
        av.simpleLightboxVideo();
      } 

      var WindowWidth = $(window).width();
      if(WindowWidth < 1280){/* NewServiceHeight */App.NewServiceHeight();} 

      $(window).load(function(event) {
        App.ExpertHeight();
      }).resize(function(event) {
        App.NewServiceHeight();
      }).scroll(function(event) {
        App.StickyHeader();
      });

    },

    getObject: function(selector){
      if(typeof cacheCollection[selector] == "undefined"){
        cacheCollection[selector] = $(selector);
      }
      return cacheCollection[selector];
    },

    SectionBlankStrip: function(){
      var bs =  '.c-blank_strip';
      if (this.getObject(bs).length > 0) { 
        var LeftPostition = this.getObject(".c-section_header .container").offset().left
        _this.getObject(bs).css('width', LeftPostition); 
       }
    }, 

    ContactAccordian: function(){ 
      var cad = "div.a-accordian_detail"; 
      _this.getObject(".c-accordian_title > span").on('click', function() {
        if(!$(this).parent().parent().hasClass('c-open')){
          _this.getObject(".c-single_accordian").removeClass('c-open');
            _this.getObject(cad).slideUp("slow");
          $(this).parent().parent().find(cad).slideDown("slow");
          $(this).parent().parent().addClass('c-open');
          return false;
        }
      });
    },

    OurServies: function(){
        var owl = _this.getObject("#c-services");
        owl.owlCarousel({
          items : 3, //10 items above 1000px browser width
          itemsDesktop : [1000,3], //5 items between 1000px and 901px
          itemsDesktopSmall : [900,2], // 3 items betweem 900px and 601px
          itemsTablet: [600,1], //2 items between 600 and 0;
          itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
          pagination : false,
          paginationNumbers : true, 
          autoPlay : true,
          navigation: false
        });
         
        _this.getObject("#c-arrow_left > span").on('click', function() { owl.trigger('owl.next'); });
        _this.getObject("#c-arrow_right > span").on('click', function() { owl.trigger('owl.prev'); });
    },

    ReviewList: function(){
        var owl = _this.getObject("#c-review_list");
        owl.owlCarousel({
          items : 3, //10 items above 1000px browser width
          itemsDesktop : [1000,2], //5 items between 1000px and 901px
          itemsDesktopSmall : [900,2], // 3 items betweem 900px and 601px
          itemsTablet: [600,1], //2 items between 600 and 0;
          itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
          pagination : false,
          paginationNumbers : true, 
          autoPlay : true,
          navigation: false
        }); 
        _this.getObject("#c-review_left > span").on('click', function() { owl.trigger('owl.next'); });
        _this.getObject("#c-review_right > span").on('click', function() { owl.trigger('owl.prev'); });
    },

    ClientLogo: function(){
        var owl = _this.getObject("#c-client_logo_list");
        owl.owlCarousel({
          items : 4, //10 items above 1000px browser width
          itemsDesktop : [1000,4], //5 items between 1000px and 901px
          itemsDesktopSmall : [900,2], // 3 items betweem 900px and 601px
          itemsTablet: [600,1], //2 items between 600 and 0;
          itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
          pagination : false,
          paginationNumbers : true, 
          autoPlay : true,
          navigation: false
        });  
        _this.getObject("#c-client_left > span").on('click', function() { owl.trigger('owl.next'); });
        _this.getObject("#c-client_right > span").on('click', function() { owl.trigger('owl.prev'); });
    },

    NewsSlideShow: function(){
        var owl = _this.getObject("#c-news_slider");
        owl.owlCarousel({
          items : 1, //10 items above 1000px browser width
          itemsDesktop : [1000,1], //5 items between 1000px and 901px
          itemsDesktopSmall : [900,1], // 3 items betweem 900px and 601px
          itemsTablet: [600,1], //2 items between 600 and 0;
          itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
          pagination : false,
          paginationNumbers : true, 
          autoPlay : true,
          navigation: false
        }); 
        _this.getObject("#c-review_left > span").on('click', function() { owl.trigger('owl.next'); });
        _this.getObject("#c-review_right > span").on('click', function() { owl.trigger('owl.prev'); });
    },

    PriceTextHeight: function(){
      _this.getObject(".c-price_listing > div").each(function() {
        $(this).find('div.c-single_service_list_text').css("min-height",$(this).find('img').height());
      });
    },

    NewServiceHeight: function(){
      var cntd = ".c-newser_thumbs > div";  
      var ServHght = _this.getObject(""+cntd+":nth-child(2) img").height();
      _this.getObject(""+cntd+"").css('height', ServHght);
    },

    CircleCounter: function(){ 
       var cch = ".c-cirle_half";
       var ccf = ".c-cirle_full"; 
       $(".c-counter_circle div.row > div.c-counter_bg").each(function() {
         var counter_val = $(this).data("val"); 
         if(counter_val <= 50){ 
              var counter_val     = $(this).data("val");
              var counter_val     = counter_val*2;
              var circle_percent  = (180*counter_val/100);
              var circle_fill     = circle_percent+90;
              $(this).find(ccf).hide();
              $(this).find(cch).css('background-image', 'linear-gradient('+circle_fill+'deg, transparent 50%, #E4EFF9 50%), linear-gradient(90deg, #E4EFF9 50%, transparent 50%)');
         }
         else
         {  
              var counter_val    = $(this).data("val"); 
              var counter_val    = counter_val*2; 
              var circle_percent = (180*counter_val/100); 
              var circle_fill    = circle_percent-90;
              $(this).find(cch).hide();
              $(this).find(ccf).css('background-image', 'linear-gradient('+circle_fill+'deg, transparent 50%, #2a2d3c 50%), linear-gradient(90deg, #E4EFF9 50%, transparent 50%)');

         } 
       });  
    },

    ExpertHeight: function(){  
      var celd = ".c-expert_list > div > div";  
      var items = [];
      var maxValueInArray = "";
      _this.getObject(celd).each(function(n){
          items[n] = $(this).height();
          maxValueInArray = Math.max.apply(Math, items);
      }); 
      _this.getObject(celd).each(function(n){
        $(this).height(maxValueInArray);
      });
    },

    ColorSelector: function(){
      _this.getObject("#c-selector_icon").on('click', function(event) {
        _this.getObject("body").toggleClass('c-body_overlay');
        $(this).parent(".c-customizer").toggleClass('c-customizer_toggle');
        return false;
      });
    },

    ContactForm: function(){
        var fail = ".fail";
        var succ = ".succ";
          if (_this.getObject(fail).length > 0) {
            var msg = location.search.split('msg=')[1];
            if(msg=='succ'){
              _this.getObject(succ).show();
              _this.getObject(fail).hide();
              _this.getObject(document).scrollTop( $(succ).offset().top ); 
            }else if (msg=='fail') {
              _this.getObject(fail).show();
              _this.getObject(succ).hide();
              _this.getObject(document).scrollTop( $(fail).offset().top ); 
            }else{
              _this.getObject(succ).hide();
              _this.getObject(fail).hide();
            }
         } 
    },

    ColorCustomizer: function(){
          _this.getObject("#c-color_selector > li").on('click', function(event) { 
            var x = $(this).css('backgroundColor'); 
            _this.getObject(".c-cirle_graph_per > div").remove(); 
            _this.getObject( "body" ).addClass('t-overlay');
            _this.ChkIt(this);
            _this.getObject(".c-customizer").removeClass('c-customizer_toggle');
            _this.getObject("body").removeClass('c-body_overlay');
            return false;
        });
    },

    ChkIt: function(color_rels){ 
        var Themes = {
          "color_1":"assets/css/themes/color_1.css",
          "color_2":"assets/css/themes/color_2.css",
          "color_3":"assets/css/themes/color_3.css",
          "color_4":"assets/css/themes/color_4.css",
          "color_5":"assets/css/themes/color_5.css",
          "color_6":"assets/css/themes/color_6.css",
          "color_7":"assets/css/themes/color_7.css",
          "color_8":"assets/css/themes/color_8.css",
        };
        var color_rel = $(color_rels).attr("data-attr");   
          if(Themes.hasOwnProperty(color_rel)){ 
            $(document).find("link#ThemeRoller").remove();
            _this.SwitchTheme(Themes[color_rel]); 
          }
    },

    SwitchTheme: function(href){
      var wjs = document.createElement('link');
      wjs.type = 'text/css';
      wjs.id = 'ThemeRoller';
      wjs.async = true;
      wjs.rel="stylesheet";
      wjs.onload = function(){
        _this.getObject("body").removeClass('c-overlay');
      };
      wjs.href = href;
      (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(wjs);
    },

    StickyHeader: function(){
      var cs = ".c-sticky";
      var cf = "c-fixed"; 
      if (_this.getObject(cs).length > 0) { 
      var BannerHeight = $(".c-strip_header").height();
      var sticky = _this.getObject(cs),
          scroll = _this.getObject(window).scrollTop();

        if (scroll >= BannerHeight) sticky.addClass(cf);
        else sticky.removeClass(cf);
      }
    } 
  }
})(window)


/****** ANIMATION *****/
$(document).ready(function($) {
  App.init();
});