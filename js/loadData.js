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
                winner += "                <div class=\"raffleEndTime\"> Ended " + formatDate(new Date(moment(result[i][0].endTime).format('MM/DD/YYYY'))) + "<\/div>";
                winner += "                <div class=\"raffleItemImage\">";
                if(result[i][0].isImagePresent==true) {
                    winner += "                    <img src=\".\/uploads\/winnersImages/" + result[i][0].ticketID + ".png\" class=\"upcomingImage2\"\/>";
                }else{
                    winner += "                    <img src=\".\/uploads\/" + result[i][0].raffleID + ".png\" class=\"upcomingImage2\"\/>";
                }
                winner += "                <\/div>";
                winner += "                <div class=\"winnerText\">WINNER<\/div>";
                if(result[i][0].instagramLink) {
                    winner += "                <div class=\"winnerName\"><a href='" + result[i][0].instagramLink + "' target='_blank'>" + result[i][0].Firstname.toUpperCase()+" "+result[i][0].Lastname.substr(0,1).toUpperCase() + "</a><\/div>";
                }else{
                    winner += "                <div class=\"winnerName\">" + result[i][0].Firstname.toUpperCase()+" "+result[i][0].Lastname.substr(0,1).toUpperCase() + "<\/div>";
                }
                if(result[i][0].Location) {
                    winner += "                <div class=\"winnerLoc\"><img src='./images/marker.png' height='20' /> &nbsp;<span>" + result[i][0].Location + "</span><\/div>";
                }
                winner += "            <\/div>";
                $(".slider").append(winner);
                console.log(moment(result[i][0].endTime).format('MM/DD/YYYY'));
            }
        }

        String.prototype.replaceAll = function(search, replacement) {
            var target = this;
            return target.replace(new RegExp(search, 'g'), replacement);
        };
        var slider = $('.slider').anyslider();
        var anyslider = slider.data('anyslider');
        $(".nextArrow").click(function(){
            anyslider.next();
        })
        $(".previousArrow").click(function(){
            anyslider.prev();
        })
    });
    function formatDate(date) {
        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();

        return  monthNames[monthIndex] +' ' + day +  ' ' + year;
    }
    $.post("./php/getUpcomingRaffles.php",function(response){
        var result = JSON.parse(response);
        for(var i=0;i<result.length;i++){
            if(result[i]!="") {
                var dt =new moment(result[i].endTime).format("DD.MM.YYYY");
                var upcoming="";
                upcoming += " <div class=\"singleItem\">";
                upcoming += "            <div class=\"raffleItemImage\">";
                upcoming += "                <h4 class=\"endDate\">"+dt.toString()+"<\/h4>";
                upcoming += "                <img src=\".\/uploads\/"+result[i].raffleID+".png\" class=\"upcomingImage\"\/>";
                upcoming += "            <\/div>";
                upcoming += "            <span class=\"upcomingShoeName\"><mark>"+result[i].shoeName+"</mark><\/span>";
                upcoming += "        <\/div>";
                $(".upcomingRaffles").append(upcoming);
            }
        }
        $(".raffleItemImage img").on({mouseenter:function(){
            $(this).closest(".raffleItemImage").children("h4.endDate").stop().animate({zIndex:"100000"},500).fadeIn(500);
        },mouseleave:function(){
            $(this).closest(".raffleItemImage").children("h4.endDate").stop().fadeOut(300);
        }});


    });
    
    var raffleID = $(".shoeSize").attr("data-id");
    $.post("./php/getCurrentRaffle.php",function(response){
        var result = JSON.parse(response);
        if(!result.length>1) {
            $(".nextRaffle").hide();
        }
       for(var i=0;i<result.length;i++) {

           var raffle = "";
           raffle += "<div class=\"raffle\">";
           raffle += "         <div class=\"firstHalf\">";
           raffle += "            <div class=\"raffleItem\">";
           raffle += "                <div class=\"liveTextAnimation\">";
           raffle += "                    <h1><span class=\"liveText\">LIVE<\/span><span class=\"liveDot\">.<\/span><\/h1>";
           raffle += "                <\/div>";
           raffle += "                <div class=\"ticketInfoContainer\">";
           raffle += "                    <div class=\"centeringParent\">";
           raffle += "                        <h1 class=\"dollarSign\">$<\/h1>";
           raffle += "                        <h1 class=\"ticketPrice\">" + result[i].price + "<\/h1>";
           raffle += "                        <h1 class=\"infoText\">PER<\/br>TICKET<\/h1>";
           raffle += "                    <\/div>";
           raffle += "                <\/div>";
           raffle += "                <div class=\"raffleItemImage\">";
           if(result[i]["colors"].length>0) {
               raffle += "                    <img src='./uploads/" + result[i]["colors"][0].colorID + ".png' class=\"image\"\/>";
           }else{
               raffle += "                    <img src='./uploads/test-raffle.png' class=\"image\"\/>";
           }
           raffle += "                <\/div>";
           raffle += "            <\/div>";
           raffle += "         <\/div><div class=\"raffleItemDescription\">";
           raffle += "         <h1>";
           raffle += "             <p>" + result[i].shoeDescription + "<\/p>";
           raffle += "             <br\/>";
           raffle += "";
           raffle += "             <input type=\"button\" class=\"enterNowButton2\" value=\"ENTER NOW\" \/>";
           raffle += "         <\/h1>";
           raffle += "         <\/div><div class=\"secondHalf\">";
           raffle += "             <div class=\"raffleItem enterIntoRaffle\">";
           raffle += "";
           raffle += "                 <div class=\"expander\">";
           raffle += "                     <img src=\".\/images\/expander-white.png\" class=\"expanderImage\" \/>";
           raffle += "                 <\/div>";
           raffle += "                <div class=\"entryInputBoxes\">";
           raffle += "                    <h1 class=\"shoeName\">" + result[i].shoeName + "<\/h1>";
           raffle += "                    <div class=\"inputBoxes\">";

           raffle += "                        <label>SHOE SIZE<\/label><select  data-id='" + result[i].raffleID + "' class=\"shoeSize selectpicker\" required>";
           raffleID = result[i].raffleID;
           var sizes = result[i]["sizes"];
               for (var j = 0; j < sizes.length; j++) {
                   raffle += "<option value='" + sizes[j].sizeValue + "'>" + sizes[j].sizeValue + "</option>";
               }
           raffle += "                    <\/select><br\/>";
           raffle += "                        <label>SHOE COLOR<\/label><select data-id='" + result[0].raffleID + "'  class=\"shoeColor selectpicker\" required>";
             var colors = result[i]["colors"];
               for (var j = 0; j < colors.length; j++) {
                   raffle += "<option value='" + colors[j].colorID + "'>" + colors[j].Name + "</option>";
               }
           raffle += "                      ";
           raffle += "                    <\/select><br\/>";
           raffle += "";
           raffle += "                        <label>TICKETS<\/label><input type=\"number\" min=\"1\" value=\"1\" class=\"tickets\" required\/>";
           raffle += "                        <br\/>";
           raffle += "                        <input type=\"button\" data-id='" + result[i].raffleID + "' class=\"paypal-button\" class=\"enterNowButton\" value=\"ENTER NOW\" \/>";
           raffle += "                    <\/div>";
           raffle += "                <\/div>";
           raffle += "             <\/div>";
           raffle += "         <\/div>";
           raffle += ""


           $(".raffle-page .sliderRaffles").append(raffle);
           $('select').selectpicker('refresh');
       }

//        $(".raffle .raffleItemImage").html("<img src='./uploads/"+result[0].raffleID+".png' class='image'/>");
       // $(".raffle .ticketPrice").html(result[0].price);
        //$(".raffle .shoeName").html(result[0].shoeName);
      //  $(".shoeSize").attr("data-id",result[0].raffleID);
        //$(".raffleItemDescription h1 p").html(result[0].shoeDescription);
        var slider1 = $('.sliderRaffles').anyslider();
        var anyslider = slider1.data('anyslider');
        anyslider.pause();
        $(".nextRaffle").click(function(){
           anyslider.next();
        });
    });
    //alerts(raffleID);

});
