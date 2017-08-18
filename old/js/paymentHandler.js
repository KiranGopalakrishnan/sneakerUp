/**
 * Created by Kiran on 26-02-2017.
 */
$(document).ready(function(e){
   $.post("./php/clientToken.php",function(response){
        console.log(response);
   })
});