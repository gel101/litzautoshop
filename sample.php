
<body style="overflow:hidden">
    <button class="d-none" id="sideAlertBtn">Show Alert</button>
    <div class="alert hide">
        <span class="fas fa-exclamation-circle"></span>
        <span class="msg">Warning: This is a warning alert!</span>
        <div class="close-btn-alert">
            <span class="fas fa-times"></span>
        </div>
    </div>
    <script>
        $('#sideAlertBtn').click(function(){
            $('.alert').addClass("show");
            $('.alert').removeClass("hide");
            $('.alert').addClass("showAlert");
            setTimeout(function(){
                $('.alert').removeClass("show");
                $('.alert').addClass("hide");
            },5000);
        });

        $('.close-btn-alert').click(function(){
            $('.alert').removeClass("show");
            $('.alert').addClass("hide");
            setTimeout(0);
        });
    </script>
</body>