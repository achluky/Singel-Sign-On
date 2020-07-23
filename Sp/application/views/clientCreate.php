<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>PDDikti &mdash; Identity Platform</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $this->config->item('sp');?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('sp');?>assets/modules/fontawesome/css/all.min.css">
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

                <?php if($info!=""){?>
                  <div class="alert alert-info alert-dismissible show fade">
                    <div class="alert-body">
                      <button class="close" data-dismiss="alert">
                        <span>×</span>
                      </button>
                      <?php echo $info ?>
                    </div>
                  </div>
                <?php } ?>
                <div class="card">
                  <form class="needs-validation" novalidate="" action="<?php echo $this->config->item('sp');?>client/create/action" method="POST">
                    <div class="card-header">
                      <h4>Create Client Data</h4>
                    </div>
                    <div class="card-body">                      
                      <div class="form-group">
                        <label>Application Name</label>
                        <input type="text" class="form-control" required="" name="name">
                        <div class="invalid-feedback">
                          Apa Nama Aplikasi Anda
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Email PIC</label>
                        <input type="email" class="form-control" required="" name="pic">
                        <div class="invalid-feedback">
                          Email yang bertanggung Jawab atas Aplikasi Anda
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Redirect URL</label>
                        <input type="text" class="form-control" required="" name="redirect_url">
                        <div class="invalid-feedback">
                          Url yang diarahkan ketika selesai autentikasi
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Logout URL</label>
                        <input type="text" class="form-control" required="" name="logout_url">
                        <div class="invalid-feedback">
                          Url logout aplikasi anda
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-left">
                      <button class="btn btn-primary">Create</button>
                    </div>
                  </form>
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

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="<?php echo $this->config->item('sp');?>assets/js/scripts.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/js/custom.js"></script>
</body>
</html>