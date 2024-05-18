/**
 * Dark Light Mode
 * Header Connect
 * Loadmore Item
 * headerFixed
 * retinaLogo
 * ajaxContactForm
 * mobileNav
 * ajaxSubscribe
 * alertBox
 * loadmore
 */

(function ($) {
  "use strict";

  //Scroll back to top
  function handlePreloader() {
    if ($(".preloader").length) {
      $("body").addClass("page-loaded");
      $(".preloader").delay(400).fadeOut(0);
    }
  }




  $(".jb_walt_tran_btn_dummy").click(function(){
    // $(this).closest(".jb_walt_tran_btn_set").siblings(".jb_walt_tran_btn_set").find(".jb_walt_tran_btn_bdy").hide();
    $(this).closest(".jb_walt_tran_li").siblings(".jb_walt_tran_li").find(".jb_walt_tran_btn_set").removeClass("jb_walt_tran_btn_open").find(".jb_walt_tran_btn_bdy").hide();
    $(this).closest(".jb_walt_tran_btn_set").find(".jb_walt_tran_btn_bdy").slideToggle(200);
    $(this).closest(".jb_walt_tran_btn_set").toggleClass("jb_walt_tran_btn_open");
   

  });


$(".jb_report_typ_select").change(function(){
  var dnam = $(this).val();
  $(".jb_report_pane_li").removeClass("jb_report_pane_li_act");
$(".jb_report_pane_li").each(function(){
  if($(this).attr("data-nam") == dnam){
    $(this).addClass("jb_report_pane_li_act");
  }
});});

  $(".jb_kyc_card_img").click(function(){
    $(this).closest(".jb_kyc_card").find(".jb_kyc_card_input").click();
  });
  $(".jb_report_hdr_li").click(function(){
    var dnam = $(this).attr("data-nam");
    $(".jb_report_pane_li").removeClass("jb_report_pane_li_act");
    $(".jb_report_hdr_li").removeClass("jb_report_hdr_li_act");
    $(this).addClass("jb_report_hdr_li_act");
  $(".jb_report_pane_li").each(function(){
    if($(this).attr("data-nam") == dnam){
      $(this).addClass("jb_report_pane_li_act");
    }
  })
  });
  
$(".jb_depwith_hdr_li").click(function(){
  var dnam = $(this).attr("data-nam");
  $(".jb_depwith_pane_li").removeClass("jb_depwith_pane_li_act");
  $(".jb_depwith_hdr_li").removeClass("jb_depwith_hdr_li_act");
  $(this).addClass("jb_depwith_hdr_li_act");
$(".jb_depwith_pane_li").each(function(){
  if($(this).attr("data-nam") == dnam){
    $(this).addClass("jb_depwith_pane_li_act");
  }
})
});
$(".jb_sett_hdr_li").click(function(){
  var dnam = $(this).attr("data-nam");
  $(".jb_sett_tab_pane_li").removeClass("jb_sett_tab_pane_li_act");
  $(".jb_sett_hdr_li").removeClass("jb_sett_hdr_li_act");
  $(this).addClass("jb_sett_hdr_li_act");
$(".jb_sett_tab_pane_li").each(function(){
  if($(this).attr("data-nam") == dnam){
    $(this).addClass("jb_sett_tab_pane_li_act");
  }
})
});


  $(".jb_buycrypto_modal_tot_btn").click(function(){
    $(".jb_buycrypto_modal_tot_out").slideToggle(400);
  });
  $(".jb_buycrypto_modal_cls").click(function(){
    $(".jb_buycrypto_modal_tot_out").toggle();
  });
  $(".jb_bctomt_btn_1").click(function(){
    $(".jb_buycrypto_modal_tabs").removeClass("jb_buycrypto_modal_tab_act");
    $(".jb_bctomt_1").addClass("jb_buycrypto_modal_tab_act");
  });
  $(".jb_bctomt_btn_2").click(function(){
    $(".jb_buycrypto_modal_tabs").removeClass("jb_buycrypto_modal_tab_act");
    $(".jb_bctomt_2").addClass("jb_buycrypto_modal_tab_act");
  });
  $(".jb_bctomt_btn_3").click(function(){
    $(".jb_buycrypto_modal_tabs").removeClass("jb_buycrypto_modal_tab_act");
    $(".jb_bctomt_3").addClass("jb_buycrypto_modal_tab_act");
  });
  $(".jb_bctomt_btn_4").click(function(){
    $(".jb_buycrypto_modal_tabs").removeClass("jb_buycrypto_modal_tab_act");
    $(".jb_bctomt_4").addClass("jb_buycrypto_modal_tab_act");
  });
  $(".jb_bctomt_btn_5").click(function(){
    $(".jb_buycrypto_modal_tabs").removeClass("jb_buycrypto_modal_tab_act");
    $(".jb_bctomt_5").addClass("jb_buycrypto_modal_tab_act");
  });









  $(".jb_supo_exp_ch_text_fil").click(function(){
    $(".jb_supo_exp_ch_text_fil_in").click();
  });


  $(".jb_acrd_hd").click(function() {$(this).closest(".jb_acrd").toggleClass("jb_acrd_act")});
  $(".jh_password_ico").click(function() {
    if($(this).closest(".jb_log_in_set").hasClass("jb_pass_opn")){
      $(this).removeClass("fa-eye-slash");
      $(this).addClass("fa-eye");
      $(this).closest(".jb_log_in_set").removeClass("jb_pass_opn");
      $(this).closest(".jb_log_in_set").find(".jb_log_in_input").attr("type","password");
    }else{
      $(this).removeClass("fa-eye");
      $(this).addClass("fa-eye-slash");
      $(this).closest(".jb_log_in_set").addClass("jb_pass_opn");
      $(this).closest(".jb_log_in_set").find(".jb_log_in_input").attr("type","text");
    }
  
  });
  $( "body" ).delegate( "focusin", ".jb_log_in_input", function() {
    $(this).closest(".jb_log_in_set").addClass("jb_log_in_act");
  });
  $( "body" ).delegate( "focusout", ".jb_log_in_input", function() {
    $(this).closest(".jb_log_in_set").removeClass("jb_log_in_act");
    console.log("out");
  });
  
  function txtchk(){
 
  $(".jb_log_in_input").each(function() {
    var tvalu=$(this).val();
    if($(this).is(':focus')){
     
      $(this).closest(".jb_log_in_set").addClass("jb_log_in_act");
      $(this).closest(".jb_log_in_set").addClass("jb_log_in_open");
  }
  else{
    $(this).closest(".jb_log_in_set").removeClass("jb_log_in_act");
     if((tvalu == "") || (tvalu == 0)){
    $(this).closest(".jb_log_in_set").removeClass("jb_log_in_open");
   }else{
    $(this).closest(".jb_log_in_set").addClass("jb_log_in_open");
   }
  }
  });
}
setInterval( txtchk, 200);

  var themesflatTheme = {
    // Main init function
    init: function () {
      this.config();
      this.events();
    },

    // Define vars for caching
    config: function () {
      this.config = {
        $window: $(window),
        $document: $(document),
      };
    },

    // Events
    events: function () {
      var self = this;

      // Run on document ready
      self.config.$document.on("ready", function () {
        // Retina Logos
        self.retinaLogo();
      });

      // Run on Window Load
      self.config.$window.on("load", function () {});
    },

    // Retina Logos
    retinaLogo: function () {
      var retina = window.devicePixelRatio > 1 ? true : false;
      var $logo = $("#site-logo img");
      var $logo2 = $("#logo-footer img");
      var $logo_retina = $logo.data("retina");

      if (retina && $logo_retina) {
        $logo.attr({
          src: $logo.data("retina"),
          width: $logo.data("width"),
          height: $logo.data("height"),
        });
      }
      if (retina && $logo_retina) {
        $logo2.attr({
          src: $logo.data("retina"),
          width: $logo.data("width"),
          height: $logo.data("height"),
        });
      }
    },
  }; // end themesflatTheme

  // Start things up
  themesflatTheme.init();

  // Header Fixed
  // var headerFixed = function () {
  //   if ($("body").hasClass("header-fixed")) {
  //     var nav = $("#header_main");
  //     if (nav.length) {
      
  //       $(window).on("load scroll", function () {
  //         if ($(window).scrollTop() > 200) {
  //           nav.addClass("is-fixed");
  //           injectSpace.show();
  //         } else {
  //           nav.removeClass("is-fixed");
  //           injectSpace.hide();
  //         }

  //         if ($(window).scrollTop() > 400) {
  //           nav.addClass("is-small");
  //         } else {
  //           nav.removeClass("is-small");
  //         }
  //       });
  //     }
  //   }
  // };
  var goTop = function () {
    $(window).scroll(function () {
      if ($(this).scrollTop() > 800) {
        $("#scroll-top").addClass("show");
      } else {
        $("#scroll-top").removeClass("show");
      }
    });

    $("#scroll-top").on("click", function () {
      $("html, body").animate({ scrollTop: 0 }, 200, "easeInOutExpo");
      return false;
    });
  };

  //   // Dark Light Mode
  //   $(".sun").on('click', function (e) {
  //     e.preventDefault();
  //     $(".body").addClass("is_dark")

  //     document.getElementById("site-logo").src = "assets/images/logo/logo-dark.png";

  // });

  // $(".moon").on('click', function (e) {
  //     e.preventDefault();
  //     $(".body").removeClass("is_dark")

  //     document.getElementById("site-logo").src = "assets/images/logo/logo.png";

  // });

  // Mobile Navigation
  var mobileNav = function () {
    var mobile = window.matchMedia("(max-width: 1024px)");
    var wrapMenu = $(".left__main");
    var navExtw = $(".nav-extend.active");
    var navExt = $(".nav-extend.active").children();

    responsivemenu(mobile);

    mobile.addListener(responsivemenu);

    function responsivemenu(mobile) {
      if (mobile.matches) {
        $("#main-nav")
          .attr("id", "main-nav-mobi")
          .appendTo("#header_main")
          .hide()
          .children(".menu")
          .append(navExt)
          .find("li:has(ul)")
          .children("ul")
          .removeAttr("style")
          .hide()
          .before('<span class="arrow"></span>');
      } else {
        $("#main-nav-mobi")
          .attr("id", "main-nav")
          .removeAttr("style")
          .prependTo(wrapMenu)
          .find(".ext")
          .appendTo(navExtw)
          .parent()
          .siblings("#main-nav")
          .find(".sub-menu")
          .removeAttr("style")
          .prev()
          .remove();

        $(".mobile-button").removeClass("active");
        $(".mobile-button-style2").removeClass("active");
        $(".sub-menu").css({ display: "block" });
      }
    }
    $(document).on("click", ".mobile-button", function () {
      $(this).toggleClass("active");
      $("#main-nav-mobi").slideToggle();
    });
    $(document).on("click", ".mobile-button-style2", function () {
      $(this).toggleClass("active");
      $("#main-nav-mobi").slideToggle();
    });
    $(document).on("click", "#main-nav-mobi .arrow", function () {
      $(this).toggleClass("active").next().slideToggle();
    });
  };

  var alertBox = function () {
    $(document).on("click", ".close", function (e) {
      $(this).closest(".flat-alert").remove();
      e.preventDefault();
    });
  };

  var flatAccordion = function () {
    var args = { duration: 600 };
    $(".flat-toggle .toggle-title.active").siblings(".toggle-content").show();

    $(".flat-toggle.enable .toggle-title").on("click", function () {
      $(this).closest(".flat-toggle").find(".toggle-content").slideToggle(args);
      $(this).toggleClass("active");
    }); // toggle

    $(".flat-accordion .toggle-title").on("click", function () {
      $(".flat-accordion .flat-toggle").removeClass("active");
      $(this).closest(".flat-toggle").toggleClass("active");

      if (!$(this).is(".active")) {
        $(this)
          .closest(".flat-accordion")
          .find(".toggle-title.active")
          .toggleClass("active")
          .next()
          .slideToggle(args);
        $(this).toggleClass("active");
        $(this).next().slideToggle(args);
      } else {
        $(this).toggleClass("active");
        $(this).next().slideToggle(args);
        $(".flat-accordion .flat-toggle").removeClass("active");
      }
    }); // accordion
  };

  var flatCounter = function () {
    if ($(document.body).hasClass("counter-scroll")) {
      var a = 0;
      $(window).scroll(function () {
        var oTop = $(".counter").offset().top - window.innerHeight;
        if (a == 0 && $(window).scrollTop() > oTop) {
          if ($().countTo) {
            $(".counter")
              .find(".number")
              .each(function () {
                var to = $(this).data("to"),
                  speed = $(this).data("speed");

                $(this).countTo({
                  to: to,
                  speed: speed,
                });
              });
          }
          a = 1;
        }
      });
    }
  };

  var flattabs1 = function () {
    $(".flat-tabs1").each(function () {
      $(this).find(".content-tab1").children().hide();
      $(this).find(".content-tab1").children(".s2").show();
      $(this)
        .find(".menu-tab1")
        .children("li")
        .on("click", function () {
          var liActive = $(this).index();
          var contentActive = $(this)
            .siblings()
            .removeClass("active")
            .parents(".flat-tabs1")
            .find(".content-tab1")
            .children()
            .eq(liActive);
          contentActive.addClass("active").fadeIn("slow");
          contentActive.siblings().removeClass("active");
          $(this)
            .addClass("active")
            .parents(".flat-tabs1")
            .find(".content-tab1")
            .children()
            .eq(liActive)
            .siblings()
            .hide();
        });
    });
  };
  var flattabs2 = function () {
    $(".flat-tabs2").each(function () {
      $(this).find(".content-tab2").children().hide();
      $(this).find(".content-tab2").children().first().show();
      $(this)
        .find(".menu-tab2")
        .children("li")
        .on("click", function () {
          var liActive = $(this).index();
          var contentActive = $(this)
            .siblings()
            .removeClass("active")
            .parents(".flat-tabs2")
            .find(".content-tab2")
            .children()
            .eq(liActive);
          contentActive.addClass("active").fadeIn("slow");
          contentActive.siblings().removeClass("active");
          $(this)
            .addClass("active")
            .parents(".flat-tabs2")
            .find(".content-tab2")
            .children()
            .eq(liActive)
            .siblings()
            .hide();
        });
    });
  };

  var flattabs = function () {
    $(".flat-tabs").each(function () {
      $(this).find(".content-tab").children().hide();
      $(this).find(".content-tab").children().first().show();
      $(this)
        .find(".menu-tab")
        .children("li")
        .on("click", function () {
          var liActive = $(this).index();
          var contentActive = $(this)
            .siblings()
            .removeClass("active")
            .parents(".flat-tabs")
            .find(".content-tab")
            .children()
            .eq(liActive);
          contentActive.addClass("active").fadeIn("slow");
          contentActive.siblings().removeClass("active");
          $(this)
            .addClass("active")
            .parents(".flat-tabs")
            .find(".content-tab")
            .children()
            .eq(liActive)
            .siblings()
            .hide();
        });
    });
  };

  // Sidebar Toggle

  $(".btn").click(function () {
    $(this).toggleClass("click");
    $(".dashboard__sidebar").toggleClass("show");
    $(".dashboard").toggleClass("show");
  });
  $(".feat-btn").click(function () {
    $("nav ul .feat-show").toggleClass("show");
  });

  $(".sidebar__menu li").click(function () {
    $(this).addClass("active").siblings().removeClass("active");
  });

  $(function () {
    var url = window.location.pathname,
      urlRegExp = new RegExp(url.replace(/\/$/, "") + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
    // now grab every link from the navigation
    $(".sidebar__menu a").each(function () {
      // and test its normalized href against the url pathname regexp
      if (urlRegExp.test(this.href.replace(/\/$/, ""))) {
        $(this).addClass("active");
      }
    });
  });
  // End Sidebar Toggle

  var popupVideo = function () {
    if ($().magnificPopup) {
      $(".popup-youtube").magnificPopup({
        type: "iframe",
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
      });
    }
  };

  $(".icon-star").on("click", function () {
    $(this).toggleClass("active");
  });

  // Dom Ready
  $(function () {
    handlePreloader();
    
    goTop();
    mobileNav();
    alertBox();
    flatAccordion();
    flatCounter();
    flattabs();
    popupVideo();
    flattabs1();
    flattabs2();

    AOS.init({
      duration: 1000,
    });
  });
})(jQuery);
