app.directive('scrollTop', function ($timeout, $window, $document) {
	return {
		restrict: 'C',
		replace: true,
		templateUrl: 'app/views/directives/scroll_top.php',
		link: function (scope, element, attr) {

			//if the width is bigger than 768px
			if (angular.element($window).width() >= 768) {
				//apply the scroll handler
				angular.element($window).on('scroll', function () {
					var height = angular.element($window).height();
					var top = angular.element($window).scrollTop();

					if (top >= height) {
						element.fadeIn();
					} else {
						element.fadeOut();
					}
				});
			}
			
			/*
			//watch for document.height changes
			scope.$watch(function () {
				return angular.element($document).height();
			}, function onHeightChange(newValue, oldValue) {

				var width = angular.element($window).width();

				//if the height has changed and the width is bigger than 768px
				if (newValue != oldValue && width >= 768) {
					//apply the scroll handler
					angular.element($window).on('scroll', function (){
						var height = angular.element($window).height();
						var top = angular.element($window).scrollTop();

						if (top >= height) {
							element.fadeIn();
						} else {
							element.fadeOut();
						}
					});
				}

			});*/
			
			//apply the click handler
			element.click(function () {
				$("html, body").animate({scrollTop: 0}, 1000);
			});

		}
	};
});