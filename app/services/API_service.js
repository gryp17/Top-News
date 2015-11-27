app.service('APIservice', function ($http, $rootScope) {

	/**
	 * Used to fetch articles
	 * @param {int} limit
	 * @param {int} offset
	 * @param {String} category
	 * @returns {object}
	 */
	this.getArticles = function (category, limit, offset) {

		//set default values if the param is not present
		if (typeof (limit) !== 'number') {
			limit = 6;
		}

		//set default values if the param is not present
		if (typeof (offset) !== 'number') {
			offset = 0;
		}

		return $http({
			method: 'POST',
			url: 'API/getArticles',
			data: {
				category: category,
				limit: limit,
				offset: offset
			}
		});

	};

	/**
	 * Used to fetch articles via keyword filter
	 * @param {String} search_val
	 * @param {String} category
	 * @returns {object}
	 */
	this.getArticlesBySearch = function (category, search_val) {
		return $http({
			method: 'POST',
			url: 'API/getArticlesBySearch',
			data: {
				category: category,
				search_val: search_val
			}
		});
	};


	/**
	 * Used to fetch all articles from the specified date
	 * @param {string} date
	 * @returns {object}
	 */
	this.getArticlesByDate = function (date) {
		return $http({
			method: 'POST',
			url: 'API/getArticlesByDate',
			data: {
				date: date,
			}
		});
	};


	/**
	 * Returns the latest article date in format YYYY-mm-dd
	 * @returns {object}
	 */
	this.getLatestArticleDate = function (category) {
		return $http({
			method: 'POST',
			url: 'API/getLatestArticleDate',
			data: {
				category: category,
			}
		});
	};


	/**
	 * Used to fetch single article data
	 * @param {int} id
	 * @returns {object}
	 */
	this.getArticle = function (id) {
		return $http({
			method: 'POST',
			url: 'API/getArticle',
			data: {
				id: id
			}
		});

	};

	/**
	 * Used to increment the article views
	 * @param {int} id
	 * @returns {object}
	 */
	this.addArticleView = function (id) {
		return $http({
			method: 'POST',
			url: 'API/addArticleView',
			data: {
				id: id
			}
		});
	}



});

