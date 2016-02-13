jQuery(document).ready(function($){
	
	// $('.datepicker').datepicker({
 //        format: "dd/mm/yyyy"
 //    });
    

    $('.mask_money').mask('000.000.000.000.000,00', {reverse: true});
    $('.datepicker').mask('00/00/0000', {reverse: false});
});

var app = angular.module('promocaoApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
//var app = angular.module('promocaoApp', []);


//var app = angular.module('promocaoApp', []);

app.controller("Sorteios", ['$scope', function($scope) {


  $scope.sorteios = sorteios_arr;
  // $scope.sorteios = [{
  //     periodo_inicio: '',
  //     periodo_fim:    '',
  //     data_sorteio:   '',
  //     observacao:     '',
  //     premios: [{
  //         quantidade: '',
  //         nome:       '',
  //         valor:      ''
  //     }]

  // }];
  
  $scope.addNewSorteio = function() {

   // var newItemNo = $scope.sorteios.length+1;
   // $scope.sorteios.push({'id':'sorteio'+newItemNo});
    $scope.sorteios.push({
      premios: [{}]
    });



  };
    
  $scope.removeSorteio = function(index) {
   // var newItemNo = $scope.sorteios.length+1;
   // $scope.sorteios.push({'id':'sorteio'+newItemNo});
    $scope.sorteios.splice(index, 1);
  };

  $scope.addNewPremio = function(sorteio) {
    var index_sorteio = $scope.sorteios.indexOf(sorteio);
    $scope.sorteios[index_sorteio].premios.push({});
 
  };

  $scope.removePremio = function(index,sorteio) {
    var index_sorteio = $scope.sorteios.indexOf(sorteio);
    $scope.sorteios[index_sorteio].premios.splice(index, 1);
  };

  $scope.isPremioRemovivel = function(sorteio) {
    var index_sorteio = $scope.sorteios.indexOf(sorteio);
    return $scope.sorteios[index_sorteio].premios.length > 1;
  };

  $scope.isSorteioRemovivel = function() {
    return $scope.sorteios.length > 1;
  };


}]);

