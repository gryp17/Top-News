app.directive('errorPopup', function () {
	return {
		restrict: 'C',
		link: function (scope, element, attr) {

			//get the closest input sibling
			var input = element.siblings('input');

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
					
					//add the input-error class and the focus event handler
					input.addClass('input-error');
					input.on('focus', function (){
						input.addClass('input-error');
					});
					
					input.popover('show');
				} else {
					//remove the input-error class and the focus event handler
					input.removeClass('input-error');
					input.off('focus');
					
					input.popover('hide');
				}

			});

		}
	};
});