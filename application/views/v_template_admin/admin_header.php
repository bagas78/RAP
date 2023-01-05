<?php $set = $this->query_builder->view_row("SELECT * FROM t_logo"); ?>

<!DOCTYPE html>
<html>  
<head> 
  <meta charset="utf-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <title><?= strtoupper(@$title) ?> | <?=@$set['logo_nama'] ?></title> 
  <!-- <link rel="shortcut icon" href="<?php echo base_url() ?>assets/gambar/icon.png" /> -->
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 --> 
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">   
  <!-- Font Awesome --> 
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->  
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->   
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins 
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/dist/css/skins/_all-skins.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Data Table -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/dist/css/skins/_all-skins.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

  <!-- jqueryui css-->
  <link href="<?php echo base_url() ?>assets/css/jquery-ui.css" rel="stylesheet">

  <!--material icon-->
  <link href="<?php echo base_url() ?>adminLTE/dist/css/material/material-icon.css" rel="stylesheet"/>

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>adminLTE/bower_components/jquery/dist/jquery.min.js"></script>

  <script src="<?php echo base_url() ?>adminLTE/bower_components/ckeditor/ckeditor.js"></script>

  <!--number format-->
  <script src="<?php echo base_url() ?>assets/js/number_format.js"></script>

  <!--date format-->
  <script src="<?php echo base_url() ?>assets/js/moment.js"></script>

  <!--jquery-ui-->
  <script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>

  <!--alert-->
  <script src="<?php echo base_url('assets/') ?>sweetalert/sweet-alert.js"></script>

<style type="text/css">
  ::-webkit-scrollbar {
    width: 10px;
    height: 10px;
  }

  ::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, 0.2);
  }

  ::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0);
  }
 .text-image-border{
    width: 50px;  
    height: 50px;
    background-color: #e1e3e2
 }
 .text-image{
    position: absolute;
    top: 25px;
    left: 40px;
    font-size: 25px;
    transform: translate(-50%, -50%);
 }
  /*timer*/
  .without_ampm::-webkit-datetime-edit-ampm-field {
   display: none;
 }
 input[type=time]::-webkit-clear-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   -o-appearance: none;
   -ms-appearance:none;
   appearance: none;
   margin: -10px; 
 }
 hr{
  margin-bottom: 20px;
  border: 0;
  margin-top: 0;
  border-top: 20px solid #F2F2F2;
 }
 .clock {
    font-size: 18px;
    color: white;
    margin: 0;
    position: absolute;
    top: 50%;
    left: 37.5vw;
    transform: translateY(-50%);
    background-color: #666;
    padding: 5px 30px 5px 30px;
    border-radius: 50px;
 }
 .title-app{
  float: left;
  line-height: 3.7;
  color: white;
  margin-left: 20px;
 }
 @media (max-width: 767px) {
    .clock {
    left: 37vw;
    }
    .title-app{
      display: none; 
    }
  }

.block{
  margin-top: 1px;
}

.active {
    background: #eee;
}

thead{
  background: aliceblue;
}

.bg-alice{
  background: aliceblue;
  padding: 2%;
  margin: 0;
}

</style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="text-align: center;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <span class="title-app"><?=@$set['logo_nama'] ?> </span>

      <span class="clock" id="clock"></span>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         <li>
            <a href="#" data-toggle="control-sidebar"><i style="padding-top: 5px;" class="material-icons">settings</i></a>
          </li>
          
        </ul>
      </div>
      
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">

          <?php if ($this->session->userdata('foto') == ''): ?>
            <img src="<?php echo base_url() ?>assets/gambar/user/no.jpg" class="img-circle" alt="User Image"  style="height: 45px;">
          <?php else: ?>
            <img src="<?php echo base_url() ?>assets/gambar/user/<?php echo $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image"  style="height: 45px;">
          <?php endif ?>
          
        </div>
        <div class="pull-left info">
          <p><?php 
              $n = $this->session->userdata('name'); 
              if (strlen($n) > 22) {
                echo substr($n,0,22).' ...';
              } else {
                echo substr($n,0,22);
              } ?>    
          </p>
          <a><i class="fa fa-user text-dark"></i> 
          <?php switch ($this->session->userdata('level')) {
            case 1:
              echo 'Admin';
              break;
            case 2:
              echo 'Owner';
              break;
          } ?></a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <br/>
          
         <li>
          <a href="<?php echo base_url() ?>dashboard">
            <div class="col-md-1 col-xs-1"><i class='material-icons'>dashboard</i></div> <div class="col-md-5 col-xs-5"><span>Dashboard</span></div>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">import_contacts</i></div> 
            <div class="col-md-5 col-xs-5"><span>Kontak</span></div>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li>
              <a href="<?php echo base_url('kontak/supplier') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Supplier</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('kontak/pelanggan') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Pelanggan</span>
              </a>
            </li>
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">add_shopping_cart</i></div> 
            <div class="col-md-5 col-xs-5"><span>Pembelian</span></div>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li>
              <a href="<?php echo base_url('pembelian/bahan') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Master Bahan</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('pembelian/po') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Purchase Order ( PO )</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('pembelian/umum') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Pembelian Umum</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('pembelian/avalan') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Bahan Avalan</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('pembelian/utama') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Bahan Baku Utama</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('pembelian/bayar') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Pembayaran Hutang</span>
              </a>
            </li>
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">multiline_chart</i></div> 
            <div class="col-md-5 col-xs-5"><span>Produksi</span></div>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li>
              <a href="<?php echo base_url('produksi/peleburan') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Peleburan</span>
              </a>
            </li> 
            <li>
              <a href="<?php echo base_url('produksi/pesanan') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Pesanan Produksi</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('produksi/transaksi') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Transkasi Produksi</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('produksi/proses') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Proses Produksi</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('produksi/pewarnaan') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Pewarnaan</span>
              </a>
            </li>
            
          </ul>
        </li>

        <li>
          <a href="<?php echo base_url('master_produk') ?>">
            <div class="col-md-1 col-xs-1"><i class="material-icons">widgets</i></div> <div class="col-md-5 col-xs-5"><span>Master Produk</span></div>
          </a>
        </li>

        <li>
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">local_grocery_store</i></div> <div class="col-md-5 col-xs-5"><span>Penjualan</span></div>
          </a>
        </li>

        <li>
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">equalizer</i></div> <div class="col-md-5 col-xs-5"><span>Keuangan</span></div>
          </a>
        </li>

        <li>
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">assignment</i></div> <div class="col-md-5 col-xs-5"><span>Laporan</span></div>
          </a>
        </li>

        <li>
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">layers</i></div> <div class="col-md-5 col-xs-5"><span>Warehouse / Inventory</span></div>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">settings</i></div> 
            <div class="col-md-5 col-xs-5"><span>Pengaturan</span></div>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li>
              <a href="<?php echo base_url('pengaturan/pajak') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Setting Pajak</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('pengaturan/backup') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Backup Database</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('pengaturan/logo') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Logo dan Perusahaan</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Hak Akses</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('pengaturan/pegawai') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Master Pegawai</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('pengaturan/mesin') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Master Mesin</span>
              </a>
            </li>
            
            
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


<!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" style="background: white;">
       <ul class="control-sidebar-menu">
          <li>
            <a href="<?php echo base_url() ?>profile">
              <i class="fa fa-sort"></i><span> Profile</span>
            </a>
          </li>

          <li>
            <a href="#" onclick="logout('<?php echo base_url('login/logout') ?>')">
              <i class="fa fa-sort"></i><span> Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </aside>
  <!-- /.control-sidebar -->
    

  