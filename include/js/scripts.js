$(document).ready(function () {

	//currencies ticker fix
	setTimeout(function () {
		var source = $("#currency-exchange iframe").attr("src");
		var currencyWidth = $("#currency-exchange").width();
		currencyWidth = currencyWidth - 2;

		source = source.replace(".php?w=700", ".php?w=" + currencyWidth);
		$("#currency-exchange iframe").attr("src", source).delay(350).fadeIn(500);
	}, 500);

});