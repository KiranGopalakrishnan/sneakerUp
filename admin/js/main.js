/**
 * Created by Kiran on 26-02-2017.
 */
$(document).ready(function(){
    $.post("./php/checkRaffle.php",function(response){
        //var result = JSON.parse(response);
        console.log("rafflesUpdated")
    });
    var shoeColors=[];
    var shoeColorImages=[];
    var shoeSizes=[];

    $(".addNewButton").click(function(){

        $(".shoeSizeSelected").html("");
        $(".overlay").fadeIn(500);
        $(".addNew").show();
        $(".addNew").removeClass("blurAnim");
    });
    $(".overlay").click(function(e){
        if (e.target == this) {
            $(".overlay").children().fadeOut(500);
            $(".overlay").fadeOut(500);
        }
    });
    function closePopup(){
        $(".overlay").children().fadeOut(500);
        $(".overlay").fadeOut(500);
    }
    $(".addNew form.addNewRaffle").submit(function(e){
        e.preventDefault();
        e.stopPropagation();
        var isAnEdit = $(".addNew").hasClass("edit");
        if(!isAnEdit) {

            var formdata = new FormData($(this)[0]);
            var sizesSorted=[];
            for(var i=0;i<shoeSizes.length;i++)
            {

                sizesSorted[sizesSorted.length]  = parseFloat(shoeSizes[i].substr(3,shoeSizes[i].length));
            }
            sizesSorted.sort(function(a,b) { return a - b; });
            for(var i=0;i<sizesSorted.length;i++) {
                sizesSorted[i] = "US " + sizesSorted[i];
            }
            var jsonSizes = JSON.stringify(sizesSorted);
            formdata.append("shoeSizes", jsonSizes);
            var shoeColorsJson = JSON.stringify(shoeColors);
            formdata.append("shoeColors", shoeColorsJson);
//alert(formdata);

            $(".addNewRaffle h3").html("Add New Raffle");
            $.ajax({
                url: "./php/newRaffle.php",
                type: "POST",
                data: formdata,
                mimeTypes: "multipart/form-data",
                contentType: false,
                cache: false,
                async: false,
                processData: false,
                success: function (response) {

                    alert(response);
                }
            });
        }else{
            var formdata = new FormData($(this)[0]);
            var sizesSorted=[];
            for(var i=0;i<shoeSizes.length;i++)
            {
                sizesSorted[sizesSorted.length]  = parseFloat(shoeSizes[i].substr(3,shoeSizes[i].length));
             }
            sizesSorted.sort(function(a,b) { return a - b; });
            for(var i=0;i<sizesSorted.length;i++) {
                sizesSorted[i] = "US " + sizesSorted[i];
            }
            var jsonSizes = JSON.stringify(sizesSorted);
            formdata.append("shoeSizes", jsonSizes);
            var shoeColorsJson = JSON.stringify(shoeColors);
            formdata.append("shoeColors", shoeColorsJson);
            formdata.append("action","01");
            var id = $(".addNew").attr("data-id");
            formdata.append("id",id);

//alert(formdata);
            $.ajax({
                url: "./php/adminActions.php",
                type: "POST",
                data: formdata,
                mimeTypes: "multipart/form-data",
                contentType: false,
                cache: false,
                async: false,
                processData: false,
                success: function (response) {
                    alert(response);
                }
            });
        }
    });
    $.post("./php/getUpcomingRaffles.php",function(result){
        response = JSON.parse(result);
        for(var i=0;i<response.length;i++) {
            var upcoming = "";
            upcoming += "          <div class=\"singleItem\" data-id='"+response[i].raffleID+"'>";

            if(response[i].status=="1") {
                upcoming += "                            <span class=\"raffleID greenDot\">" + response[i].raffleID + "<\/span>";
            }else{
                upcoming += "                            <span class=\"raffleID redDot\">" + response[i].raffleID + "<\/span>";
            }
            upcoming += "                            <span class=\"raffleName\">" + response[i].shoeName + "<\/span>";
            upcoming += "                            <span class=\"startDate\">" + response[i].startTime + "<\/span>";
            upcoming += "                            <span class=\"endDate\">" + response[i].endTime + "<\/span>";
            upcoming += "                        <\/div>";

            $(".upcomingItems").append(upcoming);
        }
    });
    $.post("./php/getPreviousRaffles.php",function(result){
        response = JSON.parse(result);
        for(var i=0;i<response.length;i++) {
            var previousRaffle = "";

             previousRaffle += "          <div class=\"singleItem\" data-id='"+response[i].raffleID+"'>";
            if(response[i].winnerDecided=="1") {
                previousRaffle += "                            <span class=\"raffleID greenDot\">" + response[i].raffleID + "<\/span>";
            }else{
                previousRaffle += "                            <span class=\"raffleID redDot\">" + response[i].raffleID + "<\/span>";
            }

            previousRaffle += "                            <span class=\"raffleName\">" + response[i].shoeName + "<\/span>";
             previousRaffle += "                            <span class=\"startDate\">" + response[i].startTime + "<\/span>";
             previousRaffle += "                            <span class=\"endDate\">" + response[i].endTime + "<\/span>";

             previousRaffle += "                        <\/div>";

            $(".previousItems").append( previousRaffle);
        }
    });
    /*$.post("./php/viewCurrentRaffle.php",function(response){
        result = JSON.parse(response);
        var lastwinner="";
        lastwinner += " <div class=\"lastWinnerItem\">";
        lastwinner += "                        <span class=\"raffleName\"><h3>"+result[0].shoeName+"<\/h3><\/span>";
        lastwinner += "                        <span class=\"lastRaffleEndTime\"><h5>"+result[0].endTime+"<\/h5><\/span>";
        lastwinner += "                        <span class=\"endRaffleImage\"><img src=\"..\/uploads\/"+result[0].raffleID+".png\" class=\"winnerRaffleImage\" \/><\/span>";
        lastwinner += "                    <\/div>";
        $(".viewCurrentRaffle").html(lastwinner);
    });*/
    $.post("./php/getPreviousWinners.php",function(result){
        response = JSON.parse(result);
        console.log(response);

        for(var j=0;j<response.length;j++) {
            for (var i = 0; i < response[j].length; i++) {
                var previousRaffleWinners = "";
                previousRaffleWinners += "          <div class=\"singleItem\" data-id='" + response[j][i].ticketID + "'>";
                previousRaffleWinners += "                            <span class=\"raffleID\">" + response[j][i].raffleID + "<\/span>";
                previousRaffleWinners += "                            <span class=\"raffleName\">" + response[j][i].shoeName + "<\/span>";
                previousRaffleWinners += "                            <span class=\"raffleName\">" + response[j][i].Firstname + " " + response[j][i].Lastname + "<\/span>";
                previousRaffleWinners += "                            <span class=\"startDate\">" + new moment(response[j][i].startTime).format("DD MMM YYYY ") + "<\/span>";
                previousRaffleWinners += "                            <span class=\"endDate\">" + new moment(response[j][i].endTime).format("DD MMM YYYY ") + "<\/span>";
                previousRaffleWinners += "                        <\/div>";
                $(".previousWinnerItems").append(previousRaffleWinners);
            }
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
    $("body").on("click",".upcomingRaffles .singleItem",function(e){
        e.stopPropagation();
        $(".overlay").fadeIn(500);
       var raffleID = $(this).attr("data-id");
        $(".actionsPopup.currentAndUpcomingRaffles").attr('data-id',raffleID);
       $(".actionsPopup.currentAndUpcomingRaffles").show();
       sendRequestFor = $(this).children(".actionSelect").val();
    });
    $("body").on("click",".previousWinners .singleItem",function(e){
        e.stopPropagation();
        $(".overlay").fadeIn(500);
        var raffleID = $(this).attr("data-id");
        $(".actionsPopup.winners").attr('data-id',raffleID);
        $(".actionsPopup.winners").show();
        sendRequestFor = $(this).children(".actionSelect").val();
    });
    $("body").on("click",".previousRaffles .singleItem",function(e){
        e.stopPropagation();
        $(".overlay").fadeIn(500);
        var raffleID = $(this).attr("data-id");
        $(".actionsPopup.endedRaffles").attr('data-id',raffleID);
        $(".actionsPopup.endedRaffles").show();
        sendRequestFor = $(this).children(".actionSelect").val();
    });

    $("body").on("submit",".actionForm",function(e){
        e.preventDefault();
        var action = $(this).find(".actionSelect").val();
        var id =$(this).closest(".actionsPopup").attr("data-id");
        //alert(action);
        var data=[];
        switch (action){
            case "01":
                setRaffleDataToForm(id);
                $(".addNewRaffle h3").html("Edit Raffle");
                $(".addNew").attr("data-id",id);
                $(".addNew").addClass("edit");
                $(".addNew").show();
                break;
            case "02":
                $.post("./php/adminActions.php",{id:id,action:action},function(result) {
                    alert("Done !");
                });
                    break;
            case "03":
                location.href="./php/exportToExcel.php?id="+id;
               /* $.post("./php/adminActions.php",{id:id,action:action},function(result) {
                    alert("Done !");
                });*/
                break;
            case "07":
                location.href="./php/exportNameList.php?id="+id;
                /* $.post("./php/adminActions.php",{id:id,action:action},function(result) {
                 alert("Done !");
                 });*/
                break;
            case "04":
                $(".winnerForm").attr("data-id",id);
                $(".enterWinner").fadeIn(500);
                break;
            case "05":
                $.post("./php/adminActions.php",{id:id,action:action},function(result) {
                    alert("Done !");
                });
                break;
            case "06":
                setWinnerDataToForm(id);
                $(".winnerChangeForm").attr("data-id",id);
                $(".changeWinner").find(".winnerChangeForm .ticketid").val(id);
                $(".changeWinner").fadeIn(500);
                break;
        }

    });
function setRaffleDataToForm(id){
    $.post("./php/getRaffle.php",{id:id},function(response) {
        var result = JSON.parse(response);
        $(".addNewRaffle .shoeName").val(result[0].shoeName);
        $(".addNewRaffle .shoeDescription").val(result[0].shoeDescription);
        $(".addNewRaffle .rafflePrice").val(result[0].price);
        $(".addNewRaffle .startTime").val(moment(result[0].startTime).format("YYYY-MM-DDTHH:mm"));
        $(".addNewRaffle .endTime").val(moment(result[0].endTime).format("YYYY-MM-DDTHH:mm"));
        //alert(moment(result[0].endTime).format("YYYY-MM-DDTHH:mm"));

        $(".shoeSizeSelected").html("");
        $.post("./php/getDependantAttributes.php",{raffleID:id},function(response){
            var result = JSON.parse(response);
            shoeSizes.length=0;
            shoeColors.length=0;
            var colors = result["colors"];
            var sizes = result["sizes"];
            $(".colorsSelected").html("");
            $(".shoeSizeSelected").html("");
            for(var i=0;i<sizes.length;i++){
                shoeSizes[shoeSizes.length] = sizes[i].sizeValue;
                $(".shoeSizeSelected").append("<span data-id='" + sizes[i].sizeValue + "' class='sizeSelected'><span class='selectedText'>" +  sizes[i].sizeValue + "</span><span class='deselect'>X</span></span>")
            }
            for(var i=0;i<colors.length;i++){

                var data = {colorID:colors[i].colorID,name: colors[i].Name,imageIncluded:false,active:true};
                shoeColors[shoeColors.length] = data;
                $(".colorsSelected").append("<span data-id='" + colors[i].Name+ "' class='colorSelected' style='background: #FFF !important;border:solid 1px #666 !important; color: #666 !important;'><span class='selectedText'>" + colors[i].Name + "</span></span>")
            }
            //console.log(shoeSizes);
        });
    });
    }
    function setWinnerDataToForm(ticketID){
    $(".winnerChangeForm").removeClass("imageExists");
        $.post("./php/getWinnerData.php",{ticketID:ticketID},function(response) {
            result = JSON.parse(response);
            $(".winnerChangeForm .instagram").val(result[0].instagramLink);
            $(".winnerChangeForm .location").val(result[0].Location);
            if(result[0].isImagePresent==1) {
                $(".winnerChangeForm").addClass("imageExists");
            }
        });
    }
$(".enterWinner .winnerForm").submit(function(e){
   e.preventDefault();
   var id = $(".winnerForm").attr("data-id");
    var formdata = new FormData($(this)[0]);
    formdata.append("action","04");
    formdata.append("id",id);
    var isEdit = $(".winnerForm").hasClass("edit");
    formdata.append("isEdit",isEdit);
    $.ajax({
        url: "./php/adminActions.php",
        type: "POST",
        data: formdata,
        mimeTypes: "multipart/form-data",
        contentType: false,
        cache: false,
        async: false,
        processData: false,
        success: function (response) {

            alert("Done !");
            closePopup();

        }
    });
});
    $(".changeWinner .winnerChangeForm").submit(function(e){
        e.preventDefault();
        var id = $(".winnerChangeForm").attr("data-id");
        if(id!=null) {
            var formdata = new FormData($(this)[0]);
            formdata.append("action", "06");
            formdata.append("id", id);
            var imageExists = $(".winnerChangeForm").hasClass("imageExists");
            var isEdit = $(".winnerChangeForm").hasClass("edit");
            $(".winnerChangeForm").hasClass("edit");
            alert(imageExists);
            formdata.append("isEdit", isEdit);
            formdata.append("imageExists", imageExists);
            var ticketID = $(".changeWinner").find(".winnerChangeForm .ticketid").val();
            formdata.append("ticketID", ticketID);
            $.ajax({
                url: "./php/adminActions.php",
                type: "POST",
                data: formdata,
                mimeTypes: "multipart/form-data",
                contentType: false,
                cache: false,
                async: false,
                processData: false,
                success: function (response) {
                    alert("Done !");
                    closePopup();
                }
            });
        }else{
            alert("An Error Occured");
        }
    });
    var image,name,colorCode;
    var i=0;
    $("body").on("click",".colorSelecter",function (e){
        $(".colorName").focus();
        var colorSelected = "color"+shoeColors.length;
        colorCode = colorSelected;
        $(".addNewRaffle").append("<input type='file' class='colorFile "+colorCode+"' name='"+colorCode+"' style='visibility: hidden;' />");
        $("."+colorCode).click();

    });
    $("body").on("change",".colorFile",function(e){
        var file =  $(this).val();
        image = file;
       $(".addNew").addClass("blurAnim");
       $(".enterColorName").fadeIn(500);
    });
$(".colorNameForm").submit(function(e){
    name = $(this).find(".colorName").val();
    e.preventDefault();
    $(".addNew").removeClass("blurAnim");
    if(name.length>0) {
        var data = {name: name,imageIncluded:true,active:true};
        shoeColors[shoeColors.length] = data;
    }else{
        alert("An Error Occured");
    }
    $(this).closest(".enterColorName").hide();
        $(".colorsSelected").append("<span data-id='" + name+ "' class='colorSelected' style='background: #FFF !important;border:solid 1px #666 !important; color: #666 !important;'><span class='selectedText'>" + name + "</span></span>")
    i=0;
});
$("body").on("click",".colorSelected",function(){
    var colorName = $(this).attr("data-id");
        for(var i=0;i<shoeColors.length;i++){
            if(shoeColors[i].name==colorName){
                shoeColors[i].active = false;
                alert("removed");
                $(this).remove();
            }
        }
    });
});
