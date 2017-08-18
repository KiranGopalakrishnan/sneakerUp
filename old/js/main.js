/**
 * Created by Kiran on 19-02-2017.
 */
$(document).ready(function(e){
    $(".expandAnswer").hide();
    //var slider = $('.slider').anyslider();
    //var anyslider = slider.data('anyslider');
    $("body").on('click','.singleFaqItem h1',function(e){
        $(this).closest(".singleFaqItem").children(".expandAnswer").slideToggle(1000,"swing");
    });
    if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        var fixmeTop = $('.header').offset().top;       // get initial position of the element
        $(window).scroll(function() {
            var currentScroll = $(window).scrollTop(); // get current position
            // assign scroll event listener
           // console.log(currentScroll);
            var headerHeight=$(".header").outerHeight();
            if (currentScroll >= fixmeTop-headerHeight) {           // apply position: fixed if you
                $('.header').css({                      // scroll to that element or below it
                    position: 'fixed',
                    top: '0',
                    left: '0'
                });

            } else {                                   // apply position: static
                $('.header').css({                      // if you scroll above it
                    position: 'static'
                });
            }

        });
    }else{
        $('head').append('<link rel="stylesheet" href="./css/media.css" type="text/css" />');
    }

    var headerHeight = $(".header").outerHeight();
    $(".nav li").click(function(){
        var text = $(this).html();
        var section="home-page";
        switch(text){
            case "RAFFLE":
                $(".nav > li").removeClass(".active-menu-grey");
                $(".nav > li").removeClass(".active-menu-red");
                $(this).addClass("active-menu-red");
                section = "raffle-page";
                break;
            case "UPCOMING":
                $(".nav > li").removeClass("active-menu-grey");
                $(".nav > li").removeClass("active-menu-red");
                $(this).addClass("active-menu-red");
                section = "upcoming";
                break;
            case "WINNERS":
                $(".nav > li").removeClass(".active-menu-grey");
                $(".nav > li").removeClass("active-menu-red");
                $(this).addClass("active-menu-red");
                section="winner";
                break;
            case "FAQ":
                $(".nav > li").removeClass("active-menu-grey");
                $(".nav > li").removeClass("active-menu-red");
                $(this).addClass("active-menu-red");
                section = "faq";
                break;
            case "CONTACT US":
                $(".nav > li").removeClass("active-menu-grey");
                $(".nav > li").removeClass("active-menu-red");
                $(this).addClass("active-menu-red");
                section = "contact";
                break;
        }

        var scrollTo =($("."+section).offset().top)-headerHeight;
        /*if(section=="UPCOMING"){
            console.log(scrollTo +"--->"+section.offset().top);
        }*/
        $("body").animate({
            scrollTop: scrollTo
        },1000);


    });

    $(".scrollDown").click(function(){

        var scrollTo =$(".raffle-page").offset().top-headerHeight;
        $("body").animate({
            scrollTop: scrollTo
        },1000)
    });
    $(".faqScrollDown").click(function(){
        var scrollTo =$(".faq").offset().top-headerHeight;
        $("body").animate({
            scrollTop: scrollTo
        },1000)
    });



    var i=1;
    $(".expander").click(function () {
        var divname= $(this).closest(".secondHalf");
        $(divname).css('position', 'relative');

        if(i%2==0) {
            $(this).removeClass("expander-active");
            $(divname).animate({left:"0%"},600,"swing",function(){
                //$(".raffleItemDescription").show();
            });
        }else{
            $(this).addClass("expander-active");
            $(divname).animate({left:"45%"},600,"swing");
        }
        i++
    });


});