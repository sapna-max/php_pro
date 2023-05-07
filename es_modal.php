<!-- Modal -->
		<div class="modal fade" id="eligibility_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Update Password</h4>
			</div>
			<div class="modal-body">
				 <form  id="es" class="login_form"  method="post" action="">
				 		<div class="row">
						<div class="col-xs-12"><label> Email-Id </label></div>
						<div class="col-xs-12">	<input value="" type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2" required>
						</div>
						</div>	

						<div class="row">
						<div class="col-xs-12"><label>Contact No.</label></div>
						<div class="col-xs-12"><input  type="text" class="form-control unicase-form-control text-input" id="contactno2" name="contactno" maxlength="10" value="" required></div>
						</div>

					
						<div class="row">
							<div class="col-xs-12"><label>Password</label></div>
							<div class="col-xs-12"><input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword2" value=""></div>
						</div>
					
						<div class="row">
							<div class="col-xs-12"><label>Confirm Password</label></div>
							<div class="col-xs-12"><input value="" type="password" class="form-control unicase-form-control text-input" id="confirmpassword2" name="confirmpassword" required></div>
						</div>					
						
					<div class="row">
					<div class="col-xs-12">
					<br>
						<button type="submit" name="save_eligibility"  class="btn btn-success"><i class="fa fa-save"></i> Update Info</button>
					</div>				 
					</div>				 
			</form>
			</div>
			<div class="modal-footer">
				<button type="submit"  class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				
			</div>
			</div>
			
		</div>
		</div>
	
		  								<script>
	 											jQuery(document).ready(function(){	 											
												jQuery("#es").submit(function(e){
														e.preventDefault();
														var formData = jQuery(this).serialize();													
														$.ajax({															
															type: "POST",
															url: "es_save.php",															
															data: formData,
															success: function(html){
															alert('Password Successfully Updated');
															window.location = 'login.php';
															}
														});
														return false;
														});
										}); 
										</script>