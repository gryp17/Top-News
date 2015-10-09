app.service('APIservice', function ($http){
	
	/**
	 * Used to fetch articles
	 * @param {int} limit
	 * @param {int} offset
	 * @param {String} category
	 * @returns {object}
	 */
	this.getArticles = function (limit, offset, category){
		var url = 'API/getArticles/';
		
		//check if there is a category param
		if(typeof(category) !== 'undefined' && category !== null){
			url = url + category + '/';
		}
		
		//check if there are limit and offset params
		if(typeof(limit) === 'number' && typeof(offset) === 'number'){
			url = url + limit + '/' + offset;
		}
		
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
	this.getArticlesBySearch = function (search_val, category){
		var url = 'API/getArticlesBySearch/';
		
		//check if there is a category param
		if(typeof(category) !== 'undefined' && category !== null){
			url = url + category + '/';
		}
		search_val = encodeURIComponent(search_val);
		url = url + search_val;
		
		return $http.get(url);
	};
	
	
});

