<?php
// require_once($url . '/footer.php');// echo '$_SERVER["DOCUMENT_ROOT"]' . $_SERVER['DOCUMENT_ROOT'];
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');
?>

<div class="app-content  my-3 my-md-5">
    <div class="side-app">
        <marquee style="padding:8px;background-color:#FDD58C"><b>要好好的做，努力赚钱，美好未来！</b></marquee>
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
</div>
<div id="changePassModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="../user/changePassword">
                <input type="hidden" name="_token" value="zZmMzS63qa18RXY01BZGv6chzLXG1ppo7j1x0Zub">
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <label for="change-password"><b>Current password</b></label>
                        <input type="password" class="form-control " name="current_password" autocomplete="current_password" placeholder="Current Password..">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control " name="password" autocomplete="password" placeholder="New Password..">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control " name="password_confirmation" autocomplete="password_confirmation" placeholder="Confirm Password..">
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] .  '/template/footer.php') ?>