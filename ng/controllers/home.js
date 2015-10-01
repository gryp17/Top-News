app.controller("homeController", function ($rootScope, $scope, $routeParams, $http) {
    
    var response = $http.get("API/getArticles");
    response.success(function (result, status, headers, config) {
		if(result.status == 1){
			$rootScope.articles_data = result.data;
			$("#loading-wrapper").fadeOut(200, function () {
				$("#articles-wrapper").fadeIn(500);
			});
		}else{
			console.log(result);
		}
    });

    response.error(function (result, status, headers, config) {
        alert("AJAX failed!");
    });

});