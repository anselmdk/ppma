angular.module('ppma', ['ngRoute'])
    .config(['$routeProvider'], function ($routeProvider) {
        $routeProvider.
            when('/entries', {
                templateUrl: '/assets/templates/entries/index.html'
            }).
            otherwise({
                redirectTo: '/entries'
            });
    });
