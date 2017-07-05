<!DOCTYPE html>
<html ng-app="arbooksApp">
<head>
	<title>ArBuku - <?php if(isset($title)) echo $title; else echo 'Kenyamanan Mencari Buku' ?></title>
<link rel="stylesheet" type="text/css" href="<?= fullurl(); ?>/public/css/semantic.css">
<link rel="stylesheet" type="text/css" href="<?= fullurl(); ?>/public/css/uikit.almost-flat.min.css">
<link rel="stylesheet" type="text/css" href="<?= fullurl(); ?>/public/css/angular-ui-notification.min.css">
<link rel="stylesheet" type="text/css" href="<?= fullurl(); ?>/public/css/components/slideshow.almost-flat.min.css">
<link rel="stylesheet" type="text/css" href="<?= fullurl(); ?>/public/css/components/dotnav.almost-flat.min.css">
<link rel="stylesheet" type="text/css" href="<?= fullurl(); ?>/public/css/components/slidenav.almost-flat.min.css">
<link rel="stylesheet" type="text/css" href="<?= fullurl(); ?>/public/css/style.css">
<link rel="shortcut icon" href="<?= fullurl(); ?>/public/img/logo.png">
</head>
<body ng-controller="baseController">
<?php
use Library\Auth;

include 'partial/header.php';
include 'partial/cart.php';

if(!Auth::user()) {
	include 'partial/login-register.php';
}

echo '<div class="pusher">';
subView($view, $globals);
echo '</div>';
?>

<script src="<?= fullurl(); ?>/public/js/jquery.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/semantic.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/uikit.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/components/sticky.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/components/slideshow.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular-animate.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular-ui-notification.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular-validation-match.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular-sanitize.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular-semantic-ui.js"></script>
<script src="<?= fullurl(); ?>/public/js/readmore.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/ng-file-upload.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/moment.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/id.js"></script>

<script>
$(document).ready(function() {
	<?php  if(!Auth::user() || in_array(Auth::user()->role_id, ['2','3']) ) { ?>
	$('.cookie.nag').nag({
		key      : 'accepts-cookies',
		value    : true
	});
	<?php } ?>

});

var app = angular.module('arbooksApp', ['ui-notification','validation.match','ngFileUpload','ngSanitize'
	,'semantic-ui',"hm.readmore",'ngAnimate']);

