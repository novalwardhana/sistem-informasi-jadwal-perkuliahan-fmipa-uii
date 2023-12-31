<section class="content-header">
	<h1>
	Dashboard
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>
</section>

<section class="content">
	<div class="row">

		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-red">
				<div class="inner">
					<h3><?php echo $totalDosen ?></h3>
					<p>Dosen</p>
				</div>
				<div class="icon">
					<i class="fa fa-slideshare"></i>
				</div>
					<a href="<?php echo base_url('master-dosen') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3><?php echo $totalMataKuliah ?></h3>
					<p>Mata Kuliah</p>
				</div>
				<div class="icon">
					<i class="fa fa-book"></i>
				</div>
					<a href="<?php echo base_url('master-mata-kuliah') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $totalRuang ?></h3>
					<p>Ruang</p>
				</div>
					<div class="icon">
						<i class="fa fa-building"></i>
					</div>
					<a href="<?php echo base_url('master-ruang') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-purple">
				<div class="inner">
					<h3><?php echo $totalKelas ?></h3>
					<p>Kelas</p>
				</div>
					<div class="icon">
						<i class="fa fa-window-restore"></i>
					</div>
					<a href="<?php echo base_url('master-kelas') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>
</section>
