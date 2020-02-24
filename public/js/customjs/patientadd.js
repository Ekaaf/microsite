$(function(){
  $(document).ready(function() {
    $("#unique_id").focusout(function(){
      checkUniqueID();
    });
  });
});


function checkUniqueID(){

  $.ajax({
      type: 'get',
      url: '/smile_admin/admin/patient/checkUniqueID',
      data: {
        unique_id : $("#unique_id").val()
      },
      dataType: 'json',
  })
  .done(function (data) {
    console.log(data);
    $("#assigned_chamber").val(data.data.chamber_name)
  })
  .fail(function (error) {
    console.log(error.responseJSON.error)
    $("#errordiv").text(error.responseJSON.error);
    $("#errordiv").show();
    });
    
}