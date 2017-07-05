<div class="article" ng-controller="categoryController">
	<div class="ui masthead vertical tab segment">
		<div class="ui container">
			<div class="introduction">
				<h1 class="ui header">
					Pengaturan Kategori
					<div class="sub header">
						Kategori digunakan untuk mengklasifikasi jenis buku
					</div>
				</h1>
				<div class="ui hidden divider"></div>
				<!-- <a id="add" class="ui blue labeled icon button" data-tab="second">
					<i class="plus icon"></i>Tambahkan Buku
				</a> -->
			</div>

			<div id="tabular" class="ui  secondary pointing menu">
				<a class="active item" data-tab="first">Daftar Kategori</a>
			</div>
			<div class="ui teal message" ng-if="update">
				<div class="header">Sedang Mengubah: </div> 
				{{input.category_name}}
			</div>
			<form  class="ui form" name="cat" ng-submit="categoryAdd(input)" novalidate>
				<div class="inline fields">
					<div class="sixteen wide field">
						<label>Nama Kategori</label>
						<input type="text" ng-model="input.category_name" name="category_name">
						<div class="ui red pointing label letter-spacing-small" 
						ng-show="cat.category_name.$dirty &&cat.category_name.$invalid">
						Nama Kategori Dibutuhkan.</div>
						<button class="uk-margin-left ui blue labeled icon button" type="submit">
						<i class="save icon"></i>Simpan</button>
					</div>
				</div>
				<div ng-click="reset()" ng-if="update" class="ui teal labeled icon button"><i class="undo icon"></i>Reset</div>
			</form>

			<div id="itemFirst" class="ui active bottom tab uk-margin-large-top first" data-tab="first">
				<?php include 'category-list.view.php'; ?>
			</div>

		</div>
	</div>
</div>
