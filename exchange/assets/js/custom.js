(function ($) {
  'use strict';
function homecheck(){
  if($(".sb_trd_indmain_page").length != 0){
    $(".sb_trd_home_bnr").addClass("jbhbg_act");
  }
}


// range slider
$("body").delegate(".market-trade-list-perc-bar", "input", function(  ){
  var valu= Number($(this).val());

  // console.log(" Val ",valu);

  var ofleft =  $(this).offset().left;
     $(this).closest(".market-trade-list-perc-bar_out").find(".market-trade-list-perc-bar-tooltip").show();

     
    $(this).closest(".market-trade-list-perc-bar_out").find(".market-trade-list-perc-bar-tooltip").text(valu+"%");
    var thiswidth = ($(this).closest(".market-trade-list-perc-bar_out").find(".market-trade-list-perc-bar-tooltip").width());
  
  
  });

  $("body").delegate(".lev_adj", "input", function(  ){
    var valu= Number($(this).val());
    $('.ac_lev').html(valu+" %");

  });

  


// // exchange order book bg
// function bgc(){


//    console.log(' BG Clsss ');
//   var divs = '<div class="sb_m_tbl_bg"></div>';

//   $("body").delegate(".bg_control", "each", function(){
//   // $('.bg_control').each(function(){ 
//     console.log(' BG Clsss ');

//     $(this).append(divs);
//     $(this).find(".sb_m_tbl_bg").css({"width":  $(this).attr("data-perc")+"%"});

//   }); 
//  }
//  bgc();


//  function bgcr(){
//    $('.bg_control').each(function(){
//     // console.log("JJJ");
     
//     $(this).find(".sb_m_tbl_bg").css({"width": $(this).attr("data-perc")+"%"});
//    });
//  }

//  setInterval(bgcr, 1000);

 



function bgcontoli(){
  var bgdiv = document.querySelectorAll(".sb_m_tbl_bg");
  for( var i = 0; i < bgdiv.length; i++){
  
  var crtdiv = bgdiv[i].getAttribute("data-perc");
  console.log(crtdiv);
  bgdiv[i].style.width = crtdiv+"%";
  }
  }
  bgcontoli();
  setInterval(bgcontoli, 2000);




 // exchange order book bg


// homecheck();
$("body").delegate(".sb_trd_pnl__ord_head_ico1", "click", function(){
  $(this).closest(".sb_trd_trade_mbl_trad_tab_s ").addClass("sb_trd_pnl__ord_buy_set_act");
$(this).closest(".sb_trd_trade_mbl_trad_tab_s ").removeClass("sb_trd_pnl__ord_sell_set_act");
});
$("body").delegate(".sb_trd_pnl__ord_head_ico2", "click", function(){
  $(this).closest(".sb_trd_trade_mbl_trad_tab_s ").removeClass("sb_trd_pnl__ord_buy_set_act");
$(this).closest(".sb_trd_trade_mbl_trad_tab_s ").addClass("sb_trd_pnl__ord_sell_set_act");
});
$("body").delegate(".sb_trd_pnl__ord_head_ico3", "click", function(){
  $(this).closest(".sb_trd_trade_mbl_trad_tab_s ").removeClass("sb_trd_pnl__ord_buy_set_act");
$(this).closest(".sb_trd_trade_mbl_trad_tab_s ").removeClass("sb_trd_pnl__ord_sell_set_act");
});
$("body").delegate(".sb_hdr_li > a", "click", function(){
  $(this).closest(".sb_hdr_li").find(".sb_hdr_li_ul").slideToggle();
});
$("body").delegate(".sb_hdr_mbl_menu_btn", "click", function(){
  $(".sb_hdr_ul").toggleClass("sb_hdr_ul_act");
});
$("body").delegate(".sb_hdr_mbl_menu_cls", "click", function(){
  $(".sb_hdr_ul").removeClass("sb_hdr_ul_act");
});

$("body").delegate(".sb_hdr_right_noti_ico", "click", function(){
  $(this).closest(".sb_hdr_right_noti_set").find(".sb_hdr_right_noti_in").slideToggle();
});

$("body").delegate(".sb_hdr_right_user_avt", "click", function(){
  $(this).closest(".sb_hdr_right_user_avt_set").find(".sb_hdr_right_user_in").slideToggle();
});

$("body").delegate(".sb_trad_marg_li_nor", "click", function(){
$(this).closest(".sb_trad_ex_pane_li").removeClass("sb_trad_jh_borrow");
$(this).closest(".sb_trad_ex_pane_li").removeClass("sb_trad_jh_repay");
});
$("body").delegate(".sb_trad_marg_li_borrow", "click", function(){
$(this).closest(".sb_trad_ex_pane_li").addClass("sb_trad_jh_borrow");
$(this).closest(".sb_trad_ex_pane_li").removeClass("sb_trad_jh_repay");
});
$("body").delegate(".sb_trad_marg_li_repay", "click", function(){
$(this).closest(".sb_trad_ex_pane_li").removeClass("sb_trad_jh_borrow");
$(this).closest(".sb_trad_ex_pane_li").addClass("sb_trad_jh_repay");
});
$("body").delegate(".sb_trad_marg_li", "click", function(){
  $(this).siblings(".sb_trad_marg_li").removeClass("sb_trad_marg_li_act");
  $(this).addClass("sb_trad_marg_li_act");
});



$("body").delegate(".sb_trad_ex_head_li", "click", function(){
  var nam = $(this).attr("data-nam");
  $(this).closest(".sb_trad_ex_tab_sec").find(".sb_trad_ex_head_li").removeClass("sb_trad_ex_head_li_act");
  $(this).addClass("sb_trad_ex_head_li_act");
  $(this).closest(".sb_trad_ex_tab_sec").find(".sb_trad_ex_pane_li").removeClass("sb_trad_ex_pane_li_act");
  $(this).closest(".sb_trad_ex_tab_sec").find(".sb_trad_ex_pane_li").each(function(){
    if($(this).attr("data-nam") == nam){
      $(this).addClass("sb_trad_ex_pane_li_act");
    }
  });
});



    // tooltip order book start
    if($(window).width() > 900){
    var nos1=0;
var nos2=0;
var nos3=0;
function h(){
        var toolt = '<div class="esft_exc_or_tooltip"></div>';
        $("body").append(toolt);
    };
    h();
      $(document).on("mousemove", function (event) {
$(".esft_exc_or_tooltip").css({top:event.pageY});
        });


    $("body").delegate(".sb_trd_trade_set_orderbook tbody tr", "mouseleave", function(){
        $(this).closest("tbody").find("tr").removeClass("esft_exc_ord_li");
         $(".esft_exc_or_tooltip").hide();
         nos1=0;
         nos2=0;
         nos3=0;
    });
   
    $("body").delegate(".sb_trd_trade_set_orderbook tbody tr", "mouseover", function(){
        nos1=0;
         nos2=0;
         nos3=0;
var myno = $(this).index() + 1;
$(".esft_exc_or_tooltip").show();

if(myno > 0){
  var offright = ($(this).offset().left + $(this).width() + 10);
$(".esft_exc_or_tooltip").css({left:offright});


$(".esft_exc_or_tooltip").css({"margin-top":"-"+($(window).scrollTop() + 40)+"px"});
for(var i = 0; i <= myno; i++){
    $(this).closest("tbody").find("tr:nth-child("+i+")").addClass("esft_exc_ord_li");
    nos1 = nos1 + Number($(this).closest("tbody").find("tr:nth-child("+i+")").find("td:nth-child(1)").text());
    nos2 = nos2 + Number($(this).closest("tbody").find("tr:nth-child("+i+")").find("td:nth-child(2)").text());
    nos3 = nos3 + Number($(this).closest("tbody").find("tr:nth-child("+i+")").find("td:nth-child(1)").text());
   
}
nos3 = nos3 / myno;
$(".esft_exc_or_tooltip").html(
    $(this).closest("tbody").attr("data-nam1")+" : "+parseFloat(nos1).toFixed(4)+"<br>"+
    $(this).closest("tbody").attr("data-nam2")+" : "+parseFloat(nos2).toFixed(4)+"<br>"+
    $(this).closest("tbody").attr("data-nam3")+" : "+parseFloat(nos3).toFixed(4)
    );

}else{
console.log("--------------------");
}
});
}else{}
 // tooltip order book end



 $("body").delegate(".sb_m_trad_tbl_or_btn_grn", "click", function(){
  var nam = $(this).attr("data-nam");
  $(".sb_m_trad_e_modal_out").removeClass("sb_m_trad_e_modal_act");
  $(".sb_m_trad_e_modal_out").each(function () {
  if($(this).attr("data-nam") == nam){
    $(this).addClass("sb_m_trad_e_modal_act");
  }
    });
  
  });
  
  
  $("body").delegate(".sb_m_trad_e_modal_in_hd_cls", "click", function(){
  
    $(".sb_m_trad_e_modal_out").removeClass("sb_m_trad_e_modal_act");
  
  
  });
  
  
   $("body").delegate(".sb_trad_futr_li_levi_btn", "click", function(){
    $(".sb_trad_futr_li_levi_set").slideToggle(); 
  });
   $("body").delegate(".sb_trad_futr_li_levi_btn_cls", "click", function(){
    $(".sb_trad_futr_li_levi_set").slideToggle(); 
  });
   $("body").delegate(".sb_trd_trad_buysell_chklbl", "click", function(){
  
    if($(this).find("input").prop('checked') == true){
      $(this).closest(".sb_trd_trad_buysell_chkset").addClass("sb_trd_trad_buysell_chkset_open");
   
      $(this).closest(".sb_trd_trad_buysell_chkset").find(".sb_trd_trad_buysell_chk_bdy").slideDown(200);
  }
  else{
    $(this).closest(".sb_trd_trad_buysell_chkset").removeClass("sb_trd_trad_buysell_chkset_open");
   
    $(this).closest(".sb_trd_trad_buysell_chkset").find(".sb_trd_trad_buysell_chk_bdy").slideUp(200);
  }
  });
  
  $(".sb_trd_trade_buysell_btn_buy").click(function(){
    $(".sb_trd_trade_set_buyandsell").addClass("sb_trd_trade_set_buyandsell_act_buy");
  });
  $(".sb_trd_trade_buysell_btn_sell").click(function(){
    $(".sb_trd_trade_set_buyandsell").addClass("sb_trd_trade_set_buyandsell_act_sell");
  });
  $(".sb_trd_trade_set_buyandsell_mbl_hdr_cls").click(function(){
    $(this).closest(".sb_trd_trade_set_buyandsell").removeClass("sb_trd_trade_set_buyandsell_act_sell");
    $(this).closest(".sb_trd_trade_set_buyandsell").removeClass("sb_trd_trade_set_buyandsell_act_buy");
  });
  
  $(".sb_trd_trade_mbl_trad_menu_li").click(function(){
    $(".sb_trd_trade_mbl_trad_menu_li").removeClass("sb_trd_trade_mbl_trad_menu_act");
    $(this).addClass("sb_trd_trade_mbl_trad_menu_act");
    var tnam = $(this).attr("data-nam");
    $(".sb_trd_trade_mbl_trad_tab_s").hide();
    var cla = ".sb_trd_trade_set_"+tnam;
  
   $(cla).show();
    var dpos =$(".sb_trd_trade_mbl_trad_tab_pan").position().top;
  
    $(cla).css({ top: dpos});
    $(".sb_trd_trade_mbl_trad_tab_pan").css({height:$(cla).height()});
    
  
  });
  $(window).scroll(function() {
    var dpos =$(".sb_trd_trade_mbl_trad_tab_pan").position().top;
  
    $(".sb_trd_trade_mbl_trad_tab_s").css({ top: dpos});
  });




$(".sb_trd_trad_buysell_chklbl").click(function(){
  $(this).closest(".sb_trd_trad_buysell_chkset").toggleClass("sb_trd_trad_buysell_chkset_open");
 
  if($(this).find("input").prop('checked') == true){
    $(this).closest(".sb_trd_trad_buysell_chkset").find(".sb_trd_trad_buysell_chk_bdy").slideDown(200);
}
else{
  $(this).closest(".sb_trd_trad_buysell_chkset").find(".sb_trd_trad_buysell_chk_bdy").slideUp(200);
}
});

$(".sb_trd_trade_buysell_btn_buy").click(function(){
  $(".sb_trd_trade_set_buyandsell").addClass("sb_trd_trade_set_buyandsell_act_buy");
});
$(".sb_trd_trade_buysell_btn_sell").click(function(){
  $(".sb_trd_trade_set_buyandsell").addClass("sb_trd_trade_set_buyandsell_act_sell");
});
$(".sb_trd_trade_set_buyandsell_mbl_hdr_cls").click(function(){
  $(this).closest(".sb_trd_trade_set_buyandsell").removeClass("sb_trd_trade_set_buyandsell_act_sell");
  $(this).closest(".sb_trd_trade_set_buyandsell").removeClass("sb_trd_trade_set_buyandsell_act_buy");
});

$(".sb_trd_trade_mbl_trad_menu_li").click(function(){
  $(".sb_trd_trade_mbl_trad_menu_li").removeClass("sb_trd_trade_mbl_trad_menu_act");
  $(this).addClass("sb_trd_trade_mbl_trad_menu_act");
  var tnam = $(this).attr("data-nam");
  $(".sb_trd_trade_mbl_trad_tab_s").hide();
  var cla = ".sb_trd_trade_set_"+tnam;

 $(cla).show();
  var dpos =$(".sb_trd_trade_mbl_trad_tab_pan").position().top;

  $(cla).css({ top: dpos});
  $(".sb_trd_trade_mbl_trad_tab_pan").css({height:$(cla).height()});
  

});
$(window).scroll(function() {
  var dpos =$(".sb_trd_trade_mbl_trad_tab_pan").position().top;

  $(".sb_trd_trade_mbl_trad_tab_s").css({ top: dpos});
});
function sizchk(){

var dpos =$(".sb_trd_trade_mbl_trad_tab_pan").position().top;

$(".sb_trd_trade_set_orderbook").css({ top: dpos});
  $(".sb_trd_trade_mbl_trad_tab_pan").css({height:$(".sb_trd_trade_set_orderbook").height()});
}
// sizchk();


  
  // change theme
  var ThemeOn = false;
  $('#changeThemeLight').on('click', function (e) {
    ThemeOn = !ThemeOn;
    if (ThemeOn) {
      $('#changeThemeLight a i').attr('class', 'icon ion-md-moon');
      $('header').attr('class', 'dark-bb');
      $('body').attr('id', 'dark');
      $('.navbar-brand img').attr('src', 'assets/img/logo-light.png');
    } else {
      $('#changeThemeLight a i').attr('class', 'icon ion-md-sunny');
      $('header').attr('class', 'light-bb');
      $('body').attr('id', 'light');
      $('.navbar-brand img').attr('src', 'assets/img/logo-dark.png');
    }
  });

  $('#changeThemeDark').on('click', function (e) {
    ThemeOn = !ThemeOn;
    if (ThemeOn) {
      $('#changeThemeDark a i').attr('class', 'icon ion-md-sunny');
      $('header').attr('class', 'light-bb');
      $('body').attr('id', 'light');
      $('.navbar-brand img').attr('src', 'assets/img/logo-dark.png');
    } else {
      $('#changeThemeDark a i').attr('class', 'icon ion-md-moon');
      $('header').attr('class', 'dark-bb');
      $('body').attr('id', 'dark');
      $('.navbar-brand img').attr('src', 'assets/img/logo-light.png');
    }
  });
})(jQuery);


$("body").delegate(".sb_trad_futr_li_sf", "click", function(){

// $(".sb_trad_futr_li_sf").click(function(){
  $(".sb_trad_futr_li_sf").removeClass("sb_trad_futr_li_act");
  $(this).addClass("sb_trad_futr_li_act");
  });