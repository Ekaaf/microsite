$(document).ready(function(){
	getUsers();
});


function getUsers(){
    $('#usertable').DataTable({
        "processing": true,
        // "language": {
        //     "processing": "Hang on. Waiting for response... <img src=\"loader.png\" />" //add a loading image,simply putting <img src="loader.gif" /> tag.
        // },
        "serverSide": true,
        "destroy" :true,
        "ajax": {
            url: "getusers",
        },
       "columns": [
            { "data": "0" },
            { "data": "name" },
            { "data": "email" },
            { "data": "type",
              "render": function ( data, type, full, meta ) {
                    if(data==1){
                        return 'Admin';
                    }
                    else if(data==2){
                        return 'Brand Promoter';
                    }
                    else if(data==3){
                        return 'SuperVisor';
                    }
                }
            },
            // { "data": "id" },
            { "data": "id",
              "render": function ( data, type, full, meta ) {
                return "<a href=\""+data+"/edit\"><button class=\"btn btn-success btn\"><i class=\"fa fa-pencil\"></i></button></a>"+
                         "<button onclick=\"deleteuser('"+data+"');\" class=\"btn btn-danger btn ml-2 delete_news\"><i class=\"fa fa-trash-o\"></i></button"
              }
            }

        ]
    });
}


function deleteuser(id){

    var txt;
    var r = confirm("Are you sure want to delete ?");
    if (r == true) {
        $.ajax({
            type: 'get',
            url: 'delete/'+id,
            data: {
              id : id
            },
            dataType: 'text',
        })
        .done(function (data) {
          
          alert("Successfully deleted.")
          getUsers();
          
        });
    }
}