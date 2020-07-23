<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>PDDikti &mdash; Identity Platform</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $this->config->item('sp');?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('sp');?>assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo $this->config->item('sp');?>assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('sp');?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('sp');?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $this->config->item('sp');?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('sp');?>assets/css/components.css">
</head>
<body class="layout-2">
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <a href="index.html" class="navbar-brand sidebar-gone-hide">PDDikti &mdash; Identity Platform</a>
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        <div class="nav-collapse">
          <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <ul class="navbar-nav">
            <li class="nav-item active"><a href="<?php echo $this->config->item('sp');?>dashboard" class="nav-link"><i class="fas fa-home"></i> Beranda</a></li>
          </ul>
        </div>
        <form class="form-inline ml-auto"></form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown ">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?php echo $this->config->item('sp');?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $this->session->userdata('name'); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo $this->config->item('sp');?>welcome/signout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
            <ul class="sidebar-menu">
              <li class="dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Clients</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?php echo $this->config->item('sp');?>client/create"><i class="fas fa-plus-circle"></i> Create Client</a></li>
                  <li><a class="nav-link" href="<?php echo $this->config->item('sp');?>client/daftar"><i class="fas fa-list"></i> Client List</a></li>
                </ul>
              </li>       
            </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

          <div class="section-body">
                <div class="card">

                  <div class="card-header">
                    <h4>Clients</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th>Application Name</th>
                            <th>Client ID</th>
                            <th>Client secret</th>
                            <th>Creation date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>        
                          <?php foreach($result->result() as $row){?>                         
                          <tr>
                            <td><?php echo $row->name?></td>
                            <td><?php echo $row->client_id?></td>
                            <td><?php echo $row->client_secret?></td>
                            <td><?php echo $row->date?></td>
                            <td><a href="<?php echo $this->config->item('sp');?>client/detail/<?php echo $row->client_id?>" class="btn btn-primary">Detail</a></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
          </div>

        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo $this->config->item('sp');?>assets/modules/jquery.min.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/popper.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/tooltip.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/moment.min.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="<?php echo $this->config->item('sp');?>assets/modules/sticky-kit.js"></script>

  <!-- JS Libraies -->
  <script src="<?php echo $this->config->item('sp');?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?php echo $this->config->item('sp');?>assets/js/page/modules-datatables.js"></script>

  <!-- Template JS File -->
  <script src="<?php echo $this->config->item('sp');?>assets/js/scripts.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/js/custom.js"></script>
</body>
</html>