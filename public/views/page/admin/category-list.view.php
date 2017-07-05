<table class="ui very basic  celled table">
	<thead>
		<tr>
			<th>Nomor</th>
			<th>Nama Kategori</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="c in category" >
			<td ng-click="updateCategory(c.id)">{{ $index + 1 }}</td>
			<td ng-click="updateCategory(c.id)">{{c.category_name}}</td>
			<td>
				<button class="ui button" ng-click="updateCategory(c.id)">Ubah</button>
				<button class="ui red labeled icon button" ng-click="deleteCategory(c.id)">
					<i class="remove icon"></i>Hapus
				</button>
			</td>
		</tr>
	</tbody>
</table>