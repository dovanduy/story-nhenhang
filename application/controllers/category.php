<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 2/13/15
 * Time: 5:34 PM
 */
class Category extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('mysql_model');
    }
    public function detail($cate_slug,$id){
        echo $id.$cate_slug;
    }


}