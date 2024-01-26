<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menu Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Menu Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                <h3 class='card-title'>Menu Read</h3>
                  <table class="table table-bordered">
              	    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
              	    <tr><td>Link</td><td><?php echo $link; ?></td></tr>
              	    <tr><td>Icon</td><td><?php echo $icon; ?></td></tr>
              	    <tr><td>Is Active</td><td><?php echo $is_active; ?></td></tr>
              	    <tr><td>Is Parent</td><td><?php echo $is_parent; ?></td></tr>
              	    <tr><td></td><td><a href="<?php echo site_url('menu') ?>" class="btn btn-default">Cancel</a></td>
                    </tr>
          	       </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
</div>