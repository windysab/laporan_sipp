<aside class="main-sidebar elevation-4 sidebar-dark-info">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link navbar-lightblue">
      <img src="<?php echo base_url(); ?>template/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SISFO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url(); ?>template/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Zen</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
                        $this->db->order_by("index", "asc");
                        $menu = $this->db->get_where('menu', array('is_parent' => 0,'is_active'=>1));
                        foreach ($menu->result() as $m) {
                            // chek ada sub menu
                            $submenu = $this->db->get_where('menu',array('is_parent'=>$m->id,'is_active'=>1));
                            if($submenu->num_rows()>0){
                                // tampilkan submenu
                                echo "\n\t\t\t\t\t\t\t\t<li class='nav-item has-treeview'>
                                    ".anchor('#',  "<i class='$m->icon'></i>"." ".strtoupper($m->name).' <i class="fas fa-angle-left right"></i>', 'class="nav-link"')."
                                        <ul class='nav nav-treeview' style='background-color:#6C757D'> \n ";
                                foreach ($submenu->result() as $s){
                                     echo "\t\t\t\t\t\t\t\t\t\t\t<li class='nav-item'>" . anchor($s->link, "<i class='$s->icon'></i> <span>" . strtoupper($s->name),'class="nav-link"') . "</span>\n\t\t\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t\t\t";
                                }
                                   echo"</ul>\n
                                </li>";
                            }else{
                                echo "\n<li class='nav-item'>" . anchor($m->link, "<i class='$m->icon'></i> <span>" . strtoupper($m->name), array('class' => 'nav-link')) . "</span></li>";//format fungsi anchor
                            }
                            
        }
        ?>  

        </ul>

        

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>