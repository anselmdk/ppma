angular.module('ppma', ['ngRoute', 'ngResource', 'ngAnimate'])

    .controller('EntryController', function($scope, $resource) {
        var entries = $resource('/entries').query(function() {
            $scope.entries = entries;
        });
    })

    .controller('EntryViewController', function ($scope, $resource, $routeParams, $location) {
        var entry = $resource('/entries/:id').get({id: $routeParams.id}, function() {
            $scope.entry = entry;
        });

        $scope.submit = function(a, b, c) {
            entry.$save();
            $location.url('/entries');
        }
    })

    .config(function ($routeProvider) {
        $routeProvider
            .when('/entries', {
                templateUrl: '/templates/entries/index.html',
                controller: 'EntryController'
            })
            .when('/entries/:id', {
                templateUrl: '/templates/entries/view.html',
                controller: 'EntryViewController'
            })
            .when('/entries/:id/update', {
                templateUrl: '/templates/entries/update.html',
                controller: 'EntryViewController'
            })
            .otherwise({
                redirectTo: '/entries'
            });
    });
