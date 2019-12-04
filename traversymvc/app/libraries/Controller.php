<?php

    class Controller
    {
        /*
         * Base Controller
         * Loads models and views
         */


         //Load model
         public function model($model)
         {  
             //require model
            require_once("../app/model/" . $model . ".php");
             //instantiate model
             return new $model();
         }

         //load view
         public function view($view, $data = [])
         {
            if(file_exists("../app/views/" . $view . ".php")){
                require_once("../app/views/" . $view . ".php");
            } else {
                //view does not exist
                die("View does not exist");
            }
         }
    }