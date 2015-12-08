app.directive('currencyExchangeBar', function ($timeout) {
	return {
		restrict: 'C',
		replace: true,
		templateUrl: 'app/views/directives/currency_exchange_bar.php',
		link: function (scope, element, attr) {

			//currencies ticker fix
			$timeout(function () {
				var iframe = element.find("iframe");
				
				var source = iframe.attr('src')
				var currencyWidth = element.width();
				currencyWidth = currencyWidth - 2;

				source = source.replace(".php?w=700", ".php?w=" + currencyWidth);
				iframe.attr("src", source).delay(350).fadeIn(500);
			}, 500);

		}
	}
});