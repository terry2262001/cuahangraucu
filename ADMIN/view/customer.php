<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>
  
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>


<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="../JS/customer.js?v7"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <?php
          if (isset($_SESSION['username'])) {
          ?>
          <div class="d-flex justify-content-center align-items-center gap-2">
            <a href="#" class=""><?= $_SESSION['username']; ?></a>
            <a class="btn btn-warning ml-2" href="../view/logout.php">Log out</a>
          </div>
          <?php
          } else {
          ?>
             <a href="../view/index.php"><i class="fa fa-user" style="font-size:30px;color:black"></i></a>
          <?php
          }
          ?>
      <li class="nav-item">
     
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #7fad39;">
    <!-- Brand Logo -->
    <div class="brand-link">
      <img src="./PICTURE/logo.png" alt="AdminHMK Logo" class="brand-image img-circle elevation-3" style="border-radius: 0;">
      <a href="#"><span class="brand-text font-weight-light" style="font-weight: 1000!important;color: #c2c7d0;">OGANI </span></a>
    <div>
          
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info">
          <a class="d-block"><?php echo $data["title"]?></a>
        </div>
      </div>
      <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                      Tables
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="">
                    <li class="nav-item" style="list-style-type:none;">
                      <a href="../view/sanpham.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sản phẩm</p>
                      </a>
                    </li>
                  </ul>
                  
                </li>
              </ul>
            </nav>
    </div>
    
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $data["title"]?></h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
    <div class="container-fluid">
      
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <a  href="../view/userpage.php">

                <button type="button" class="btn btn-primary" data-toggle="modal">Thêm User</button>  
              </a>
                
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Stat  us</th>
                    <th style="text-align: center;">Action</th>
                  </tr>
                  </thead>
                  <tbody id="user_content">
                    <?php

                    for($i = 0 ; $i< count($data["users"]);$i++){
                      echo '<tr>';
                      echo '<td class="serial">'.$data["users"][$i]["userid"].'</td>';
                      echo '<td>'.$data["users"][$i]["fullname"].'</td>';
                      echo '<td>'.$data["users"][$i]["phone"].'</td>';
                      echo '<td>'.$data["users"][$i]["email"].'</td>';
                      echo '<td>complete</td>';
                      echo '<td>
                      <a href="../controller/UserController.php?action=edit&id='.$data["users"][$i]["userid"].'"><button onclick="" type="button" class="btn btn-warning" data-toggle="modal" style=" margin-left: 20%; margin-right: 18%; width: auto;">SỬA</button>
                      <a href="../controller/UserController.php?action=delete&id='.$data["users"][$i]["userid"].'"><button onclick="" type="button" class="btn btn-danger">XÓA</button>
                      </td>';
                      echo'</tr>';

                    }
                    ?> 
                    


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
                    

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>



<div class="modal fade" id="modal_themuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="../controller/UserController.php"  method="post">
      <input type="hidden" name="user_action" value="user_create"/>

          <input
            type="text"
            placeholder="Tên khách hàng"
            name="tenkhachhang"
            id="tenkhachhang"
            class="margin-top20"
          />
          <input
            type="tel"
            placeholder="Phone"
            name="phone"
            id="phone"
            class="margin-top20"
            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
            maxlength="10"
          /> 
          <input
            type="text"
            placeholder="Username"
            name="username"
            id="username"
            class="margin-top20"
          />
          <input    
            type="password"
            placeholder="Password"
            name="password"
            id="password"
            class="margin-top20"
          />
          <input 
            type="email" 
            placeholder="Email" 
            name="email" 
            id="email"
            class="margin-top20" />
            <input 
            type="status" 
            placeholder="Status" 
            name="status" 
            id="status"
            class="margin-top20" />
            <br />
            <button type="submit" name="create_user" class="btn btn-primary">Thêm</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="dong_themuser">Đóng</button>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>




<button type="button" data-toggle="modal" data-target="#modal_suauser" id="btn_suauser" style="display:none"></button>
<div class="modal fade" id="modal_suauser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sửa User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="../PHP/customer_controller.php" method="post">
          <input
            type="text"
            placeholder="Tên khách hàng"
            name="tenkhachhang"
            id="edit_tenkhachhang"
            class="margin-top20"
          />
          <input
            type="tel"
            placeholder="Phone"
            name="phone"
            id="edit_phone"
            class="margin-top20"
            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
            maxlength="10"
          /> 
          <input
            type="text"
            placeholder="Username"
            name="username"
            id="edit_username"
            class="margin-top20"
          />
          <input    
            type="password"
            placeholder="Password"
            name="password"
            id="edit_password"
            class="margin-top20"
          />
          <input 
            type="email" 
            placeholder="Email" 
            name="email" 
            id="edit_email"
            class="margin-top20" />
            <br />
            <button type="button" onclick="suauser()" class="btn btn-primary">Cập nhật</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="dong_suauser">Đóng</button>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>












</body>
</html>
