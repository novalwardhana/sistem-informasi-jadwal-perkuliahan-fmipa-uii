    <aside class="main-sidebar">
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-cubes"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="padding-top: 3px; padding-bottom: 3px;">
            <li><a href="<?php echo base_url('Mahasiswa') ?>" style="margin: 12px 0px; color: #555;"><i class="fa fa-graduation-cap"></i> <span>Mahasiswa</span></a></li>
            <li><a href="<?php echo base_url('MataKuliah') ?>" style="margin: 12px 0px; color: #555;"><i class="fa fa-book"></i> <span>Mata Kuliah</span></a></li>
            <li><a href="<?php echo base_url('Dosen') ?>" style="margin: 12px 0px; color: #555;"><i class="fa fa-slideshare"></i> <span>Dosen</span></a></li>
            <li><a href="<?php echo base_url('skormaks') ?>" style="margin: 12px 0px; color: #555;"><i class="fa fa-tasks"></i> <span>Skor Maks Config</span></a></li>
            <li><a href="<?php echo base_url('klasifikasi') ?>" style="margin: 12px 0px; color: #555;"><i class="fa fa-pie-chart"></i> <span>Klasifikasi</span></a></li>
            <li><a href="<?php echo base_url('harkat') ?>" style="margin: 12px 0px; color: #555;"><i class="fa fa-tags"></i> <span>Harkat</span></a></li>
            <li><a href="<?php echo base_url('kelas') ?>" style="margin: 12px 0px; color: #555;"><i class="fa fa-building"></i> <span>Kelas</span></a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('dosenPengampu') ?>"><i class="fa fa-clipboard"></i> <span>Pengampu Mata Kuliah</span></a></li>
        <li><a href="<?php echo base_url('mahasiswaPeserta') ?>"><i class="fa fa-users"></i> <span>Jadwal Perkuliahan</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
