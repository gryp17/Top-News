<div id="signup-wrapper" class="row" ng-controller="signupController">

	<div class="alert alert-info">
		Sign Up
	</div>

	<form name="signUpForm" autocomplete="off">

		<!-- Firefox password manager hack -->
		<input type="text" class="hidden"/>
		<input type="password" class="hidden"/>
		<!-- hack ends -->

		<div>
			<input type="text" class="form-control" name="username" placeholder="Username" ng-required="true" ng-minlength="3" ng-maxlength="50" ng-model="user_data.username">

			<!-- min length error -->
			<div class="error-popup" data-show="signUpForm.username.$error.minlength" data-content="The field must have at least 3 characters"></div>

			<!-- max length error -->
			<div class="error-popup" data-show="signUpForm.username.$error.maxlength" data-content="The field exceeds 50 characters"></div>


		</div>
		<div>
			<input type="text" class="form-control" name="email" placeholder="Email" ng-required="true" ng-maxlength="100" ng-pattern="email_pattern" ng-model="user_data.email">

			<!-- email format error -->
			<div class="error-popup" data-show="signUpForm.email.$error.pattern" data-content="Invalid email"></div>

			<!-- max length error -->
			<div class="error-popup" data-show="signUpForm.email.$error.maxlength" data-content="The field exceeds 100 characters"></div>
		</div>


		<div>
			<input type="password" class="form-control" name="password" placeholder="Password" ng-required="true" ng-minlength="4" ng-maxlength="50" ng-model="user_data.password">

			<!-- min length error -->
			<div class="error-popup" data-show="signUpForm.password.$error.minlength" data-content="The field must have at least 4 characters"></div>

			<!-- max length error -->
			<div class="error-popup" data-show="signUpForm.password.$error.maxlength" data-content="The field exceeds 50 characters"></div>
		</div> 
		
		<div>
			<input type="password" class="form-control" name="repeat_password" placeholder="Password" ng-model="user_data.repeat_password">

			<!-- passwords match error -->
			<div class="error-popup" data-show="!passwords_match" data-content="The passwords don't match"></div>
		</div>

		<div>
			<div class="required-notification" ng-class="{'hidden-element': !signUpForm.$error.required}">All fields are required.</div>
			<input type="button" class="btn btn-success" ng-disabled="signUpForm.$invalid" value="Sign up" ng-click="signUp()"/>		
		</div>

	</form>


</div>
