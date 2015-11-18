
var app = angular.module("top-news", ['ngRoute', 'ngSanitize', 'ngAnimate']);

app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
                .when('/articles/:section_name', {
                    templateUrl: 'app/views/partials/articles.php',
                }).when('/archive', {
                    templateUrl: 'app/views/partials/archive.php',
                }).when('/article/:id', {
                    templateUrl: 'app/views/partials/article.php',
                }).otherwise({
					templateUrl: 'app/views/partials/home.php',
				});
}]);

