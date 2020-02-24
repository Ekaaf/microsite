<!DOCTYPE html>
<html lang="en" >
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/png"  href="assets/images/logo_1.jpg">
    <!-- fontawesome  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="/assets/css/select2.css" rel="stylesheet" />
    <!-- <link rel="icon" type="image/png" href="assets/images/logo_1.jpg" sizes="192x192"> -->
    <title>Microsite</title>
  </head>
  <body style="background-color: #2B2A6D;">
    <!-- .site-wrapper -->
    <div class="site-wrapper">
    	div class="login-div">
        <div class="row pt-4">
            <div class="col-5">
                <img class="pl-2 img-fluid" src="{{URL::to('public/images/pic1.png')}}">
            </div>
            <div class="col-7" style="text-align: right;">
                <img class="img-fluid pr-2" src="{{URL::to('public/images/pic2.png')}}">
            </div>
        </div>

        <div class="row pt-5" style="justify-content: center;">
            <img class="img-fluid" src="{{URL::to('public/images/pic3.png')}}">
        </div>

        <div class="row no-gutter pt-5 ml-1 mr-1" style="justify-content: center;">
            <div style="width: 30%;text-align: right;color: white;margin-right: 5px;">নাম: </div>
            <div style="width: 65%;text-align: left;color: white;margin-right: 5px;">
                <input type="text" class="form-input" name="name" id="name" required>
            </div>
        </div>

        <div class="row no-gutter pt-4 ml-1 mr-1" style="justify-content: center;">
            <div style="width: 30%;text-align: right;color: white;margin-right: 5px;">মোবাইল : </div>
            <div style="width: 65%;text-align: left;color: white;margin-right: 5px;">
                <input type="number" class="form-input" name="name" id="mobile" required>
            </div>
        </div>

        <div class="row ml-5 mr-5 mt-5" style="color: white;">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
              <label class="form-check-label" for="defaultCheck1">
                আমি সম্মতি দিচ্ছি আমার বয়স ১৮ বা তার ঊর্ধ্বে এবং আমি ইউনিলিভার বাংলাদেশ এবং তার সাথে সম্পৃক্ত তৃতীয় পক্ষদের, আমার ব্যক্তিগত তথ্য ব্যবহার, সংরক্ষণ এবং প্রক্রিয়াকরণ এবং ভবিষ্যতে আমার সাথে যোগাযোগ করার অনুমতি দিচ্ছি 
              </label>
            </div>
            
        </div>

        <div class="row mt-4" style="justify-content: center;">
            <button type="button" class="btn btn-light" onclick="save();">Submit</button>
        </div>

        <div class="row pt-5" style="justify-content: center;">
            <img class="img-fluid" src="{{URL::to('public/images/pic4.png')}}">
        </div>

        <div class="pl-4 pt-2 pb-2" style="background: white;width: 100%;position: fixed;bottom: 0;">
            <img class="img-fluid" src="{{URL::to('public/images/bottom1.png')}}">
            <img class="img-fluid" src="{{URL::to('public/images/bottom2.png')}}">
        </div>
    </div>
      
    </div>

    <!-- JavaScripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/select2.js"></script>

    <style>
    input[type="text"]
    {
        border: 0;
        border-bottom: 1px solid blue;
        outline: 0;
    }

    input[type="password"]
    
    .login-div{
        display:flex;
        height:100%;
        background: #2B2A6D;
    }

    .form-input {
        border: 0.7px solid #262C64;
        box-sizing: border-box;
        border-radius: 20px;
        width: 75%;
        margin-top: -1%;
        padding-left: 5px;
        background: white;
        height: 33px;
   }
    ::-webkit-input-placeholder {
        margin-left: 5%;
        color: black;
    }
    :-moz-placeholder { /* Firefox 18- */
        color: black;
    }
    ::-moz-placeholder {  /* Firefox 19+ */
        color: black;
    }
    :-ms-input-placeholder {
        color: black;
    }
</style>
<script type="text/javascript">
	function save(){
		name = $("#name").val();
		if(name==""){
			alert("Please enter name");
			return false;
		}

		mobile = $("#mobile").val();
		if(mobile==""){
			alert("Please enter mobile number");
			return false;
		}

		if($('#defaultCheck1').prop('checked')) {
            // something when checked
        } else {
            alert("Please agree to terms and conditions.");
            return false
        }
		  $.ajax({
		  	headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
		      type: 'post',
		      url: './save',
		      data: {
		        name : name,
		        mobile : mobile
		      },
		      dataType: 'text',
		  })
		  .done(function (data) {
		  	if(data=="success"){
		  		alert("Submitted successfully");
		  		$("#name").val("");
		  		$("#mobile").val("");
		  	}
		  })
		  .fail(function (error) {
		    console.log(error.responseJSON.error)
	      });
		    
		}
</script>
  </body>
</html>