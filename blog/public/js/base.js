app = new angular.module('app',['ngRoute','ngResource']);

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

//diretiva para exibir o loading
app.directive("loadingIndicator", function() {
	return {
		restrict : "A",
		template: "<div id='loading'> <img src='images/loading.gif'/>Loading...</div>",
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

//diretiva para comparar 2 campos
//  de formulário
app.directive("compareTo",function() {
	return {
		require: "ngModel",
		scope: {
			otherModelValue: "=compareTo"
		},
		link: function(scope, element, attributes, ngModel) {
			ngModel.$validators.compareTo = function(modelValue) {
				return modelValue == scope.otherModelValue;
			};
			scope.$watch("otherModelValue", function() {
				ngModel.$validate();
			});
		}
	};
}); 

//Notificacoes
function notifyOk(message){
	$('.bottom-right').notify({
		message: { text: message}
	}).show();
}
function notifyError(error){
	message = "";
	if (error.data!=null)
		if (error.data.message!=null)
			message = error.data.message;

		if (message=="")
			if (error.statusText!=null)
				message = "Error: " + error.statusText;
		
		if (message=="")
			if (typeof error == "string")
				message = error;


		$('.bottom-right').notify({
			message: { text: message}, 
			type: 'danger', 
		}).show();

		$('#loading').css('display','none');
	}

app.service('login',function($rootScope){
	this.check = function(){
		if ($rootScope.authuser == null){
			window.location.assign('/index.html');
		}
	}  
});