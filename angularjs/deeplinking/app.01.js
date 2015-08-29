var app = angular.module('app',['ngRoute']);

app.config(['$routeProvider',function($routeProvider){
	$routeProvider.
	when('/',{controller:'listController', templateUrl:'list.html'}).
	when('/edit/:name',{controller:'editController',templateUrl:'form.html'}).
	when('/new',{controller:'newController', templateUrl:'form.html'}).
	otherwise({redirectTo:'/'});
}]);

app.run(['$rootScope',function($rootScope){
	$rootScope.fruits = ["banana","apple","orange"];
	console.log('app.run');
}]);