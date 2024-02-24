function showTranmenu() {
  let change = document.getElementsByClassName('tran-menu')[0];
  let tranBtn = document.getElementById('tranBtn');

  change.classList.toggle('show');
  tranBtn.setAttribute('class', 'list-group-item list-group-item-action bg-transparent main-bg-color');
}

function showMngmenu() {
  let change = document.getElementsByClassName('mng-menu')[0];
  let mngBtn = document.getElementById('mngBtn');

  change.classList.toggle('show');
  mngBtn.setAttribute('class', 'list-group-item list-group-item-action bg-transparent main-bg-color');
}
