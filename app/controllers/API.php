<?php

class API extends Controller {

    public function index() {
        
    }

    public function getArticles($limit = 6, $offset = 0) {
        $articles_model = $this->load_model('Articles_model');
        echo $articles_model->getArticles($limit, $offset);
    }

    public function getArticlesBySearch($search_value) {
        $search_value = urldecode($search_value);
        $articles_model = $this->load_model('Articles_model');
        echo $articles_model->getArticlesBySearch($search_value);
    }

}