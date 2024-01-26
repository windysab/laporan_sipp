<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--section class="content-header">
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
      </div>
    </section-->

    <!-- Main content -->
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
                          <label>Nim <?php echo form_error('nim') ?></label>                          
                        </div>
                      </td>
                      <td width="80%">
                        <div class="form-group">
                          <input type="text" class="form-control col-lg-3" placeholder="Nim" name="nim" value="<?php echo $nim; ?>">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Nama <?php echo form_error('nama') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">                          
                          <input type="text" class="form-control col-lg-12" placeholder="Nama" name="nama" value="<?php echo $nama; ?>">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Jenis Kelamin <?php echo form_error('gender') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group"> 
                          <select name="gender" class="form-control col-lg-3">
                            <option  value="L" <?php echo $gender=='L'?'selected':'' ?>>Laki-laki</option>
                            <option value="P" <?php echo $gender=='P'?'selected':'' ?>>Perempuan</option>
                          </select>                  
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Tempat Lahir <?php echo form_error('tempat_lahir') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">                          
                          <input type="text" class="form-control col-lg-12" name="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">                          
                          <input type="date" class="form-control col-lg-4" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Agama <?php echo form_error('kd_agama') ?></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">                          
                          <select name="kd_agama" class="form-control col-lg-3">
                            <option value="1" <?php echo $kd_agama=='1'?'selected':''; ?>>Islam</option>
                            <option value="2" <?php echo $kd_agama=='2'?'selected':''; ?>>Kristen</option>
                            <option value="3" <?php echo $kd_agama=='3'?'selected':''; ?>>Hidu</option>
                            <option value="4" <?php echo $kd_agama=='4'?'selected':''; ?>>Budha</option>
                            <option value="99" <?php echo $kd_agama=='99'?'selected':''; ?>>Dan Lain-lain</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <label>Foto <?php echo form_error('foto') ?></label>
                        </div>
                      </td>
                      <td>            
                        <div class="row"> 
                          <div class="col-7">           
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imgInp" name="foto" value="<?php echo base_url()."uploads/". $foto;?>">
                                <label class="custom-file-label" for="exampleInputFile"><?php echo empty($foto)?'Choose File':$foto; ?></label>
                              </div>
                            </div>
                          </div>
                          <div class="col-5">
                            <img id="blah" src="<?php echo empty($foto)?base_url().'uploads/user-siluet.jpg':base_url().'uploads/'.$foto ?>" alt="your image" width="100" height="100" />
                          </div>
                        </div>
                      </td>
                    </tr>
                  </table>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="hidden" name="id" value="<?php echo $nim; ?>" />
                  <button type="submit" class="btn btn-warning"><?php echo "$button"; ?></button>
                  <a href="<?php echo site_url('mhs') ?>" class="btn btn-success">Cancel</a></td></tr>
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
