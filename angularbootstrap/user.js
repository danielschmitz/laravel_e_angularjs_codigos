var app = angular.module('app',['ngResource']);

app.config(function($httpProvider) {
    $httpProvider.interceptors.push(function($q, $rootScope) {
        return {
            'request': function(config) {
                $rootScope.$broadcast('loading-started');
                return config || $q.when(config);
            },
            'response': function(response) {
                $rootScope.$broadcast('loading-complete');
                return response || $q.when(response);
            }
        };
    });
});

app.directive("loadingIndicator", function() {
return {
    restrict : "A",
    template: "<div> <img src='loading.gif'/>Loading...</div>",
    link : function(scope, element, attrs) {
        element.css({"display" : "none"});
        scope.$on("loading-started", function(e) {
            element.css({"display" : ""});
        });
        scope.$on("loading-complete", function(e) {
            element.css({"display" : "none"});
        });
    }
};
});

app.controller('UserCtrl',function($scope,$http,$resource){

$scope.user = {};
$scope.error = {};
$scope.btnGetDataDisabled = false;

var userResource = $resource("/users/:id",{},
    {
        getAllBlabLa:{method:'GET', url:'/users/blabla'}
    }
);

$scope.getData = function(){
        
        $scope.btnGetDataDisabled = true;
        userResource.get({},function(response){
            console.log(response);
        },function(response){
            $scope.btnGetDataDisabled = false;
            console.warn(response);
        });

}


/*
$scope.getData = function(){
	console.log("get data");
	$scope.btnGetDataDisabled = true;
	$http.get("data.php").then(function(response){
		$scope.user = response.data;
		$scope.btnGetDataDisabled = false;
	},function(response){

		$scope.error.title = "Error " + response.status
		$scope.error.message = response.statusText;
		$('#errorModal').modal();
		$scope.btnGetDataDisabled = false;
		console.warn(response);
	});
    }
*/




});