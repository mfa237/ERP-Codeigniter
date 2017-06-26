
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item <?php if (current_url()==base_url('Dashboard')) { echo 'active';} ?> ">
                            <a href="<?php echo base_url();?>Dashboard-Manufaktur" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <?php
                            if ($mainmenu) {
                                //MAINMENU
                                foreach ($mainmenu->result() as $row) {
                                    if (current_url()==base_url($row->menu_link) || $this->uri->segment(1)==$row->menu_alias) {
                                      $status = 'active';
                                      $expand = 'aria-expanded="true"';
                                      $in = 'in';
                                    } else {
                                      $status = '';
                                      $expand = 'aria-expanded="false"';
                                      $in = '';
                                    }
                                    echo '
                                    <li class="nav-item start '.$status.'">
                                        <a href="'.base_url($row->menu_link).'" class="nav-link">
                                            <i class="'.$row->menu_icon.'"></i>
                                            <span class="title">'.$row->menu_nama.'</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">';
                                        if ($submenu <> false) {
                                            foreach ($submenu->result() as $row2) {
                                                if ($row2->menu_parent == $row->menu_id) {
                                                    if (current_url() == base_url($row2->menu_link) || base_url().'/'.$this->uri->segment(1).'/'.$this->uri->segment(2) == base_url().'/'.$row2->menu_link) {
                                                        $status2 = 'active';
                                                    } else {
                                                        $status2 = '';
                                                    }
                                                    echo '
                                                    <li class="nav-item start '.$status2.'">
                                                        <a href="'.base_url($row2->menu_link).'" class="nav-link ">
                                                            <span class="title">'.$row2->menu_nama.'</span>
                                                        </a>
                                                    </li>
                                                    ';
                                                }
                                            }
                                        }
                                    echo '
                                        </ul>
                                    </li>
                                    ';
                                }
                            }
                        ?>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->