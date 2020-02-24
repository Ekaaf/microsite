$(document).ready(function(){
	$("#imageChange").click(function(){
        $("#previewImage").hide();
        $("#imageChange").hide();
        $("#photo_link").show();
    });
});

function showCaptured() {
    
    var photo_link = $("#photo_link").val();
    if(photo_link){
        var reader = new FileReader();
        reader.readAsDataURL($('#photo_link').prop('files')[0]);
        reader.onload = function () {
            var uploadedImage = new Image();
            uploadedImage.onload = function() {
            };
            $("#previewImage").attr("src",reader.result)
            uploadedImage.src = reader.result; 
            $("#previewImage").show();
            $("#imageChange").show();
            $("#photo_link").hide();
        };
    }
    else{
        this.captured = ""
        $("#previewImage").attr("src","")
        $("#previewImage").hide();
        $("#imageChange").hide();
        $("#photo_link").show();
    }
}

function showSelect(){
    var type = $("#type").val();
    if(type==2){
        $("#zoneDiv").hide();
        $("#territorryDiv").show();
    }
    else if(type==4){
        $("#zoneDiv").show();
        $("#territorryDiv").hide();
    }
    else{
        $("#zoneDiv").hide();
        $("#territorryDiv").hide();
    }
}
