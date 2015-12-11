app.controller("signupController", function ($rootScope, $scope, $routeParams, $timeout, searchService, APIservice) {

	//remove the text from the search input
	searchService.setSearchVal('');

	$scope.test = "sign up page";
	
	//trigger a validation error from the controller
	/*
	$timeout(function (){
		$scope.signUpForm.username.$error.maxlength = true;
	}, 500);
	*/


});
