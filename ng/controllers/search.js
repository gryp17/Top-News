app.controller("searchController", function ($rootScope, $scope, $routeParams, $http) {

    var timer;
    $("#search_value").keyup(function () {
        //clear timeout when typing
        if (timer) {
            window.clearTimeout(timer);
        }
        //start new timeout
        timer = window.setTimeout(function () {
            timer = null;
            var search_val = $("#search_value").val();
            if (search_val.trim().length >= 3) {
                search_val = encodeURIComponent(search_val);
                var response = $http.get("API/getArticlesBySearch/"+search_val);
                response.success(function (result, status, headers, config) {
					
					//if the status is success and there are articles
					if(result.status == 1 && result.data.length > 0){
						$("#archive-link, .article-box").fadeIn(1);
                        $("#not-found").fadeOut(1);
					}else{
						$("#not-found").fadeIn(500);
                        $(".article-box, #archive-link").fadeOut(1);
					}

					$rootScope.articles_data = result.data;
                });

                response.error(function (result, status, headers, config) {
                    alert("AJAX failed!");
                });
            }

        }, 1000);
    });



});