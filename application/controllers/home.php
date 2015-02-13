<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 2/13/15
 * Time: 11:12 AM
 */
class Home extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('story_model');
    }
    public function index(){
        $data['view'] = 'home_view';
        $data['hot_stories'] = $this->story_model->get_pagination(
            'get',
            'story',
            array(
                'top_hot'=>1
            ),
            10,
            0,
            'id,title,img,update_unixtime,total_view,category_slug,category_name',
            'update_unixtime'
        );
        $data['hot_view_stories'] = $this->story_model->get_pagination(
            'get',
            'story',
            array(
                'top_hot'=>0
            ),
            6,
            0,
            'id,title,img,update_unixtime,total_view,category_slug,category_name',
            'update_unixtime'
        );
        $this->load->view('index_view.php',$data);
    }
    public function cate($slug){
        echo $slug;
    }
}