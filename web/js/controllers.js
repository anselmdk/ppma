var ppmaControllers = angular.module('ppmaControllers', ['ppmaServices', 'ngRoute']);


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


ppmaControllers.controller('EntryListCtrl', ['$scope', 'Entry', '$route',
    function ($scope, Entry, $route) {
        $scope.entries = Entry.query();

        $scope.remove = function(entry) {
            Entry.remove({entryId: entry.id}, null, function() {
                $scope.entries.splice($scope.entries.indexOf(entry), 1);
            });
        };
    }]);

ppmaControllers.controller('EntryUpdateCtrl', ['$scope', 'Entry', '$routeParams', '$location',
    function ($scope, Entry, $routeParams, $location) {
        $scope.entry = Entry.get({entryId: $routeParams.id});

        $scope.submit = function () {
            Entry.update({ entryId: $scope.entry.id }, $scope.entry);
            $location.url('/entries');
        };
    }]);

ppmaControllers.controller('EntryViewCtrl', ['$scope', 'Entry', '$routeParams',
    function ($scope, Entry, $routeParams) {
        $scope.entry = Entry.get({entryId: $routeParams.id});
    }]);