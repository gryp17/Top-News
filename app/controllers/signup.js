app.controller("signupController", function ($rootScope, $scope, $routeParams, searchService, APIservice) {

	//remove the text from the search input
	searchService.setSearchVal('');

	$scope.test = "sign up page";


});
