<div id="modalLogin" class="ui large coupled first modal authModal">
	<i class="close icon"></i>
  <div class="ui header letter-spacing"><i class="sign in icon"></i>Masuk sebagai pengguna</div>
  <div class="content">
	<div class="ui two column middle aligned very relaxed stackable grid">
		<div class="column">
			<form class="ui form" name="login" ng-submit="loginn(user)" method="post" novalidate>
				<div class="field">
					<label class="letter-spacing-small">Nama Pengguna</label>
					<div class="ui left icon input">
						<input placeholder="Nama Pengguna atau Email" type="text" name="username" ng-model="user.username" required>
						<i class="user icon"></i>
					</div>
					<div class="ui red pointing label letter-spacing-small" ng-show="login.username.$dirty &&login.username.$invalid">Username dibutuhkan.</div>
				</div>
				<div class="field">
					<label class="letter-spacing-small">Kata Sandi</label>
					<div class="ui left icon input">
						<input type="password" placeholder="&#9899;&#9899;&#9899;&#9899;&#9899;&#9899;&#9899;&#9899;&#9899;" name="password" ng-model="user.password" required>
						<i class="lock icon"></i>
					</div>
					<div class="ui red pointing label letter-spacing-small" ng-show="login.password.$dirty && login.password.$invalid">Kata sandi dibutuhkan.</div>
				</div>
				<button ng-disabled="!login.$valid" ng-class="{'loading disabled' : onLoading}" type="submit" class="ui red submit fluid button"><i class="sign in icon"></i>Masuk Sekarang</button>
				<div class="uk-margin-large-top ui horizontal divider letter-spacing-small">Masuk dengan Social Media</div>
				
			</form>
			<button ng-click="authenticate('facebook')" class="uk-margin-bottom ui facebook fluid button">
				  <i class="facebook icon"></i>
				  Masuk dengan Facebook
				</button>
				<button ng-click="authenticate('google')" class="uk-margin-bottom ui google plus fluid button">
				  <i class="google plus icon"></i>
				  Masuk dengan Google Plus
				</button>
				<!-- <button ng-click="authenticate('twitter')" class="uk-margin-bottom ui twitter fluid button">
				  <i class="twitter icon"></i>
				  Masuk dengan Twitter
				</button> -->
		</div>
		
		<div class="center aligned column">

			<div class="ui header letter-spacing">Belum Daftar?</div>
			<button id="registerButton" class="ui big  red labeled icon button"  modal="#modalRegister">
				<i class="signup icon"></i>
				Daftar Sekarang
			</button>
		</div>
	</div>
  </div>
</div>
<div id="modalRegister" class="ui coupled second long modal authModal" coupled>
	<i class="close icon"></i>
  <div class="header"><i class="signup icon"></i>Daftar Sebagai Pengguna</div>
  <div class="content">
	<div class="ui middle aligned very relaxed stackable grid">
		<div class="column">
			<form class="ui form" ng-submit="registerr(input)" method="post" name="register">
				<div class="field">
					<label class="letter-spacing-small">Nama Pengguna</label>
					<div class="ui left icon input">
						<input placeholder="username" name="username" type="text" ng-model="input.username" required  ng-pattern="/^[A-z][A-z0-9]*$/">
						<i class="user icon"></i>
					</div>
					<div class="ui red pointing label letter-spacing-small" ng-show="register.username.$touched &&register.username.$invalid">Username dibutuhkan | Jangan gunakan spasi ataupun simbol.</div>
				</div>
				<div class="field">
					<label class="letter-spacing-small">Email</label>
					<div class="ui left icon input">
						<input type="email" placeholder="username@mail.com" name="email" type="text" ng-model="input.email"required>
						<i class="mail icon"></i>
					</div>
					<div class="ui red pointing label letter-spacing-small" ng-show="register.email.$touched &&register.email.$invalid">Email dibutuhkan.</div>
				</div>
				<div class="field">
					<label class="letter-spacing-small">Kata Sandi</label>
					<div class="ui left icon input">
						<input type="password" placeholder="password" minlength="8" name="password" ng-model="input.password" required>
						<i class="lock icon"></i>
					</div>
					<div class="ui red pointing label letter-spacing-small" ng-show="register.password.$touched &&register.password.$invalid">Kata sandi dibutuhkan. Minimal 8 karakter.</div>
				</div>
				<div class="field">
					<label class="letter-spacing-small">Ulangi Kata Sandi</label>
					<div class="ui left icon input">
						<input type="password" placeholder="repeat password" name="passwordConfirm" ng-model="input.passwordConfirm" match="input.password" required>
						<i class="lock icon"></i>
					</div>
					<div class="ui red pointing label letter-spacing-small" ng-show="register.password.$valid && !register.passwordConfirm.$dirty && register.passwordConfirm.$error.match">Password tidak sama</div>
				</div>
				<button ng-disabled="!register.$valid && !register.passwordConfirm.match" 
				ng-class="{'loading disabled' : onLoading}" type="submit" class="ui red fluid submit button">
				<i class="sign in icon"></i>Daftar Sekarang
				</button>
			</form>
		</div>
	</div>
  </div>
</div>
