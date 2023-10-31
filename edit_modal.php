<!-- Edit Modal -->
<div class="modal fade" id="editConModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">

            <div class="row">
                <div class="col-4 bg-success rounded-start" style="position:relative;">
                    <i class="fa-regular fa-pen-to-square fa-beat text-white" id="icon-s"></i>
                </div>

                <div class="col-8 bg-dark p-3 rounded-end ">
                    <h4 class="mb-2 text-center"><i class="fa-regular fa-pen-to-square"></i> Edit Contact</h4>

                    <div class="modal-body">
                        <div class="col">

                            <input type="hidden" name="" id="pr_id1">
                            <div class="form-floating mb-3" data-bs-theme="dark">   
                                <input class="form-control " id="F_name1" type="text" placeholder="Edit First Name">
                                <label class="form-label ">First Name <span class="contact_name_err text-danger"></span></label>
                            </div>

                            <div class="form-floating mb-3" data-bs-theme="dark">
                                <input class="form-control " id="L_name1" type="text" placeholder="Edit Last Name">
                                <label class="form-label ">Last Name <span class="contact_name_err text-danger"></span></label>
                            </div>

                            <div class="form-floating mb-3" data-bs-theme="dark">
                                <input class="form-control " id="phone_number1" type="tel" maxlength="11" pattern="[0-9]{11}" placeholder="Enter Phone Number" required>
                                <label class="form-label ">Phone Number <span class="phone_number_err text-danger"></span></label>
                            </div>

                            <div class="form-floating mb-3" data-bs-theme="dark">
                                <input class="form-control " id="c_address1" type="text" placeholder="Edit Address">
                                <label class="form-label">Address <span class="c_address_err text-danger"></span></label>
                            </div>
                        </div>

                        <div class="modal-footer mt-2">
                            <div class="d-grid gap-2 w-100">
                                <button class="btn btn-success" id="editContact"><i class="fa-solid fa-check"></i> Save</button>
                                <button data-bs-dismiss="modal" id="close2" class="btn btn-danger text-white"><i class="fa-solid fa-x"></i> Cancel</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

    <!-- End of Modal -->