<section class='content'>
  	<div class='row'>
    	<div class='col-xs-12'>
      		<div class='box'>
        		<div class='box-header'>
        			<h3 class='box-title'>JURUSAN LIST</h3>
        		</div>
        		<div class='box-body'>
					<!--h1><?php echo lang('index_heading');?></h1>
					<p><?php echo lang('index_subheading');?></p-->

					<div id="infoMessage"><?php echo $message;?></div>

					<table class="table table-bordered table-striped" id="mytable">
						<thead>
						<tr>
							<th><?php echo lang('index_fname_th');?></th>
							<th><?php echo lang('index_lname_th');?></th>
							<th><?php echo lang('index_email_th');?></th>
							<th><?php echo lang('index_groups_th');?></th>
							<th><?php echo lang('index_status_th');?></th>
							<th><?php echo lang('index_action_th');?></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($users as $user):?>
							<tr>
					            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
					            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
					            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
								<td>
									<?php foreach ($user->groups as $group):?>
										<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
					                <?php endforeach?>
								</td>
								<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
								<td><?php echo anchor("auth/edit_user/".$user->id, '<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')) ;?>
									<?php echo anchor(site_url('auth/delete/'.$user->id),'<i class="fa fa-trash-o"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ;?>
								</td>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>

					<p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>