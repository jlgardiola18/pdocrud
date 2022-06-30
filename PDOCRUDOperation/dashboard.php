<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHP CRUD Operation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

</head>
<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <?php 
            require_once('session.php');
            require_once('navbar.php');

            if(isset($_REQUEST['del'])){

                $uid = intval($_GET['del']);
                $sql = "DELETE FROM tblusers WHERE ID=:id";
                $query=$dbh->prepare($sql);
        
                $query->bindParam(':id',$uid,PDO::PARAM_STR);
                $query->execute();
        
                echo "<script>alert('Record Deleted Successfully!');</script>";
                echo "<script>window.location.href='dashboard.php'</script>";
        
            }
            
        ?>
  
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
    
        <!-- Brand Logo -->
        <a href="dashboard.php" class="brand-link">
        <span class="brand-text font-weight-light">PHP CRUD Operation</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="upload/logo.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo htmlentities($result->admin_name);?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Maintenance
                        <span class="right badge badge-danger"></span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Members
                        <span class="right badge badge-danger"></span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Reports
                        <span class="right badge badge-danger"></span>
                    </p>
                </a>
            </li>
            </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Maintenance</h1>
                    </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Maintenance</li>
                    </ol>
                </div>
                </div>
    </div><!-- /.container-fluid -->
        </section>

    <!-- Main content -->
        <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Records</h3>
                <div class="card-tools">
                    <a class="btn btn-tool" href="insert.php">Registration Form</a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                    <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button> -->
                </div>
            </div>
        <div class="card-body">
	    <table class="table" id="example1">
            <thead>
                <th>#</th>
                <th>Photos</th>
                <th>Name</th>
                <th>Email </th>
                <th>Contact</th>
                <th>Address</th>
                <th>Tools</th>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM tblusers";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);

                    $cnt=1;
                    if($query->rowCount() > 0 ){
                        foreach($results as $result)
                {
                ?>
                    <tr>
                        <td><?php echo htmlentities($cnt);?></td>
                        <td><img src="<?php echo htmlentities(!empty($result->photo))? ' ' .htmlentities($result->photo): 'upload/default.png';?>" class="img-circle" width="50" height="50"></td>
                        <td><?php echo htmlentities($result->first_name. ' ' .$result->last_name);?></td>
                        <td><?php echo htmlentities($result->email);?></td>
                        <td><?php echo htmlentities($result->contact_number);?></td>
                        <td><?php echo htmlentities($result->address);?></td>
                        <td>
                            <a href="profile.php?id=<?php echo htmlentities($result->ID);?>" class="btn btn-success btn-sm"><span class="fas fa-image"></span></a>
                            <a href="update.php?id=<?php echo htmlentities($result->ID);?>" class="btn btn-primary btn-sm"><span class="fas fa-edit"></span></a>
                            <a href="dashboard.php?del=<?php echo htmlentities($result->ID);?>" class="btn btn-danger btn-sm" onClick="return confirm('Do you really want to delete?')"><span class="fas fa-trash"></span></a></td>
                    </tr>

                <?php 
                    $cnt++;
                }}
                ?>

            </tbody>
	    </table>
    </div>
</div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>