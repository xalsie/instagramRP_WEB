(function(angular) {
    'use strict';
    var app = angular.module('appRoot', []);

    app.controller('appSidebar', ['$scope', '$http', function($scope, $http) {
        $scope.getAuth = false;
        $scope.responseMap = false;
        $scope.nameRP = false;
        $scope.nameDiscord = false;
        $scope.load= false;

        $scope.tab = 2;

        $http.get("/assets/js/appAngular.php?action=getUser")
        .then(function (response) {
            console.log(response);

            if (response.data == "") {
                return false;
            }

            $scope.responseMap = response.data;
            $scope.firstName= response.data[0].nameRP;
            $scope.lastName= response.data[0].nameDiscord;

            $scope.getAuth= response.data[1];

            if ($scope.getAuth) {
                $scope.tab = 1;
            }
        });
        
        $scope.setTab = function(newTab) {
            $scope.tab = newTab;
        };
    
        $scope.isSet = function(tabNum){
            let $grid = $('.grid');

            // if (tabNum == '4' && $scope.getAuth) {
                // console.log("#### START");
                // console.log(tabNum);
                // console.log($scope.getAuth);
                // console.log("#### END");
            //     window.location = "/Profile/index.php?userid="+$scope.responseMap[0].id;
            // }

            setTimeout(() => {
                let $grid = $('.grid');
                    $grid.isotope('layout');
            }, 300);

            // bind event listener to be triggered just once. note ONE not ON
            $grid.one( 'arrangeComplete', function() {
                if (!$scope.load) {
                    console.log("load finish");

                    setTimeout(() => {
                        $("#sidebarMenu").removeClass("removeForAlign").css("top", "48.1px");
                    }, 300);

                    setTimeout(() => {
                        $("#sidebarMenu").css("top", "48px");
                    }, 400);

                    $scope.load= true;
                }
            });
            
            return $scope.tab === tabNum;
        };
    }]);

})(window.angular);