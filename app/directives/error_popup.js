app.directive('errorPopup', function () {
	return {
		restrict: 'C',
		link: function (scope, element, attr) {

			//get the closest input sibling
			var input = element.siblings('input[type="text"]');

			//configure the popover
			input.popover({
				placement: 'top',
				content: attr.content,
				trigger: 'manual'
			});

			//watch for changes to the error trigger
			scope.$watch(function () {
				return scope.$eval(attr.show);
			}, function (newValue, oldValue) {

				//if an error has been triggered show the popover
				if (newValue === true) {
					//change the popover content in case there is more than 1 error assigned to this popover
					input.data('bs.popover').options.content = attr.content;
					console.log('show popup with message ' + attr.content);
					input.popover('show');
				} else {
					console.log('hide popup');
					input.popover('hide');
				}

			});

		}
	};
});