<?php require_once "cek_unit.php"; ?>
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <p>
            <font size="5px"><b>Data Permintaan</b></font>
          </p>
          <p>Data Permintaan Barang</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="index.php?p=datapesanan" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <p>
            <font size="5px"><b>Data Stok Barang</b></font>
          </p>
          <p>Data Stok Barang</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="index.php?p=material" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <p>
            <font size="5px"><b>Tata Tertib</b></font>
          </p>
          <p>Tata Tertib Permintaan Barang</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="" class="small-box-footer" data-toggle="modal" data-target="#myModal">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Tata Tertib Permintaan Barang</b></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <p>1. Unit menginput data permintaan Barang di form permintaan Barang.</p>
        <p>2. Unit menunggu permintaan di konfirmasi oleh Penyelia SDM & UMUM.</p>
        <p></p>
      </div>
      <!-- footer modal -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>