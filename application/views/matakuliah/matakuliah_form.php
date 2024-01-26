<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center" >
          <!-- left column -->
          <div class="col-md-12" style="margin-top:2px ">
            <!-- general form elements -->
            <?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-info" id="info"> <?= $this->session->flashdata('message') ?> </div>
            <?php } ?>
            <div class="card card-light">
              <div class="card-header d-flex justify-content-center">
                <h3 class="card-title"><strong><?php echo $judul;?></strong></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                echo form_open_multipart($action, 'role="form" class="form-horizontal" name="mhs"');
              ?>
              <!--form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data"-->
                <div class="card-body">
                  <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                      <table width="100%" id="mytable">
                    <tr>
                      <td width="20%">
                        <div class="form-group">
                          <label>ID <?php echo form_error('id_mata_kuliah') ?></label>                          
                        </div>
                      </td>
                      <td width="80%">
                        <div class="form-group">
                          <input type="text" <?php echo $button=='Ubah'?' disabled name="id_mata_kuliahx"':' name="id_mata_kuliah"';?> class="form-control col-lg-3" placeholder="ID" value="<?php echo $id_mata_kuliah; ?>">
                          <?php if ($button=='Ubah') {?>
                          <input type="hidden" class="form-control col-lg-3" placeholder="ID" name="id_mata_kuliah" value="<?php echo $id_mata_kuliah; ?>">
                        <?php }?>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Nama <?php echo form_error('nama_mata_kuliah') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">                          
                          <input type="text" class="form-control col-lg-12" placeholder="Nama Matakuliah" name="nama_mata_kuliah" value="<?php echo $nama_mata_kuliah; ?>">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>SKS <?php echo form_error('sks') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group"> 
                          <input type="text" class="form-control col-lg-5" placeholder="SKS" name="sks" value="<?php echo $sks; ?>">                 
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Semester <?php echo form_error('semester') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">                          
                          <input type="text" class="form-control col-lg-12" name="semester" placeholder="Semester" value="<?php echo $semester; ?>">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Prodi <?php echo form_error('nama_prodi') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group"> 
                          <select name="id_prodi" class="form-control col-lg-4">
                            <?php 
                            foreach ($prodi->result() as $row) {
                            ?>

                            <option  value="<?php echo $row->id_prodi; ?>" <?php  echo $row->id_prodi==$id_prodi?' selected':''; ?>>
                              <?php echo $row->nama_prodi;?>
                            </option>
                            <?php
                            }
                            ?>
                          </select>                  
                        </div>
                      </td>
                    </tr>
                  </table>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="hidden" name="id" value="<?php echo $id_mata_kuliah; ?>" />
                  <button type="submit" class="btn btn-warning"><?php echo "$button"; ?></button>
                  <a href="<?php echo site_url('matakuliah') ?>" class="btn btn-success">Kembali</a></td></tr>
                </div>
              </form>
              
              <!--script>document.mhs.submit();</script-->
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
