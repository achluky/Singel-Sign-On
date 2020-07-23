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
  <link rel="stylesheet" href="<?php echo $this->config->item('sp');?>assets/modules/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $this->config->item('sp');?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('sp');?>assets/css/components.css">
</head>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                PD-DIKTI <br/>Identity Platform
            </div>
            <div class="card card-primary">
              <div class="card-body">

                <?php if(isset($error)){?>
                <div class="alert alert-info alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>×</span>
                    </button>
                    <?php echo $error ?>
                  </div>
                </div>
                <?php } ?>
            
                <form method="POST" action="" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="input" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Silahkan isi username anda
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="#" class="text-small">
                          Lupa Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                    Silahkan isi password anda
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Sign In
                    </button>
                  </div>
                </form>

              </div>
            </div>
            <div class="simple-footer">
              PDDikti - Pangkalan Data Pendidikan Tinggi. &copy;  <?= date("Y") ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo $this->config->item('sp');?>assets/modules/jquery.min.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/popper.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/tooltip.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/modules/moment.min.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/js/stisla.js"></script>
  
  <!-- Template JS File -->
  <script src="<?php echo $this->config->item('sp');?>assets/js/scripts.js"></script>
  <script src="<?php echo $this->config->item('sp');?>assets/js/custom.js"></script>
</body>
</html>