<form class="ui grid form" name="stock" ng-submit="stockAdd(st)" novalidate>
	<div class="four wide column">
		<div class="field">
			<label>Tanggal Transaksi</label>
			<div date-picker="st.date" timezone="Asia/Jakarta" ng-model="st.date" 
			format="DD MMMM YYYY"
			min-view="date" max-view="year"></div>
		</div>
	</div>
	<div class="twelve wide column">
		<div class="field">
			<label>Judul Buku</label>
			<sm-dropdown class="fluid search selection" 
			model="st.book_id" items="books" 
			label="item.title" value="item.id" name="book_id" default-text="'Pilih Buku'" 
			required></sm-dropdown>
			
			<div class="ui red pointing label letter-spacing-small" 
			ng-show="stock.book_id.$dirty &&stock.book_id.$invalid">
			Buku dibutuhkan.</div>

		</div>
		<div class="field">
			<label>Nama Distributor</label>
			<sm-dropdown class="fluid search selection" 
			model="st.distributor_id" items="distributor" 
			label="item.distributor_name" value="item.id" name="distributor_id" default-text="'Pilih Distributor'" 
			required></sm-dropdown>
		</div>
		<div class="field">
			<label>Jumlah Buku</label>
			<div class="ui right labeled  input">
				<input placeholder="0" type="number" name="amount" ng-model="st.amount" required>
				<div class="ui label">
					<i class="book icon"></i>
				</div>
			</div>
			<div class="ui red pointing label letter-spacing-small" 
			ng-show="add.tax.$dirty &&add.tax.$invalid">
			Jumlah Buku Dibutuhkan.</div>
		</div>
	</div>

	<button ng-disabled="!stock.$valid" ng-class="{'loading disabled' : onLoading}" type="submit" 
		class="ui blue button"><i class="save icon"></i>Simpan</button>

</form>