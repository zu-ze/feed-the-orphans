<?php 
	$user = Application::$app->session->getUser(); 
	$orphanage = Application::$app->session->getOrphanage();
?>
<div>
	<div class="topbar flex flex-row justify-between px-5">
		<div class="float-left">
			<div class="nav-item">
				<span>FTO</span>
			</div>
		</div>
		<!-- <div class="float-right" >
			<div class="nav-item">
				<input type="text" name="" id="search" placeholder="search here">
				<label><i class="fas fa-2x fa-search"></i> </label>
			</div>
		</div> -->
		<div class="float-right flex flex-row">
			<div class="nav-item">
				<a href="/orphanage/profile" ><i class="fas fa-2x fa-home"></i>
				<?php echo $orphanage->name ?></a>
			</div>
			<div class="nav-item">
				<i class="fas fa-2x fa-user-alt" ></i>
				<?php echo $user->userName ?>
				<!-- <img src="/images/photo.jpg"> -->
			</div>
			<div class="nav-item">
				<form action="/logout" method="POST" >
					<button type="submit">
						<i class="fas fa-2x fa-sign-out-alt"></i>
					</button>
				</form>
			</div>
		</div>
	</div>
	<div class="sidebar">
		<ul>
			<li class="active" data="dashboard">
				<a href="/orphanage/dashboard">
					<i class="fas fa-th-large"></i>
					<div>Dashboard</div>
				</a>
			</li>
			<li data="donation">
				<a href="/orphanage/donation">
					<i class="fas fa-donate "></i>
					<div>Donation</div>
				</a>
			</li>
			<li data="events">
				<a href="/orphanage/calendar">
				<i class="fas fa-calendar"></i>
				<div>Events</div>
				</a>
			</li>
			<li data="map">
				<a href="/orphanage/map">
				<i class="fas fa-map"></i>
				<div>Map</div>
				</a>
			</li>
			<li data="reports">
				<a href="/orphanage/report">
					<i class="fas fa-file"></i>
					<div>Reports</div>
				</a>
			</li>
		</ul>
	</div>
</div>