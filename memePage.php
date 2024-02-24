<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Form with Bootstrap</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
  #congratulation-modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border: 2px solid #ccc;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
    z-index: 9999;
  }
  .cntr{
    display: flex;
    place-items: center;
    justify-content: center;
  }
  .btn{
    margin: 20px 20px 20px 20px;
  }
</style>
</head>
<body>
  
  
<div class="container mt-5">
  <form class="cntr">
  <h2>Madayon ang sabot?</h2>
    <div class="form-group cntr">
    </div>
  <br>
  <br>
  <br>
  </form>
  <div class="cntr">
  <button type="submit" id="yes" class="btn btn-primary">YES</button>
    <button type="submit" id="no" class="btn btn-success">DILI</button>
  </div>
</div>

<div id="congratulation-modal">
  <h3>DILI JUD DIAY MADAYON!</h3>
  <p>Wala man moy klaro oy</p>
</div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
  function moveButtonRandomly() {
    const button = document.getElementById('yes');
    const maxX = window.innerWidth - button.clientWidth;
    const maxY = window.innerHeight - button.clientHeight;

    const randomX = Math.floor(Math.random() * maxX);
    const randomY = Math.floor(Math.random() * maxY);

    button.style.position = 'absolute';
    button.style.left = `${randomX}px`;
    button.style.top = `${randomY}px`;
  }

  document.getElementById('yes').addEventListener('mouseover', moveButtonRandomly);

  function showCongratulationsModal() {
    const modal = document.getElementById('congratulation-modal');
    modal.style.display = 'block';

    setTimeout(function () {
      modal.style.display = 'none';
    }, 3000);
  }

  document.getElementById('no').addEventListener('click', showCongratulationsModal);
</script>

</body>
</html>
