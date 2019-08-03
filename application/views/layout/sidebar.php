<?php
	$dataSessionPermission = $this->session->userdata('permission');
?>
<aside class="main-sidebar">
    <section class="sidebar">

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
				<!-- Treeview Master Data -->
				<?php
					if (isset($dataSessionPermission['Mahasiswa']) || isset($dataSessionPermission['MataKuliah']) || isset($dataSessionPermission['Dosen']) || isset($dataSessionPermission['SkorMaks']) || isset($dataSessionPermission['Klasifikasi']) || isset($dataSessionPermission['Harkat']) || isset($dataSessionPermission['Kelas'])) {
				?>
				<li class="treeview">
          <a href="#">
            <i class="fa fa-cubes"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="padding-top: 3px; padding-bottom: 3px;">

						<?php
							if (isset($dataSessionPermission['Mahasiswa'])) {
						?>
						<li><a href="<?php echo base_url('Mahasiswa') ?>" style="margin: 1px 5px 12px 5px; color: #555;"><i class="fa fa-graduation-cap"></i> <span>Mahasiswa</span></a></li>
						<?php
							}
						?>
            
						<?php
							if (isset($dataSessionPermission['MataKuliah'])) {
						?>
            <li><a href="<?php echo base_url('MataKuliah') ?>" style="margin: 12px 5px; color: #555;"><i class="fa fa-book"></i> <span>Mata Kuliah</span></a></li>
						<?php
							}
						?>

						<?php
							if (isset($dataSessionPermission['Dosen'])) {
						?>
						<li><a href="<?php echo base_url('Dosen') ?>" style="margin: 12px 5px; color: #555;"><i class="fa fa-slideshare"></i> <span>Dosen</span></a></li>
            <?php
							}
						?>
						
						<?php
							if (isset($dataSessionPermission['SkorMaks'])) {
						?>
						<li><a href="<?php echo base_url('SkorMaks') ?>" style="margin: 12px 5px; color: #555;"><i class="fa fa-tasks"></i> <span>Skor Maks Config</span></a></li>
						<?php
							}
						?>
						
						<?php
							if (isset($dataSessionPermission['Klasifikasi'])) {
						?>
						<li><a href="<?php echo base_url('Klasifikasi') ?>" style="margin: 12px 5px; color: #555;"><i class="fa fa-pie-chart"></i> <span>Klasifikasi</span></a></li>
            <?php
							}
						?>
						
						<?php
							if (isset($dataSessionPermission['Harkat'])) {
						?>
						<li><a href="<?php echo base_url('Harkat') ?>" style="margin: 12px 5px; color: #555;"><i class="fa fa-tags"></i> <span>Harkat</span></a></li>
						<?php
							}
						?>
						
						<?php
							if (isset($dataSessionPermission['Kelas'])) {
						?>
						<li><a href="<?php echo base_url('Kelas') ?>" style="margin: 12px 5px; color: #555;"><i class="fa fa-building"></i> <span>Kelas</span></a></li>
						<?php
							}
						?>
					</ul>
        </li>
				<?php
					}
				?>
				<!-- End Treeview Master Data -->

				<!-- Treeview Agenda Perkuliahan -->
				<?php
					if (isset($dataSessionPermission['DosenPengampu']) || isset($dataSessionPermission['JadwalPerkuliahan'])) {
				?>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-calendar-check-o"></i>
						<span>Agenda Perkuliahan</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu" style="padding-top: 3px; padding-bottom: 3px;">
						<?php
							if (isset($dataSessionPermission['DosenPengampu'])) {
						?>
						<li><a href="<?php echo base_url('DosenPengampu') ?>" style="margin: 1px 5px 12px 5px; color: #555;"><i class="fa fa-address-card"></i> <span>Pengampu Mata Kuliah</span></a></li>
						<?php
							}
						?>

						<?php
							if (isset($dataSessionPermission['JadwalPerkuliahan'])) {
						?>
						<li><a href="<?php echo base_url('JadwalPerkuliahan') ?>" style="margin: 12px 5px; color: #555;"><i class="fa fa-calendar"></i> <span>Jadwal Perkuliahan</span></a></li>
						<?php
							}
						?>
						
					</ul>
				</li>
				<?php
					}
				?>
				<!-- End Treeview Agenda Perkuliahan -->

				<!-- Treeview Laporan -->
				<?php
					if (isset($dataSessionPermission['NilaiMataKuliah'])) {
				?>
				<li class="treeview">
					<a href="#">
            <i class="fa fa-clipboard"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
					<ul class="treeview-menu" style="padding-top: 3px; padding-bottom: 3px;">
						<?php
							if (isset($dataSessionPermission['NilaiMataKuliah'])) {
						?>
						<li><a href="<?php echo base_url('NilaiMataKuliah') ?>" style="margin: 1px 5px 12px 5px; color: #555;"><i class="fa fa-file-text"></i> <span>Nilai Mahasiswa</span></a></li>
						<?php
							}
						?>
					</ul>
				</li>
				<?php
					}
				?>
				<!-- End Treeview Laporan -->

				<?php
					if (isset($dataSessionPermission['UserManagement']) || isset($dataSessionPermission['UserRole']) || isset($dataSessionPermission['UserPermission'])) {
				?>
				<li class="treeview">
					<a href="#">
            <i class="fa fa-users"></i>
            <span>User Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
					<ul class="treeview-menu" style="padding-top: 3px; padding-bottom: 3px;">
						<?php
							if (isset($dataSessionPermission['UserManagement'])) {
						?>
						<li><a href="<?php echo base_url('UserManagement') ?>" style="margin: 1px 5px 12px 5px; color: #555;"><i class="fa fa-user"></i> <span>Users</span></a></li>
						<?php
							}
						?>

						<?php
							if (isset($dataSessionPermission['UserRole'])) {
						?>
						<li><a href="<?php echo base_url('UserRole') ?>" style="margin: 1px 5px 12px 5px; color: #555;"><i class="fa fa-toggle-on"></i> <span>Role</span></a></li>
						<?php
							}
						?>
						
						<?php
							if (isset($dataSessionPermission['UserPermission'])) {
						?>
						<li><a href="<?php echo base_url('UserPermission') ?>" style="margin: 1px 5px 12px 5px; color: #555;"><i class="fa fa-key"></i> <span>Permission</span></a></li>
						<?php
							}
						?>
					</ul>
				</li>
				<?php
					}
				?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
