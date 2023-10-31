<!DOCTYPE html>
<html>

<?php include 'head.php'; ?>

<body style="background: #2b343b; color: white;">

	<div class="row vhw">

		<?php include 'navbar.php'; ?>

		<div class="col p-3 m-2 overflow-auto scrollbar1">

			<nav class="navbar text-white">
				<div class="container-fluid">
					<?php
					include 'config.php';

					$query = mysqli_query($conn, "SELECT COUNT(*) as num_contacts FROM contacts");
					$result = mysqli_fetch_assoc($query);
					$num_contacts = $result['num_contacts'];

					?>
					<h4 class="navbar-brand text-white"><i class="fa-solid fa-list-ul"></i> You have <?php echo $result['num_contacts']; ?> Contacts</h4>

				</div>
			</nav>

			<hr class="bg-secondary">

			<!-- Table -->
			<div class="container-fluid my-3 p-3 rounded shadow-lg overflow-auto scrollbar1 w-75">

				<div class="row">
					<div class="col">
						<table class="table table-dark table-striped table-hover table-responsive-md text-white py-3" id="table1">
							<thead>
								<tr>
									<th class="text-center">Contact Name</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								include 'config.php';

								$st = mysqli_query($conn, "SELECT * FROM contacts ORDER BY id DESC");

								while ($data = mysqli_fetch_assoc($st)) {

								?>
									<tr>
										<td class='text-center'><?php echo $data['F_name']; ?> <?php echo $data['L_name']; ?></td>
										<td class="text-center">
											<!-- Favorite Action -->
											<?php if ($data['favorite'] === '0') { ?>
												<button class="btn btn-outline-primary text-white fav" onclick="toggleFavoriteStatus('<?php echo $data['id']; ?>')">
													<i class="fa-regular fa-star"></i>
												</button>
											<?php } else { ?>
												<button class="btn btn-outline-warning text-white unfav" onclick="toggleRemoveFavoriteStatus('<?php echo $data['id']; ?>')">
													<i class="fa-solid fa-star"></i>
												</button>
											<?php } ?>
											<!-- View Action -->
											<button class="btn btn-outline-success text-white" onclick="viewModal
													('<?php echo $data['id']; ?>',
													'<?php echo $data['F_name']; ?>',
													'<?php echo $data['L_name']; ?>',
													'<?php echo $data['phone_number']; ?>',
													'<?php echo $data['c_address']; ?>')">
												<i class="fa-solid fa-eye"></i>
											</button>
											<!-- Edit Action -->
											<button class="btn btn-outline-info text-white" onclick="editModal
												('<?php echo $data['F_name']; ?>',
												'<?php echo $data['L_name']; ?>',
												'<?php echo $data['phone_number']; ?>',
												'<?php echo $data['c_address']; ?>',
												'<?php echo $data['id']; ?>')">
												<i class="fa-solid fa-pen-to-square"></i>
											</button>
											<!-- Delete Action -->
											<button class="btn btn-outline-danger text-white" onclick="deleteModal
												('<?php echo $data['id']; ?>')">
												<i class="fa-solid fa-trash-can"></i>
											</button>
										</td>
									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- End of Table -->
		</div>

		</div>
			<!-- Actions Modals -->
			<?php include 'add_modal.php'; ?>
			<?php include 'edit_modal.php'; ?>
		<!-- Loader -->
		<div class='loaderClass'>
			<div class='preloader'>
				<div class='loader'></div>
			</div>
		</div>

	</div>
	</div>
	</div>

</body>

<!-- JavaScripts -->

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Jquery -->
<script src="js/jquery.min.js" ></script>
<!-- FontAwesome -->
<script src="js/fontawesome.min.js"></script>
<script src="js/all.min.js"></script>
<script src="js/solid.min.js"></script>
<script src="js/regular.min.js"></script>
<script src="js/v4-shims.min.js"></script>
<!-- Jquery DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<!-- CustomScript -->
<script src="js/custom.js"></script>

<script type="text/javascript">
	// Add Favorite
	function toggleFavoriteStatus(contact_id) {
		Swal.fire({
			title: 'Add to favorites?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: '<i class="fa-solid fa-check"></i> Yes'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: 'add_favorite.php',
					type: 'POST',
					data: {
						id: contact_id,
						favorite: 1,
					},
					success: function(response) {
						if (response === 'success') {
							Swal.fire({
								title: 'Success!',
								text: 'Contact added to favorites successfully!',
								icon: 'success',
								confirmButtonText: 'Ok'
							}).then(function() {
								window.location.href = "index.php";
							});
						} else {
							// show an error message
							Swal.fire({
								title: 'Error!',
								text: 'Failed to update contact favorite status!',
								icon: 'error',
								confirmButtonText: 'Ok'
							}).then(function() {
								window.location.href = "index.php";
							});
						}
					}
				});
			}
		})
	}

	// Remove Favorite
	function toggleRemoveFavoriteStatus(contact_id) {
		Swal.fire({
			title: 'Remove from favorites?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: '<i class="fa-solid fa-check"></i> Yes'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: 'add_favorite.php',
					type: 'POST',
					data: {
						id: contact_id,
						favorite: 0,
					},
					success: function(response) {
						if (response === 'success') {
							Swal.fire({
								title: 'Success!',
								text: 'Contact removed from favorites successfully!',
								icon: 'success',
								confirmButtonText: 'Ok'
							}).then(function() {
								window.location.href = "index.php";
							});
						} else {
							// show an error message
							Swal.fire({
								title: 'Error!',
								text: 'Failed to update contact favorite status!',
								icon: 'error',
								confirmButtonText: 'Ok'
							}).then(function() {
								window.location.href = "index.php";
							});
						}
					}
				});
			}
		})
	}

	// View Contact
	function viewModal(id, F_name, L_name, phone, address) {
		Swal.fire({
			title: ``,
			html: `
			<h1 class="text-white"><i class="fa-solid fa-circle-user fa-2xl"></i> ${F_name} ${L_name}</h1><br>
			<p>Contact Information</p>
			<div class="form-floating mb-2" data-bs-theme="dark">
  				<input type="text" class="form-control" id="floatingInputDisabled" placeholder="" value="${F_name}" disabled>
  				<label for="floatingInputDisabled">First Name</label>
			</div>
			<div class="form-floating mb-2" data-bs-theme="dark">
  				<input type="text" class="form-control " id="floatingInputDisabled" placeholder="" value="${L_name}" disabled>
  				<label for="floatingInputDisabled">Last Name</label>
			</div>
			<div class="form-floating mb-2" data-bs-theme="dark">
  				<input type="text" class="form-control " id="floatingInputDisabled" placeholder="" value="${phone}" disabled>
  				<label for="floatingInputDisabled">Phone Number</label>
			</div>
			<div class="form-floating mb-2" data-bs-theme="dark">
  				<input type="text" class="form-control " id="floatingInputDisabled" placeholder="" value="${address}" disabled>
  				<label for="floatingInputDisabled">Address</label>
			</div>	
   			 `
			 ,
			showConfirmButton: false,
			showCancelButton: true,
			cancelButtonText: '<i class="fa-solid fa-x"></i> Close',
			focusCancel: true,
			cancelButtonColor: '#d33'

		});
	}

	// Loader
	$(window).on('load', function() {
		$('.preloader').addClass('complete')
	})

	// Custom SideNavbar
	const list = document.querySelectorAll('.list');

	function activelink() {
		list.forEach((item) =>
			item.classList.remove('active'));
		this.classList.add('active');
	}
	list.forEach((item) =>
		item.addEventListener('click', activelink));
</script>

<!-- JavaScripts End -->

</html>