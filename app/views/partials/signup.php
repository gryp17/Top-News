<div id="signup-wrapper" class="row" ng-controller="signupController">
	
	<h4 class="center-text">Sign Up</h4>
	
	<form name="signUpForm">
		<div>
			<input type="text" class="form-control" name="username" placeholder="Username" ng-required="true" ng-maxlength="8" ng-model="userData.username">
			
			<!-- max length error -->
			<div class="error-popup" data-show="signUpForm.username.$error.maxlength" data-content="Username exceeds 8 characters"></div>
   
		
		</div>
		<div>
			<input type="text" class="form-control" name="email" placeholder="Email" ng-required="true" ng-maxlength="8" ng-pattern="/^.+?@[0-9A-Z]+?\.\w+$/i" ng-model="userData.email">

			<!-- email format error -->
			<div class="error-popup" data-show="signUpForm.email.$error.pattern" data-content="Invalid email"></div>
			
			<!-- max length error -->
			<div class="error-popup" data-show="signUpForm.email.$error.maxlength" data-content="The field exceeds 8 characters"></div>
		</div>

		<div>
			<div class="required-notification" ng-class="{'hidden-element': !signUpForm.$error.required}">All fields are required.</div>
			<input type="button" class="btn btn-success" ng-disabled="signUpForm.$error.required" value="Sign up" ng-click="signUp()"/>		
		</div>

	</form>
	
	
</div>
