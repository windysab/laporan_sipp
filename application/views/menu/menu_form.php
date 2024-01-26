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
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-lightblue">
              <div class="card-header d-flex justify-content-center">
                <h3 class="card-title"><strong><?php echo $judul; ?></strong></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="mytable">
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Nama <?php echo form_error('name') ?></label>                          
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Nama" name="name" value="<?php echo $name; ?>">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Link <?php echo form_error('link') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">                          
                          <input type="text" class="form-control" placeholder="Link" name="link" value="<?php echo $link; ?>">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Icon <?php echo form_error('icon') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">                          
                          <input type="text" class="form-control" name="icon" placeholder="Icon" value="<?php echo $icon; ?>">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Is Active <?php echo form_error('is_active') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">                          
                          <?php echo form_dropdown('is_active',array('1'=>'AKTIF','0'=>'TIDAK AKTIF'),$is_active,"class='form-control'");?>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Is Parent <?php echo form_error('is_parent') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">                          
                          <select name="is_parent" class="form-control">
                            <option value="0">YA</option>
                            <?php
                              $menu = $this->db->get('menu');
                              foreach ($menu->result() as $m){
                              echo "<option value='$m->id' ";
                              echo $m->id==$is_parent?'selected':'';
                              echo">".  strtoupper($m->name)."</option>";
                              }
                            ?>
                    </select>
                        </div>
                      </td>
                    </tr>
                    
                  </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="hidden" name="id" value="<?php echo $id; ?>" />
                  <button type="submit" class="btn btn-primary"><?php echo $button;?></button>
                  <a href="<?php echo site_url('menu') ?>" class="btn btn-warning">Cancel</a></td></tr>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>