/**
 * Created by Kiran on 26-02-2017.
 */
$(document).ready(function(){
    $.post("./php/checkRaffle.php",function(response){
        //var result = JSON.parse(response);
        console.log("rafflesUpdated")
    });

    var shoeSizes=[];

    $(".addNewButton").click(function(){
        $(".addNew").show();
    });
    $("form.addNewRaffle").submit(function(e){
        e.preventDefault();
        var formdata = new FormData($(this)[0]);
        var jsonSizes = JSON.stringify(shoeSizes);
        formdata.append("shoeSizes",jsonSizes);
//alert(formdata);
        $.ajax({
            url: "./php/newRaffle.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            async: false,
            processData: false,
            success: function(response) {

                alert(response);
            }
            });
    });
    $.post("./php/getUpcomingRaffles.php",function(result){
        response = JSON.parse(result);
        for(var i=0;i<response.length;i++) {
            var upcoming = "";
            upcoming += "          <div class=\"singleItem\">";
            upcoming += "                            <span class=\"raffleName\">" + response[i].shoeName + "<\/span>";
            upcoming += "                            <span class=\"startDate\">" + response[i].startTime + "<\/span>";
            upcoming += "                            <span class=\"endDate\">" + response[i].endTime + "<\/span>";
            if(response[i].status=="1") {
                upcoming += "                            <span class=\"activeNow\"><div class=\"greenDot\"><\/div><\/span>";
            }else{
                upcoming += "                            <span class=\"activeNow\"><\/span>";
            }
            upcoming += "                        <\/div>";

            $(".upcomingItems").append(upcoming);
        }
    });
    $.post("./php/viewCurrentRaffle.php",function(response){
        result = JSON.parse(response);
        var lastwinner="";
        lastwinner += " <div class=\"lastWinnerItem\">";
        lastwinner += "                        <span class=\"raffleName\"><h3>"+result[0].shoeName+"<\/h3><\/span>";
        lastwinner += "                        <span class=\"lastRaffleEndTime\"><h5>"+result[0].endTime+"<\/h5><\/span>";
        lastwinner += "                        <span class=\"endRaffleImage\"><img src=\"..\/uploads\/"+result[0].raffleID+".png\" class=\"winnerRaffleImage\" \/><\/span>";
        lastwinner += "                    <\/div>";
        $(".viewCurrentRaffle").html(lastwinner);
    });
    $.post("./php/getLastWinner.php",function(response){
        result= JSON.parse(response);
        if(result!="") {
            var lastwinner = "";
            lastwinner += " <div class=\"lastWinnerItem\">";
            lastwinner += "                        <span class=\"raffleName\"><h3>" + result[0].shoeName + "<\/h3><\/span>";
            lastwinner += "                        <span class=\"lastRaffleEndTime\"><h5>" + result[0].endTime + "<\/h5><\/span>";
            lastwinner += "                        <span class=\"endRaffleImage\"><img src=\"..\/uploads\/" + result[0].raffleID + ".png\" class=\"winnerRaffleImage\" \/><\/span>";
            lastwinner += "                        <span class=\"winnerName\"><h3>" + result[0].buyerName + "<\/h3><\/span>";
            lastwinner += "                       <span class=\"emailName\"><h4>" + result[0].buyerEmail + "<\/h4><\/span>";
            lastwinner += "                    <\/div>";
            $(".viewLastWinner").html(lastwinner);
        }

    });
    $(".closePopup").click(function(){
       $(".addNew").hide();
    });
    $(".shoeSizeSelecter").change(function(e){

        var selectedSize = $(this).val();

        if(!isInArray(selectedSize,shoeSizes)) {
            shoeSizes[shoeSizes.length] = selectedSize;
            $(".shoeSizeSelected").append("<span data-id='" + selectedSize + "' class='sizeSelected'><span class='selectedText'>" + selectedSize + "</span><span class='deselect'>X</span></span>")
        }
        });
    $("body").on("click",".deselect",function(){
        var deselectedValue = $(this).closest(".sizeSelected").attr('data-id');
        var index = shoeSizes.indexOf(deselectedValue);
        $(this).closest(".sizeSelected").hide();
        //alert("sadd");
        if (index > -1) {
            shoeSizes.splice(index, 1);
        }
        console.log(shoeSizes);
    });
    function isInArray(value, array) {
        return array.indexOf(value) > -1;
    }
});
