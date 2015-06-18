<div id="loading-wrapper" class="row">
    <img class="img-responsive center" src="/img/loading.gif"/>
</div>

<div id="articles-wrapper" class="row" ng-controller="homeController as home">
    <br>

        <article class="article-box" ng-repeat="article in articles_data">
            <div class="article-img">
                <a href="#/article/{{article.ID}}">
                    <div class="section-box">{{article.category_name | uppercase}}</div>
                    <img class="img-responsive center" ng-src="/res/articles/img/{{article.image_path}}"/>
                </a>
            </div>
            <div class="article-title">
                <a href="#/article/{{article.ID}}">{{article.title}}</a>
            </div>
            <div class="article-summary">
                <a href="#/article/{{article.ID}}">{{article.summary | limitTo : 100}}...</a>
            </div>
            <a href="#/article/{{article.ID}}" class="read-more-btn">
                Read More...
            </a>
        </article>

    <a href="#/archive" id="archive-link">View Archive</a>
</div>