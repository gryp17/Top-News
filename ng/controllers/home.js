app.controller("homeController", function ($scope, $routeParams, $http) {
    //this.items = products;

    var response = $http.get("/API/getLatestArticles");
    response.success(function (data, status, headers, config) {
        $scope.articles_data = data;
        $("#loading-wrapper").fadeOut(200, function () {
            $("#articles-wrapper").fadeIn(500);
        });
    });

    response.error(function (data, status, headers, config) {
        alert("AJAX failed!");
    });

});