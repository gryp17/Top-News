
var app = angular.module("top-news", ['ngRoute']);

app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
                .when('/articles/:section_name', {
                    templateUrl: '/application/views/partials/articles.php',
                }).otherwise({
            templateUrl: '/application/views/partials/home.php',
        });
    }]);

app.controller("homeController", function ($scope, $routeParams, $http) {
    //this.items = products;

    var response = $http.get("/ajax/getLatestArticles/?limit=6");
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




app.controller("articlesController", function ($scope, $routeParams, $http) {
    $scope.section_name = $routeParams.section_name;
});



//directives (za include na template)
/*
 app.directive('productContainer', function(){
 return{
 restrict: 'E', (Type of directive - element) //HTML <product-container></product-container>; restrict: 'A' (attribute) //HTML <div product-container></div>
 templateUrl: 'template.html',
 controller: function(){},
 controllerAs: 'the name of the controller'
 };
 });
 */
