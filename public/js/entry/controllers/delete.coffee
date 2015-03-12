angular.module('ppmaEntryModule').controller('ppmaEntryDeleteController', [

  '$scope', 'ppmaEntry', '$routeParams', '$location'
  ($scope, ppmaEntry, $routeParams, $location) ->

    ppmaEntry.get({entryId: $routeParams.id}).$promise.then((entry) ->
      $scope.entry = entry
    )

    $scope.delete = ->
      ppmaEntry.delete({entryId: $routeParams.id})
      $location.url('/entries')

    return

])