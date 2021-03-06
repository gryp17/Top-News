app.controller("homeController", function ($rootScope, $scope, $routeParams, APIservice) {

	//get the latest 6 articles
	var response = APIservice.getArticles();
	response.success(function (result, status, headers, config) {
		if (result.status === 1) {
			$rootScope.articles_data = result.data;
			$("#loading-wrapper").fadeOut(200, function () {
				$("#articles-wrapper").fadeIn(500);
			});
		} else {
			console.log(result.error);
		}
	});


});