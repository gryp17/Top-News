app.service('APIservice', function ($http){
	
	this.getArticles = function (limit, offset, category){
		var url = 'API/getArticles/';
		
		//check if there is a category param
		if(typeof(category) !== 'undefined'){
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
	
	this.getArticlesBySearch = function (search_val, category){
		search_val = encodeURIComponent(search_val);
		return $http.get("API/getArticlesBySearch/" + search_val);
	};
	
	
});

