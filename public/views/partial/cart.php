<div id="modalCart" class="ui small modal">
	<i class="close icon"></i>
	<div class="ui header letter-spacing">Keranjang Belanja</div>
	<div class="content">
		<div class="ui green small message uk-text-center">
			<div class="header">(FREE ONGKIR) Buku {{ ct.title }}</div>
		</div>
		<div class="ui grid">
			<div class="uk-margin-left two wide column">
				<div class="ui tiny image">
					<img ng-src="<?= fullurl(); ?>/public/img/upload/{{ ct.picture }}">
				</div>
			</div>
			<div class="seven wide column uk-margin-small-top">
				<div class="">Buku {{ ct.title }}</div>
				<del class="uk-text-muted">Rp. {{ ct.sellprice }}</del> Discount {{ ct.discount }}%<br>
				<b class="text-red" style="font-size:1.4em;">Rp.{{ ct.price }}</b>
			</div>
			<div class="six wide column ui form">
				<div class="field">
					<input type="number" placeholder="Jumlah Barang" ng-model="amount" ng-change="subtotalCount()">
				</div>
			</div>
		</div>

		<div class="uk-float-left uk-margin-left uk-margin-top">
			<div class="ui list">
				<div class="item">Total Harga Barang:</div>
				<div class="item">Pajak:</div>
				<div class="item"><b>Subtotal:</b></div>
			</div>
		</div>

		<div class="uk-float-right uk-margin-large-right uk-text-right uk-margin-top">
			<div class="ui list">
				<div class="item">Rp. {{ ct.price }}</div>
				<div class="item">{{ ct.tax }}%</div>
				<div class="item"><b>Rp. {{ subtotal }}</b></div>
			</div>
			<button class="ui my-red labeled icon button"><i class="shop icon"></i>Beli Sekarang</button>
			<button ng-click="addCart(ct.id)" 
			ng-class="{'loading disabled': loading}" class="ui green labeled icon button">
				<i class="add to cart icon"></i>Tambahkan ke Keranjang
			</button>
		</div>
		<div class="uk-clearfix"></div>

	</div>
</div>