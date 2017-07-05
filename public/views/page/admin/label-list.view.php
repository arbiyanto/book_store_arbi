<div class="ui teal message" ng-if="update">
	<div class="header">Sedang Mengubah: </div> 
	{{input.label_name}}
</div>
<form  class="ui form" name="cat" ng-submit="labelAdd(input)" novalidate>
	<div class="inline fields">
		<div class="sixteen wide field">
			<label>Nama Label</label>
			<input type="text" ng-model="input.label_name" name="label_name">
			<div class="ui red pointing label letter-spacing-small" 
			ng-show="cat.label_name.$dirty &&cat.label_name.$invalid">
			Nama Label Dibutuhkan.</div>
			<button class="uk-margin-left ui blue labeled icon button" type="submit">
			<i class="save icon"></i>Simpan</button>
		</div>
	</div>
	<div ng-click="reset()" ng-if="update" class="ui teal labeled icon button"><i class="undo icon"></i>Reset</div>
</form>
<table class="ui very basic  celled table">
	<thead>
		<tr>
			<th>Nomor</th>
			<th>Nama Label</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="l in label" >
			<td ng-click="updateLabel(l.id)">{{ $index + 1 }}</td>
			<td ng-click="updateLabel(l.id)">{{l.label_name}}</td>
			<td>
				<button class="ui button" ng-click="updateLabel(l.id)">Ubah</button>
				<button class="ui red labeled icon button" ng-click="deleteLabel(l.id)">
					<i class="remove icon"></i>Hapus
				</button>
			</td>
		</tr>
	</tbody>
</table>
