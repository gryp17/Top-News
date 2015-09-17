<?php

class API extends Controller {

    public function index() {
        
    }

    public function getArticles($limit = 6, $offset = 0) {
        $api_model = $this->load_model('API_model');
        echo $api_model->getArticles($limit, $offset);
    }

    public function getArticlesBySearch($search_value) {
        $search_value = urldecode($search_value);
        $api_model = $this->load_model('API_model');
        echo $api_model->getArticlesBySearch($search_value);
    }

}