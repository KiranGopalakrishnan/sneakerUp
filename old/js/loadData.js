/**
 * Created by Kiran on 27-02-2017.
 */
$(document).ready(function(e){
    $.post("./admin/php/checkRaffle.php",function(response){
        //var result = JSON.parse(response);
        console.log("rafflesUpdated")
        });
    $.post("./php/getPreviousWinners.php",function(response){
        var result = JSON.parse(response);
        for(var i=0;i<result.length;i++){
            if(result[i]!="") {
                var winner = "";
                winner += "  <div class=\"singleWinnerItem\">";
                winner += "                <div class=\"upcomingShoeName\">" + result[i][0].shoeName + "<\/div>";
                winner += "                <br\/>";
                winner += "                <div class=\"raffleEndTime\"> ENDED " + result[i][0].endTime + "<\/div>";
                winner += "                <div class=\"raffleItemImage\">";
                winner += "                    <img src=\".\/uploads\/" + result[i][0].raffleID + ".png\" class=\"upcomingImage2\"\/>";
                winner += "                <\/div>";
                winner += "                <div class=\"winnerText\">WINNER<\/div>";
                winner += "                <div class=\"winnerName\">SIMOND<\/div>";
                winner += "            <\/div>";
                $(".slider").append(winner);
            }
        }

        var slider = $('.slider').anyslider();
        var anyslider = slider.data('anyslider');
        $(".nextArrow").click(function(){
            anyslider.next();
        })
        $(".previousArrow").click(function(){
            anyslider.prev();
        })
    });
    $.post("./php/getUpcomingRaffles.php",function(response){
        var result = JSON.parse(response);
        for(var i=0;i<result.length;i++){
            if(result[i]!="") {
                var dt =new Date(result[i].endTime);
                var upcoming="";
                upcoming += " <div class=\"singleItem\">";
                upcoming += "            <div class=\"raffleItemImage\">";
                upcoming += "                <h4 class=\"endDate\">"+dt.getDate()+"."+dt.getMonth()+"."+dt.getFullYear() +"<\/h4>";
                upcoming += "                <img src=\".\/uploads\/"+result[i].raffleID+".png\" class=\"upcomingImage\"\/>";
                upcoming += "            <\/div>";
                upcoming += "            <span class=\"upcomingShoeName\">"+result[i].shoeName+"<\/span>";
                upcoming += "        <\/div>";
                $(".upcomingRaffles").append(upcoming);
            }
        }
        $(".raffleItemImage img").on({mouseenter:function(){
            $(this).closest(".raffleItemImage").children("h4.endDate").stop().animate({zIndex:"100000"},500).fadeIn(500);
        },mouseleave:function(){
            $(this).closest(".raffleItemImage").children("h4.endDate").stop().animate({zIndex:"-100000"},500).fadeOut(500);
        }});


    });
    $.post("./php/getCurrentRaffle.php",function(response){
        var result = JSON.parse(response);
        $(".raffle .raffleItemImage").html("<img src='./uploads/"+result[0].raffleID+".png' class='image'/>");
        $(".raffle .ticketPrice").html(result[0].price);
        $(".raffle .shoeName").html(result[0].shoeName);
        $(".raffle .shoeDescription").html(result[0].shoeDescription);
        $(".shoeSize").attr("data-id",result[0].raffleID);
        $(".raffleItemDescription h1").html(result[0]["shoeDescription"]);
    });
});
