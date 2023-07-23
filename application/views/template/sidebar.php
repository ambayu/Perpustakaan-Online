 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('auth'); ?>">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-book-reader"></i>
         </div>
         <div class="sidebar-brand-text mx-3"> E-EBOOK </div>
     </a>

     <!-- query menu -->

     <?php
$role_id = $this->session->userdata('level');
$querymenu = "
        SELECT a.id,a.menu,b.level from user_menu a
        left join tbl_acces_menu b on a.id=b.menu_id
        where b.level= $role_id
        ORDER BY b.menu_id asc
        ";
$menu = $this->db->query($querymenu)->result_array();

?>
     <!-- Divider -->
     <hr class="sidebar-divider ">
     <!-- LOOPING MENU -->


     <!-- sub menu -->
     <?php foreach ($menu as $m): ?>
     <div class='sidebar-heading'>
         <?=$m['menu'];?>
     </div>

     <?php $query = "
      select * from user_sub_menu a
      left join user_menu b on a.menu_id=b.id
      where b.id= " . $m['id'] . "
      order by a.menu_id asc
      ";
$submenu = $this->db->query($query)->result_array();
?>

     <?php foreach ($submenu as $sm): ?>

     <?php if ($title == $sm['title']): ?>
     <li class="nav-item active">
         <?php else: ?>
     <li class="nav-item">
         <?php endif;?>
         <a class="nav-link pb-0" href="<?=base_url($sm['url'])?>">
             <i class="<?=$sm['icons']?>"></i>
             <span><?=$sm['title'];?></span></a>
     </li>
     <?php endforeach;?>
     <hr class="sidebar-divider mt-3">
     <?php endforeach;?>


     <!-- Divider -->

     <li class="nav-item">
         <a class="nav-link" href="<?=base_url('auth/logout');?>">

             <i class="fas  fa-fw fa-sign-out-alt"></i>
             <span>Logout</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->