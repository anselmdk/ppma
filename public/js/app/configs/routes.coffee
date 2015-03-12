angular.module('ppmaAppModule').config([

  '$routeProvider'
  ($routeProvider) ->

    $routeProvider.when('/entries',
      controller: 'ppmaEntryIndexController'
      templateUrl: 'js/entry/views/index.html'
    ).when('/entries/:id/delete',
      controller: 'ppmaEntryDeleteController'
      templateUrl: 'js/entry/views/delete.html'
    ).otherwise(
      redirectTo: '/entries'
    )

    return

])