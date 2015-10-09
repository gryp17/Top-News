
var app = angular.module("top-news", ['ngRoute']);

app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
                .when('/articles/:section_name', {
                    templateUrl: 'app/views/partials/articles.php',
                }).when('/archive', {
                    templateUrl: 'app/views/partials/archive.php',
                }).otherwise({
					templateUrl: 'app/views/partials/home.php',
        });
}]);

