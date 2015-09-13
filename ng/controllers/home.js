app.controller("homeController", function ($scope, $routeParams, $http, Scopes) {
    
    var response = $http.get("API/getArticles");
    response.success(function (data, status, headers, config) {
        $scope.articles_data = data;
        Scopes.set('articles_data', $scope.articles_data);
        $("#loading-wrapper").fadeOut(200, function () {
            $("#articles-wrapper").fadeIn(500);
        });
    });

    response.error(function (data, status, headers, config) {
        alert("AJAX failed!");
    });

    setInterval(function(){
        $scope.articles_data = Scopes.get('articles_data');
        $scope.$digest();
    }, 1000);

});