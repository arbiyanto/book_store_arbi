<div class="ui teal message" ng-if="update">
	<div class="header">Sedang Mengubah Status </div> 
	{{detail.payment_number}}
</div>

<div class="ui very padded segment">
	<div class="ui horizontal divider header">Data Pengguna</div>
	<img class="ui centered rounded uk-margin-bottom small image" src="<?= fullurl(); ?>/public/img/{{ detail.picture }}" />
	<div class="ui two column grid">
		<div class="column">
			<div class="ui list">
				<div class="item">
					<div class="ui two column grid ">
						<div class="column">Nama Pemegang Rekening</div>
						<div class="column"><b>{{ detail.card_holder }}</b></div>
					</div>
				</div>

				<div class="item">
					<div class="ui two column grid">
						<div class="column">Nomor Rekening </div>
						<div class="column"><b>{{ detail.card_number }} ({{ detail.payment_method }})</b></div>
					</div>
				</div>

				<div class="item">
					<div class="ui two column grid">
						<div class="column">Nomor Telepon </div>
						<div class="column"><b>{{ detail.phone }}</b></div>
					</div>
				</div>

			</div>
		</div>

		<div class="column">
			<div class="ui list">
				<div class="item">
					<div class="ui two column grid ">
						<div class="column">Nama Pengguna</div>
						<div class="column"><b>{{ detail.username }}</b></div>
					</div>
				</div>

				<div class="item">
					<div class="ui two column grid">
						<div class="column">Email</div>
						<div class="column"><b>{{ detail.email }}</b></div>
					</div>
				</div>

				<div class="item">
					<div class="ui two column grid">
						<div class="column">*Nama Penerima</div>
						<div class="column"><b>{{ detail.recipient }}</b></div>
					</div>
				</div>

				<div class="item">
					<div class="ui two column grid">
						<div class="column">*Alamat Tujuan</div>
						<div class="column"><b>{{ detail.destination }}</b></div>
					</div>
				</div>

			</div>
		</div>

	</div>

	<table class="ui blue striped table">
		<thead>
			<tr>
				<th>Nama Buku</th>
				<th>Jumlah Pembelian</th>
				<th>Pajak</th>
				<th>Diskon</th>
				<th>Harga Jual</th>
				<th>Harga Akhir</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="d in detail.cart">
				<td>{{ d.title }}</td>
				<td>{{ d.amount }} Buku</td>
				<td>{{ d.tax }}%</td>
				<td>{{ d.discount }}%</td>
				<td>Rp.{{ d.sellprice }}</td>
				<td>Rp.{{ d.price }}</td>
			</tr>
		</tbody>
		<tfoot class="full-width">
			<tr>
				<th><b>Total</b></th>
				<th colspan="3"><b>{{ detail.book_total }} Buku</b></th>
				<th colspan="5">
					<div class="ui right floated header">
					{{ detail.ttl }}
					</div>
				</th>
			</tr>
		</tfoot>
	</table>

	<div class="ui horizontal divider header">Konfirmasi</div>
	<form class="ui form" name="confirmation" ng-submit="paymentConfirmation(input,detail.id)" novalidate>
		<div class="field">
			<label>Status</label>
			<sm-dropdown class="selection" 
			model="input.status" items="status" 
			label="item.status_name" value="item.id" default-text="'Pilih Status'" settings="{allowAdditions: true}">
			</sm-dropdown>
		</div>

		<div class="field">
			<label>Nomor Resi</label>
			<input type="text" ng-model="input.resi_number" name="resi_number" placeholder="Nomor Resi" />
		</div>

		<button type="submit" class="ui labeled blue icon button"><i class="save icon"></i>Simpan</button>
	</form>
</div>