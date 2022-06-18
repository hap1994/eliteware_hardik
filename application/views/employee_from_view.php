<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Employee</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<di class="col-md-12 mt-3 mb-3">
				<h3 class="text-center">Add Employee
					<a href="<?=base_url('index.php/home')?>" class="btn btn-primary" style="float: right;">Employee List</a>
				</h3>
			</div>			
			
			<div class="col-md-12">
				<form class="row g-3" id="emp_from" action="<?=base_url('index.php/home/employee_submit')?>" method="post" enctype="multipart/form-data">
					<div class="col-md-4">
					    <label for="Employee Code" class="form-label">Employee Code</label>
					    <input type="text" readonly class="form-control" id="emp_code" name="emp_code" value="<?=$employeeId?>">
					</div>
					<div class="col-md-4">
						<label for="First name" class="form-label">First name</label>
					    <input type="text" class="form-control" id="first_name" name="first_name">
					</div>				  
				  	<div class="col-md-4">
				    	<label for="Last name" class="form-label">Last name</label>
				    	<input type="text" class="form-control" id="last_name" name="last_name">
				   	</div>
				  	<div class="col-md-4">
				    	<label for="Last name" class="form-label">Joining Date</label>
				    	<input type="date" class="form-control" id="joining_date" name="joining_date">
				   	</div>
					<div class="col-md-4">
				    	<label for="Last name" class="form-label">Profile Image</label>
				    	<input type="file" class="form-control" id="profile_img" name="profile_img">
				   	</div>  
					<div class="col-12">
				    	<button class="btn btn-primary" type="submit">Submit</button>
				  	</div>
				</form>
			</div>
		</div>		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	</div>
	<script type="text/javascript">
	    $(document).ready(function(){
	        $('#emp_from').submit(function(e){
	        	e.preventDefault(); 
				$.ajax({
					url:'<?php echo base_url();?>index.php/home/employee_submit',
					type:"post",
					data:new FormData(this),
					processData:false,
					contentType:false,
					cache:false,
					async:false,
					success: function(data){
						alert(data);
						var myObj = $.parseJSON(data);
						//alert(myObj.result);
						if(myObj.result==false) {
						 	alert(myObj.error);
						} else {
							window.location = '<?=base_url('index.php/home')?>';
						}
					}
				});
	        });
	    });
	</script>
</body>
</html>
