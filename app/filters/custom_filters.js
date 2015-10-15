/**
 * limitText filter
 */
app.filter('limitText', function() {
	return function(text, max_length, add_dots) {
		
		//default max length
		if(typeof(max_length) === 'undefined'){
			max_length = 100;
		}
		
		//default add dots value
		if(typeof(add_dots) === 'undefined' ){
			add_dots = true;
		}
		
		if(text.length > max_length){
			text = text.substring(0, max_length);
			
			if(add_dots === true){
				text = text+"...";
			}
			
		}

		return text;
	};
});