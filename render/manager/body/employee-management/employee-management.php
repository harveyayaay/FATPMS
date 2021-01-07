<?php include '../../header/header.php'; ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <!-- sidebar menu -->
        <?php include '../../navigation/navigation.php'; ?>
      <!-- /sidebar menu -->

      <!-- top navigation -->
        <?php include '../../navigation/top-navigation.php'; ?>
      <!-- /top navigation -->

      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              
                  
                  <!-- activity management (productive) -->
                  <?php include 'profile-view.php'; ?>
                  <!-- /activity management (productive) -->

            </div>
          </div>
        </div>
        <!-- /page content -->
     
    </div>
  </div>
</body>
<?php include '../../footer/footer.php'; ?>