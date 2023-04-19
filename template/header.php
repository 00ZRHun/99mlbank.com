<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/auth.php');
?>

<!doctype html>
<html lang="en" dir="ltr">

<head>
	<!-- Meta data -->
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="Reallist- Bootstrap Responsive Real estate Classifieds, Dealer, Rentel, Builder and Agent Multipurpose HTML Template" name="description">
	<meta content="Spruko Technologies Private Limited" name="author">
	<meta name="keywords" content="html template, real estate websites, real estate html template, property websites, premium html templates, real estate company website, bootstrap real estate template, real estate marketplace html template, listing website template, property listing html template, real estate bootstrap template, real estate html5 template, real estate listing template, property template, property dealer website" />

	<!-- Favicon -->
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

	<!-- Title -->
	<title>(RM) Card Management System</title>

	<link rel="stylesheet" href="<?= SITEURL ?>/assets/fonts/fonts/font-awesome.min.css">

	<!-- Bootstrap Css -->
	<link rel="stylesheet" href="<?= SITEURL ?>/assets/plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css">

	<!-- Dashboard Css -->
	<link rel="stylesheet" href="<?= SITEURL ?>/assets/css/style.css">
	<link rel="stylesheet" href="<?= SITEURL ?>/assets/css/admin-custom.css">


	<link rel="stylesheet" href="<?= SITEURL ?>/assets/plugins/charts-c3/c3-chart.css">

	<!-- Data table css -->
	<link rel="stylesheet" href="<?= SITEURL ?>/assets/plugins/datatable/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= SITEURL ?>/assets/plugins/datatable/jquery.dataTables.min.css">


	<!-- Slect2 css -->
	<link rel="stylesheet" href="<?= SITEURL ?>/assets/plugins/select2/select2.min.css">

	<!-- Sidemenu Css -->
	<link rel="stylesheet" href="<?= SITEURL ?>/assets/css/sidemenu.css">
	<!-- p-scroll bar css-->
	<link rel="stylesheet" href="<?= SITEURL ?>/assets/plugins/pscrollbar/pscrollbar.css">

	<!---Font icons-->
	<link rel="stylesheet" href="<?= SITEURL ?>/assets/css/icons.css">
	<link rel="stylesheet" href="<?= SITEURL ?>/assets/plugins/iconfonts/icons.css">

</head>

