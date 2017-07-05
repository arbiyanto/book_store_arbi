<form class="ui form" name="distAdd" ng-submit="distributorAdd(dt)" novalidate>
	<div class="field">
		<label>Nama Distributor</label>
		<input type="text" name="distributor_name" ng-model="dt.distributor_name" placeholder="Nama Distributor" required>
		<div class="ui red pointing label letter-spacing-small" 
		ng-show="distAdd.distributor_name.$dirty &&distAdd.distributor_name.$invalid">
		Judul Buku Dibutuhkan.</div>
	</div>
	<div class="field">
		<label>Penulis</label>
		<textarea name="distributor_address" ng-model="dt.distributor_address" placeholder="Alamat Distributor" ></textarea>
		<div class="ui red pointing label letter-spacing-small" 
		ng-show="distAdd.distributor_address.$dirty &&distAdd.distributor_address.$invalid">
		Penulis Dibutuhkan.</div>
	</div>
	<button ng-disabled="!distAdd.$valid" ng-class="{'loading disabled' : onLoading}" type="submit" 
	class="ui blue button"><i class="save icon"></i>Simpan</button>
	<div ng-click="deleteDistributor(dt.id)" ng-if="dt.id" class="uk-float-right ui red labeled icon button"><i class="remove icon"></i>Hapus Distributor</div>
	<div ng-click="reset()" class="uk-float-right ui teal labeled icon button"><i class="undo icon"></i>Reset</div>
</form>