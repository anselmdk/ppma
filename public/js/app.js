var ppmaApp = angular.module('ppma', ['ngRoute', 'ppmaControllers']);

ppmaApp.config(function ($routeProvider) {
    $routeProvider
        .when('/entries', {
            templateUrl: '/templates/entries/index.html',
            controller: 'EntryListCtrl'
        })
        .when('/entries/:id', {
            templateUrl: '/templates/entries/view.html',
            controller: 'EntryViewCtrl'
        })
        .when('/entries/:id/update', {
            templateUrl: '/templates/entries/update.html',
            controller: 'EntryUpdateCtrl'
        })
        .otherwise({
            redirectTo: '/entries'
        });
});
