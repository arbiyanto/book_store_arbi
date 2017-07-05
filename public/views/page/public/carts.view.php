<div class="ui grid container uk-margin-large-top">
	<div class="ten wide column">
		<div class="ui items">
			<div class="item" ng-repeat="ct in cartUser.cart">
				<div class="ui tiny image">
					<img ng-src="<?= fullurl(); ?>/public/img/upload/{{ ct.picture }}">
				</div>
				<div class="content uk-margin-top">
					
					<div class="uk-float-left">
						<div class="ui header">{{ ct.title }}</div>
						<del class="ui header uk-margin-small-top disabled">Harga Awal: Rp. {{ct.sellprice}}</del>
					<div class="ui header uk-margin-small-top text-red">Harga Barang: Rp. {{ct.price}}</div>
						<div class="description uk-text-muted">Diskon: {{ct.discount}}%</div>
					</div>
					
					<div class="uk-float-right">
						<form class="ui form">
							<div class="inline fields uk-margin-top">
								<label>Jumlah</label>
								<input type="number" ng-model="myamount[$index]" ng-change="changeSub($index)" />
							</div>
						</form>
					</div> 
					
				</div>
			</div>
		</div>
		<div class="uk-float-left uk-margin-left uk-margin-top">
			<div class="ui list">
				<div class="item"><b>Subtotal:</b></div>
			</div>
		</div>

		<div class="uk-float-right uk-margin-large-right uk-text-right uk-margin-top">
			<div class="ui list">
				<div class="item"><b>Rp. {{ mysubtotal }}</b></div>
			</div>
			<button class="ui my-red labeled icon button" ng-click="buy()"><i class="shop icon"></i>Beli Sekarang</button>
		</div>
		<div class="uk-clearfix"></div>

	</div>

	<div class="three wide column">
		
	</div>

</div>