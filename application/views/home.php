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
		  				<li class="active"><a id="first" data-toggle="tab" href="#register">New Comer</a></li>
		  				<li><a data-toggle="tab" href="#login">Coming Members</a></li>
					</ul>
					<!-- Tab Navigation -->

<div class="tab-content">
<!-- Register Tab Content -->
  <div id="register" class="tab-pane in active">
		<span class="login100-form-title">
		Hi, Welcome!
	</span>
<?php
$attributes = array('id' => 'form-signup');
             echo form_open('',$attributes); ?>
	<div class="wrap-input100 validate-input" data-validate = "First email is required">
		<input class="input100" type="text" name="fname" id="fname" placeholder="Nama Depan">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-user" aria-hidden="true"></i>
		</span>
	</div>

	<div class="wrap-input100 validate-input" data-validate = "Last name is required">
		<input class="input100" type="text" name="lname" id="lname" placeholder="Nama Belakang">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-user" aria-hidden="true"></i>
		</span>
	</div>

	<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
		<input class="input100" type="text" name="email" id="email" placeholder="Email">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-envelope" aria-hidden="true"></i>
		</span>
	</div>

	<div class="wrap-input100 validate-input" data-validate = "Phone is required">
		<input class="input100" type="text" name="phone" id="phone" placeholder="No HP (WhatsApp)">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			+62
		</span>
	</div>

	<div class="wrap-input100 validate-input" data-validate = "Phone is required">
        <input class="input100" type="text" name="dateOfBirth" id="dateOfBirth" placeholder="Tanggal Lahir" autocomplete="off">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </span>
	</div>

	<div class="wrap-input100 validate-input" data-validate = "Paroki is required">
		<select class="input100"  name="parish" id="parish" placeholder="Paroki" onchange="changeFunc();">
			<option>Choose Parish</option>
			<?php if($parishes) {
				foreach ($parishes as $parish) { ?>
					<option value="<?php echo $parish['parishId']; ?>"><?php echo $parish['parishName']; ?></option>
			<?php }
			 }?>
			<option value="999">Others...</option>
		</select>
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-home" aria-hidden="true"></i>
		</span>
	</div>

	<div id="other-parish" class="hide-other-parish wrap-input100 validate-input" data-validate = "Paroki is required">
		<input class="input100" type="text" name="otherParish" id="otherParish" placeholder="Paroki">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-home" aria-hidden="true"></i>
		</span>
	</div>

	<div class="wrap-input100 validate-input" data-validate = "Profesi is required">
		<input class="input100" type="text" name="occupation" id="occupation" placeholder="Profesi">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-user" aria-hidden="true"></i>
		</span>
	</div>


	<div class="container-login100-form-btn">
		<input class="input100" type="text" name="id" id="id" value="<?php echo $id; ?>" hidden />

		<button class="login100-form-btn">
			Register
		</button>
	</div>
	 <?php echo form_close(); ?>

  </div>
  <!-- Register Tab Content -->
  <!-- Login Tab Content -->
  <div id="login" class="tab-pane fade">
		<span class="login100-form-title">
		Hi, Welcome back!
		</span>
		<?php
$attributes = array('id' => 'form-signin');
             echo form_open('',$attributes); ?>
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
	 <?php echo form_close(); ?>
  </div>
<!-- Login Tab Content -->
				</div>
			</div>
		</div>
	</div>
<?php $this->view('footer/footer'); ?>

<script type="text/javascript">
 $(document).ready(function() {
 	$('#first').click();
 	document.getElementById("form-signup").onkeypress = function(e) {
	  var key = e.charCode || e.keyCode || 0;     
	  if (key == 13) {
	    e.preventDefault();
	  }
	}
 });


 $('form#form-signup').submit(function(e) {
    var form = $(this);
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('home/doRegister/').$id; ?>",
        data: form.serialize(),
        success: function(data){
        	let obj = JSON.parse(data)
        	alert(obj.message)
        	$('form#form-signup').find('input:text').val(''); 
        },
        error: function() { alert("Error posting feed."); }
   });

});

 $('form#form-signin').submit(function(e) {
    var form = $(this);
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('home/doLogin/').$id; ?>",
        data: form.serialize(),
        success: function(data){
        	alert(data);
        },
        error: function() { alert("Error posting feed."); }
   });

});

      $(document).ready(function() {
        $('#dateOfBirth').daterangepicker({
          locale: {
            format:'DD-MM-YYYY',
          },
          singleDatePicker: true,
          calender_style: "picker_4"
        });
      });

      function changeFunc(){
      	var parish = document.getElementById("parish");
      	if(parish.value==999) {
      		$('#other-parish').removeClass('hide-other-parish');
      		$('#other-parish').addClass('show-other-parish');

      	}
      	else {
      		$('#other-parish').removeClass('show-other-parish');
      		$('#other-parish').addClass('hide-other-parish');

      	}
      }


//       $(document).ready(function () {
//     $("#parish").keyup(function () {
//     	let char = $("#parish").val();
//     	if(char.length < 3) return;
//         $.ajax({
//             type: "GET",
//             url: "<?php echo base_url(); ?>" + "Parish/getParish?parish="+char,
//             dataType: "json",
//             success: function (data) {
//             	if(data.length > 0) {
//             		$('#dropDownParish').empty();
//             		data.forEach(function(item) {
// 					     $('#dropDownParish').append('<li role="displayCountries" ><a role="menuitem dropdownCountryli" class="dropdownlivalue">' + item['parishName'] + '</a></li>');
// 					});
//             	}
//             }
//         });
//     });
//     $('ul.txtcountry').on('click', 'li a', function () {
//         $('#parish').val($(this).text());
//     });
// });

    </script>