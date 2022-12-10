<?php $user = Application::$app->session->getUser() ?>
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
			<!-- <div class="nav-item">
				<i class="fas fa-2x fa-bell"></i>
			</div> -->
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
				<a href="/admin/dashboard">
					<i class="fas fa-th-large"></i>
					<div>Dashboard</div>
				</a>
			</li>
			<li data="users">
				<a href="/admin/users">
					<i class="fas fa-users"></i>
					<div>Users</div>
				</a>
			</li>
			<li data="orphanages">
				<a href="/admin/orphanages">
				<i class="fas fa-home"></i>
				<div>Orphanages</div>
				</a>
			</li>
			<li data="reports">
				<a href="/admin/report">
					<i class="fas fa-file"></i>
					<div>Reports</div>
				</a>
			</li>
		</ul>
	</div>
</div>