// Code goes here

var myApp = angular.module('myApp', ['angularUtils.directives.dirPagination'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

function MyController($scope, $http) {
  var currentPage
  $scope.currentPage = (sessionStorage.getItem('cpage'))?sessionStorage.getItem('cpage'):1;
  $scope.pageSize = 1;
  var page=$("#page").val();
  var action=$("#action").val();
  url=adminUrl+page+'-'+action;
   $http.get(url).success( function(response) {
      $scope.datas = angular.fromJson(response); 
   });

  $scope.pageChangeHandler = function(num) {
      console.log('meals page changed to ' + num);
  };
}

function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
    sessionStorage.cpage =num;
    console.log('going to page ' + num);
  };
}

myApp.controller('MyController', MyController);
myApp.controller('OtherController', OtherController);