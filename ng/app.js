
var app = angular.module("top-news", ['ngRoute']);

app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
                .when('/articles/:section_name', {
                    templateUrl: '/CI/application/views/partials/articles.php',
                }).otherwise({
            templateUrl: '/CI/application/views/partials/home.php',
        });
    }]);



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
