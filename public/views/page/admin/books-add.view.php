<form  class="ui form" name="add" ng-submit="bookAdd(input)" novalidate>
	<div class="ui teal message" ng-if="update">
		<div class="header">Sedang Mengubah: </div> 
		{{input.title}}
	</div>
	<div class="field">
		<label>Judul Buku</label>
		<input type="text" name="title" ng-model="input.title" placeholder="Judul Buku" required>
		<div class="ui red pointing label letter-spacing-small" 
		ng-show="add.title.$dirty &&add.title.$invalid">
		Judul Buku Dibutuhkan.</div>
	</div>
	<div class="field">
		<label>Penulis</label>
		<input type="text" name="author" ng-model="input.author" placeholder="Penulis" required>
		<div class="ui red pointing label letter-spacing-small" 
		ng-show="add.author.$dirty &&add.author.$invalid">
		Penulis Dibutuhkan.</div>
	</div>
	<div class="field">
		<label>No.ISBN</label>
		<input type="text" name="noisbn" ng-model="input.noisbn" placeholder="000xxxxx" required>
		<div class="ui red pointing label letter-spacing-small" 
		ng-show="add.noisbn.$dirty &&add.noisbn.$invalid">
		Nomor ISBN Dibutuhkan.</div>
	</div>
	<div class="fields">
		<div class="four wide field">
			<label>Tanggal Rilis</label>
			<div date-picker="input.date" timezone="Asia/Jakarta" ng-model="input.date" 
			format="DD MMMM YYYY"
			min-view="date" max-view="year"></div>
		</div> {{date}}
		<div class="six wide field">
			<label>Penerbit</label>
			<input type="text" name="publisher" ng-model="input.publisher" placeholder="Penerbit" required>
			<div class="ui red pointing label letter-spacing-small" 
			ng-show="add.publisher.$dirty &&add.publisher.$invalid">
			Penerbit Dibutuhkan.</div>
		</div>
		<div class="six wide field">
			<label>Kategori Buku</label>
			<sm-dropdown class="fluid search selection" 
			model="input.category_id" items="category" 
			label="item.category_name" value="item.id" default-text="'Select Country'"></sm-dropdown>

			<div class="ui red pointing label letter-spacing-small" 
			ng-show="add.category_id.$dirty &&add.category_id.$invalid">
			Kategori Buku Dibutuhkan.</div>
		</div>
	</div>

	<div class="four fields">
		<div class="field">
			<label>Harga Pokok</label>
			<div class="ui labeled input">
				<div class="ui label">
				Rp.
				</div>
				<input type="number" name="baseprice" ng-model="input.baseprice" required>
			</div>
			<div class="ui red pointing label letter-spacing-small" 
			ng-show="add.baseprice.$dirty &&add.baseprice.$invalid">
			Harga Pokok Dibutuhkan.</div>
		</div>

		<div class="field">
			<label>Harga Jual</label>
			<div class="ui labeled input">
				<div class="ui label">
				Rp.
				</div>
				<input type="number" name="sellprice" ng-model="input.sellprice"  required>
			</div>
			<div class="ui red pointing label letter-spacing-small" 
			ng-show="add.sellprice.$dirty &&add.sellprice.$invalid">
			Harga Jual Dibutuhkan.</div>
		</div>

		<div class="field">
			<label>Pajak</label>
			<div class="ui right labeled  input">
				<input type="number" name="tax" ng-model="input.tax" required>
				<div class="ui label">
				%
				</div>
			</div>
			<div class="ui red pointing label letter-spacing-small" 
			ng-show="add.tax.$dirty &&add.tax.$invalid">
			Pajak Dibutuhkan.</div>
		</div>

		<div class="field">
			<label>Diskon</label>
			<div class="ui right labeled  input">
				<input type="number" name="discount" ng-model="input.discount" >
				<div class="ui label">
				%
				</div>
			</div>
			<div class="ui red pointing label letter-spacing-small" 
			ng-show="add.discount.$dirty &&add.discount.$invalid">
			Diskon Dibutuhkan.</div>
		</div>

	</div>
	<div class="field">
	<div ckeditor="options" id="editor1" placeholder="Deskripsi tentang buku" ng-model="input.description" ready="onReady()"></div>
	</div>
	<div class="field">
		<img class="ui small image" ng-if="input.picture" 
		ng-src="<?= fullurl(); ?>/public/img/upload/{{ input.picture}}" />

		<button class="ui button uk-margin-top" 
			ngf-select="uploadPicture(add.picture.$valid && picture, $file)" 
			ngf-resize="{width: 356, height: 542, centerCrop: true,quality: .9, 
			type: 'image/jpeg'}" 
			name="picture" ng-model="picture" ngf-pattern="'image/*'"
    ngf-accept="'image/*'">
    		<i class="upload icon"></i>Upload Foto Sampul Buku
    	</button>

    	<div id="upload" class="ui indicating progress uk-margin-top" progress >
    		<div class="bar"></div>
    	</div>
	</div>

	<button ng-disabled="!add.$valid" ng-class="{'loading disabled' : onLoading}" type="submit" 
	class="ui blue button">
	<i class="save icon"></i>Simpan</button>
	<div ng-click="deleteBooks(input.id)" ng-if="input.id" class="uk-float-right ui red labeled icon button"><i class="remove icon"></i>Delete</div>
	<div ng-click="reset()" class="uk-float-right ui teal labeled icon button"><i class="undo icon"></i>Reset</div>
</form>