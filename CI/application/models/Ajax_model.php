<?php

class Ajax_model extends CI_Model {

    function testFunction($param) {
        return "PARAM IS " . $param;
    }

    function getLatestArticles($limit) {
        $data = array();
        
        $limit = intval($limit);
        $query = "select article.ID, title, summary, content, image_path, date, category.name as category_name from article, category where article.categoryID = category.ID order by date desc limit $limit";
        $results = $this->db->query($query);

        if ($results->num_rows() > 0) {
            foreach ($results->result() as $row) {
                $data[] = $row;
            }
        }
        
        return json_encode($data);
    }

}
