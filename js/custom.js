// Data Tables
$(document).ready(function () {
	$("#table1").DataTable({
		lengthMenu: [
			[10, 15, 25, -1],
			[10, 15, 25, 'All'],
		],
		searching: false,
		language: {
			emptyTable: "No contacts available"
		},
		"pagingType": "full_numbers"
	});

	// Node
	class Node {
		constructor(data) {
			this.data = data;
			this.next = null;
		}
	}

	// Linked list
	class LinkedList {
		constructor() {
			this.head = null;
		}

		insert(data) {
			const newNode = new Node(data);
			newNode.next = this.head;
			this.head = newNode;
		}

		traverse() {
			let temp = this.head;
			while (temp != null) {
				console.log(temp.data);
				temp = temp.next;
			}
		}
	}

	// Create a new instance of the linked list
	const contactList = new LinkedList();

	// Add Contact
	$("#addModal").click(function () {
		$("#addConModal").modal("show");
	});

	document.getElementById("close1").onclick = function () {
		$('#addConModal').modal('hide');
	};

	$("#addContact").click(function () {
		var valid = true;
		var F_name = $("#F_name").val();
		var L_name = $("#L_name").val();
		var phone_number = $("#phone_number").val();
		var c_address = $("#c_address").val();

		if (F_name == "" || L_name == "" || phone_number == "" || c_address == "") {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Please fill in all required fields',
			});
		} else if (valid) {

			// Add the form data to the linked list
			const contact = {
				F_name: F_name,
				L_name: L_name,
				phone_number: phone_number,
				c_address: c_address
			};
	
			contactList.insert(contact);

			// Handle the form submission for saving all contacts to the database
			// Convert the linked list to an array and stringify it for sending to the server
			const contactArray = [];
			let temp = contactList.head;
			while (temp != null) {
				contactArray.push(temp.data);
				temp = temp.next;
			}
			const formData = { contacts: JSON.stringify(contactArray) };

			var form_data = {
				F_name: F_name,
				L_name: L_name,
				phone_number: phone_number,
				c_address: c_address
			};

			$.ajax({
				url: "insert_contact.php",
				type: "POST",
				data: form_data,
				dataType: "json",
				success: function (response) {
					if (response['valid'] == false) {
						Swal.fire({
							title: 'Error!',
							text: response['msg'],
							icon: 'error',
							confirmButtonText: 'Ok'
						});
					} else {
						Swal.fire({
							title: 'Success!',
							text: 'Contact added successfully!',
							icon: 'success',
							confirmButtonText: 'Ok'
						}).then(function () {
							window.location.href = "index.php";
						});
					}
				}
			});

				// Clear the linked list
				contactList.head = null;
			}
		});
	});
	

// Edit Contact
function editModal(F_name, L_name, phone_number, c_address, pr_id) {
	
	var F_name = F_name;
	var L_name = L_name;
	var pr_id = pr_id;
	var phone_number = phone_number;
	var c_address = c_address;

	$("#F_name1").val(F_name);
	$("#L_name1").val(L_name);
	$("#phone_number1").val(phone_number);
	$("#c_address1").val(c_address);
	$("#pr_id1").val(pr_id);

	$("#editConModal").modal("show");
}

$("#close2").on("click", function () {
	$('#editConModal').modal('hide');
});

$("#editContact").on("click", function () {
	var valid = true;
	var pr_id = $("#pr_id1").val();
	var F_name = $("#F_name1").val();
	var L_name = $("#L_name1").val();
	var phone_number = $("#phone_number1").val();
	var c_address = $("#c_address1").val();

	if (F_name === "" || L_name === "" || phone_number === "" || c_address === "") {

		let errorMessage = "";

		if (F_name === "") {
			errorMessage += "Please enter a first name.<br>";
		}

		if (L_name === "") {
			errorMessage += "Please enter a last name.<br>";
		}

		if (phone_number === "") {
			errorMessage += "Please enter a phone number.<br>";
		}

		if (c_address === "") {
			errorMessage += "Please enter an address.<br>";
		}

		valid = false;

		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			html: errorMessage,
		});
	}

	if (valid) {
		Swal.fire({
			title: 'Update Contact',
			text: "Are you sure you want to update this Contact?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, update it!'
		}).then((result) => {
			if (result.isConfirmed) {
				var form_data = {
					id: pr_id,
					F_name: F_name,
					L_name: L_name,
					phone_number: phone_number,
					c_address: c_address
				}

				$.ajax({
					url: "update_contact.php",
					type: "POST",
					data: form_data,
					dataType: "json",
					success: function (response) {
						if (response.valid === false) {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: response.msg
							});
						} else {
							Swal.fire({
								icon: 'success',
								title: 'Contact updated!',
								showConfirmButton: false,
								timer: 1500
							}).then(() => {
								window.location.href = "index.php";
							});
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: textStatus + ": " + errorThrown
						});
					}
				});

			} else {
				window.location.href = "index.php";
			}
		});
	}
});

		// Delete Contact
			function deleteModal(pr_id) {
				Swal.fire({
					title: 'Delete Contact',
					text: "Are you sure you want to delete this Contact?",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
					if (result.isConfirmed) {
						var form_data = {
							id: pr_id
						}

						$.ajax({
							url: "delete_contact.php",
							type: "POST",
							data: form_data,
							dataType: "json",
							success: function (response) {
								if (response['valid'] == false) {
									alert(response['msg']);
								} else {
									Swal.fire(
										'Deleted!',
										'Contact deleted!',
										'success'
									).then(() => {
										window.location.href = "index.php";
									});
								}
							}
						});
					}
				})
			}
		


