<?php
	$dataSessionPermission = $this->session->userdata('permission');
?>
<aside class="main-sidebar">
    <section class="sidebar">
			
		<div class="user-panel">
			<div class="pull-left image">
			<img src="https://eu.ui-avatars.com/api/?name=<?php echo substr($this->session->userdata('nama_user'), 0, 1); ?>&size=250" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
			<p><?php echo $this->session->userdata('nama_user'); ?></p>
				<a href="#"><i class="fa fa-user text-success"></i> <?php echo $this->session->userdata('username'); ?></a>
				<a href="#"><i class="fa fa-certificate text-success"></i> <?php echo $this->session->userdata('role_user'); ?></a>
			</div>
		</div>
			
      	<ul class="sidebar-menu" data-widget="tree">

			<!-- Dashboard -->
			<li class="menu-sidebar-dashboard"><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
					
			<!-- Treeview Master Data -->
			<?php
				if (isset($dataSessionPermission['MasterPeriode']) || isset($dataSessionPermission['MasterProdi']) || isset($dataSessionPermission['MasterRuang']) || isset($dataSessionPermission['MasterMataKuliah']) || isset($dataSessionPermission['MasterKelas']) || isset($dataSessionPermission['MasterDosen'])) {
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
						if (isset($dataSessionPermission['MasterPeriode'])) {
					?>
					<li class="menu-sidebar-master-periode"><a href="<?php echo base_url('master-periode') ?>" style="margin: 12px 5px 12px 21px;"><span>Periode</span></a></li>
					<?php
						}
					?>
					<?php
						if (isset($dataSessionPermission['MasterProdi'])) {
					?>
					<li class="menu-sidebar-master-prodi"><a href="<?php echo base_url('master-prodi') ?>" style="margin: 12px 5px 12px 21px;"><span>Prodi</span></a></li>
					<?php
						}
					?>
					<?php
						if (isset($dataSessionPermission['MasterDosen'])) {
					?>
					<li class="menu-sidebar-master-dosen"><a href="<?php echo base_url('master-dosen') ?>" style="margin: 12px 5px 12px 21px;"><span>Dosen</span></a></li>
					<?php
						}
					?>
					<?php
						if (isset($dataSessionPermission['MasterMataKuliah'])) {
					?>
					<li class="menu-sidebar-master-mata-kuliah"><a href="<?php echo base_url('master-mata-kuliah') ?>" style="margin: 12px 5px 12px 21px;"><span>Mata Kuliah</span></a></li>
					<?php
						}
					?>
					<?php
						if (isset($dataSessionPermission['MasterRuang'])) {
					?>
					<li class="menu-sidebar-master-ruang"><a href="<?php echo base_url('master-ruang') ?>" style="margin: 12px 5px 12px 21px;"><span>Ruang</span></a></li>
					<?php
						}
					?>
					<?php
						if (isset($dataSessionPermission['MasterKelas'])) {
					?>
					<li class="menu-sidebar-master-kelas"><a href="<?php echo base_url('master-kelas') ?>" style="margin: 12px 5px 12px 21px;"><span>Kelas</span></a></li>
					<?php
						}
					?>
				</ul>
			</li>
			<?php
				}
			?>
			<!-- End Treeview Master Data -->

			<!-- Treeview Penawaran Mata Kuliah -->
			<?php
				if (isset($dataSessionPermission['PenawaranMataKuliah']) || isset($dataSessionPermission['PenawaranMataKuliah'])) {
			?>
			<li class="menu-sidebar-penawaran-mata-kuliah">
				<a href="<?php echo base_url('penawaran-mata-kuliah') ?>">
					<i class="fa fa-pencil-square-o"></i>
					<span>Penawaran Mata Kuliah</span>
				</a>
			</li>
			<?php
				}
			?>
			<!-- End Treeview Penawaran Mata Kuliah -->

			<!-- Treeview Jadwal Perkuliahan -->
			<?php
				if (isset($dataSessionPermission['JadwalPerkuliahan']) || isset($dataSessionPermission['MatriksJadwalPerkuliahan'])) {
			?>
			<li class="treeview menu-sidebar-jadwal-perkuliahan">
				<a href="#">
					<i class="fa fa-calendar"></i>
					<span>Jadwal Perkuliahan</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu" style="padding-top: 3px; padding-bottom: 3px;">
					<?php
						if (isset($dataSessionPermission['JadwalPerkuliahan'])) {
					?>
					<li class="menu-sidebar-jadwal-perkuliahan-jadwal"><a href="<?php echo base_url('jadwal-perkuliahan') ?>" style="margin: 12px 5px 12px 21px;"><span>Jadwal</span></a></li>
					<?php
						}
					?>
					<?php
						if (isset($dataSessionPermission['MatriksJadwalPerkuliahan'])) {
					?>
					<li class="menu-sidebar-matriks-jadwal-perkuliahan"><a href="<?php echo base_url('matriks-jadwal-perkuliahan') ?>" style="margin: 12px 5px 12px 21px;"><span>Matriks</span></a></li>
					<?php
						}
					?>
				</ul>
			</li>
			<?php
				}
			?>
			<!-- Treeview End Jadwal Perkuliahan -->

			<!-- Treeview User Management -->
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
					<li class="menu-sidebar-user-management-user"><a href="<?php echo base_url('user-management') ?>" style="margin: 12px 5px 12px 21px;"><span>User</span></a></li>
					<?php
						}
						if (isset($dataSessionPermission['UserRole'])) {
					?>
					<li class="menu-sidebar-user-management-role"><a href="<?php echo base_url('UserRole') ?>" style="margin: 12px 5px 12px 21px;"><span>Role</span></a></li>
					<?php
						}
						if (isset($dataSessionPermission['UserPermission'])) {
					?>
					<li class="menu-sidebar-user-management-permission"><a href="<?php echo base_url('UserPermission') ?>" style="margin: 12px 5px 12px 21px;"><span>Permission</span></a></li>
					<?php
						}
					?>
				</ul>
			</li>
			<?php
				}
			?>
			<!-- End Treeview User Management -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
