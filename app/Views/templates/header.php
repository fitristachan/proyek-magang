<!DOCTYPE html>
<html lang="en">

<head>
<pre><link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif"></pre>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Happiness Bookstore</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <!-- Bootstrap Font Icon CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
  
</head>

<body class="bg-light">
  <nav class="navbar bg-white fixed-top">
  <div class="container-fluid">
  <div class="navbar navbar-expand-lg bg-white">
   <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="fs-5 fw-bold text-primary" role="button"><span class="mx-auto p-1"><i class="bi bi-book-half"></i></i></span>Happiness Bookstore</span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
    <a class="nav-link active" aria-current="page" href="<?= base_url('/home/beranda')?>">Home</a>
    <a class="nav-link" href="<?= base_url('Main/stocks')?>">Stock</a>
    <a class="nav-link" href="<?= base_url('pos/cashier')?>">Cashier</a>
    <a class="nav-link" href="<?= base_url('Main/employee')?>">Employee</a>
    <a class="nav-link" href="<?= base_url('pos/history')?>">History</a>
</div>
</div>
</div>
  
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary" id="offcanvasNavbarLabel">Happiness Bookstore</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url('home/beranda')?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Main/stocks')?>">Stocks</a>
          </li>
          <a class="nav-link" href="<?= base_url('pos/cashier')?>">Cashier</a>
          <a class="nav-link" href="<?= base_url('Main/employee')?>">Employee</a>
          <a class="nav-link" href="<?= base_url('pos/history')?>">History</a>
        </ul>
      </div>
    </div>
            <!-- Avatar -->
            <div class="nav-item dropdown">
              <a class="navbar-brand dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i> <span class="mx-auto p-2"><?= $session->username ?></span>
              </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="<?=base_url('home/logout')?>">Log out</a></li>
                </ul>
            </div>
  </div>
</div>
</nav>

    <!-- Wrapper -->
    <div class="wrapper my-4 .mx-auto mt-5 pt-5">
        <!-- Main Container -->
        <div class="main container">
            <?php if(!empty($session->getFlashdata('success_message'))): ?>
                <div class="alert alert-success rouded-0">
                    <div class="d-flex">
                        <div class="col-11"><?= $session->getFlashdata('success_message') ?></div>
                        <div class="col-1 text-end"><a href="javascript:void(0)" onclick="$(this).closest('.alert').remove()" class="text-muted text-decoration-none"><i class="bi bi-x-circle"></i></a></div>
                    </div>
                </div>
            <?php endif ?>
            <?php if(!empty($session->getFlashdata('error_message'))): ?>
                <div class="alert alert-danger rouded-0">
                    <div class="d-flex">
                        <div class="col-11"><?= $session->getFlashdata('error_message') ?></div>
                        <div class="col-1 text-end"><a href="javascript:void(0)" onclick="$(this).closest('.alert').remove()" class="text-muted text-decoration-none"><i class="bi bi-x-circle"></i></a></div>
                    </div>
                </div>
            <?php endif ?>