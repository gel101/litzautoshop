<head>
    <!-- Alert Css -->
    <link rel="stylesheet" href="./css/alert.css">
</head>
<body style="overflow:hidden;">
    <div class="alert hide">
        <span class="fas fa-exclamation-circle"></span>
        <span class="msg">Warning: <span class="" id="sideAlertMessage"></span></span>
        <div class="close-btn-alert">
            <span class="fas fa-times"></span>
        </div>
    </div>
</body>
<script>
    function triggerAlert(sms){
        $('.alert').addClass("show");
        $('.alert').removeClass("hide");
        $('.alert').addClass("showAlert");
        $('#sideAlertMessage').html(sms);
        
        setTimeout(function(){
            $('.alert').removeClass("show");
            $('.alert').addClass("hide");
        },5000);
    }

    $('.close-btn-alert').click(function(){
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
        setTimeout(0);
    });
</script>