(function(angular) {
    'use strict';
    var app = angular.module('appRoot', ['infinite-scroll']);

    app.controller('appCommon', ['$scope', '$http', function($scope, $http) {
        $scope.getAuth = false;
        $scope.responseMap = false;
        $scope.nameRP = false;
        $scope.nameDiscord = false;
        $scope.load= false;
        $scope.limit = 25;

        $scope.tab = 2;

        $http.get("/assets/js/appAngular.php?action=getUser")
        .then(function (response) {
            console.log(response);

            if (response.data == "") {
                return false;
            }

            $scope.compteName= response.data[0].compteName;
            $scope.discord_name= response.data[0].discord_name;

            $scope.getAuth= response.data[1];

            if ($scope.getAuth) {
                $scope.tab = 1;
            }
        });
        
      $scope.setTab = function(newTab) {
          $scope.tab = newTab;
      };
  
      $scope.isSet = function(tabNum) {
          let $grid = $('.grid');

          // setTimeout(() => {
          //     let $grid = $('.grid');
          //         $grid.isotope('layout');
          // }, 300);

          // bind event listener to be triggered just once. note ONE not ON
          // $grid.one( 'arrangeComplete', function() {
          //     if (!$scope.load) {
          //         console.log("load finish");

          //         setTimeout(() => {
          //             $("#sidebarMenu").removeClass("removeForAlign").css("top", "48.1px");
          //         }, 300);

          //         setTimeout(() => {
          //             $("#sidebarMenu").css("top", "48px");
          //         }, 400);

          //         $scope.load= true;
          //     }
          // });
          
          return $scope.tab === tabNum;
      };


      $scope.getFromUrl = () => {
        $http.get("/assets/js/appAngular.php?action=getImgProfile&limit="+$scope.limit)
        .then(function (response) {
          $scope.responseMap = response.data;
        });
      }
      

      // $scope.getFromUrl();

      $scope.loadMoreProfile = function() {
        $scope.limit += 15;

        $scope.getFromUrl();
      };

    }]);
    
    app.controller('appProfile', ['$scope', '$http', function($scope, $http) {
      $scope.responseMap = false;
      $scope.discord_name = false;
      $scope.compteName = false;
      $scope.registerCompte = false;
      $scope.limit = 25;

      $scope.urlParams = () => {
        var urlParams = new URLSearchParams(window.location.search);
        return Array(urlParams.get('userid'));
      }
    
      $http.get("/Profile/assets/appAngular.php?action=getUser&userid="+$scope.urlParams()[0])
        .then(function (response) {
            console.log(response);

            $scope.registerCompte = !response.data[0];
            $scope.compteName = response.data[1].compteName;
            $scope.discord_name = response.data[1].discord_name;
        });

        $scope.getFromUrl = () => {
          $http.get("/Profile/assets/appAngular.php?action=getImage&userid="+$scope.urlParams()[0]+"&limit="+$scope.limit)
          .then(function (response) {
            $scope.responseMap = response.data;
          });
        }
        

        $scope.getFromUrl();

        $scope.loadMoreProfile = function() {
          $scope.limit += 15;

          $scope.getFromUrl();
        };


    }]);

})(window.angular);