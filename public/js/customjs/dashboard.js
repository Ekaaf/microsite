var url = (window.location.pathname).split('/');
$(function(){
  $(document).ready(function() {
    getpersons();
  });
});

function getpersons(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var table= $('#personTable').DataTable( {
        "processing": true,
        "lengthMenu": [ [5, 10, 25, 50, -1], [5 ,10, 25, 50, "All"] ],
        "pageLength": 10,
        // dom: 'Blfrtip',
        // buttons: [
        //     'csv', 'excel', 'pdf', 'print'
        // ],
        // "language": {
        //     "processing": "Hang on. Waiting for response... <img src=\"loader.png\" />" //add a loading image,simply putting <img src="loader.gif" /> tag.
        // },
        "serverSide": true,
        "destroy" :true,
        "ajax": {
                    "url": './getpersons',
                    "data": function ( d ) {
                        // d.from_date = $('#from_date').val();
                        // d.to_date = $('#to_date').val();
                        // d.store_code = $('#store_code').val();
                        // d.store_name = $('#store_name').val();
                        // d.plot_no = $('#plot_no').val();
                        // d.mobilenumber = $('#mobilenumber').val();
                        // d.town_id = $('#town_id').val();
                        // d.zone_id = $('#zone_id').val();
                        // d.territorry_id = $('#territorry_id').val();
                        // d.oral_care = $('#oral_care').val();

                        // d.within_coverage = $('#within_coverage').val();
                        // d.oral_care_availability = $('#oral_care_availability').val();
                        // d.sensetive_expert_professional = $('#sensetive_expert_professional').val();
                        // d.sensetive_expert_gumcare = $('#sensetive_expert_gumcare').val();
                        // d.sensetive_expert_fresh = $('#sensetive_expert_fresh').val();
                        // d.pepsodant = $('#pepsodant').val();
                        // d.mediplus = $('#mediplus').val();
                        
                    },
                },
        "columns": [
            { "data": "0" },
            { "data": "name" },
            { "data": "mobile" }
            // { "data": "id",
            //   "render": function ( data, type, full, meta ) {
            //     return "<a href=\""+data+"/edit\"><button class=\"btn btn-success btn\"><i class=\"fa fa-pencil\"></i></button></a>"+
            //              "<button onclick=\"deletedoctor('"+data+"');\" class=\"btn btn-danger btn delete_news\"><i class=\"fa fa-trash-o\"></i></button"
            //   }
            // }
        ]


  });


}


function deletedoctor(id){

    var txt;
    var r = confirm("Are you sure want to delete ?");
    if (r == true) {
        $.ajax({
            type: 'get',
            url: '../doctor/delete/'+id,
            data: {
              id : id
            },
            dataType: 'text',
        })
        .done(function (data) {
          
          alert("Successfully deleted.")
          getdoctors();
          
        });
    }
}
