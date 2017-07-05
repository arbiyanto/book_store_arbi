<div class="ui header">Permintaan Transaksi</div>
<table class="ui very basic collapsed selectable celled table">
	<thead>
		<tr>
			<th>Nama Rekening</th>
			<th>Metode Pembayaran</th>
			<th>Nomor Rekening</th>
			<th>Waktu</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="p in payment" style="cursor:pointer;" ng-click="paymentUpdate(p.id)">
			<td>{{ p.card_holder }}</td>
			<td>{{ p.payment_method }}</td>
			<td>{{ p.card_number }}</td>
			<td>{{ p.created_at }}</td> 
			<td ng-if="p.status==0" ng-bind-html="st[0]"></td>
			<td ng-if="p.status==1" ng-bind-html="st[1]"></td>
			<td ng-if="p.status==2" ng-bind-html="st[2]"></td>
		</tr>
	</tbody>

</table>