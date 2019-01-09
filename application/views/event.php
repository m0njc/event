<?php $this->view('header/header'); ?>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-event100">
        <div class="row" style="margin-bottom: 20px;">
          <label class="error-label" ><?php echo $this->session->flashdata('error'); ?></label>
      <label class="success-label" ><?php echo $this->session->flashdata('success'); ?></label>
        </div>
					<table class="table">
                      <thead>
                        <tr>
                          <th>Event Name</th>
                          <th>Date </th>
                          <th width="250px">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if($events) {
                          foreach ($events as $event) {
                            ?>
                        <tr>
                          <td><?php echo $event['eventName']; ?></td>
                          <td><?php echo date("d M Y",strtotime($event['eventDate'])); ?></td>
                          <td>
                            <a data-toggle="modal" data-target="#exampleModalCenter" data-eventid="<?php echo $event['eventId']; ?>" data-eventname="<?php echo $event['eventName']; ?>" data-eventdate="<?php echo date("d-m-Y",strtotime($event['eventDate'])); ?>" class="table-action open-edit-modal"><i class="fa fa-pencil"></i></a>
                            <a onclick="return confirm('Are you sure?')" href="<?php echo site_url('Event/doDelete/').$event['eventId'];?>" class="table-action"><i class="fa fa-times"></i></a>
                            <a class="table-action" href="<?php echo site_url('Event/Participant/').$event['eventId'];?>"><i class="fa fa-list"></i></a>
                            <a class="table-action" href="<?php echo site_url('Home/Register/').$event['eventId'];?>">Registration <i class="fa fa-arrow-right"></i></a>
                          </td>
                        </tr>

                            <?php
                          }
                        } ?>

                      </tbody>
                    </table>

			</div>
      <a class="floating-button fb-create" href="#" data-toggle="modal" data-target="#exampleModalCenter">Create New Event</a>
      <a class="floating-button fb-logout" href="<?php echo site_url('Logout')?>">Log Out </a>
		</div>
	</div>

  <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('Event/doAdd'); ?>
        <div class="row">
          <div class="col-md-10 offset-md-1">
            <input class="input100" type="text" name="tbx_eventName" id="tbx_eventName" placeholder="Event Name"  autocomplete="off">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-home" aria-hidden="true"></i>
            </span>
          </div>

          <div class="col-md-10 offset-md-1" >
            <input class="input100" type="text" name="tbx_date" id="tbx_date" placeholder="Event Date" autocomplete="off">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-calendar" aria-hidden="true"></i>
            </span>
          </div>
        </div>
        <div class="row">          
          <div class="col-md-4 offset-md-4">
            <input type="text" name="tbx_eventId" id="tbx_eventId" hidden>
            <button class="login100-form-btn" type="submit">
              Submit
            </button>
          </div>
          </div>
           <?php echo form_close();?>
      </div>
    </div>
  </div>
</div>

<?php $this->view('footer/footer'); ?>
<script>
      $(document).ready(function() {
        $('#tbx_date').daterangepicker({
          locale: {
            format:'DD-MM-YYYY',
          },
          singleDatePicker: true,
          calender_style: "picker_4"
        });
      });
      $(document).on("click", ".open-edit-modal", function () {
           var eventId = $(this).data('eventid');
           var eventName = $(this).data('eventname');
           var eventDate = $(this).data('eventdate');
           $(".modal-body #tbx_eventName").val( eventName );
           $(".modal-body #tbx_date").val( eventDate );
           $(".modal-body #tbx_eventId").val( eventId );
      });
      $(document).on("click", ".fb-create", function () {
           $(".modal-body #tbx_eventName").val('');
           $(".modal-body #tbx_date").val('');
           $(".modal-body #tbx_eventId").val('');
      });
    </script>


