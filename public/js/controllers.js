var ppmaControllers = angular.module('ppmaControllers', ['ppmaServices']);

ppmaControllers.controller('EntryListCtrl', ['$scope', 'Entry',
    function ($scope, Entry) {
        $scope.entries = Entry.query();
    }]);

ppmaControllers.controller('EntryViewCtrl', ['$scope', 'Entry', '$routeParams',
    function ($scope, Entry, $routeParams) {
        $scope.entry = Entry.get({entryId: $routeParams.id});
    }]);

ppmaControllers.controller('EntryUpdateCtrl', ['$scope', 'Entry', '$routeParams', '$location',
    function ($scope, Entry, $routeParams, $location) {
        $scope.entry = Entry.get({entryId: $routeParams.id});

        $scope.submit = function () {
            $scope.entry.$save();
            $location.url('/entries');
        }
    }]);