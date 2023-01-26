<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Members Data</title>
		<style>
			.error{
				color: red;
			}
		</style>
  </head>
  <body>
    
		<div class="container text-center">
			<h1 class="text-center mt-5">Members Data</h1>
			<p class="text-center text-success" id="res_message"></p>
				<table class="table table-bordered mt-5">
						<thead>
							<tr>
								<th scope="row">Parents</th>
								<?php foreach($parents as $parent) { ?>
								<th scope="col"><?= $parent['parent_name']?></th>
								<?php } ?>
							</tr>
						</thead>
						<tbody id="child">
							<tr>
								<th class="text-center" scope="row">Childs</th>
								<td id="one"></td>
								<td id="two"></td>
								<td id="three"></td>
								<td id="four"></td>
								<td id="five"></td>
							</tr>
						</tbody>
				</table>
			<a href="#" class="btn btn-primary" id="add_member" data-bs-toggle="modal" data-bs-target="#memberModal">Add Member</a>
		</div>

		<!--Add Member Modal -->
			<div class="modal fade" id="memberModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Add New Member here</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form id="members_form">
									<div class="mb-3">
										<label class="form-label">Parents</label>
										<select class="form-select" name="parent">
											<option value="" selected>--Select Parent here--</option>
											<?php foreach($parents as $parent) { ?>
												<option value="<?= $parent['parent_id']?>"><?= $parent['parent_name']?></option>
											<?php } ?>
										</select>
									</div>
									<div class="mb-3">
										<label class="form-label">Name</label>
										<input type="text" class="form-control" name="m_name" placeholder="Add member name here">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
									<button class="btn btn-primary" id="save_member">Add Member</button>
								</div>
						</form>
					</div>
				</div>
			</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
		<script> var _base_url = "<?= base_url()?>";</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
		<script>

			$(document).ready(function(){
				loadData();
				$('#save_member').on('click', function(){

					jQuery.validator.addMethod("lettersonly", function(value, element) {
						return this.optional(element) || /^[a-z\s]+$/i.test(value);
					}, "Only alphabetical characters");

					$('#members_form').validate({
							rules:{
								parent:{
									required:true
								},
								m_name:{
									required:true,
									lettersonly:true
								}
							},
							messages:{
								parent:{
									required:'Please select parent'
								},
								m_name:{
									required:'Pleas add Member name',
									lettersonly:'Please add only characters'
								}
							},
							submitHandler: function(form) {
								$('#save_member').html('Saving..');
										$.ajax({
												url: _base_url + '/add-member',
												type: "POST",
												data: $('#members_form').serialize(),
												success: function(response) {
													$('#one').text("");
													$('#two').text("");
													$('#three').text("");
													$('#four').text("");
													$('#five').text("");
													loadData();
														$('#save_member').html('Saved');
														$('#res_message').html('Member added succesfully......!!!!!');
														$('#res_message').show();
														$('#memberModal').modal('hide');
														$('#memberModal').find('input').val('');
														$('#memberModal').find('select').val('');
														setTimeout(function() {
																$('#res_message').hide();
																$('#res_message').html('');
														}, 3000);
												}
										});
										}
								});
					});
			});
			
				function loadData(){
					
						$.ajax({
							method: "GET",
							url: _base_url + '/get-data',
							success: function (response) {
								$.each(response, function (key, value) { 
									if(value['parent_id'] ==1){
										$('#one').append('<tbody><tr><td>'+value['name']+'</td></tr></tbody>')
									}
									if(value['parent_id'] ==2){
										$('#two').append('<tbody><tr><td>'+value['name']+'</td></tr></tbody>')
									}
									if(value['parent_id'] ==3){
										$('#three').append('<tbody><tr><td>'+value['name']+'</td></tr></tbody>')
									}
									if(value['parent_id'] ==4){
										$('#four').append('<tbody><tr><td>'+value['name']+'</td></tr></tbody>')
									}
									if(value['parent_id'] ==5){
										$('#five').append('<tbody><tr><td>'+value['name']+'</td></tr></tbody>')
									}
								});
							}
						});
					}
		</script>
  </body>
</html>