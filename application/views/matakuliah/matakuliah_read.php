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
                  <h4 class='d-flex justify-content-center'><?php echo $judul; ?></h4>
                  <table class="table table-bordered">
                    <tr><td width="20%">ID</td><td width="80%"><?php echo $id_mata_kuliah; ?></td></tr>
              	    <tr><td>Nama</td><td><?php echo $nama_mata_kuliah; ?></td></tr>
              	    <tr><td>SKS</td><td><?php echo $sks; ?></td></tr>
              	    <tr><td>Semester</td><td><?php echo $semester; ?></td></tr>
                    <tr><td>Prodi</td><td><?php echo $nama_prodi; ?></td></tr>
              	    <tr><td></td><td><a href="<?php echo site_url('matakuliah') ?>" class="btn btn-default">Cancel</a></td>
                    </tr>
          	       </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
</div>