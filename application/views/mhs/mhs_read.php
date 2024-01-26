<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mahasiswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mahasiswa</li>
            </ol>
          </div>
        </div>
      </div>
    </section-->
        <!-- Main content -->
        <section class='content'>
          <div class='row d-flex justify-content-center'>
            <div class='col-lg-8' style="margin-top: 2px;">
              <div class='card'>
                <div class='card-header'>
                  <h4 class='d-flex justify-content-center'>Detail Mahasiswa</h4>
                  <table class="table table-bordered">
                    <tr><td width="20%">nim</td><td width="80%"><?php echo $nim; ?></td></tr>
              	    <tr><td>nama</td><td><?php echo $nama; ?></td></tr>
                    <?php $gender1=$gender=='L'?'Laki-Laki':'Perempuan';?>
              	    <tr><td>Jenis Kelamin</td><td><?php echo $gender1; ?></td></tr>
              	    <tr><td>Tanggal Lahir</td><td><?php echo $tanggal_lahir; ?></td></tr>
              	    <tr><td>Tempat Lahir</td><td><?php echo $tempat_lahir; ?></td></tr>
                    <tr><td>Foto</td><td><img src="<?php echo base_url();?>uploads/<?php echo $foto; ?>" width="100px" height="100px"></td></tr>
              	    <tr><td></td><td><a href="<?php echo site_url('mhs') ?>" class="btn btn-default">Cancel</a></td>
                    </tr>
          	       </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
</div>