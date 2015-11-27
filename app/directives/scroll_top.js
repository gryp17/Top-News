app.directive('scrollTop', function () {
	return {
		restrict: 'C',
		replace: true,
		templateUrl: 'app/views/directives/scroll_top.php',
		link: function (scope, element, attr) {

			//watch for document.height changes
			scope.$watch(function () {
				return $(document).height();
			}, function onHeightChange(newValue, oldValue) {

				//if the height has changed and the width is bigger than 768px
				if (newValue != oldValue && $(document).width() >= 768) {
					//apply the scroll handler
					$(window).scroll(function () {
						var height = $(window).height();
						var top = $(this).scrollTop();

						if (top >= height + height / 2) {
							element.fadeIn();
						} else {
							element.fadeOut();
						}
					});
				}

			});

			//apply the click handler
			element.click(function () {
				$("html, body").animate({scrollTop: 0}, 1000);
			});

		}
	}
});