<!DOCTYPE html>
<html ng-app="arbooksApp">
<head>
	<title>ArBooks - <?php if(isset($title)) echo $title; else echo 'Halaman Admin' ?></title>
<link rel="stylesheet" type="text/css" href="<?= fullurl(); ?>/public/css/semantic.css">
<link rel="stylesheet" type="text/css" href="<?= fullurl(); ?>/public/css/uikit.almost-flat.min.css">
<link rel="stylesheet" type="text/css" href="<?= fullurl(); ?>/public/css/angular-ui-notification.min.css">
<link rel="stylesheet" type="text/css" href="<?= fullurl(); ?>/public/css/angular-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="<?= fullurl(); ?>/public/css/admin.css">
<link rel="shortcut icon" href="<?= fullurl(); ?>/public/img/logo.png">
</head>
<body ng-controller="baseController">
<?php
use Library\Auth;

if(Auth::user() && in_array(Auth::user()->role_id, ['2','3']) ) {
	include 'partial/admin/sidebar.php';
}

echo '<div class="pusher">';
subView($view, $globals);
echo '</div>';
?>

<script src="<?= fullurl(); ?>/public/js/jquery.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/semantic.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/ckeditor.js"></script>
<script src="<?= fullurl(); ?>/public/js/lang/id.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular-ui-notification.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular-validation-match.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular-datepicker.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular-sanitize.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular-ckeditor.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/angular-ckeditor-placeholder.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/sm-core.js"></script>
<script src="<?= fullurl(); ?>/public/js/sm-dropdown.js"></script>
<script src="<?= fullurl(); ?>/public/js/ng-file-upload.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/moment.min.js"></script>
<script src="<?= fullurl(); ?>/public/js/id.js"></script>
<script src="<?= fullurl(); ?>/public/js/moment-timezone-with-data.min.js"></script>
<script>
$(document).ready(function() {
	$('.popup').popup();
	$('.menu .item').tab();
	$('.button').tab();
	$("#add").click(function() {
		$("#tabular .item").removeClass('active');
		$("#addItem").addClass('active');
	});
	$(".tes").click(function() {
		$("#tabular .item,#itemFirst").removeClass('active');
		$("#addItem,#itemSecond").addClass('active');
	});
	$(".tes2").click(function() {
		$("#tabular .item,#itemFifth").removeClass('active');
		$("#fourthTab,#itemFourth").addClass('active');
	});
});

var app = angular.module('arbooksApp', ['ui-notification','validation.match','datePicker','ngFileUpload','ngSanitize'
	,'semantic-ui-dropdown','ckeditor']);

