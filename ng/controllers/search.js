app.controller("searchController", function($rootScope, $scope, $routeParams, $http, searchService, APIservice) {
	
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
					response = APIservice.getArticles();
					//response = $http.get("API/getArticles");
				}
				//otherwise search
				else {
					response = APIservice.getArticlesBySearch(search_val);
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
	


/*
	var timer;
	$("#search_value").keyup(function() {
		//clear timeout when typing
		if (timer) {
			window.clearTimeout(timer);
		}
		//start new timeout
		timer = window.setTimeout(function() {
			timer = null;

			$rootScope.search_val = $("#search_value").val();
			console.log($rootScope.search_val);

			if ($rootScope.search_val.length === 0 || $rootScope.search_val.length >= 3) {
				var response;

				//if nothing is written in the input get the latest articles
				if ($rootScope.search_val.length === 0) {
					response = $http.get("API/getArticles");
				}
				//otherwise search
				else {
					var search_val = encodeURIComponent($rootScope.search_val);
					response = $http.get("API/getArticlesBySearch/" + search_val);
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

				response.error(function(result, status, headers, config) {
					alert("AJAX failed!");
				});
			}

		}, 1000);
	});
*/


});