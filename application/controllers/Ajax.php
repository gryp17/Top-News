<?php

class Ajax extends CI_Controller {

    public function index() {}

    public function test() {
        $param = $_GET["bla"];
        $this->load->model('ajax_model');
        echo $this->ajax_model->testFunction($param);
    }
    
    public function getLatestArticles() {
        $limit = $_GET["limit"];
        $this->load->model('ajax_model');
        echo $this->ajax_model->getLatestArticles($limit);
    }

}