app
.controller('baseController', ['$scope','$http','Notification','Upload', function($scope,$http, Notification, Upload) {
	$scope.onLoading = false;

	$scope.adminLogin = function(input) {
		$scope.onLoading = true;
		$http.post("<?= fullurl(); ?>/auth/login/admin", input)
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
}])
.controller('booksController', ['$scope','$http','Notification','Upload','$sce' , function($scope,$http, Notification, Upload,$sce) {
	$scope.onLoading = false;
	$scope.input = {};

	$scope.books = <?php echo json_encode($data) ?>

	// Editor options.
	$scope.options = {
		language: 'id',
		allowedContent: true,
		entities: false
	};

	// Called when the editor is completely ready.
	$scope.onReady = function () {
	// ...
	};

	$scope.indexSearch = function(array, id) {	
		return array.map(function(el) {
		  return el.id;
		}).indexOf(id);
    }

	$scope.bookAdd = function(input) {
		input.date = moment(input.date).format('DD-MM-YYYY');
		$scope.onLoading = true;

		if(input.id===undefined) {
			$http.post('<?= fullurl(); ?>/admin/books/create', input)
			.then(function (response) {
				if(response.data.status=="success") {
					Notification({message: response.data.message}, response.data.status);
					$scope.books.push(response.data.books);
					$scope.onLoading = false;
					$scope.input = {};

					$("#tabular .item,#itemSecond").removeClass('active');
					$("#firstTab,#itemFirst").addClass('active');
				}else {
					Notification({message: response.data.message}, response.data.status);
					$scope.onLoading = false;
				}
			});
		}else{
			$http.put('<?= fullurl(); ?>/admin/books/update/'+input.id, input)
			.then(function (response) {
				Notification({message: response.data.message}, response.data.status);
				var index = $scope.indexSearch($scope.books, input.id);
                $scope.books[index] = response.data.books;
				$scope.onLoading = false;
				$scope.input = {};

				$("#tabular .item,#itemSecond").removeClass('active');
				$("#firstTab,#itemFirst").addClass('active');
			}, function (resp) {
				Notification({message: resp.data.message}, resp.data.status);
				$scope.onLoading = false;
			})
		}
		
	}

	$scope.reset = function() {
		$scope.input = {};
		$scope.dt = {};
		$scope.date = null;
	}

	$scope.updateBooks = function(id) {
		$scope.input = {};
		$http.get("<?= fullurl(); ?>/admin/books/detail/"+id)
			.then(function (response) {
				$scope.date = moment.unix(parseInt(response.data.da)).format('DD MMMM YYYY');
				$scope.input = response.data;
				$scope.input.description = response.data.description;
				$scope.input.baseprice = parseInt(response.data.baseprice);
				$scope.input.sellprice = parseInt(response.data.sellprice);
				$scope.input.tax = parseInt(response.data.tax);
				$scope.input.discount = parseInt(response.data.discount);
			}
		);
	}

	$scope.deleteBooks = function(id) {
		if (confirm("Hapus Buku Ini?")) {
			$http.delete("<?= fullurl(); ?>/admin/books/delete/"+id)
				.then(function (response) {
					Notification({message: response.data.message}, response.data.status);
					var index = $scope.indexSearch($scope.books, input.id);
					$scope.books.splice(index, 1);
					$scope.input = {};
					
					$("#tabular .item,#itemSecond").removeClass('active');
					$("#firstTab,#itemFirst").addClass('active');
				},
				function (resp) {
					Notification({message: response.data.message}, response.data.status);
				}
			);
		}
	}

	$scope.getCategory = function() {
		$http.get("<?= fullurl(); ?>/get/categories")
			.then(function (response) {
				$scope.category = response.data;
			}
		);
	}

	$scope.uploadPicture = function(isValid, file, method) {
        if (isValid) {
        	$scope.fname = file.name;
            $scope.onProgress1 = true;
            Upload.upload({
                url: '<?= fullurl(); ?>/upload/picture',
                method: 'POST',
                data: {
                    image: file,
                } 
            }).then(function (resp) {
                $scope.onProgress1 = false;
                $scope.input.picture = resp.data.content;
            }, function (resp) {
                Notification({message: resp.message}, resp.status);
            }, function (evt) {
                var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                $scope.progress1 = progressPercentage;
                $('#upload').progress({
                	percent: $scope.progress1
                });
            });
	    }    
    }

    $scope.distributorAdd = function(input) {
    	$scope.onLoading = true;

		if(input.id===undefined) {
			$http.post('<?= fullurl(); ?>/admin/distributor/create', input)
			.then(function (response) {
				Notification({message: response.data.message}, response.data.status);
				$scope.distributor.push(response.data.distributor);
				$scope.onLoading = false;
			}, function (resp) {
				Notification({message: response.data.message}, response.data.status);
				$scope.onLoading = false;
			})
		}else{
			$http.put('<?= fullurl(); ?>/admin/distributor/update/'+input.id, input)
			.then(function (response) {
				Notification({message: response.data.message}, response.data.status);
				$scope.onLoading = false;
				var index = $scope.indexSearch($scope.distributor, input.id);
                $scope.distributor[index] = response.data.distributor;
			}, function (resp) {
				Notification({message: resp.data.message}, resp.data.status);
				$scope.onLoading = false;
			})
		}
    }

    $scope.updateDistributor = function(id) {
		$scope.dt = {};
		$http.get("<?= fullurl(); ?>/admin/distributor/detail/"+id)
			.then(function (response) {
				$scope.dt = response.data;
			}
		);
	}

	$scope.deleteDistributor = function(id) {
		if (confirm("Hapus Distributor Ini?")) {
			$http.delete("<?= fullurl(); ?>/admin/distributor/delete/"+id)
				.then(function (response) {
					Notification({message: response.data.message}, response.data.status);
					var index = $scope.indexSearch($scope.distributor, input.id);
					$scope.distributor.splice(index, 1);
				},
				function (resp) {
					Notification({message: response.data.message}, response.data.status);
				}
			);
		}
	}

    $scope.getDistributor = function() {
		$http.get("<?= fullurl(); ?>/get/distributor")
			.then(function (response) {
				$scope.distributor = response.data;
			}
		);
	}

	$scope.getDistributor = function() {
		$http.get("<?= fullurl(); ?>/get/distributor")
			.then(function (response) {
				$scope.distributor = response.data;
			}
		);
	}

	$scope.stockAdd = function(input) {
    	$scope.onLoading = true;
    	input.date = moment(input.date).format('DD-MM-YYYY');

		if(input.id===undefined) {
			$http.post('<?= fullurl(); ?>/admin/stock/create', input)
			.then(function (response) {
				Notification({message: response.data.message}, response.data.status);
				setInterval(function() {
					window.location.reload();	
				},2000);
				$scope.onLoading = false;
			}, function (resp) {
				Notification({message: response.data.message}, response.data.status);
				$scope.onLoading = false;
			})
		}
    }

	$scope.getCategory();
	$scope.getDistributor();
}])
.controller('categoryController', ['$scope','$http','Notification','Upload' , function($scope,$http, Notification, Upload) {
	$scope.category = <?php echo json_encode($data) ?>

	$scope.update = false;

	$scope.indexSearch = function(array, id) {	
		return array.map(function(el) {
		  return el.id;
		}).indexOf(id);
    }

	$scope.categoryAdd = function(input) {
    	$scope.onLoading = true;

		if(input.id===undefined) {
			$http.post('<?= fullurl(); ?>/admin/categories/create', input)
			.then(function (response) {
				Notification({message: response.data.message}, response.data.status);
				$scope.category.unshift(response.data.category);
				$scope.onLoading = false;
				$scope.input = {};
			}, function (resp) {
				Notification({message: response.data.message}, response.data.status);
				$scope.onLoading = false;
			})
		}else{
			$http.put('<?= fullurl(); ?>/admin/categories/update/'+input.id, input)
			.then(function (response) {
				var index = $scope.indexSearch($scope.category, input.id);
                $scope.category[index] = response.data.category;
				Notification({message: response.data.message}, response.data.status);
				$scope.onLoading = false;
				$scope.input = {};
				$scope.update = false;
			}, function (resp) {
				Notification({message: resp.data.message}, resp.data.status);
				$scope.onLoading = false;
			})
		}
    }

    $scope.updateCategory = function(id) {
		$scope.input = {};
		$scope.update = true;
		$scope.onLoading = false;
		$http.get("<?= fullurl(); ?>/admin/categories/detail/"+id)
			.then(function (response) {
				$scope.input = response.data;
			}
		);
	}

	$scope.reset = function() {
		$scope.input = {};
		$scope.update = false;
	}

	$scope.deleteCategory = function(id) {
		if (confirm("Hapus Kategori Ini?")) {
			$http.delete("<?= fullurl(); ?>/admin/categories/delete/"+id)
				.then(function (response) {
					Notification({message: response.data.message}, response.data.status);
					var index = $scope.indexSearch($scope.category, id);
					$scope.category.splice(index, 1);
				},
				function (resp) {
					Notification({message: response.data.message}, response.data.status);
				}
			);
		}
	}

}])
.controller('labelController', ['$scope','$http','Notification','Upload' , function($scope,$http, Notification, Upload) {
	$scope.label = <?php echo json_encode($data) ?>;
	$scope.labelbooks = <?php if(isset($labelbooks)) echo json_encode($labelbooks); else echo '[]'; ?>;

	$scope.update = false;
	$scope.onLoading = false;
	$scope.input = {};
	$scope.inp = {};

	$scope.indexSearch = function(array, id) {	
		return array.map(function(el) {
		  return el.id;
		}).indexOf(id);
    }

	$scope.labelAdd = function(input) {
    	$scope.onLoading = true;

		if(input.id===undefined) {
			$http.post('<?= fullurl(); ?>/admin/labels/create', input)
			.then(function (response) {
				Notification({message: response.data.message}, response.data.status);
				$scope.label.unshift(response.data.label);
				$scope.onLoading = false;
				$scope.input = {};
			}, function (resp) {
				Notification({message: response.data.message}, response.data.status);
				$scope.onLoading = false;
			})
		}else{
			$http.put('<?= fullurl(); ?>/admin/labels/update/'+input.id, input)
			.then(function (response) {
				var index = $scope.indexSearch($scope.label, input.id);
                $scope.label[index] = response.data.label;
				Notification({message: response.data.message}, response.data.status);
				$scope.onLoading = false;
				$scope.input = {};
				$scope.update = false;
			}, function (resp) {
				Notification({message: resp.data.message}, resp.data.status);
				$scope.onLoading = false;
			})
		}
    }

    $scope.updateLabel = function(id) {
		$scope.input = {};
		$scope.update = true;
		$scope.onLoading = false;
		$http.get("<?= fullurl(); ?>/admin/labels/detail/"+id)
			.then(function (response) {
				$scope.input = response.data;
			}
		);
	}

	$scope.reset = function() {
		$scope.input = {};
		$scope.update = false;
	}

	$scope.deleteLabel = function(id) {
		if (confirm("Hapus Label Ini?")) {
			$http.delete("<?= fullurl(); ?>/admin/labels/delete/"+id)
				.then(function (response) {
					Notification({message: response.data.message}, response.data.status);
					var index = $scope.indexSearch($scope.label, id);
					$scope.label.splice(index, 1);
				},
				function (resp) {
					Notification({message: response.data.message}, response.data.status);
				}
			);
		}
	}

	$scope.getBooks = function() {
		$http.get("<?= fullurl(); ?>/get/books")
			.then(function (response) {
				$scope.books = response.data;
			}
		);
	}

	$scope.getBooks();

	$scope.labelBooksAdd = function(input) {
		$scope.onLoading = true;

		if(input.id===undefined) {
			$http.post('<?= fullurl(); ?>/admin/booklabels', input)
			.then(function (response) {
				Notification({message: response.data.message}, response.data.status);
				$scope.labelbooks.unshift(response.data.labelbooks);
				$scope.onLoading = false;
				$scope.inp = {};
			}, function (resp) {
				Notification({message: response.data.message}, response.data.status);
				$scope.onLoading = false;
			})
		}else{
			$http.put('<?= fullurl(); ?>/admin/booklabels', input)
			.then(function (response) {
				var index = $scope.indexSearch($scope.labelbooks, input.id);
                $scope.labelbooks[index] = response.data.labelbooks;
				Notification({message: response.data.message}, response.data.status);
				$scope.onLoading = false;
				$scope.inp = {};
				$scope.update = false;
			}, function (resp) {
				Notification({message: resp.data.message}, resp.data.status);
				$scope.onLoading = false;
			})
		}
	}

	$scope.deleteLabelBooks = function(id) {
		if (confirm("Hapus Label Ini?")) {
			$http.delete("<?= fullurl(); ?>/admin/booklabels/delete/"+id)
				.then(function (response) {
					Notification({message: response.data.message}, response.data.status);
					var index = $scope.indexSearch($scope.label, id);
					$scope.labelbooks.splice(index, 1);
				},
				function (resp) {
					Notification({message: response.data.message}, response.data.status);
				}
			);
		}
	}

}])
.controller('paymentController', ['$scope','$http','Notification','$sce' , function($scope,$http, Notification,$sce) {
	$scope.payment = <?php echo json_encode($data) ?>

	$scope.input = {};

	$scope.st = [];

	$scope.convertDate = function() {
		var x = 0;
		for(x; x < $scope.payment.length; x++) {
			$scope.payment[x].created_at = moment($scope.payment[x].created_at, 'X').fromNow();
		}
	}

	$scope.status = [
		{ id:0,status_name: '<div style="color:red;"><i class="delete icon"></i>Pembayaran Belum Dikonfirmasi Pengguna</div>' },
		{ id:1,status_name: '<div style="color:blue;"><i class="checkmark icon"></i>Pembayaran Sudah Dikonfirmasi Pengguna</div>'  },
		{ id:2,status_name: '<div style="color:green;"><i class="send icon"></i>Pembayaran Terkonfirmasi, Barang sudah dikirim</div>'  }
	];

	for(var x=0; x < $scope.status.length; x++) {
		$scope.st[x] = $sce.trustAsHtml($scope.status[x].status_name);
	}


	$scope.format2 = function(n, currency) {
    	return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
    }

	$scope.convertDate();

	$scope.paymentUpdate = function(id) {
		$http.get("<?= fullurl(); ?>/admin/payment/detail/"+id)
			.then(function (response) {
				$scope.detail = response.data;
				$scope.input.status = response.data.status;
				$scope.input.resi_number = response.data.resi_number;
				$("#tabular .item,#itemFirst").removeClass('active');
				$("#itemSecond").addClass('active');
				$scope.detail.ttl = $scope.format2($scope.detail.total, 'Rp.');
			}
		);
	}

	$scope.paymentConfirmation = function(input,id) {
		$http.put('<?= fullurl(); ?>/admin/payment/update/'+id, input)
			.then(function (response) {
				Notification({message: response.data.message}, response.data.status);
				/*var index = $scope.indexSearch($scope.category, input.id);
                $scope.category[index] = response.data.category;
				
				$scope.onLoading = false;
				$scope.input = {};
				$scope.update = false;*/
			}, function (resp) {
				Notification({message: resp.data.message}, resp.data.status);
				$scope.onLoading = false;
			})
	}

}])
.directive('select', function($timeout) {
	return {
		restrict: 'E', 
		link: function(scope, element) {
			// We use a tomeout of 0ms so that that semantic waits for angular to init the scope
			$timeout(function() {
				element.dropdown();
			});
		}
	}
  
})
.directive('progress', function() {
	return function (scope, element, attr) {
		$(element).progress();
    };
})

;
</script>
</body>
</html>