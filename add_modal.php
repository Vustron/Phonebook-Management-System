	        <!-- Add Modal -->
	        <div class="container">

	        	<div class="modal fade" id="addConModal">
	        		<div class="modal-dialog modal-lg modal-dialog-centered">

	        			<div class="modal-content">
	        				<div class="row">

	        					<div class="col-4 bg-primary rounded-start" style="position:relative;">
	        						<i class="fa-solid fa-address-book fa-bounce text-white" id="icon-s"></i>
	        					</div>

	        					<div class="col-8 bg-dark p-3 rounded-end">

	        						<h4 class="mb-2 text-center"><i class="fa-solid fa-user-plus"></i> Add New Contact</h4>

	        						<div class="modal-body">
	        							<div class="col">

	        								<div class="form-floating mb-3" data-bs-theme="dark">
	        									<input class="form-control " id="F_name" type="text" placeholder="Enter First Name" required>
												<label class="form-label ">First Name <span class="F_name_err text-danger"></span></label>
	        								</div> 

	        								<div class="form-floating mb-3" data-bs-theme="dark">
	        									<input class="form-control " id="L_name" type="text" placeholder="Enter Last Name" required>
												<label class="form-label ">Last Name <span class="L_name_err text-danger"></span></label>
	        								</div>

	        								<div class="form-floating mb-3" data-bs-theme="dark">
	        									<input class="form-control " id="phone_number" type="tel" maxlength="11" pattern="[0-9]{1,11}" placeholder="Enter Phone Number" required oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^-/, '')">
												<label class="form-label ">Phone Number<span class="phone_number_err text-danger alert" role="alert"></span></label>
	        								</div>

	        								<div class="form-floating mb-3" data-bs-theme="dark">
	        									<input class="form-control " id="c_address" type="text" placeholder="Enter Address" required>
												<label class="form-label ">Address <span class="c_address_err text-danger"></span></label>
	        								</div>

	        								<div class="modal-footer mt-2">
	        									<div class="d-grid gap-2 w-100">
	        										<button type="submit" name="submit" id="addContact" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add</button>
	        										<button data-bs-dismiss="modal" id="close1" class="btn btn-danger text-white"><i class="fa-solid fa-x"></i> Cancel</button>
	        									</div>
	        								</div>

	        							</div>
	        						</div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
			</div>
	        	<!-- End of Modal -->