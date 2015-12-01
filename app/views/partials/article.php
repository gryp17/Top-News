<div id="loading-wrapper" class="row">
    <img class="img-responsive center" src="img/loading.gif"/>
</div>

<div id="article-wrapper" class="row" ng-controller="articleController">
	<div ng-if="article">
		<h4 class="title" ng-bind-html="article.title"></h4>
		<img class="img-responsive center article-img" ng-src="res/articles/img/{{article.image_path}}"/>

		<div class="info-wrapper">
			<span class="date" ng-bind="article.date | formatDate:'fullDate'"></span>

			<button type="button" readonly="readonly" class="btn btn-default btn-sm views">
				{{article.views}} &nbsp; <span class="glyphicon glyphicon-eye-open"></span>
			</button> 
		</div>

		<hr>
		<article ng-bind-html="article.content"></article>
		
		<a class="btn btn-default back-btn" href="javascript:window.history.back()">Go back</a>
	</div>
</div>
