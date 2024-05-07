<?php
include 'connection.php';


    $mechanic_id = $_POST['mechanic_id'];

    $stmt = mysqli_query($conn, "SELECT * FROM staff WHERE staff_id = '$mechanic_id'");

    while ($data = mysqli_fetch_assoc($stmt)) {
?>

    <div class="row">
        <!-- <div class="col-md-3">
            <a href="db/<?php echo $data['validID']; ?>" target="_blank" rel="noopener noreferrer">
                <img class="form-control" src="db/<?php echo $data['validID']; ?>" alt="" srcset="">
            </a>
        </div> -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label col-md-6">Mechanic Name</label><span class="a_fname_err text-danger"></span>
                    <input class="form-control" type="text" value="<?php echo $data['fname']; ?> <?php echo $data['lname']; ?>" disabled>
                    <br>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Mechanic Birthdate</label><span class="a_lname_err text-danger"></span>
                    <input class="form-control" type="text" value="<?php echo date('m/d/Y', strtotime($data['birthdate'])); ?>"disabled>
                    <br>
                </div>
                <div class="col-md-4">
                    <label class="form-label"> Mechanic Phone Number</label><span class="a_phoneNum_err text-danger"></span>
                    <input class="form-control" type="text" value="<?php echo $data['pNum']; ?> "disabled>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Mechanic Address</label><span class="a_address_err text-danger"></span>
                    <input class="form-control" type="text" value="Purok 3, New Visayas Panabo City"disabled>
                    <br>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mechanic Email</label><span class="a_email_err text-danger"></span>
                    <input class="form-control" type="text" value="<?php echo $data['email']; ?> "disabled>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3><center>Service</center></h3>
    <br>
<?php
    }
?>