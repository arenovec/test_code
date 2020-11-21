

$("#menu").mouseover(function () {
    $("ul.js_close_ul ").css("display", "block")
});
$("#menu").mouseout(function () {
    $("ul.js_close_ul ").css("display", "none")
});


$(".js_focus_al").focus(function () {
    $(this).closest("li").addClass("al_active");
});
$(".js_focus_al").blur(function () {
    $(this).closest("li").removeClass("al_active");
});

/*
$().fancybox({
    selector: '.imglist a:visible',
});
*/
setTimeout(function () {
    var h;
    if ($(window).width() > 1279) {
        h = $(".slider_section").height();
        $(".js_open_ul").height(h - 0);       
    } else if ($(window).width() <= 991 && $(window).width() >= 768) {
        h = $(".slider_section2").height();
        $(".js_open_ul").height(h + 1);
    } else if ($(window).width() <= 1278 && $(window).width() >= 992) {
        h = $(".slider_section").height();
        $(".js_open_ul").height(h + 1);
    } else {
        h = $(".slider_section1").height();
        $(".js_open_ul").height(h - 1);
    }

}, 250);







// $(".slider_section").height(h - 0);

// var hcont, hbreadcrumb;
// hcont = $(".al_content").height();
// hbreadcrumb = $(".al_breadcrumb").height();

// $(".js_rek_height").height(hcont + hbreadcrumb -365);

$(".js_sort").click(function () {
    if ($("#al_drop_filter").hasClass("al_drop_filter_open")) {
        $("#al_drop_filter").slideUp().removeClass("al_drop_filter_open");
    } else {
        $("#al_drop_filter").slideDown().addClass("al_drop_filter_open");
    }
});


$(function () {
    $('#dl-menu').dlmenu();
});


$(function () {
    $('.myTabExample #enter').tab('show')
});

$('.js-icon-open').on('click',function(){

  $(this).find(".icon-close").toggle();
  $(this).find(".icon-open").toggle();
  
  let input = $(this).parents('.form-group').find('input');

  if(input.attr('type')=='password')
    input.attr('type','text');
  else  
    input.attr('type','password');
});