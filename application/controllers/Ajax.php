<?php

class Ajax extends CI_Controller {

    public function index() {}

    public function test() {
        $param = $_GET["bla"];
        $this->load->model('ajax_model');
        echo $this->ajax_model->testFunction($param);
    }

}
