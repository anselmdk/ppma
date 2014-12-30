var ppmaServices = angular.module('ppmaServices', ['ngResource']);

ppmaServices.factory('Category', ['$resource', function($resource) {
    return $resource('/api/categories/:categoryId', null, {
        'update': { method: 'PUT' }
    });
}]);

ppmaServices.factory('Entry', ['$resource', function($resource) {
    return $resource('/api/entries/:entryId', null, {
        'update': { method: 'PUT' }
    });
}]);