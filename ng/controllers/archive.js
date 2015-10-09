app.controller("archiveController", function ($rootScope, $scope, $routeParams, $http, searchService, APIservice) {
	
	//remove the text from the search input
	searchService.setSearchVal('');
	
	$("body").scrollTop(0);
	
	
	//get the first batch of articles
	var response = APIservice.getArticles();
	response.success(function(result, status, headers, config) {
		if (result.status === 1) {
			$rootScope.articles_data = result.data;
			$("#loading-wrapper").fadeOut(200, function() {
				$("#articles-wrapper").fadeIn(500);
			});
		} else {
			console.log(result.error);
		}
	});
	


	//Lazy Loading Effect

	var limit = 6;
	var offset = 6;
	//prevent infinite loading
	var loading = false;


	//on window scroll get more articles with lazy loading
	$(window).scroll(function () {
		
		//don't load more articles if there is an active search
		var search_val = searchService.getSearchVal();
		if(search_val.length >= 3){
			return false;
		}
		
		var scrollTop = $(window).scrollTop() + 500;
		var footerPosition = $("footer").offset().top - 400;

		if (scrollTop > footerPosition && loading == false) {
			offset = offset + 6;
			loading = true;

			var response = APIservice.getArticles(limit, offset);
			response.success(function (result, status, headers, config) {
				loading = false;

				if (result.status === 1) {
					//push the articles in articles array
					for (var i = 0; i < result.data.length; i++) {
						$rootScope.articles_data.push(result.data[i]);
					}
				}else{
					console.log(result.error);
				}

			});

		}

	});

});