/**
 * Created by Kiran on 19-02-2017.
 */
$(document).ready(function(e){
    $(".expandAnswer").hide();
    $("body").on('click','.singleFaqItem h1',function(e){
        $(this).closest(".singleFaqItem").children(".expandAnswer").slideToggle(1000,"swing");
    });
    
        //$('head').append('<link rel="stylesheet" href="./css/media.css" type="text/css" />');
    if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        var fixmeTop = $('.header').offset().top;       // get initial position of the element
        $(window).scroll(function() {
            var currentScroll = $(window).scrollTop(); // get current position
            // assign scroll event listener
           // console.log(currentScroll);
            var headerHeight=$(".header").outerHeight();
            if (currentScroll > fixmeTop) {           // apply position: fixed if you
                $('.header').css({                      // scroll to that element or below it
                    position: 'fixed',
                    top: '0',
                    left: '0'
                });
                $('.raffle-page').css('marginTop',headerHeight+"px");

            } else {

                $('.raffle-page').css('marginTop','0');// apply position: static
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
        headerHeight = $(".header").outerHeight();
        switch(text){
            case "RAFFLE":
                $(".nav > li").removeClass("active-menu-grey");
                $(".nav > li").removeClass("active-menu-red");
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
        $("body,html").animate({
            scrollTop: scrollTo
        },1000);


    });
    $(".enterNowButton2").click(function(){
        $(".expander").removeClass("expander-active");
        $(".enterNowButton").closest(".secondHalf").animate({left:"0%"},600,"swing");
    });
    $(".scrollDown").click(function(){

        var scrollTo =$(".raffle-page").offset().top-headerHeight;
        $("body,html").animate({
            scrollTop: scrollTo
        },1000)
    });

    $(".faqScrollDown").click(function(){
        var scrollTo =$(".faq").offset().top-headerHeight;
        $("body,html").animate({
            scrollTop: scrollTo
        },1000)
    });

    $(".raffleItemImage img").on({mouseenter:function(){
        $(this).closest(".raffleItemImage").stop().children("h4.endDate").animate({zIndex:"100000"},900).show();
    },mouseleave:function(){
        $(this).closest(".raffleItemImage").stop().children("h4.endDate").hide();
    }});


    var i=1;
    $("body").on("click",".expander",function () {
        var divname= $(this).closest(".secondHalf");
        $(divname).css('position', 'relative');
        var open =$(".expander").hasClass("expander-active");
        if(open) {
            $(this).removeClass("expander-active");
            $(divname).animate({left:"0%"},600,"swing",function(){
                //$(".raffleItemDescription").show();
            });
        }else{
            $(this).addClass("expander-active");
            $(divname).animate({left:"45%"},600,"swing");
        }
    });
$("body").on("change",".shoeColor",function() {
    var selected = $(this).val();
    if (selected != "") {
    $(this).closest(".raffle").find(".raffleItemImage").html(" <img src='./uploads/" + selected + ".png' class=\"image\"\/>");
}
});
    $("form.feedbackForm").submit(function(e){
        e.preventDefault();
        var formdata = new FormData($(this)[0]);
        $.ajax({
            url: "./php/sendMail.php",
            type: "POST",
            data: formdata,
            contentType: false,
            async: false,
            processData: false,
            success: function(response) {

                $(".feedbackForm").html("<h1>Your Message Has been sent !</h1>");
            }
        });
    });
});