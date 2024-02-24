const paymentMethod = document.querySelector('.paymentMethod');
const gcashInfo = document.querySelector('.gcashInfo');
const directPay = document.getElementById('directPay');

paymentMethod.addEventListener('change', function(){
    if(paymentMethod.value == 'direct'){
        directPay.innerHTML = "Visit our shop @<br>✅Location Prk.5 Little Panay Panabo City <br>✅2-3 weeks releasing of finish units<br>✅contact number 09461030783";
        gcashInfo.style.display = 'none';
    }else if (paymentMethod.value == 'gcash') {
        gcashInfo.style.display = 'block';
        directPay.innerHTML = "";
    }else if(paymentMethod.value == 'installment'){
        gcashInfo.style.display = 'none';
        directPay.innerHTML = "Dp start@60k depending on the unit <br>2 yrs term <br>Monthly-9,250 <br>Processing fee-8,250<br>----------------------------------<br>REQUIREMENTS<br>EMPLOYED✅<br>COE<br>LATEST PAYSLIP 3MON.<br>LATEST ELECTRIC BILLING <br>BRGY.CLEARANCE <br>2 VALID ID & WIFE <br>MARRIAGE CONTRACT IF MARRED OG DILI BIRTH CERTIFICATE <br>----------------------------------------<br>REQUIREMENTS<br>SELF - EMPLOYED✅<br>BUSINESS PERMIT <br>LATEST BANK STATEMENT  3MON./RECEIPT 3MON. <br>LATEST ELECTRIC BILLING <br>BRGY.CLEARANCE <br>2 VALID ID & WIFE <br>MARRIAGE CONTRACT IF MARRED OG DILI BIRTH CERTIFICATE";
    }else {
        gcashInfo.style.display = 'none';
        directPay.innerHTML = "";
    }

});

const sppaymentMethod = document.querySelector('.sppaymentMethod');
const spgcashInfo = document.querySelector('.spgcashInfo');
const spdirectPay = document.getElementById('spdirectPay');

sppaymentMethod.addEventListener('change', function(){
    if(sppaymentMethod.value == 'direct'){
        spdirectPay.innerHTML = "Visit our shop @<br>✅Location Prk.5 Little Panay Panabo City <br>✅2-3 weeks releasing of finish units<br>✅contact number 09461030783";
        spgcashInfo.style.display = 'none';
    }else if (sppaymentMethod.value == 'gcash') {
        spgcashInfo.style.display = 'block';
        spdirectPay.innerHTML = "";
    }else {
        spgcashInfo.style.display = 'none';
        spdirectPay.innerHTML = "";
    }

});

