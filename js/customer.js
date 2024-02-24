var modal = document.getElementById('myModal');
var closeBtn = document.getElementsByClassName('close')[0];
var minivanCheck = document.getElementById('minivanCheck');
let carImageContainer = document.getElementById('carImageContainer');
let carImage = document.getElementById('carImage');


document.getElementById('carColors').addEventListener('change', function() {
    var selectedColor = this.value;
    var imagePath ='img/' + selectedColor + 'car.jpg';
    carImage.src = imagePath;
});

minivanCheck.addEventListener('click', function(event) {
    event.preventDefault();
    var carName = document.getElementById('carName').value;
    var carColors = document.getElementById('carColors').value;
    var transmission = document.getElementById('transmission').value;
    var addons = document.getElementById('addons').value;
    let transCost = 0;
    let totalAddons = 0;
    
    switch (transmission) {
        case "4X2 automatic price= 185k":
            transCost = 185000;
            break;
        case "4X4 automatic price= 205k":
            transCost = 205000;
            break;
        case "4X2 manual price= 200k":
            transCost = 200000;
            break;
        case "4X4 manual price= 210k":
            transCost = 210000;
            break;
        case "Wagon price= 250k":
            transCost = 250000;
            break;
        default:
            transCost = 0;
        }
    
    if (addons == "Add 16k for new tires and mags") {
        totalAddons = 16000;
    }if (addons == "None") {
        totalAddons = 0;
    }
    
    var totalcost = transCost + totalAddons;
    var downPayment = totalcost / 2;

    var carInfo = "Car Name: " + carName + "<br>Car Color: " + carColors +
    "<br>Transmission: " + transmission + "<br>Add ons: " + addons + "<br><br>Total Cost : ₱ " + totalcost  + "<br>Down Payment Cost : ₱ " + downPayment +
    "<br><br><br>Informations: <br>1st owner..our unit are fresh from Japan <br>Free registration direct to your name<br>anzhal paint<br>New preon aircon<br>New battery brandnew<br></br>Free Tint (hardblack/medium)<br>7 touchscreen stereo with backing camera<br>✅Location Prk.5 Little Panay Panabo City <br>✅2-3 weeks releasing of finish units<br>✅contact number 09461030783<br>Visit also our shop";
    carImageContainer.innerHTML = carInfo;
});

let resetBtn = document.getElementById('resetBtn');
let carForm = document.getElementById('carForm');

resetBtn.addEventListener('click', function() {
    carForm.reset();
    carImageContainer.innerHTML = "";
    carImage.src = "";
});


let paymentMethod = document.querySelector('.paymentMethod');
let gcashInfo = document.querySelector('.gcashInfo');
let directPay = document.querySelector('.directPay');
let installmentPay = document.querySelector('.installmentPay');


paymentMethod.addEventListener('change', function(){
    if(paymentMethod.value == 'direct'){
        directPay.textContent = "Direct Payment ni sya";
        gcashInfo.style.display = 'none';
    }else if (paymentMethod.value == 'gcash') {
        gcashInfo.style.display = 'block';
        directPay.textContent = "";
    }else if(paymentMethod.value == 'installment'){
        gcashInfo.style.display = 'none';
        directPay.textContent = "Installment Requirements ni siya";
    }else {
        gcashInfo.style.display = 'none';
        directPay.textContent = "";
    }
});


let sppaymentMethod = document.querySelector('.sppaymentMethod');
let spgcashInfo = document.querySelector('.spgcashInfo');
let spdirectPay = document.querySelector('.spdirectPay');

sppaymentMethod.addEventListener('change', function(){
    if(sppaymentMethod.value == 'spdirect'){
        spdirectPay.textContent = "Direct Payment ni sya";
        spgcashInfo.style.display = 'none';
    }else if (sppaymentMethod.value == 'spgcash') {
        spgcashInfo.style.display = 'block';
        spdirectPay.textContent = "";

    }else {
        spgcashInfo.style.display = 'none';
        spdirectPay.textContent = "";
    }
});

let rmpaymentMethod = document.querySelector('.rmpaymentMethod');
let rmgcashInfo = document.querySelector('.rmgcashInfo');
let rmdirectPay = document.querySelector('.rmdirectPay');


rmpaymentMethod.addEventListener('change', function(){
    if(rmpaymentMethod.value == 'rmdirect'){
        rmdirectPay.textContent = "Direct Payment ni sya";
        rmgcashInfo.style.display = 'none';
    }else if (rmpaymentMethod.value == 'rmgcash') {
        rmgcashInfo.style.display = 'block';
        rmdirectPay.textContent = "";
    }else {
        rmdirectPay.textContent = "";
        rmgcashInfo.style.display = 'none';
    }
});