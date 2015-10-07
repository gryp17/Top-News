<div id="search-bar" class="input-group" ng-controller="searchController as search">
    <input id="search_value" name="search-value" ng-model="search_data.search_val" ng-keyup="search()" class="form-control" placeholder="Search" type="text">
    <span class="input-group-btn" id="search-button-container">
        <button class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
    </span>
</div>