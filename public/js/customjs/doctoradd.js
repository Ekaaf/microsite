if($('#i').length>0){
    var i = $("#i").val();
}
else{
    var i = 2;
}

$(function(){
  $(document).ready(function() {
    $("#addUniqueID").click(function(){
        $("#uniqueIdDiv").append("<br>");
        $('#start_range1').clone().prop("id", "start_range"+i).appendTo("#uniqueIdDiv");
        $("#start_range"+i).val("");
        $('#end_range1').clone().prop("id", "end_range"+i).appendTo("#uniqueIdDiv");
        $("#end_range"+i).val("");
        $('#end_range'+i).addClass('ml-2');
        i++;
    });
  });
});


