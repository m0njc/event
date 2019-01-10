<?php $this->view('header/header'); ?>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				

				<div class="">
					<table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone number</th>
                          <th>First Come (Y/N)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if($participants) {
                          foreach ($participants as $participant) {
                            ?>
                        <tr>
                          <td><?php echo $participant['firstName'].' '.$participant['lastName']; ?></td>
                          <td><?php echo $participant['email']; ?></td>
                          <td><?php echo $participant['phone1']; ?></td>
                          <td><?php if($participant['minEventId']==$id) echo 'Y'; else echo "N"; ?></td>
                        </tr>
                      <?php }
                        }
                        ?>
                      </tbody>
                    </table>
                    <a class="table-action pull-right"  href="<?php echo site_url('Event');?>"><i class="fa fa-arrow-left"></i> back</a>

			</div>
		</div>
	</div>
	<?php $this->view('footer/footer'); ?>