angular.module('ppmaAppModule').config([

  '$routeProvider'
  ($routeProvider) ->

    $routeProvider.when('/entries',
      controller: 'ppmaEntryIndexController'
      templateUrl: 'js/entry/views/index.html'
    ).when('/entries/:id/delete',
      controller: 'ppmaEntryDeleteController'
      templateUrl: 'js/entry/views/delete.html'
    ).when('/entries/:id/update',
      controller: 'ppmaEntryUpdateController'
      templateUrl: 'js/entry/views/update.html'
    ).otherwise(
      redirectTo: '/entries'
    )

    return

])