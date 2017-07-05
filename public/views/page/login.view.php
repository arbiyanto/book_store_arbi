<style type="text/css">
body {
  background-color: #DADADA;
}
body  .grid {
  height: 100vh;
  flex-direction:column;
  -webkit-flex-direction:column;
  align-items:center;
  -webkit-align-items:center;
  align-content:center;
  -webkit-align-content:center;
  justify-content:center;
  -webkit-justify-content:center;

}
.image {
  margin-top: -100px;
}
.column {
  max-width: 450px;
}
</style>
<div class="ui middle aligned center aligned grid">
	<div class="column">
		<h2 class="ui  image header">
			<img src="<?= fullurl(); ?>/public/img/logo.png" class="image">
			<div class="content">
				Masuk Sebagai Admin
			</div>
		</h2>
		<form class="ui large form" ng-submit="adminLogin(input)" name="login" id="login">
			<div class="ui stacked segment">
				<div class="field">
					<div class="ui left icon input">
						<i class="user icon"></i>
						<input placeholder="Username" id="username" type="text" ng-model="input.username" required minlength="5" maxlength="30">
					</div>
				</div>
				<div class="field">
					<div class="ui left icon input">
						<i class="lock icon"></i>
						<input type="password" name="password" placeholder="Password" ng-model="input.password" required minlength="7" maxlength="24">
					</div>
				</div>
				<button ng-disabled="!login.$valid" ng-class="{'disabled loading': onLoading}" class="ui fluid button black" type="submit" name="action">
				Masuk Sekarang
				</button>
			</div>
	
			<div class="ui error message visible" ng-if="error">
				{{ message }}
			</div>
		</form>
	</div>
</div>
