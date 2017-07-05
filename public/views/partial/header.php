<div id="nag" class="ui inline blue cookie nag">
  <span class="title">
    Website kami menggunakan cookies agar pengalaman pengguna tetap stabil
  </span>
  <i class="close icon"></i>
</div>
<div id="mainNav" class="ui icon tiny inverted borderless menu" data-uk-sticky="{ top:'0' }">
	<div class="ui container uk-hidden-large">
		<a id="sidebarToggle" class="active logo item">
		   <img class="icon" src="<?= fullurl(); ?>/public/img/logo.png" width="30" alt=""><i class="dropdown icon"></i>
		</a>
		<div class="right menu" ng-if="!isLogin()" >
			<a class="item" ng-click="loginForm()">
				<i class="unlock large icon"></i>
			</a>
		</div>
		<div class="right menu" ng-if="isLogin()">
			<a class="ui item" ng-click="resetFilter()">
			  <i class="home large icon"></i>
			</a>
			<a class="ui item" ng-click="toggleSearch()">
			  <i class="search large icon"></i>
			</a>
			<a class="ui browse item" data-position="bottom right">
			  <img ng-if="auth.user_pict" class="ui circular image" ng-src="{{ env.site }}img/avatar.png" style="width:30px" >
			  <i ng-if="! auth.user_pict" class="user icon"></i>
			</a>
			<div class="ui popup bottom right transition hidden">
				<div class="uk-grid uk-grid-small">
					<div class="uk-width-1-2">
						<img ng-if="auth.user_pict" class="ui circular image" ng-src="{{ env.site }}img/avatar.png">
						<img ng-if="! auth.user_pict" class="ui circular image" ng-src="/img/sampleprofile.png" />
					</div>
					<div class="uk-width-1-2">
						<h4>{{ auth.name }}</h4>
						<a class="ui kg-bg-base small black button" href="/{{ auth.name }}"><i class="user icon"></i> Profile</a>
					</div>
				</div>
				<hr class="uk-grid-divider" />
				<a class="secondary ui button" ng-click="logout()"><i class="lock icon"></i> Logout</a>
				<a class="ui right floated icon circular secondary  button" href="/{{ auth.name }}/edit"><i class="icon setting"></i></a>
			</div>
		</div>
	</div> 
	<div class="ui container uk-visible-large">
		  <a class="active item logo" href="<?php echo fullurl(); ?>">
			<img ng-src="<?= fullurl(); ?>/public/img/logo_invert.png" alt="">
			Buku
		  </a>
		<div class="ui floating  dropdown item" sm-dropdown-bind="{action: 'hide'}">
			<span class="text">Kategori</span>
			<i class="dropdown icon"></i>
			<div class="menu">
				<div class="ui icon search input">
					<i class="search icon"></i>
					<input type="text" placeholder="Cari Kategori...">
				</div>
				<div class="divider"></div>
				<div class="header">
					<i class="tags icon"></i>
					Nama Kategori
				</div>
				<sm-menu items="menu1" class="scrolling menu" label="item.category_name" description="item.description" children="item.children"
				divider="item.divider" on-click="handleClick(item, $event)"></sm-menu>
			</div>
		</div>

		<div class="ui search uk-width-3-5 item" search>
			<div class="ui icon form input ">
				<input class="prompt" type="text" placeholder="Cari Buku...">
				<i class="search link icon"></i>
			</div>
			<div class="results"></div>
		</div>
		<div class="right menu" ng-if="!isLogin()" >
			<div class="ui floating  dropdown icon item" id="cart" sm-dropdown-bind="{action: 'hide'}"
			>
				<i class="cart large icon"></i>
				<div class="menu">
					<div class="header">
						<i class="tags icon"></i>
						Total: {{ cartUser.count }} barang
					</div>
					<div class="item" ng-repeat="cd in cartUser.cart">
						{{ cd.title }}
					</div>
					<div class="header description" ng-if="cartUser.message">
						<div class="content">{{ cartUser.message }}</div>
					</div>
					<div class="divider"></div>
					<a href="<?= fullurl(); ?>/carts" class="uk-text-center item">Lihat Keranjang</a>
				</div>
			</div>
			<?php use Library\Auth; if(!Auth::user()): ?>
			<a class="item" modal="#modalLogin">
				Masuk
			</a>
			<a class="item" modal="#modalRegister">
				<button class="ui inverted button">Daftar</button>
			</a>
			<?php endif; ?>
			<?php if(Auth::user()): ?>
			<a class="item">
			<?php echo Auth::user()->username; ?>
			</a>
			<a href="<?= fullurl(); ?>/logout" class="item" >
				<button class="ui inverted button">Logout</button>
			</a>
			<?php endif; ?>
			<!-- <a class="item btn" ng-click="loginForm()">
				<i class="unlock large icon"></i>
				 Akun
			</a> -->
			
		</div>
	</div>
</div>