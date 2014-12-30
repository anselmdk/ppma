var ppmaServices = angular.module('ppmaServices', ['ngResource']);

ppmaServices.factory('Entry', ['$resource', function($resource) {
    return $resource('/entries/:entryId', {}, {
        query: { method: 'GET', isArray: true }
    });
}]);