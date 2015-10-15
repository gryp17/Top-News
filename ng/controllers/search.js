app.controller("searchController", function($rootScope, $scope, $routeParams, $http, searchService, APIservice) {
	
	$scope.section_name = null;
	
	//get the section name every time the route changes
	$rootScope.$on('$routeChangeSuccess', function (){
		if(typeof($routeParams.section_name) !== 'undefined'){
			$scope.section_name = $routeParams.section_name;
		}else{
			$scope.section_name = null;
		}
	});
	
	$scope.timer;
	$scope.search = function() {

		//clear timeout when typing
		if ($scope.timer) {
			window.clearTimeout($scope.timer);
		}
		//start new timeout
		$scope.timer = window.setTimeout(function() {
			$scope.timer = null;

			//get the search value
			var search_val = searchService.getSearchVal();

			if (search_val.length === 0 || search_val.length >= 3) {
				var response;

				//if nothing is written in the input get the latest articles
				if (search_val.length === 0) {
					response = APIservice.getArticles($scope.section_name, null, null);
				}
				//otherwise search
				else {
					response = APIservice.getArticlesBySearch($scope.section_name, search_val);
				}

				response.success(function(result, status, headers, config) {

					//if the status is success and there are articles
					if (result.status == 1 && result.data.length > 0) {
						$("#archive-link, .article-box").fadeIn(1);
						$("#not-found").fadeOut(1);
					} else {
						$("#not-found").fadeIn(500);
						$(".article-box, #archive-link").fadeOut(1);
					}

					$rootScope.articles_data = result.data;
				});

			}

		}, 1000);


	};


});