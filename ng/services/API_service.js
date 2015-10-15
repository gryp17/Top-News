app.service('APIservice', function ($http){
	
	/**
	 * Used to fetch articles
	 * @param {int} limit
	 * @param {int} offset
	 * @param {String} category
	 * @returns {object}
	 */
	this.getArticles = function (category, limit, offset){
		var url = 'API/getArticles/';
		
		//check if there is a category param
		if(typeof(category) === 'undefined' || category === null){
			category = null;
		}
		
		//set default values if the param is not present
		if(typeof(limit) !== 'number'){
			limit = 6;
		}
		
		//set default values if the param is not present
		if(typeof(offset) !== 'number'){
			offset = 0;
		}
		
		url = url + category + '/' + limit + '/' + offset;
		
		return $http({
			method: 'GET',
			url: url
		});
	};
	
	/**
	 * Used to fetch articles via keyword filter
	 * @param {String} search_val
	 * @param {String} category
	 * @returns {object}
	 */
	this.getArticlesBySearch = function (category, search_val){
		var url = 'API/getArticlesBySearch/';
		
		//check if there is a category param
		if(typeof(category) === 'undefined' || category === null){
			category = null;
		}
		
		search_val = encodeURIComponent(search_val);
		url = url + category + '/' + search_val + '/';
		
		return $http.get(url);
	};
	
	
});

