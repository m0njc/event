<?php $this->view('header/header'); ?>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo base_url()?>/templates/images/logo.png" alt="IMG">
				</div>

				<div class="login100-form">

					<!-- Tab Navigation -->
					<ul class="nav nav-tabs">
		  				<li class="active"><a id="first" data-toggle="tab" href="#login">Coming Members</a></li>
		  				<li><a data-toggle="tab" href="#register">New Comer</a></li>
					</ul>
					<!-- Tab Navigation -->

<div class="tab-content">
<!-- Login Tab Content -->
  <div id="login" class="tab-pane in active">
		<span class="login100-form-title">
		Hi, Welcome back!
		</span>
	<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
		<input class="input100" type="text" name="email" placeholder="Email"  autocomplete="off">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-envelope" aria-hidden="true"></i>
		</span>
	</div>
	<div class="text-center">OR</div>
	<div class="wrap-input100 validate-input" data-validate = "Password is required">
		<input class="input100" type="text" name="phone" placeholder="Phone Number" autocomplete="off">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-phone" aria-hidden="true"></i>
		</span>
	</div>
	
	<div class="container-login100-form-btn">
		<button class="login100-form-btn">
			Submit
		</button>
	</div>
  </div>
<!-- Login Tab Content -->

<!-- Register Tab Content -->
  <div id="register" class="tab-pane fade">
		<span class="login100-form-title">
		Hi, Welcome!
	</span>

	<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
		<input class="input100" type="text" name="fname" placeholder="First Name">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-user" aria-hidden="true"></i>
		</span>
	</div>

	<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
		<input class="input100" type="text" name="lname" placeholder="Last Name">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-user" aria-hidden="true"></i>
		</span>
	</div>

	<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
		<input class="input100" type="text" name="email" placeholder="Email">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-envelope" aria-hidden="true"></i>
		</span>
	</div>

	<div class="wrap-input100 validate-input" data-validate = "Password is required">
		<input class="input100" type="text" name="phone" placeholder="Phone Number">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-phone" aria-hidden="true"></i>
		</span>
	</div>
	
	<div class="container-login100-form-btn">
		<button class="login100-form-btn">
			Register
		</button>
	</div>

  </div>
  <!-- Register Tab Content -->
				</div>
			</div>
		</div>
	</div>
<?php $this->view('footer/footer'); ?>

<script type="text/javascript">
 $(document).ready(function() {
 	$('#first').click();
 });
</script>