<div class="ui grid container uk-margin-top" ng-controller="booksListController">
	<div class="row">
		<div class="column">
			<div class="ui search icon input uk-width-1-4">
				<i class="search icon"></i>
				<input type="text" placeholder="Cari Buku Disini" ng-model="searchText">
			</div>
			<div class="uk-float-right">
				<span class="uk-text-muted">Urutkan</span>
				<sm-dropdown class="selection" model="sort" items="sortBy" label="item.name" value="item.name" 
				default-text="'Urutkan Sebagai'">
				</sm-dropdown> 
			</div>
		</div>
	</div>
	<div class="row">
		<div class="four wide column" >
			<form class="ui red segment form" data-uk-sticky="{ top:80 }">
				<label>Rentang Harga</label>
				<div class="field uk-margin-top">
					<input type="number" placeholder="Minimal">
				</div>
				<div class="field">
					<input type="number" placeholder="Maksimal">
				</div>
				<label class="uk-margin-top uk-margin-bottom">Nama Penulis</label>
				<div class="field uk-margin-top">
					<input type="text" placeholder="Penulis...">
				</div>
				<label class="uk-margin-top uk-margin-bottom">Penerbit</label>
				<div class="field uk-margin-top">
					<input type="text" placeholder="Penerbit...">
				</div>
				<button type="submit" class="ui fluid button">Lihat</button>
			</form>
		</div>
		
		<div class="twelve wide column">
			<div class="ui grid">

				<div class="doubling four column row">
			        <div class="column web-card" ng-repeat="b in books | filter: searchText">
			            <a href="<?= fullurl(); ?>/books/detail/{{ b.id }}" class="mask"></a>
			            <a >
			                <div class="ui image">
			                    <button ng-click="cart(b)" class="ui icon button my-red cart-button">
			                        <i class="add to cart icon"></i>
			                    </button>
			                    <a class="ui ribbon label">Rp.{{ b.price }}</a>
			                    <img ng-src="<?= fullurl(); ?>/public/img/upload/{{ b.picture }}" alt="">
			                    
			                </div>
			                <div class="ui tiny header">{{ b.title }}
			                    <div class="sub header uk-margin-small-top">{{ b.author }}</div>
			                </div>
			            </a>
			        </div>
			    </div>

			</div>
		</div>

	</div>

</div>