app.controller('baseController', ['$scope','$rootScope','$http','$window','Notification', function($scope,$rootScope,$http, $window,Notification) {
	$scope.onLoading = false;
	$scope.menu1 = [];

	// redirect with angularjs
	/*$scope.tes = function() {
		$window.location.href = '<?= fullurl(); ?>';
	}
*/
	$scope.amount = 1;

	$scope.myamount = [];
	$scope.st = [];
	$scope.mysubtotal = 0;

	Number.prototype.formatMoney = function(c, d, t){
		var n = this, 
	    c = isNaN(c = Math.abs(c)) ? 2 : c, 
	    d = d == undefined ? "." : d, 
	    t = t == undefined ? "," : t, 
	    s = n < 0 ? "-" : "", 
	    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
	    j = (j = i.length) > 3 ? j % 3 : 0;
	   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	 };

	$scope.cartList = function() {
		$http.get('<?= fullurl(); ?>/get/cart')
			.then(function (response) {
				$rootScope.cartUser = response.data;
				for(var x = 0; x < $rootScope.cartUser.cart.length; x++) {
					$scope.myamount[x] = $rootScope.cartUser.cart[x].amount;
				}

				$scope.getTotal();
			})
	}

	$scope.cartList();

	$rootScope.cart = function(data) {
		$scope.ct = data;
		var unmount = function() {
			$scope.amount = 1;
			$scope.ct = {};
			$scope.subTotal = 0;
		}
		$scope.modal1 = $("#modalCart").modal({onHidden: unmount}).modal('show');
		var st = parseInt(data.price.replace(/\D/g,''));
		$scope.saveTotal = st;
		$scope.subtotal = (st).formatMoney(0, ',', '.');
	}

	$scope.addCart = function(id) {
		$scope.loading = true;
		var input = { book_id: id, amount: $scope.amount }
		$http.post('<?= fullurl(); ?>/add/cart', input)
			.then(function (response) {
				Notification({message: response.data.message}, response.data.status);
				$scope.loading = false;
				$scope.modal1.modal('hide');
				$scope.cartList();
			});
	}

	$rootScope.subtotalCount = function() {
		$scope.subtotal = ($scope.saveTotal * $scope.amount).formatMoney(0,',','.');
	}

	function add(a, b) {
		return a + b;
	}

	$scope.changeSub = function() {
		$scope.mysubtotal = 0;

		for(var x = 0; x < $rootScope.cartUser.cart.length; x++) {
			var k = parseInt($rootScope.cartUser.cart[x].price.replace(/\D/g,''));
			$scope.st[x] = k * $scope.myamount[x];
		}
		var st = $scope.st.reduce(add, 0);
		$scope.mysubtotal = (st).formatMoney(0,',','.');
	}

	$scope.getTotal = function() {
		$scope.mysubtotal = 0;
		for(var x = 0; x < $rootScope.cartUser.cart.length; x++) {
			var k = parseInt($rootScope.cartUser.cart[x].price.replace(/\D/g,''));
			$scope.st[x] = (k * parseInt($rootScope.cartUser.cart[x].amount));
		}
		
		var st = $scope.st.reduce(add, 0);
		$scope.mysubtotal = (st).formatMoney(0,',','.');
	}

	$scope.buy = function() {
		var t = angular.toJson($scope.st);
		var input = [
			{amount: $scope.st,total: $scope.mysubtotal,cart: $rootScope.cartUser.cart}		];
		
		$http.post('<?= fullurl(); ?>/', input).then(function() {

		})
	}



	$scope.loginn = function(input) {
		$scope.onLoading = true;
		$http.post("<?= fullurl(); ?>/auth/login/user", input)
			.then(function (response) {
				$scope.onLoading = false;
				Notification({message: response.data.message}, response.data.status);
				setInterval(function() {
					window.location.reload();	
				},1000)
				
			}, function (resp) {
				$scope.error = true;
				$scope.message = resp.data.message;
				$scope.onLoading = false;
			});
	}

	$scope.handleClick = function(item, $event) {
		alert( item.id );
	};


	$scope.registerr = function(input) {
		$scope.onLoading = true;
		$http.post("<?= fullurl(); ?>/auth/register", input)
			.then(function (response) {
				$scope.onLoading = false;
				Notification({message: response.data.message}, response.data.status);
				setInterval(function() {
					window.location.reload();	
				},1000)
				
			}, function (resp) {
				$scope.error = true;
				$scope.message = resp.data.message;
				$scope.onLoading = false;
			});
	}

	$scope.getCategory = function() {
		$http.get('<?= fullurl(); ?>/get/categories')
			.then(function (response) {
				$scope.menu1 = response.data;
			});
	}

	$scope.newBooks = <?php if(isset($newbooks)) echo json_encode($newbooks); else echo '[]' ; ?>;
	$scope.bestSeller = <?php if(isset($bestseller)) echo json_encode($bestseller); else echo '[]' ; ?>;

	$scope.getCategory();
	

}])
.controller('booksDetailController', ['$scope','$rootScope','$http','$sce', function($scope,$rootScope,$http, $sce) {
	$scope.detail = <?php if(isset($data)) echo json_encode($data); else echo '{}'; ?>;
	$scope.other_books = <?php if(isset($other_books)) echo json_encode($other_books); else echo '[]'; ?>;
	$scope.limitChar = 800;

	$scope.detail.date = moment.unix(parseInt($scope.detail.date)).format('DD MMMM YYYY');

}])
.controller('booksListController', ['$scope','$rootScope','$http','$sce', function($scope,$rootScope,$http, $sce) {
	$scope.books = <?php if(isset($data)) echo json_encode($data); else echo '[]'; ?>;
	$scope.sort = <?php if(isset($sort)) echo $sort; else echo '""'; ?>;
	$scope.sortBy = [
		{name: 'Terbaru'},
		{name: 'Termurah'},
		{name: 'Termahal'},
		{name: 'Terlaris'}
	];
	

}])
.directive('modal', function() {
	return {
		restrict: 'A',
		link: {
		    pre: function (scope, element, attrs) {
		    	$(element).click(function() {
		    		$(attrs.modal).modal('toggle');
		    	});
		    }
		}
	};
})
.directive('search', function() {
	return {
		/*controller: controller*/
		link: {
		    pre: function (scope, element, attrs) {
		    	
		    	$.fn.search.settings.templates.customType = function(response, fields) {
					var html = '';
					if(response[fields.results] !== undefined) {

						// each result
						$.each(response[fields.results], function(index, result) {
							if(result[fields.url]) {
								html  += '<a class="result" href="' + result[fields.url] + '">';
							}else {
								html  += '<a class="result">';
							}
							if(result[fields.image] !== undefined) {
								html += ''+ '<div class="ui left image">'+ ' <img src="' + result[fields.image] + '">'+ '</div>';
							}
							html += '<div class="content">';
							if(result[fields.title] !== undefined) {
								html += '<div class="title">' + result[fields.title]+' ('+ result[fields.type] + ')</div>';
							}
							html  += ''+ '</div>';
							html += '</a>';
						});

						if(response[fields.action]) {
							html += ''+ '<a href="' + response[fields.action][fields.actionURL] + '" class="action">'
							+ response[fields.action][fields.actionText]
							+ '</a>';
						}
						return html;
					} return false;
				};

		    	$(element).search({
				apiSettings: {
					
					onResponse: function(siteResponse) {
						var response = [];
						var r = {results : response};
						for(x = 0; x < siteResponse.results.length; x++){
							response.push({
								title: siteResponse.results[x].title,
								/*type: siteResponse.results[x].type,
								episode: siteResponse.results[x].episode,*/
								image: 'url'+siteResponse.results[x].picture_catalog,
							});
						}
						return r;
					}
					,url: 'anime/searching/{query}', // url
				}, 
				fields: {
					/*type: 'type',
					status: 'status',
					episode: 'episode',*/

				},
				type: 'customType',
				minCharacters : 3,
	
				})
		    }
		}
	};
})
.directive('dimmer', function() {
	return function (scope, element, attr) {
		$(element).dimmer({
		  on: 'hover'
		});
    };
})
;
;
</script>
</body>
</html>