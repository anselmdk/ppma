angular.module('ppmaEntryModule').controller('ppmaEntryIndexController', [

  '$scope', 'ppmaEntry'
  ($scope, ppmaEntry) ->

    ppmaEntry.query().$promise.then((entries) ->
      $scope.entries = entries
    )

    return

])