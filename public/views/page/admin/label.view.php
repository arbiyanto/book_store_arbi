<div class="article" ng-controller="labelController">
	<div class="ui masthead vertical tab segment">
		<div class="ui container">
			<div class="introduction">
				<h1 class="ui header">
					Pengaturan Kategori
					<div class="sub header">
						Label digunakan untuk memudahkan pengguna melakukan pencarian berdasarkan kriteria tertentu
					</div>
				</h1>
				<div class="ui hidden divider"></div>
				<!-- <a id="add" class="ui blue labeled icon button" data-tab="second">
					<i class="plus icon"></i>Tambahkan Buku
				</a> -->
			</div>

			<div id="tabular" class="ui  secondary pointing menu">
				<a class="active item" data-tab="first">Daftar Label</a>
				<a id="secondTab" class="item" data-tab="second">Hubungkan Buku dengan Label</a>
			</div>

			<div id="itemFirst" class="ui active bottom tab uk-margin-small-top first" data-tab="first">
				<?php include 'label-list.view.php'; ?>
			</div>
			<div id="itemSecond" class="ui bottom tab uk-margin-small-top second" data-tab="second">
				<?php include 'label-books-add.view.php'; ?>
			</div>

		</div>
	</div>
</div>
