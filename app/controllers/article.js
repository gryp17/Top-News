app.controller("articleController", function ($rootScope, $scope, $routeParams, searchService, APIservice) {

	//get the section name
	$scope.section_name = $routeParams.section_name;

	//get the article id
	$scope.article_id = $routeParams.id;

	//remove the text from the search input
	searchService.setSearchVal('');

	//get the article data
	var response = APIservice.getArticle($scope.article_id);
	response.success(function (result, status, headers, config) {
		if (result.status === 1) {
			$scope.article = result.data;
			console.log($scope.article);
			$("#loading-wrapper").fadeOut(200, function () {
				$("#article-wrapper").fadeIn(500);
			});
		} else {
			console.log(result.error);
		}
	});

	//increment the article views
	APIservice.addArticleView($scope.article_id);





});
