app.controller('listController',function ($scope) {
	console.log('listController');
});

app.controller('editController', function ($scope,$location,$routeParams) {
	$scope.title = "Editar Fruta";
	$scope.fruit  = $routeParams.name;

	$scope.fruitIndex = $scope.fruits.indexOf($scope.fruit);

	$scope.save = function(){
		$scope.fruits[$scope.fruitIndex]=$scope.fruit;
		$location.path('/');
	}
});

app.controller('newController', function ($scope,$location,$routeParams) {

	$scope.title = "Nova Fruta";
	$scope.fruit  = "";

	$scope.save = function(){
		$scope.fruits.push($scope.fruit);
		$location.path('/');
	}
});
