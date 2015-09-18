app.controller("homeController", function ($scope, $routeParams, $http, Scopes) {
    
    var response = $http.get("API/getArticles");
    response.success(function (result, status, headers, config) {
		if(result.status == 1){
			$scope.articles_data = result.data;
			Scopes.set('articles_data', $scope.articles_data);
			$("#loading-wrapper").fadeOut(200, function () {
				$("#articles-wrapper").fadeIn(500);
			});
		}else{
			console.log(result.error);
		}
    });

    response.error(function (result, status, headers, config) {
        alert("AJAX failed!");
    });

    setInterval(function(){
        $scope.articles_data = Scopes.get('articles_data');
        $scope.$digest();
    }, 1000);

});