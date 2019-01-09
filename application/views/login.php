<?php $this->view('header/header'); ?>
	
	<div class="limiter">
		<div class="container-login100">


<!-- Login Tab Content -->
  <div id="login" class="tab-pane in active">
		<div style="margin:10px; text-align: center;color: white;">
			<h3>Domus Cordis</h3>
			<h5>Event Registration System</h5>
		</div>
		 <?php echo form_open('Login/doLogin'); ?>
		       <label class="error-label" ><?php echo $this->session->flashdata('login_error'); ?></label>
      <label class="" ><?php echo $this->session->flashdata('login_success'); ?></label>

	<div class="wrap-input100">
		<input class="input100" type="text" name="tbx_username" placeholder="Username" id="tbx_username">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-user" aria-hidden="true"></i>
		</span>
	</div>

	<div class="wrap-input100 validate-input" data-validate = "Password is required">
		<input class="input100" type="password" name="tbx_password" id="tbx_password" placeholder="Password">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-key" aria-hidden="true"></i>
		</span>
	</div>
	
	<div class="container-login100-form-btn">
		<button class="login100-form-btn" type="Submit">
			Submit
		</button>
	</div>
 <?php echo form_close();?>
  </div>
<!-- Login Tab Content -->	</div>
	
	

<?php $this->view('footer/footer'); ?>
	