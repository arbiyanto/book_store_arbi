<div class="ui teal message" ng-if="update">
	<div class="header">Sedang Mengubah: </div> 
	{{input.label_name}}
</div>
<form  class="ui form" name="add" ng-submit="labelBooksAdd(inp)" novalidate>
	<div class="two fields">
		<div class="field">
			<label>Judul Buku</label>
			<sm-dropdown class="fluid search selection" 
			model="inp.book_id" items="books" 
			label="item.title" value="item.id" default-text="'Pilih Buku'"></sm-dropdown>

			<div class="ui red pointing label letter-spacing-small" 
			ng-show="add.category_id.$dirty &&add.category_id.$invalid">
			Judul Buku Dibutuhkan.</div>
		</div>
		<div class="field">
			<label>Label Buku</label>
			<sm-dropdown class="fluid search selection" 
			model="inp.label_id" items="label" 
			label="item.label_name" value="item.id" default-text="'Pilih Label'"></sm-dropdown>

			<div class="ui red pointing label letter-spacing-small" 
			ng-show="add.category_id.$dirty &&add.category_id.$invalid">
			Label Buku Dibutuhkan.</div>
		</div>
	</div>
	<button ng-disabled="!add.$valid" ng-class="{'loading disabled' : onLoading}" type="submit" 
	class="ui blue button">
		<i class="save icon"></i>Simpan
	</button>
	<div ng-click="deleteBooks(inp.id)" ng-if="inp.id" class="uk-float-right ui red labeled icon button"
		><i class="remove icon"></i>Delete
	</div>
	<div ng-click="reset()" class="uk-float-right ui teal labeled icon button">
		<i class="undo icon"></i>Reset
	</div>
</form>
<table class="ui very basic  celled table">
	<thead>
		<tr>
			<th>Nomor</th>
			<th>Judul Buku</th>
			<th>Nama Label</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="lb in labelbooks" >
			<td >{{ $index + 1 }}</td>
			<td >{{ lb.title }}</td>
			<td>{{lb.label_name}}</td>
			<td>
				<button class="ui red labeled icon button" ng-click="deleteLabelBooks(lb.id)">
					<i class="remove icon"></i>Hapus
				</button>
			</td>
		</tr>
	</tbody>
</table>