<div class="ui header">List Buku</div>
<table class="ui basic selectable celled table">
	<thead>
		<tr>
			<th>Judul Buku & Kategori</th>
			<th>No.ISBN</th>
			<th>Penulis</th>
			<th>Stok</th>
			<th>Harga</th>
			<th>Diskon</th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="b in books">
			<td>
				<a ng-click="updateBooks(b.id)" class="tes">
					<h4 class="ui image header">
						<img src="<?= fullurl().'/public/img/upload/' ?>{{ b.picture }}" class="ui mini rounded image">
						<div class="content">
						{{ b.title }}
							<div class="sub header">{{ b.category_name }}</div>
						</div>
					</h4>
				</a>
			</td>
			<td>{{ b.noisbn }}</td>
			<td>{{ b.author }}</td>
			<td>{{ b.stock }}</td>
			<td>{{ b.sellprice }}</td>
			<td>{{ b.discount }}</td>
		</tr>
	</tbody>
</table>