<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Employee List</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 mt-3 mb-3">
				<h3 class="text-center">Employee List
					<a href="<?=base_url('index.php/home/employee_from')?>" class="btn btn-primary" style="float: right;">Add Employee</a>
				</h3>
			</div>

			<div class="col-md-12 mt-3 mb-3">
				<div class="col-md-6">
					<input type="text" name="daterange" class="form-control" value="01/01/2018 - 01/15/2018" />
				</div>
			</div>

			<div class="col-md-12">
				<table id="employee_tbl" class="display" style="width:100%">
			        <thead>
			            <tr>
			                <th>Employee Code</th>
			                <th>Profile Image</th>
			                <th>Full Name</th>
			                <th>Joining Date</th>
			            </tr>
			        </thead>
			        <tbody>
			        </tbody>
			    </table>
			</div>
		</div>		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

		<!-- date range picker -->
		<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	</div>
	<script type="text/javascript">		
		$(document).ready(function () {
		    $('#employee_tbl').DataTable({
	          'processing': true,
	          'serverSide': true,
	          'serverMethod': 'post',
	          'ajax': {
	             'url':'<?=base_url()?>index.php/home/employee_list'
	          },
	          'columns': [
	             { data: 'emp_code' },
	             { data: 'profile_img' },
	             { data: 'full_name' },
	             { data: 'joining_date' },
	          ]
	        });

	        $('input[name="daterange"]').daterangepicker({
			    opens: 'left'
			  }, function(start, end, label) {
			    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			});
		});
	</script>
</body>
</html>
