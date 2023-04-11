<?php
include('config.php');
?>

<!DOCTYPE html>
<html>

<head>
  <title></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <style type="text/css">
    /* .style8 {
      color: #999999
    } */
  </style>
</head>

<body style="background-color:#4e73df;">


  <center style="margin-top:38px;">

    <div class="card" style="width:22rem;">
      <div class="card-body" style="font-size: 18px;color: red;"></div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <h3><span class="style8">Select Language<br>
                &#36873;&#25321;&#35821;&#35328;
              </span><br>
              <br>
              <input type="button" class="form-control" placeholder="login" name="submit" style="border-radius:10rem;width:260px;background-color:#4e73df;text-align:center;color: #fff !important;" value="English" onclick="window.location.href='<?= $url ?>/login.php';">
              <br>
              <input type="button" class="form-control" placeholder="reset" name="reset" style="border-radius:10rem;width:260px;background-color:#4e73df;text-align:center;color: #fff !important;" value="华语" onclick="window.location.href='<?= $url ?>/cn/index.php';">
            </h3>
          </div>
        </form>


      </div>
    </div>

  </center>


</body>

</html>