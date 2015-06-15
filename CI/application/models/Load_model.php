<?php

class Load_model extends CI_Model {
    
    function addArticle($title, $summary, $content, $image_path, $views, $date,  $author_id, $category_id){
        $query = "insert into article (title, summary, content, image_path, views, date, authorID, categoryID) values (?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->query($query, array($title, $summary, $content, $image_path, $views, $date,  $author_id, $category_id));
    } 
   
}