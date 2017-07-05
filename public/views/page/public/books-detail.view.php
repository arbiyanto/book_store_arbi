<div class="ui grid container uk-margin-top" ng-controller="booksDetailController">
	<div class="row">
		<div class="four wide column" >
			<div class="ui image">
				<img ng-src="<?= fullurl(); ?>/public/img/upload/{{ detail.picture }}" alt="">
			</div>
		</div> 
		<div class="twelve wide column">
			<div class="ui grid">
				
				<div class="eight wide column">
					<div class="ui breadcrumb ">
						<a class="section">Halaman Utama</a>
						<i class="right angle icon divider"></i>
						<a class="section">{{ detail.category_name }}</a>
						
					</div>
					<h1 class="ui header neue">
						{{ detail.title }}
						<div class="sub header uk-margin-small-top">Oleh {{ detail.author }}</div>
					</h1>
					<h1 class="text-red ui header neue">
						Rp. {{ detail.price }}
						<div class="uk-float-right">
							<span style="font-size:0.6em;color:#888;font-weight:100 !important;">Diskon {{ detail.discount }}%</span>
							<del class="ui disabled tiny header">Rp.{{ detail.sellprice }}</del>
						</div>
						<div class="sub header">{{ detail.status_stock }}</div>
					</h1>

				</div>
				<div class="eight wide column">
					<a ng-repeat="l in detail.label" class="ui tag label">{{ l.label_name }}</a>
					<form class="ui form uk-margin-large-top">
						<button ng-click="cart(detail)" class="ui green labeled icon button">
							<i class="shop icon"></i>Beli Sekarang
						</button>
						<button ng-click="cart(detail)" class="ui my-red labeled  icon button">
							<i class="add to cart icon"></i>Tambahkan Keranjang
						</button>
					</form>
				</div>
			</div>
			<div class="ui divider"></div>
			<div class="uk-margin-top" hm-read-more
				hm-text="{{ detail.description }}" 
				hm-limit="500" 
				hm-more-text="Baca Deskripsi Lengkap" 
				hm-less-text="Tutup Deskripsi"
				hm-dots-class="dots"
				hm-link-class="links">
			</div>
			<div class="ui divider"></div>
		</div>
	</div>
	<div class="row">
		<div class="ten wide column">
			<div class="ui header">Spesifikasi Barang</div>
			<div class="ui two column grid">
				<div class="column">
					<div class="ui list">
						<div class="item">Judul Buku</div>
						<div class="item">Kategori</div>
						<div class="item">Penulis</div>
						<div class="item">Nomor ISBN</div>
						<div class="item">Penerbit</div>
						<div class="item">Tanggal Rilis</div>
					</div>
				</div>
				<div class="column">
					<div class="ui list">
						<div class="item">{{ detail.title }}</div>
						<div class="item">{{ detail.category_name }}</div>
						<div class="item">{{ detail.author }}</div>
						<div class="item">{{ detail.noisbn }}</div>
						<div class="item">{{ detail.publisher }}</div>
						<div class="item">{{ detail.date }}</div>
					</div>
				</div>
			</div>

			<div class="ui comments uk-margin-large-top">
				<div class="ui dividing header">Komentar</div>
				<div class="comment">
					<a class="avatar">
						<img src="" alt="gambar">
					</a>
					<div class="content">
						<div class="author">Chentong</div>
						<div class="metadata">
							<span class="date">18 Mei 2016</span>
						</div>
						<div class="text">
							How artistic!
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="six wide column">
			<div class="ui header">Buku Yang Sama</div>
			<div class="ui items">
				<a class="item" ng-repeat="other in other_books">
					<div class="ui tiny image">
						<img ng-src="<?= fullurl(); ?>/public/img/upload/{{ other.picture }}">
					</div>
					<div class="content">
						<div class="header">{{ other.title }}</div>
						<div class="description">{{ other.author }}</div>
						<div class="extra">Publisher: {{ other.publisher }}</div>
					</div>

				</a>
			</div>
		</div>

	</div>
</div>