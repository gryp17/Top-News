<div id="loading-wrapper" class="row">
    <img class="img-responsive center" src="img/loading.gif"/>
</div>

<div id="articles-wrapper" class="row" ng-controller="archiveController as archive">
	<br>
	<input type="text" id="archive_date_picker" ng-model="selected_date" placeholder="Published on..."/>
	{{selected_date}}
	<br>
	
	<div id="not-found" class="center-text">
        No articles found.
    </div>
    <article class="article-box" ng-repeat="article in articles_data">
        <div class="article-img">
            <a href="#/article/{{article.ID}}">
                <div class="section-box">{{article.category_name| uppercase}}</div>
                <img class="img-responsive center" ng-src="res/articles/img/{{article.image_path}}"/>
            </a>
        </div>
        <div class="article-title">
            <a href="#/article/{{article.ID}}">{{article.title | limitText:70}}</a>
        </div>
        <div class="article-summary">
            <a href="#/article/{{article.ID}}">{{article.summary | limitText}}</a>
        </div>
        <a href="#/article/{{article.ID}}" class="read-more-btn">
            Read More
        </a>
    </article>

</div>
