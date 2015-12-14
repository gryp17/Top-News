app.controller("signupController", function ($rootScope, $scope, $routeParams, $timeout, APIservice) {

	$scope.user_data = {};

	$scope.email_pattern = new RegExp("^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$", 'i');
	$scope.passwords_match = true;

	//watch both the password and the repeat_password properties
	$scope.$watchGroup(['user_data.password', 'user_data.repeat_password'], function (newValues, oldValues, scope) {
		if ($scope.user_data.password !== $scope.user_data.repeat_password) {
			$scope.signUpForm.$invalid = true;
			$scope.passwords_match = false;
		}else{
			$scope.passwords_match = true;
		}
	});
	
	
	//trigger a validation error from the controller
	/*
	$timeout(function (){
		//$scope.signUpForm.username.$error.maxlength = true;
	}, 500);
	*/
	
});
