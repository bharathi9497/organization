<!DOCTYPE html>
<html>
<head>
    <title>Organization task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>


<div class="container">
   
    <div class="form-group">
         <form name="add_name" id="add_name">  


            <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
            </div>


            <div class="alert alert-success print-success-msg" style="display:none">
            <ul></ul>
            </div>

            <div class="container"> Organization *
            <input type="text" name="name" placeholder="Enter your Organization Name" class="form-control name_list" />
            </div>
            <br/>
            <div>
            <h3>Users based on the organization</h3>
            </div>
            <br/>




            <div class="table-responsive">  
                <table class="table table-bordered" id="dynamic_field">  
                <td>Users</td>
                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td> 
                <tr>
                <th>Name *</th>
                <th>Email *</th>
                <th>Mobile number * </th>
                <th>Address </th>
                </tr>

                    <tr>  
                        <td><input type="text" name="user[0][name]" placeholder="Enter your Name" class="form-control name_list" /></td>  

                        <td><input type="text" name="user[0][email]" placeholder="Enter your email" class="form-control name_list" /></td>                 
                     
                        <td><input type="text" name="user[0][mobile_number]" placeholder="Enter your mobile number" class="form-control name_list" /></td>                   
                  
                        <td><input type="text" name="user[0][address]" placeholder="Enter your address" class="form-control name_list" /></td>                   
                    </tr>   
                </table>  
                <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  
            </div>


         </form>  
    </div> 
</div>


<script type="text/javascript">
    $(document).ready(function(){      
      var postURL = "<?php echo url('users'); ?>";
      var i=0;  


      $('#add').click(function(){  
           i++; 
           $('#dynamic_field').append('<tr  id="row'+i+'" class="dynamic-added"><td><input type="text" name="user['+i+'][name]" placeholder="Enter your Name" class="form-control name_list" /></td><td><input type="text" name="user['+i+'][email]" placeholder="Enter your email" class="form-control name_list" /></td> <td><input type="text" name="user['+i+'][mobile_number]" placeholder="Enter your mobile number" class="form-control name_list" /></td><td><input type="text" name="user['+i+'][address]" placeholder="Enter your address" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $('#submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#add_name').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                        i=0;
                        $('.dynamic-added').remove();
                        $('#add_name')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display','block');
                        $(".print-error-msg").css('display','none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                    }
                }  
           });  
      });  


      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });  
</script>
</body>
</html>