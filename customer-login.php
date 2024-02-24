<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Hideout Garage</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- App favicon -->
    <link rel="shortcut icon" href="img/favicon.ico">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
        }
        
        .enterAnimation {
        color: #212121;
        scale: 1.1;
        box-shadow: 0 0px 20px rgba(193, 163, 98,0.4);
        transition: all 0.3s; /* Add a smooth transition */
        }
        
    </style>
</head>
<body>


<button id="errorButton" style="display: none;" data-toggle="modal" data-target="#errorModal"></button>
<button id="successButton" style="display: none;" data-toggle="modal" data-target="#successModal"></button>

<div id="successModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon 
                        src="https://cdn.lordicon.com/oqdmuxru.json"
                        trigger="loop"
                        colors="primary:#30e849,secondary:#08a88a"
                        style="width:250px;height:250px">
                    </lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4 class="messageText">Success</h4>
                    </div>
                    <div class="row">
                        <div class="center">
                            <!-- <button id="confirmAction" class="btn btn-primary">Yes</button> -->
                            <!-- <button class="btn btn-danger" data-bs-dismiss="modal">No</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- removeNotificationModal -->
<div id="errorModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#e83a30" style="width:100px;height:150px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4 id="errorText">Login Error!</h4>
                        <p class="text-muted mx-4 mb-0">Please Try Again.</p>
                    </div>
                </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-lg btn-light" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


    <div class="content-wrapper">
        <img id="logo" src="./landingpage/images/logo-light.png" onclick="goto('index.php')">
        <img class="wave" src="img/wave.png">
        <h1 style="cursor: pointer;" >Welcome to <span>Litz</span><span style="color: red;"> Auto</span></h1>
        <div class="img">
            <img class="mainImageDisplay" src="landingpage/images/homecar.png">
        </div>
        <div class="loginForm">
            <form>
                <img src="img/avatar1.svg">
                <h2 class="title">Sign In</h2>
                <div class="input-div one">
                <div class="i">
                        <i class="fas fa-user"></i>
                </div>
                <div class="div">
                        <h5>Username</h5>
                        <input type="text" name="uname" id="uname" class="input">
                </div>
                </div>
                <div class="input-div pass">
                <div class="i"> 
                        <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                        <h5>Password</h5>
                        <input type="password" name="pass" id="pass" class="input">
                </div>
                </div>
                <button type="button" id="submit" class="newBtn">LOG IN</button>
                <br>
                <h5>No Account? <a id="signUpLink" class="" href="customer-signup.php"> Sign up!</a></h5>
                <a id="forgotPass" href="customer-forgot-account.php" rel="noopener noreferrer">Forgot Password?</a>
            </form>
        </div>
        <a href="admin-login.php" class="accountLink" id="loginLink">Admin Login</a>
    </div>



    <script src="js/jquery-3.6.3.min.js"></script>
    <script>
        
        function goto(page) {
            // Use window.location.href to navigate to the specified page
            window.location.href = page;
        }
        // Add an event listener to the document to listen for key presses
        $(document).keydown(function(event) {
            // Check if the pressed key is the Enter key (key code 13)
            if (event.which === 13) {
            // Trigger a click event on the button with id "errorButton"
            $(".newBtn").addClass("enterAnimation");
            $(".newBtn").click();
            }
        });
        

        $(document).ready(function(){
            $('.mainImageDisplay').addClass('show');  // Add the 'show' class to trigger the transition
            $('#forgotPass').css('display', 'none');

            $('#submit').click(function (){
                var valid = true;
                var uname = $("#uname").val();
                var pass = $("#pass").val();
                

                if(uname == ""){
                    valid = false;
                }

                if(pass == ""){
                    valid = false;
                }

                if(valid){
                    var form_data = {
                        uname : uname,
                        pass : pass
                    }; 
                    

                    $.ajax({
                        url : "db/customerLogin.php",
                        type : "POST",
                        data : form_data,
                        dataType: "json",
                        success: function(response){
                            if(response['valid'] == false){
                                // alert(response['msg']);
                                // $('#errorModal').modal('show');
                                // $('#errorText').text(response['msg']);
                                $('#errorButton').click();
                                $('#forgotPass').css('display', 'block');
                            }else{
                                
                                
                                window.location.href="customer-car.php";
                                // // alert(response['msg']);
                                // // $('#successModal').modal('show');
                                // $('#successButton').click();
                                // setTimeout(function () {
                                //     // $('#successModal').modal('hide');
                                //     window.location.href="customer-car.php";
                                // }, 1000);
                            }        
                        }
                    });
    
                }else {
                        // window.location.href="admin-manbirthdate-product.php";
                    }
		    });


        });


		const inputs = document.querySelectorAll(".input");

		function addcl(){
			let parent = this.parentNode.parentNode;
			parent.classList.add("focus");
		};

		function remcl(){
			let parent = this.parentNode.parentNode;
			if(this.value == ""){
				parent.classList.remove("focus");
			}
		};

		inputs.forEach(input => {
			input.addEventListener("focus", addcl);
			input.addEventListener("blur", remcl);
		});

	</script>
</body>
</html>
