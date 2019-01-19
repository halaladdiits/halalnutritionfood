//Angular JS Validation
var app = angular.module('validationApp', [],['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}]);
app.controller('foodProductValidate', ['$scope', function($scope) {
    $scope.submitForm = function() {
        if ($scope.userForm.$valid) {
        }
    };
    $scope.Math = window.Math;
    if (typeof foodProduct === "undefined") {
    }
    else{
        $scope.foodName = foodProduct['fName'];
        $scope.totalFat = foodProduct['totalFat'];
        $scope.saturatedFat = foodProduct['saturatedFat'];
        $scope.cholesterol = foodProduct['cholesterol'];
        $scope.sodium = foodProduct['sodium'];
        $scope.totalCarbohydrates = foodProduct['totalCarbohydrates'];
        $scope.dietaryFiber = foodProduct['dietaryFiber'];
    } 
}]);

//Parsley food product
if ($('#foodProductForm').length > 0 ){
    $("#foodProductForm").parsley({
        // successClass: "has-success",
        errorClass: "has-error",
        classHandler: function(el) {
            return el.$element.closest(".form-group");
        },
        errorsWrapper: "<span class='help-block'></span>",
        errorTemplate: "<span></span>"
    });
    $(".ingredient").on('change', function() {
        // $("#foodProductForm").parsley().validate();
    });
    $(".cCode, .cExpire, .cStatus, .cOrganization").on('change', function() {
        if ($(".cCode").val().length > 0 ||
            $(".cExpire").val().length > 0 ||
            $(".cStatus").val().length > 0 ||
            $(".cOrganization").val().length > 0)
        {
            $(".cCode, .cExpire, .cStatus, .cOrganization").attr("required", "required");
        } 
        else {
            $(".cCode, .cExpire, .cStatus, .cOrganization").removeAttr("required");
        }
        // $("#foodProductForm").parsley().validate();
    });
}
//Parsley addictive
if ($('#additiveForm').length > 0 ){
    $("#additiveForm").parsley({
        // successClass: "has-success",
        errorClass: "has-error",
        classHandler: function(el) {
            return el.$element.closest(".form-group");
        },
        errorsWrapper: "<span class='help-block'></span>",
        errorTemplate: "<span></span>"
    });
    $(".hOrganization, .hStatus, .hDescription, .hUrl").on('change', function() {
        if ($(".hOrganization").val().length > 0 ||
            $(".hStatus").val().length > 0 ||
            $(".hDescription").val().length > 0 ||
            $(".hUrl").val().length > 0)
        {
            $(".hOrganization, .hStatus, .hDescription, .hUrl").attr("required", "required");
        } 
        else {
            $(".hOrganization, .hStatus, .hDescription, .hUrl").removeAttr("required");
        }
        // $("#additiveForm").parsley().reset();
    });
}
if ($('.form-signin').length > 0 ){
    $(".form-signin").parsley({
        errorsWrapper: '<div></div>',
        errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>'
    });
}
