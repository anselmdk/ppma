var ppmaServices = angular.module('ppmaServices', ['ngResource']);

ppmaServices.factory('Category', ['$resource', function($resource) {
    return $resource('/api/categories/:categoryId');
}]);

ppmaServices.factory('Entry', ['$resource', function($resource) {
    return $resource('/api/entries/:entryId');
}]);