app.controller("articlesController", function ($rootScope, $scope, $routeParams, $http, $window, searchService, APIservice) {

	//get the section name
	$scope.section_name = $routeParams.section_name;

	//get the first batch of articles
	var response = APIservice.getArticles($scope.section_name);
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



	//Lazy Loading Effect

	$scope.limit = 6;
	$scope.offset = 0;
	//prevent infinite loading
	$scope.loading = false;

	//lazy loading logic
	$scope.lazyLoading = function () {
		//don't load more articles if there is an active search
		var search_val = searchService.getSearchVal();
		if (search_val.length >= 3) {
			return false;
		}

		var scrollTop = $(window).scrollTop() + 500;
		var footerPosition = $("footer").offset().top - 400;

		if (scrollTop > footerPosition && $scope.loading == false) {
			$scope.offset = $scope.offset + 6;
			$scope.loading = true;

			var response = APIservice.getArticles($scope.section_name, $scope.limit, $scope.offset);
			response.success(function (result, status, headers, config) {
				$scope.loading = false;

				if (result.status === 1) {
					//push the articles in articles array
					for (var i = 0; i < result.data.length; i++) {
						$rootScope.articles_data.push(result.data[i]);
					}
				} else {
					console.log(result.error);
				}

			});

		}
	};
	
	//on window scroll get more articles with lazy loading
	angular.element($window).on('scroll', $scope.lazyLoading);
	
	//when destroying the scope unbind the lazy loading in order to stop it in other pages
	$scope.$on('$destroy', function () {
		angular.element($window).off('scroll', $scope.lazyLoading);
	});


});
