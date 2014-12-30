var ppmaControllers = angular.module('ppmaControllers', ['ppmaServices']);


ppmaControllers.controller('CategoryWidgetCtrl', ['$scope', 'Category', 'Entry',
    function ($scope, Category, Entry) {
        $scope.categories = Category.query(function() {
            angular.forEach($scope.categories, function(category, index) {
                var entries = Entry.query({ categoryId: category.id }, function () {
                    $scope.categories[index].entryCount = entries.length;
                });
            });
        });
    }]);


ppmaControllers.controller('EntryListCtrl', ['$scope', 'Entry',
    function ($scope, Entry) {
        $scope.entries = Entry.query();
    }]);

ppmaControllers.controller('EntryUpdateCtrl', ['$scope', 'Entry', '$routeParams', '$location',
    function ($scope, Entry, $routeParams, $location) {
        $scope.entry = Entry.get({entryId: $routeParams.id});

        $scope.submit = function () {
            Entry.update({ entryId: $scope.entry.id }, $scope.entry);
            $location.url('/entries');
        }
    }]);

ppmaControllers.controller('EntryViewCtrl', ['$scope', 'Entry', '$routeParams',
    function ($scope, Entry, $routeParams) {
        $scope.entry = Entry.get({entryId: $routeParams.id});
    }]);