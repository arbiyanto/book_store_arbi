<div class="article" ng-controller="booksController">
	<div class="ui masthead vertical tab segment">
		<div class="ui container">
			<div class="introduction">
				<h1 class="ui header">
					Pengaturan Katalog Buku
					<div class="sub header">
						Atur, Tambahkan, Ubah, dan Hapus Buku
					</div>
				</h1>
				<div class="ui hidden divider"></div>
				<div class="ui right floated main menu">
					<a class="book popup icon item" data-content="Lihat Halaman" data-position="bottom center">
						<i class="book icon"></i>
					</a>
				</div>
				<a id="add" class="ui blue labeled icon button" data-tab="second">
					<i class="plus icon"></i>Tambahkan Buku
				</a>
			</div>

			<div id="tabular" class="ui  secondary pointing menu">
				<a id="firstTab" class="active item" data-tab="first">Lihat Buku</a>
				<a id="addItem" class="item" data-tab="second">Tambahkan Buku</a>
				<a class="item" data-tab="third">Tambahkan Stok Buku</a>
				<a id="fourthTab" class="item" data-tab="fourth">Tambahkan Distributor</a>
				<a id="fifthTab" class="item" data-tab="fifth">Data Distributor</a>
			</div>

			<div id="itemFirst" class="ui active bottom tab uk-margin-large-top first" data-tab="first">
				<?php include 'books-list.view.php'; ?>
			</div>
			<div id="itemSecond" class="ui bottom tab uk-margin-large-top uk-margin-large-bottom second" data-tab="second">
				<?php include 'books-add.view.php'; ?>
			</div>
			<div id="itemThird" class="ui bottom tab uk-margin-large-top uk-margin-large-bottom third" data-tab="third">
				<?php include 'books-stock.view.php'; ?>
			</div>
			<div id="itemFourth" class="ui bottom tab uk-margin-large-top uk-margin-large-bottom fourth" data-tab="fourth">
				<?php include 'books-distributor.view.php'; ?>
			</div>
			<div id="itemFifth" class="ui bottom tab uk-margin-large-top uk-margin-large-bottom fifth" data-tab="fifth">
				<?php include 'books-distributor-list.view.php'; ?>
			</div>
		</div>
	</div>
</div>
