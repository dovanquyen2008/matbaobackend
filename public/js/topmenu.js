var preClass = "";
$('.top-menu>li.havechild').hover(function () {
    
    var curClass = $(this).attr('class');
    $('.menu1').addClass("showmenu");
    //if (preClass != curClass) {
    //    $('.submenu[class*=' + preClass + ']').stop().delay('350')
    //.animate({ 'bottom': '0px' });
    //    $('.submenu[class*=' + curClass + ']').stop().delay('350')
    //.animate({ 'bottom': '' + (-$('div[class*=' + curClass + ']').height()) + 'px' });
    //}
    //preClass = curClass;
});

$('.top-menu>li.havechild').mouseleave(function () {
    $('.menu1').removeClass("showmenu");
});

//$('.top-menu').mouseleave(function () {
//    preClass = "";
//    setTimeout(function () {
//        if (preClass == "")
//            $('.submenu').stop().delay('350').animate({ 'bottom': '0px' });
//    }, 100);
//});

//$('#menu').mouseleave(function () {
//    preClass = ""
//    $('.submenu').stop().delay('350').animate({ 'bottom': '0px' });
//});

//$('.submenu').hover(function () {
//    preClass = $(this).attr('class').replace("submenu ", "");
//    $(this).css({ 'bottom': '' + (-$(this).height()) + 'px' });
//},
//function () {
//    if (preClass != curClass) {
//        $(this).stop().delay('350').animate({ 'bottom': '0px' });
//    }
//});