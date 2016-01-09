jQuery(document).ready(function($){
	
	$('.datepicker').datepicker({
        format: "dd/mm/yyyy"
    });
    

    $('.mask_money').mask('000.000.000.000.000,00', {reverse: true});
})




var app = angular.module('shanidkvApp', []);

  app.controller('MainCtrl', function($scope) {

  $scope.choices = premios_arr;
  
  $scope.addNewChoice = function() {
    var newItemNo = $scope.choices.length+1;
    $scope.choices.push({'id':'choice'+newItemNo});
  };
    
  $scope.removeChoice = function() {
    var lastItem = $scope.choices.length-1;
    $scope.choices.splice(lastItem);
  };
  
});
