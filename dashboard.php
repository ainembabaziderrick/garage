<?php
session_start();
include 'db.php';

if (!isset($_SESSION['login_id']) && !isset($_SESSION['garage_id'])) {
    header('Location: login.php');
    exit();
}

$garage_id = $_SESSION['garage_id'];

// Fetch counts
$serviceCountQuery = "SELECT COUNT(*) as total_services FROM services";
$serviceCountResult = $connection->query($serviceCountQuery);
$serviceCount = $serviceCountResult->fetch_assoc()['total_services'];

$customerCountQuery = "SELECT COUNT(*) as total_customers FROM customers ";
$customerCountResult = $connection->query($customerCountQuery);
$customerCount = $customerCountResult->fetch_assoc()['total_customers'];

$staffCountQuery = "SELECT COUNT(*) as total_staff FROM staff ";
$staffCountResult = $connection->query($staffCountQuery);
$staffCount = $staffCountResult->fetch_assoc()['total_staff'];

$salesCountQuery = "SELECT COUNT(*) as total_sales FROM cart_items WHERE is_paid = 1";
$salesCountResult = $connection->query($salesCountQuery);
$salesCount = $salesCountResult->fetch_assoc()['total_sales'];

include 'includes/head.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php include 'includes/header.php';?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'includes/sidebar.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">
              <?= $_SESSION['login_name'] ?? "Not Logged In" ?>
              </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $serviceCount ?></h3>
                <p>Services</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/garage/services/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $customerCount ?><sup style="font-size: 20px"></sup></h3>
                <p>Customers</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="/garage/customer.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $staffCount ?></h3>
                <p>Staff</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/garage/staff.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $salesCount ?></h3>
                <p>Sales</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="/garage/track_sales.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Additional Content Can Be Added Here -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'includes/footer.php';?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?php include 'includes/scripts.php';?>
</body>
</html>
