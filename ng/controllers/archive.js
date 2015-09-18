app.controller("archiveController", function ($scope, $routeParams, $http) {

	$("body").scrollTop(0);

	var response = $http.get("API/getArticles");
	response.success(function (result, status, headers, config) {

		if (result.status == 1) {
			$scope.articles_data = result.data;
			$("#loading-wrapper").fadeOut(200, function () {
				$("#articles-wrapper").fadeIn(500);
			});
		} else {
			console.log(result.error);
		}

	});

	response.error(function (result, status, headers, config) {
		alert("AJAX failed!");
	});


	//Lazy Loading Effect

	var limit = 6;
	var offset = 6;
	//prevent infinite loading
	var loading = false;

	$(window).scroll(function () {
		var scrollTop = $(window).scrollTop() + 500;
		var footerPosition = $("footer").offset().top - 400;

		if (scrollTop > footerPosition && loading == false) {
			offset = offset + 6;
			loading = true;

			var response = $http.get("API/getArticles/" + limit + "/" + offset);
			response.success(function (result, status, headers, config) {
				loading = false;

				if (result.status == 1) {
					//push the articles in articles array
					for (var i = 0; i < result.data.length; i++) {
						$scope.articles_data.push(result.data[i]);
					}
				}

			});

			response.error(function (result, status, headers, config) {
				alert("AJAX failed!");
				loading = false;
			});

		}

	});

});