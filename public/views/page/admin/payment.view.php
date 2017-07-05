<div class="article" ng-controller="paymentController">
	<div class="ui masthead vertical tab segment">
		<div class="ui container">
			<div class="introduction">
				<h1 class="ui header">
					Permintaan Transaksi
					<div class="sub header">
						Pembeli buku meminta konfirmasi pembayaran.
					</div>
				</h1>
				<div class="ui hidden divider"></div>
				<div class="ui right floated main menu">
					<a class="book popup icon item" data-content="Lihat Halaman" data-position="bottom center">
						<i class="book icon"></i>
					</a>
				</div>
			</div>

			<div id="tabular" class="ui  secondary pointing menu">
				<a id="firstTab" class="active item" data-tab="first">Sejumlah Permintaan Transaksi</a>
			</div>

			<div id="itemFirst" class="ui active bottom tab uk-margin-large-top first" data-tab="first">
				<?php include 'payment-list.view.php'; ?>
			</div>
			<div id="itemSecond" class="ui bottom tab uk-margin-large-top uk-margin-large-bottom second" data-tab="second">
				<?php include 'payment-edit.view.php'; ?>
			</div>
		</div>
	</div>
</div>
