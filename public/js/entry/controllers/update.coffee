angular.module('ppmaEntryModule').controller('ppmaEntryUpdateController', [

  '$scope', 'ppmaEntry', '$routeParams', '$location'
  ($scope, ppmaEntry, $routeParams, $location) ->

    ppmaEntry.get({entryId: $routeParams.id}).$promise.then((entry) ->
      $scope.entry = entry
    )

    $scope.save = ->
      if $scope.form.$invalid then return
      ppmaEntry.update({ entryId: $routeParams.id }, $scope.entry).$promise.then(->
        $location.url('/entries')
      )

    return

])