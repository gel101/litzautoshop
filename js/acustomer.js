var modal = document.getElementById('myModal');
var closeBtn = document.getElementsByClassName('close')[0];
var minivanCheck = document.getElementById('minivanCheck');
let carImageContainer = document.getElementById('carImageContainer');
let carImage = document.getElementById('carImage');


var sampleColor = document.getElementById('sampleColor');
var minivancolor = document.getElementById('minivancolor');

// minivancolor.addEventListener('change', function(event) {
//     event.preventDefault();

//     if (minivancolor.value == "") {
        
//     }
    
// });


minivanCheck.addEventListener('click', function(event) {
    event.preventDefault();
    var carModel = document.getElementById('carModel').value;
    var carcolor = document.getElementById('carcolor').value;
    var transmission = document.getElementById('transmission').value;
    var quantity = document.getElementById('quantity').value;
    var addons = document.getElementById('addons').value;
    var price = document.getElementById('carPrice');

    let enginecost = 0;
    let totalAddons = 0;
    
    switch (transmission) {
        case "4x2 automatic":
            enginecost = 185000;
            break;
        case "4x4 automatic":
            enginecost = 205000;
            break;
        case "4x2 manual":
            enginecost = 200000;
            break;
        case "4x4 manual":
            enginecost = 210000;
            break;
        case "Wagon":
            enginecost = 250000;
            break;
        default:
            enginecost = 0;
        }
    
    if (addons == "Add 16k for new tires and mags") {
        totalAddons = 16000;
    }if (addons == "None") {
        totalAddons = 0;
    }
    

    var totalcost = quantity * (enginecost + totalAddons);
    price.value = totalcost;
    var downPayment = totalcost / 2;

    var carInfo = "Model: " + carModel + "<br>Car Color: " + carcolor +
    "<br>Transmission: " + transmission +"<br>Quantity: " + quantity + "<br>Add ons: " + addons + "<br><br>Total Cost : ₱ " + totalcost  + "<br>Down Payment Cost : ₱ " + downPayment +
    "<br><br><br>Informations: <br>1st owner..our unit are fresh from Japan <br>Free registration direct to your name<br>anzhal paint<br>New preon aircon<br>New battery brandnew<br></br>Free Tint (hardblack/medium)<br>7 touchscreen stereo with backing camera<br>--------------------------------------<br> You can visit our shop @<br>✅Location Prk.5 Little Panay Panabo City <br>✅2-3 weeks releasing of finish units<br>✅contact number 09461030783<br>";
    carImageContainer.innerHTML = carInfo;
});

let resetBtn = document.getElementById('resetBtn');
let carForm = document.getElementById('carForm');

resetBtn.addEventListener('click', function() {
    carForm.reset();
    carImageContainer.innerHTML = "";
});

var DA64V = document.getElementById('DA64V');
var DA64W = document.getElementById('DA64W');
var DG64V = document.getElementById('DG64V');


carModel.addEventListener('change', function(){
    if (carModel.value == "DA64V") {
        DA64V.style.display = "block";
        DA64W.style.display = "none";
        DG64V.style.display = "none";
    }if (carModel.value == "DA64W") {
        DA64W.style.display = "block";
        DA64V.style.display = "none";
        DG64V.style.display = "none";
    }if (carModel.value == "DG64V Mazda") {
        DG64V.style.display = "block";
        DA64V.style.display = "none";
        DA64W.style.display = "none";
    }if (carModel.value == "Random Model") {
        DA64V.style.display = "none";
        DA64W.style.display = "none";
        DG64V.style.display = "none";
    }
});

