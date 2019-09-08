<?php
	$dataSessionPermission = $this->session->userdata('permission');
?>
<aside class="main-sidebar">
    <section class="sidebar">
			
			<div class="user-panel">
        <div class="pull-left image">
          <img src="https://placehold.it/160x160/00a65a/ffffff/&text=<?php echo substr($this->session->userdata('nama_user'), 0, 1); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama_user'); ?></p>
					<a href="#"><i class="fa fa-user text-success"></i> <?php echo $this->session->userdata('username'); ?></a>
					<a href="#"><i class="fa fa-toggle-on text-success"></i> <?php echo $this->session->userdata('role_user'); ?></a>
				</div>
			</div>
			
      <ul class="sidebar-menu" data-widget="tree">
				
        <li class="menu-sidebar-dashboard"><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
				<!-- Treeview Master Data -->
				<?php
					if (isset($dataSessionPermission['Mahasiswa']) || isset($dataSessionPermission['MataKuliah']) || isset($dataSessionPermission['Dosen']) || isset($dataSessionPermission['SkorMaks']) || isset($dataSessionPermission['Klasifikasi']) || isset($dataSessionPermission['Harkat']) || isset($dataSessionPermission['Kelas'])) {
				?>
				<li class="treeview menu-sidebar-master">
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
						<li class="menu-sidebar-master-mahasiswa"><a href="<?php echo base_url('mahasiswa') ?>" style="margin: 1px 5px 12px 5px;"><i class="fa fa-graduation-cap"></i> <span>Mahasiswa</span></a></li>
						<?php
							}
						?>
            
						<?php
							if (isset($dataSessionPermission['MataKuliah'])) {
						?>
            <li class="menu-sidebar-master-mata-kuliah"><a href="<?php echo base_url('mata-kuliah') ?>" style="margin: 12px 5px;"><i class="fa fa-book"></i> <span>Mata Kuliah</span></a></li>
						<?php
							}
						?>

						<?php
							if (isset($dataSessionPermission['Dosen'])) {
						?>
						<li class="menu-sidebar-master-dosen"><a href="<?php echo base_url('dosen') ?>" style="margin: 12px 5px;"><i class="fa fa-slideshare"></i> <span>Dosen</span></a></li>
            <?php
							}
						?>
						
						<?php
							if (isset($dataSessionPermission['SkorMaks'])) {
						?>
						<li class="menu-sidebar-master-skor-maks"><a href="<?php echo base_url('skor-maks') ?>" style="margin: 12px 5px;"><i class="fa fa-tasks"></i> <span>Skor Maks Config</span></a></li>
						<?php
							}
						?>
						
						<?php
							if (isset($dataSessionPermission['Klasifikasi'])) {
						?>
						<li class="menu-sidebar-master-klasifikasi"><a href="<?php echo base_url('klasifikasi') ?>" style="margin: 12px 5px;"><i class="fa fa-pie-chart"></i> <span>Klasifikasi</span></a></li>
            <?php
							}
						?>
						
						<?php
							if (isset($dataSessionPermission['Harkat'])) {
						?>
						<li class="menu-sidebar-master-harkat"><a href="<?php echo base_url('harkat') ?>" style="margin: 12px 5px;"><i class="fa fa-tags"></i> <span>Harkat</span></a></li>
						<?php
							}
						?>
						
						<?php
							if (isset($dataSessionPermission['Kelas'])) {
						?>
						<li class="menu-sidebar-master-kelas"><a href="<?php echo base_url('kelas') ?>" style="margin: 12px 5px;"><i class="fa fa-building"></i> <span>Kelas</span></a></li>
						<?php
							}
						?>

						<li class="menu-sidebar-master-cpl"><a href="<?php echo base_url('capaian-pembelajaran-lulusan') ?>" style="margin: 12px 5px;"><i class="fa fa-tasks"></i> <span>Capaian Pembelajaran</span></a></li>
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
				<li class="treeview menu-sidebar-agenda-perkuliahan">
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
						<li class="menu-sidebar-agenda-perkuliahan-pengampu"><a href="<?php echo base_url('dosen-pengampu') ?>" style="margin: 1px 5px 12px 5px;"><i class="fa fa-address-card"></i> <span>Pengampu Mata Kuliah</span></a></li>
						<?php
							}
						?>

						<?php
							if (isset($dataSessionPermission['JadwalPerkuliahan'])) {
						?>
						<li class="menu-sidebar-agenda-perkuliahan-jadwal"><a href="<?php echo base_url('jadwal-perkuliahan') ?>" style="margin: 12px 5px;"><i class="fa fa-calendar"></i> <span>Jadwal Perkuliahan</span></a></li>
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
					if (isset($dataSessionPermission['NilaiMataKuliah']) || isset($dataSessionPermission['NilaiMataKuliahByMahasiswa'])) {
				?>
				<li class="treeview menu-sidebar-laporan">
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
						<li class="menu-sidebar-laporan-nilai-matkul"><a href="<?php echo base_url('nilai-mata-kuliah') ?>" style="margin: 1px 5px 12px 5px;"><i class="fa fa-file-text"></i> <span>Nilai Mahasiswa</span></a></li>
						<?php
							}
						?>

						<?php
							if (isset($dataSessionPermission['NilaiMataKuliahByMahasiswa'])) {
						?>
						<li class="menu-sidebar-laporan-nilai-matkul-by-mahasiswa"><a href="<?php echo base_url('nilai-mata-kuliah-by-mahasiswa') ?>" style="margin: 1px 5px 12px 5px;"><i class="fa fa-file-text"></i> <span>Nilai Mahasiswa</span></a></li>
						<?php
							}
						?>

						<li class="menu-sidebar-laporan-evaluasi-mandiri"><a href="<?php echo base_url('evaluasi-mandiri') ?>" style="margin: 1px 5px 12px 5px;"><i class="fa fa-file-text"></i> <span>Evaluasi Mandiri</span></a></li>
					</ul>
				</li>
				<?php
					}
				?>
				<!-- End Treeview Laporan -->

				<?php
					if (isset($dataSessionPermission['UserManagement']) || isset($dataSessionPermission['UserRole']) || isset($dataSessionPermission['UserPermission'])) {
				?>
				<li class="treeview menu-sidebar-user-management">
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
						<li class="menu-sidebar-user-management-user"><a href="<?php echo base_url('user-management') ?>" style="margin: 1px 5px 12px 5px;"><i class="fa fa-user"></i> <span>Users</span></a></li>
						<?php
							}
						?>

						<?php
							if (isset($dataSessionPermission['UserRole'])) {
						?>
						<li class="menu-sidebar-user-management-role"><a href="<?php echo base_url('UserRole') ?>" style="margin: 1px 5px 12px 5px;"><i class="fa fa-toggle-on"></i> <span>Role</span></a></li>
						<?php
							}
						?>
						
						<?php
							if (isset($dataSessionPermission['UserPermission'])) {
						?>
						<li class="menu-sidebar-user-management-permission"><a href="<?php echo base_url('UserPermission') ?>" style="margin: 1px 5px 12px 5px;"><i class="fa fa-key"></i> <span>Permission</span></a></li>
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
