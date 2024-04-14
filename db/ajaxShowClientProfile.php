<?php
include 'connection.php';

if (isset($_POST['type'])) {
    $requestType = $_POST['type'];
}else{
    $requestType = "";
}

if ($_POST['clientInfo'] != "") {
    $customerID = $_POST['clientInfo'];

    $stmt = mysqli_query($conn, "SELECT * FROM clientacc WHERE cust_id='$customerID'");

    while ($data = mysqli_fetch_assoc($stmt)) {
?>

    <div class="row">
        <div class="col-md-3">
            <a href="db/<?php echo $data['validID']; ?>" target="_blank" rel="noopener noreferrer">
                <img class="form-control" src="db/<?php echo $data['validID']; ?>" alt="" srcset="">
            </a>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label col-md-6">Client Name</label><span class="a_fname_err text-danger"></span>
                    <input class="form-control" type="text" value="<?php echo $data['fname']; ?> <?php echo $data['lname']; ?>" disabled>
                    <br>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Birthdate</label><span class="a_lname_err text-danger"></span>
                    <input class="form-control" type="text" value="<?php echo $data['birthdate']; ?>"disabled>
                    <br>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Phone Number</label><span class="a_phoneNum_err text-danger"></span>
                    <input class="form-control" type="text" value="<?php echo $data['phoneNum']; ?> "disabled>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Username</label><span class="a_birthdate_err text-danger"></span>
                    <input class="form-control" type="text" value="<?php echo $data['username']; ?> "disabled>
                    <br>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label><span class="a_email_err text-danger"></span>
                    <input class="form-control" type="text" value="<?php echo $data['email']; ?> "disabled>
                    <br>
                </div>
                    <label class="form-label">Address</label><span class="a_address_err text-danger"></span>
                    <input class="form-control" type="text" value="<?php echo $data['address']; ?> "disabled>
            </div>
        </div>
    </div>
<?php
    }
}
if (isset($_POST['type']) && $requestType == "order" && $_POST['clientInfo'] == "") {

?>

<div class="col-auto">
    <h3 class='text-warning text-center'>Walk in Customer</h3>
    <br>
    <div class="row">
        <div class="col-md-4">
            <label class="form-label col-md-6">Walk in Address</label><span class="a_fname_err text-danger"></span>
            <input class="form-control" type="text" value="<?php echo $_POST['noAccAddress']; ?>" disabled>
            <br>
        </div>
        <div class="col-md-4">
            <label class="form-label">Walk in Email</label><span class="a_lname_err text-danger"></span>
            <input class="form-control" type="text" value="<?php if($_POST['noAccEmail'] != ""){ echo $_POST['noAccEmail']; }else{ echo "Not Filled";} ?>"disabled>
            <br>
        </div>
        <div class="col-md-4">
            <label class="form-label">Phone Number</label><span class="a_phoneNum_err text-danger"></span>
            <input class="form-control" type="text" value="<?php echo $_POST['noAccPhone']; ?> "disabled>
            <br>
        </div>
    </div>
</div>

<?php
}
?>