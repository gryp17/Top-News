app.directive('mainMenu', function () {
	return {
		restrict: 'C',
		link: function (scope, element, attr) {
			
			//TODO: find a way to include the menu template in the directive without flickering
			
			//configure the hamburger button
			element.find("#hamburger-button").click(function (){
				$("#menu-options").slideToggle();
			});
			
			//slide up the menu if a menu option has been pressed
			//this is needed only when the responsive version of the menu is visible
			element.find("#menu-options a").click(function (){
				if(element.find("#hamburger-button").is(":visible")){
					$("#menu-options").slideUp();
				}
			});
			
		}
	}
});