<?php
// require_once($url . '/footer.php');// echo '$_SERVER["DOCUMENT_ROOT"]' . $_SERVER['DOCUMENT_ROOT'];
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');
?>

<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Successfully Login</strong>
</div>




<div class="page-header">
    <h4 class="page-title">Announcement</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Announcement</li>
    </ol>
</div>


<div class="card">
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <img src="<?= SITEURL ?>/assets/images/beer.jpg" alt="img" class="br-tl-2 br-bl-2 " style="height:400px">
        </div>
        <div class="col-md-12 col-lg-6  pl-0 ">
            <div class="card-body p-7 about-con pabout">
                <h2 class="mb-4 font-weight-semibold">Rent Bank Card?</h2>
                <h4 class="leading-normal">Help us to grow more and more rich !</h4>
                <p class="leading-normal">Earn Money Win Everything !</p>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] .  '/template/footer.php') ?>