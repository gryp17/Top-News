
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

    var responsePromise = $http.get("/ajax/test/?bla=1234");

    responsePromise.success(function (data, status, headers, config) {
        console.log("result is " + data);
        $scope.result = data;
    });
    responsePromise.error(function (data, status, headers, config) {
        alert("AJAX failed!");
    });

    this.order = "sfafsafsafafsa";
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