<body class="app sidebar-mini">

	<div id="global-loader">
		<img src="<?= SITEURL ?>/assets/images/loader.svg" class="loader-img" alt="">
	</div>
	<div class="page">
		<div class="page-main h-100">
			<div class="app-header1 header py-1 d-flex">
				<div class="container-fluid">
					<div class="d-flex">
						<a class="header-brand" href="#">
							<!-- <img src="<?= SITEURL ?>/assets/images/brand/logo.png" class="header-brand-img" alt="Reallist logo"> -->
						</a>
						<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
						<!-- <div class="header-navicon">
								<a href="#" data-toggle="search" class="nav-link d-lg-none navsearch-icon">
									<i class="fa fa-search"></i>
								</a>
							</div> -->
						<!-- <div class="header-navsearch">
								<a href="#" class=" "></a>
								<form class="form-inline mr-auto">
									<div class="nav-search">
										<input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" >
										<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
									</div>
								</form>
							</div> -->
						<div class="d-flex order-lg-2 ml-auto">
							<div class="dropdown d-none d-md-flex">
								<a class="nav-link icon full-screen-link">
									<i class="fe fe-maximize-2" id="fullscreen-button"></i>
								</a>
							</div>
							<!-- <div class="dropdown d-none d-md-flex country-selector">
									<a href="#" class="d-flex nav-link leading-none" data-toggle="dropdown">
										<img src="<?= SITEURL ?>/assets/images/us_flag.jpg" alt="img" class="avatar avatar-xs mr-1 align-self-center">
										<div>
											<strong class="text-dark">English</strong>
										</div>
									</a>
									<div class="language-width dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<a href="#" class="dropdown-item d-flex pb-3">
											<img src="<?= SITEURL ?>/assets/images/french_flag.jpg"  alt="flag-img" class="avatar  mr-3 align-self-center" >
											<div>
												<strong>French</strong>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<img src="<?= SITEURL ?>/assets/images/germany_flag.jpg"  alt="flag-img" class="avatar  mr-3 align-self-center" >
											<div>
												<strong>Germany</strong>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<img src="<?= SITEURL ?>/assets/images/italy_flag.jpg"  alt="flag-img" class="avatar  mr-3 align-self-center" >
											<div>
												<strong>Italy</strong>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<img src="<?= SITEURL ?>/assets/images/russia_flag.jpg"  alt="flag-img" class="avatar  mr-3 align-self-center" >
											<div>
												<strong>Russia</strong>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<img src="<?= SITEURL ?>/assets/images/spain_flag.jpg"  alt="flag-img" class="avatar  mr-3 align-self-center" >
											<div>
												<strong>Spain</strong>
											</div>
										</a>
									</div>
								</div> -->
							<!-- <div class="dropdown d-none d-md-flex">
									<a class="nav-link icon" data-toggle="dropdown">
										<i class="fa fa-bell-o"></i>
										<span class=" nav-unread badge badge-danger  badge-pill">4</span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<a href="#" class="dropdown-item text-center">You have 4 notification</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item d-flex pb-3">
											<div class="notifyimg">
												<i class="fa fa-envelope-o"></i>
											</div>
											<div>
												<strong>2 new Messages</strong>
												<div class="small text-muted">17:50 Pm</div>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<div class="notifyimg">
												<i class="fa fa-calendar"></i>
											</div>
											<div>
												<strong> 1 Event Soon</strong>
												<div class="small text-muted">19-10-2019</div>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<div class="notifyimg">
												<i class="fa fa-comment-o"></i>
											</div>
											<div>
												<strong> 3 new Comments</strong>
												<div class="small text-muted">05:34 Am</div>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<div class="notifyimg">
												<i class="fa fa-exclamation-triangle"></i>
											</div>
											<div>
												<strong> Application Error</strong>
												<div class="small text-muted">13:45 Pm</div>
											</div>
										</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item text-center">See all Notification</a>
									</div>
								</div> -->
							<!-- <div class="dropdown d-none d-md-flex">
									<a class="nav-link icon" data-toggle="dropdown">
										<i class="fa fa-envelope-o"></i>
										<span class=" nav-unread badge badge-warning  badge-pill">3</span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<a href="#" class="dropdown-item d-flex pb-3">
											<img src="<?= SITEURL ?>/assets/images/faces/male/41.jpg" alt="avatar-img" class="avatar brround mr-3 align-self-center">
											<div>
												<strong>Blake</strong> I've finished it! See you so.......
												<div class="small text-muted">30 mins ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<img src="<?= SITEURL ?>/assets/images/faces/female/1.jpg" alt="avatar-img" class="avatar brround mr-3 align-self-center">
											<div>
												<strong>Caroline</strong> Just see the my Admin....
												<div class="small text-muted">12 mins ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<img src="<?= SITEURL ?>/assets/images/faces/male/18.jpg" alt="avatar-img" class="avatar brround mr-3 align-self-center">
											<div>
												<strong>Jonathan</strong> Hi! I'am singer......
												<div class="small text-muted">1 hour ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<img src="<?= SITEURL ?>/assets/images/faces/female/18.jpg" alt="avatar-img" class="avatar brround mr-3 align-self-center">
											<div>
												<strong>Emily</strong> Just a reminder that you have.....
												<div class="small text-muted">45 mins ago</div>
											</div>
										</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item text-center">View all Messages</a>
									</div>
								</div> -->
							<!-- <div class="dropdown d-none d-md-flex">
									<a class="nav-link icon" data-toggle="dropdown">
										<i class="fe fe-grid"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  app-selector">
										<ul class="drop-icon-wrap">
											<li>
												<a href="#" class="drop-icon-item">
													<i class="icon icon-speech text-dark"></i>
													<span class="block"> E-mail</span>
												</a>
											</li>
											<li>
												<a href="#" class="drop-icon-item">
													<i class="icon icon-map text-dark"></i>
													<span class="block">map</span>
												</a>
											</li>

											<li>
												<a href="#" class="drop-icon-item">
													<i class="icon icon-bubbles text-dark"></i>
													<span class="block">Messages</span>
												</a>
											</li>
											<li>
												<a href="#" class="drop-icon-item">
													<i class="icon icon-user-follow text-dark"></i>
													<span class="block">Followers</span>
												</a>
											</li>
											<li>
												<a href="#" class="drop-icon-item">
													<i class="icon icon-picture text-dark"></i>
													<span class="block">Photos</span>
												</a>
											</li>
											<li>
												<a href="#" class="drop-icon-item">
													<i class="icon icon-settings text-dark"></i>
													<span class="block">Settings</span>
												</a>
											</li>
										</ul>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item text-center">View all</a>
									</div>
								</div> -->
							<div class="dropdown ">
								<a href="#" class="nav-link pr-0 leading-none user-img" data-toggle="dropdown">
									<img src="<?= SITEURL ?>/assets/images/star.jpg" alt="profile-img" class="avatar avatar-md brround">
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
									<a class="dropdown-item" style="cursor:pointer" data-toggle="modal" data-target="#changePassModal">
										<i class="dropdown-icon icon icon-user"></i> Change Password
									</a>
									<!-- <a class="dropdown-item" href="emailservices.html">
											<i class="dropdown-icon icon icon-speech"></i> Inbox
										</a>
										<a class="dropdown-item" href="editprofile.html">
											<i class="dropdown-icon  icon icon-settings"></i> Account Settings
										</a> -->
									<!-- <a class="dropdown-item" href="<?= SITEURL ?>/logout.php" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> --> <!-- OPT: ../logout -->
									<a class="dropdown-item" href="<?= SITEURL ?>/logout.php">
										<i class="dropdown-icon icon icon-power"></i> Logout
									</a>

									<!-- TODO: chk what is doing over here -->
									<!-- <form id="logout-form" action="../logout" method="POST" class="d-none">
										<input type="hidden" name="_token" value="zZmMzS63qa18RXY01BZGv6chzLXG1ppo7j1x0Zub">
									</form> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Sidebar menu-->
			<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
			<aside class="app-sidebar doc-sidebar">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div>
							<img src="<?= SITEURL ?>/assets/images/star.jpg" alt="user-img" class="avatar avatar-lg brround">
							<!-- <a href="editprofile.html" class="profile-img">
									<span class="fa fa-pencil" aria-hidden="true"></span>
								</a> -->
						</div>
						<div class="user-info">
							<h2>Master Admin</h2>
							<span>Masteradmin</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide"><span class="side-menu__label"><b>Masteradmin</b></span></a>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-tachometer"></i><span class="side-menu__label">Dashboard</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li>
								<!-- <a href="<?= SITEURL ?>/home2/index.php" class="slide-item">Dashboard</a> --> <!-- OPT: ../home2 -->
								<a onclick='alert("This Function is Coming Soon!!!")' class="slide-item">Dashboard</a>
							</li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-money"></i><span class="side-menu__label">Rent Pay</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li>
								<a href="<?= SITEURL ?>/rent/index.php" class="slide-item">Listing</a> <!-- OPT: ../rent/index -->
								<!-- <a onclick='alert("This Function is Coming Soon!!!")' class="slide-item">Listing</a> -->
							</li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-money"></i><span class="side-menu__label">Expenses</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li>
								<a href="<?= SITEURL ?>/expense/index.php" class="slide-item">Listing</a> <!-- OPT: ../expense/index -->
								<!-- <a onclick='alert("This Function is Coming Soon!!!")' class="slide-item">Listing</a> -->
							</li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-database"></i><span class="side-menu__label">Customers Settings</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li>
								<!-- <a href="<?= SITEURL ?>/customer/index.php" class="slide-item">Customer</a> --> <!-- OPT: ../customer/index -->
								<a onclick='alert("This Function is Coming Soon!!!")' class="slide-item">Customer</a>
							</li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-database"></i><span class="side-menu__label">Cards Settings</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li>
								<!-- <a href="<?= SITEURL ?>/card/superadmin_index.php" class="slide-item">All Cards</a> --> <!-- OPT: ../card/superadmin_index -->
								<a onclick='alert("This Function is Coming Soon!!!")' class="slide-item">All Cards</a>
							</li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">Users Settings</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li>
								<!-- <a href="<?= SITEURL ?>/user/superadmin_index.php" class="slide-item">Superadmins</a> --> <!-- OPT: ../user/superadmin_index -->
								<a onclick='alert("This Function is Coming Soon!!!")' class="slide-item">Superadmins</a>
							</li>
							<li>
								<!-- <a href="<?= SITEURL ?>/user/admin_index.php" class="slide-item">Admins</a> --> <!-- OPT: ../user/admin_index -->
								<a onclick='alert("This Function is Coming Soon!!!")' class="slide-item">Admins</a>
							</li>
							<li>
								<!-- <a href="<?= SITEURL ?>/user/agent_index.php" class="slide-item">Agents</a> --> <!-- OPT: ../user/agent_index -->
								<a onclick='alert("This Function is Coming Soon!!!")' class="slide-item">Agents</a>
							</li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">Banks Settings</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li>
								<!-- <a href="<?= SITEURL ?>/bank/index.php" class="slide-item">Listing</a> --> <!-- OPT: ../bank/index -->
								<a onclick='alert("This Function is Coming Soon!!!")' class="slide-item">Listing</a>
							</li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">Announcement</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li>
								<!-- <a href="<?= SITEURL ?>/announcement/index.php" class="slide-item">Listing</a> --> <!-- OPT: ../announcement/index -->
								<a onclick='alert("This Function is Coming Soon!!!")' class="slide-item">Listing</a>
							</li>
						</ul>
					</li>

					<li class="slide">
						<a class="side-menu__item" data-toggle="slide"><span class="side-menu__label"><b>Users</b></span></a>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">Users Management</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li>
								<a href="<?= SITEURL ?>/user/index/Superadmins/index.php" class="slide-item">Superadmins</a> <!-- OPT: ../user/index/Superadmins -->
								<!-- <a onclick='alert("This Function is Coming Soon!!!")' class="slide-item">Superadmins</a> -->
							</li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">My Cards</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li>
								<!-- <a href="<?= SITEURL ?>/card/index.php" class="slide-item">Card Details</a> --> <!-- OPT: ../card/index -->
								<a onclick='alert("This Function is Coming Soon!!!")' class="slide-item">Card Details</a>
							</li>
						</ul>
					</li>
					<!-- </ul>
					<div class="app-sidebar-footer">
						<a href="emailservices.html">
							<span class="fa fa-envelope" aria-hidden="true"></span>
						</a>
						<a href="profile.html">
							<span class="fa fa-user" aria-hidden="true"></span>
						</a>
						<a href="editprofile.html">
							<span class="fa fa-cog" aria-hidden="true"></span>
						</a>
						<a href="login.html">
							<span class="fa fa-sign-in" aria-hidden="true"></span>
							</a>
						<a href="chat.html">
							<span class="fa fa-comment" aria-hidden="true"></span>
						</a>
					</div> -->
			</aside>

			<div class="app-content  my-3 my-md-5">
				<div class="side-app">
					<marquee style="padding:8px;background-color:#FDD58C"><b>要好好的做，努力赚钱，美好未来！</b></marquee>