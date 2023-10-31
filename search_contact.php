<!DOCTYPE html>
<html>

<?php include 'head.php'; ?>

<body style="background: #2b343b; color: white;">
    <div class="row vhw">
        <?php include 'searchnavbar.php'; ?>

        <div class="col p-3 m-2 overflow-auto scrollbar1">

            <nav class="navbar text-white">
                <div class="container-fluid">
                    <h4 class="navbar-brand text-white"><i class="fa-solid fa-magnifying-glass"></i> Search Contacts</h4>
                </div>
            </nav>

            <hr class="bg-secondary">

            <!-- Table -->
            <div class="container-fluid my-3 p-3 rounded shadow-lg overflow-auto scrollbar1 w-75">
                <div class="col d-flex justify-content-start">

                    <div class="container">
                        <form method="post" class="form-s">
                            <input type="search" class="search-input" name="searchcontact" placeholder="Search Contact Name, Number or Address" />
                            <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-dark table-striped table-hover table-responsive-md text-white py-3" id="table1">
                            <thead>
                                <tr>
                                    <th class="text-center">Contact Name</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <?php

                            include 'config.php';

                            function binarySearch($arr, $left, $right, $x)
                            {
                                $matches = array();

                                while ($left <= $right) {
                                    $mid = floor($left + ($right - $left) / 2);

                                    if (
                                        stripos($arr[$mid]['F_name'], $x) === 0 ||
                                        stripos($arr[$mid]['L_name'], $x) === 0 ||
                                        stripos($arr[$mid]['phone_number'], $x) === 0 ||
                                        stripos($arr[$mid]['c_address'], $x) === 0
                                    ) {
                                        $matches[] = $arr[$mid];
                                    }

                                    if (strcasecmp($arr[$mid]['F_name'] . ' ' . $arr[$mid]['L_name'], $x) >= 0) {
                                        $right = $mid - 1;
                                    } else {
                                        $left = $mid + 1;
                                    }
                                }

                                usort($matches, function ($a, $b) use ($x) {
                                    $aStartsWithX = stripos($a['F_name'], $x) === 0 || stripos($a['L_name'], $x) === 0 || stripos($a['phone_number'], $x) === 0 || stripos($a['c_address'], $x) === 0;
                                    $bStartsWithX = stripos($b['F_name'], $x) === 0 || stripos($b['L_name'], $x) === 0 || stripos($b['phone_number'], $x) === 0 || stripos($b['c_address'], $x) === 0;

                                    if ($aStartsWithX && !$bStartsWithX) {
                                        return -1;
                                    } elseif (!$aStartsWithX && $bStartsWithX) {
                                        return 1;
                                    } else {
                                        return strcasecmp($a['F_name'] . ' ' . $a['L_name'], $b['F_name'] . ' ' . $b['L_name']);
                                    }
                                });

                                return $matches;
                            }


                            if (isset($_POST['searchcontact'])) {
                                $sdata = $_POST['searchcontact'];

                                $query = "SELECT id, F_name, L_name, phone_number, c_address, favorite 
                                            FROM contacts 
                                            WHERE F_name LIKE ? OR L_name LIKE ? OR phone_number LIKE ? OR c_address LIKE ?
                                            ORDER BY F_name, L_name";

                                $stmt = mysqli_prepare($conn, $query);
                                $search_term = "%" . $sdata . "%";
                                mysqli_stmt_bind_param($stmt, "ssss", $search_term, $search_term, $search_term, $search_term);
                                mysqli_stmt_execute($stmt);

                                $result = mysqli_stmt_get_result($stmt);

                                $matches = array();
                                while ($contact = mysqli_fetch_assoc($result)) {
                                    if (
                                        stripos($contact['F_name'], $sdata) === 0 || stripos($contact['L_name'], $sdata) === 0 ||
                                        stripos($contact['phone_number'], $sdata) === 0 || stripos($contact['c_address'], $sdata) === 0
                                    ) {
                                        $matches[] = $contact;
                                    }
                                }

                                if (empty($matches)) {
                                    echo "";
                                } else {
                                    usort($matches, function ($a, $b) use ($sdata) {
                                        $aStartsWithX = stripos($a['F_name'], $sdata) === 0 || stripos($a['L_name'], $sdata) === 0 ||
                                        stripos($a['c_address'], $sdata) === 0 || stripos($a['phone_number'], $sdata) === 0;
                                        $bStartsWithX = stripos($b['F_name'], $sdata) === 0 || stripos($b['L_name'], $sdata) === 0 ||
                                        stripos($b['c_address'], $sdata) === 0 || stripos($b['phone_number'], $sdata) === 0 ;

                                        if ($aStartsWithX && !$bStartsWithX) {
                                            return -1;
                                        } elseif (!$aStartsWithX && $bStartsWithX) {
                                            return 1;
                                        } else {
                                            return strcasecmp($a['F_name'] . ' ' . $a['L_name'], $b['F_name'] . ' ' . $b['L_name']);
                                        }
                                    });

                                    foreach ($matches as $contact) {

                                        echo "
                                <tbody>
                                    <tr class='text-center'>
                                        <td>{$contact['F_name']} {$contact['L_name']}</td>
                                        <td class='text-center'>
                                            <!-- View Action -->
                                            <button class='btn btn-outline-success text-white' onclick=\"viewModal
                                                    ('{$contact['F_name']}', 
                                                    '{$contact['L_name']}',
                                                    '{$contact['phone_number']}', 
                                                    '{$contact['c_address']}',
                                                    '{$contact['id']}')\">
                                                    <i class=\"fa-solid fa-eye\"></i> 
                                            </button>
                                            <!-- Edit Action -->
                                            <button class='btn btn-outline-info text-white' onclick=\"editModal
                                                ('{$contact['F_name']}', 
                                                '{$contact['L_name']}',
                                                '{$contact['phone_number']}', 
                                                '{$contact['c_address']}',
                                                '{$contact['id']}')\">
                                                <i class=\"fa-solid fa-pen-to-square\"></i> 
                                            </button>
                                            <!-- Delete Action -->
                                            <button class='btn btn-outline-danger text-white' onclick=\"deleteModal
                                                ('{$contact['id']}')\">
                                                <i class=\"fa-solid fa-trash-can\"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>";
                                    }
                                }
                            }

                            ?>


                        </table>
                    </div>
                </div>
            </div>
            <!-- End of Table -->

            <!-- Loader -->
            <div class='loaderClass'>
                <div class='preloader'>
                    <div class='loader'></div>
                </div>
            </div>

        </div>


    </div>

    <?php include 'edit_modal.php'; ?>

</body>

<!-- JavaScripts -->

<script>
    const searchIcon = document.querySelector('.searchIcon');
    const search = document.querySelector('.search');
    searchIcon.onclick = function() {
        search.classList.toggle('active')
    }
</script>

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
 
    // View Contact
    function viewModal(F_name, L_name, phone, address) {
        Swal.fire({

            title:`` ,
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