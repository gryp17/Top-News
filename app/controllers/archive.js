app.controller("archiveController", function ($rootScope, $scope, $routeParams, searchService, APIservice) {
	
	//remove the text from the search input
	searchService.setSearchVal('');
	
	//initialize the date picker
	$scope.selected_date;
	$("#archive-date-picker").datepicker({
		constrainInput: true,
		dateFormat: "yy-mm-dd"
	});
	
	//enable the calendar icon click
	$("#archive-date-picker").siblings(".input-group-btn").click(function (){
		$("#archive-date-picker").focus();
	});
	
	//set the max date after the datepicker has been initialized
	var response = APIservice.getLatestArticleDate();
	response.success(function(result, status, headers, config) {
		if (result.status === 1) {
			$("#archive-date-picker").datepicker("option", "maxDate", new Date(result.data));
		} else {
			console.log(result.error);
		}
	});
	
	
	
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

	$scope.limit = 6;
	$scope.offset = 0;
	//prevent infinite loading
	$scope.loading = false;


	//on window scroll get more articles with lazy loading
	//first unbind all scroll handlers in order to prevent conflict with the other sections
	$(window).unbind('scroll');
	$(window).scroll(function () {
		
		//don't load more articles if there is an active search
		var search_val = searchService.getSearchVal();
		if(search_val.length >= 3){
			return false;
		}
		
		var scrollTop = $(window).scrollTop() + 500;
		var footerPosition = $("footer").offset().top - 400;

		if (scrollTop > footerPosition && $scope.loading == false) {
			$scope.offset = $scope.offset + 6;
			$scope.loading = true;

			var response = APIservice.getArticles(null, $scope.limit, $scope.offset);
			response.success(function (result, status, headers, config) {
				$scope.loading = false;

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