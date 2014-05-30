  var app = angular.module("GridCambiable", []);

	app.factory('instagram', ['$http', function($http)
	{
		return {
			fetchPopular: function(callback)
			{
	            var endPoint = "https://api.instagram.com/v1/users/256838588/media/recent/?client_id=7e20239c982b49e58cb52532e30d1cfd&callback=JSON_CALLBACK";

	            $http.jsonp(endPoint).success(function(response)
	            {
	                callback(response.data);
	            });
			}
		}
	}]);
	
	app.controller('GridCambiableController', ['$scope', 'instagram' ,
	function ($scope, instagram)
	{
		$scope.layout = 'grid';
	    
	    $scope.setLayout = function(layout)
	    {
	        $scope.layout = layout;
	    };
	    
	    $scope.isLayout = function(layout)
	    {
	        return $scope.layout == layout;
	    };
	
		$scope.pics = [];
	
		instagram.fetchPopular(function(data)
		{
			$scope.pics = data;
		});
	}]);