angular.module('ppmaEntryModule').factory('ppmaEntry', [

  '$resource'
  ($resource) ->

    $resource('entries/:entryId')

])