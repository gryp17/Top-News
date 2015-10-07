app.service('searchService', function ($rootScope){
	
	//default state
	$rootScope.search_data = {
		search_val: ''
	};
	
	/**
	 * Returns the search value
	 * @returns {String}
	 */
	this.getSearchVal = function (){
		return $rootScope.search_data.search_val;
	};
	
	/**
	 * Sets the search value
	 * @param {String} search_val
	 */
	this.setSearchVal = function (search_val){
		$rootScope.search_data.search_val = search_val;
	};
	
});

