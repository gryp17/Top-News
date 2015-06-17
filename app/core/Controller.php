<?php

class Controller{
    
    public function load_model($model, $singleton = false){
        #echo $model;
        require_once "app/models/$model.php";
        
        if($singleton){
            return call_user_func(array($model, "getInstance")); #PHP v5.2 fix
            #return $model::getInstance();
        }else{
            return new $model();
        }
    }
    
    public function load_view($view, $data = array()){
        require_once "app/views/$view.php";
    }
    
}

