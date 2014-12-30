var ppmaServices = angular.module('ppmaServices', ['ngResource']);

ppmaServices.factory('Category', ['$resource', function($resource) {
    return $resource('/categories/:categoryId');
}]);

ppmaServices.factory('Entry', ['$resource', function($resource) {
    return $resource('/entries/:entryId');
}]);