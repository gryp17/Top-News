<?php

class Load extends CI_Controller {

    public function index() {
        $data = array();
        $this->load->model('load_model');

        $json = json_decode(file_get_contents("http://top-news.netau.net/res/articles/articles.json"));

        foreach ($json as $key => $value) {
            $title = $value->title;
            $category = $value->category;
            $date = $value->date;
            $summary = $value->summary;
            $content = $value->content;
            $image_name = $value->image_name;

            switch ($category) {
                case "politics":
                    $category_id = 1;
                    break;
                case "world":
                    $category_id = 2;
                    break;
                case "technology":
                    $category_id = 3;
                    break;
                case "economy":
                    $category_id = 4;
                    break;
                case "sport":
                    $category_id = 5;
                    break;
            }
            
            
            $this->load_model->addArticle($title, $summary, $content, $image_name, 0, $date, 2, $category_id);

        }



        #$this->load_model->addArticle("test", "bla", 2, 1);

        $this->load->view('home_view', $data);
    }

}
