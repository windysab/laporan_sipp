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
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <!--h3 class="card-title">DataTable with minimal features & hover style</h3-->
              <h3 class='box-title'>MENU LIST <?php echo anchor('menu/create/','Create',array('class'=>'btn btn-danger btn-sm'));?>
                <?php echo anchor(site_url('menu/excel'), ' <i class="fa fa-file-excel"></i> Excel', 'class="btn btn-primary btn-sm"'); ?>
                <?php echo anchor(site_url('menu/word'), '<i class="fa fa-file-word"></i> Word', 'class="btn btn-primary btn-sm"'); ?>
                <?php echo anchor(site_url('menu/pdf'), '<i class="fa fa-file-pdf"></i> PDF', 'class="btn btn-primary btn-sm"'); ?>
      
    </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10px">No</th>
                  <th>Nama Menu</th>
                  <th>Link</th>
                  <th width="30">Icon</th>
                  <th>Aktif</th>
                  <th>Parent</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $start = 0;
                foreach ($menu_data as $menu)
                {
                $active = $menu->is_active==1?'AKTIF':'TIDAK AKTIF';
                $parent = $menu->is_parent>1?'MAINMENU':'SUBMENU'
                ?>
                <tr>
                  <td><?php echo ++$start ?></td>
                  <td><?php echo $menu->name ?></td>
                  <td><?php echo $menu->link ?></td>
                  <td><i class='<?php echo $menu->icon ?>'></i></td>
                  <td><?php echo $active ?></td>
                  <td><?php echo $parent ?></td>
                  <td style="text-align:center" width="140px">
                    <?php 
                    echo anchor(site_url('menu/read/'.$menu->id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-danger btn-sm')); 
                    echo '  '; 
                    echo anchor(site_url('menu/update/'.$menu->id),'<i class="fa fa-edit"></i>',array('title'=>'edit','class'=>'btn btn-danger btn-sm')); 
                    echo '  '; 
                    echo anchor(site_url('menu/delete/'.$menu->id),'<i class="fa fa-trash"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                    ?>
                  </td>
                </tr>
                <?php
                }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>