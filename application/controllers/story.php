<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 2/13/15
 * Time: 5:34 PM
 */
class Story extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('story_model');
    }
    public function detail($slug){
        //lay thong tin truyen
        $data['story'] = $this->story_model->get_one(
            'story',
            array(
                'story_slug'=>$slug
            )
        );
        if($data['story']){
            $data['title'] = $data['story']->category_name.'-'.$data['story']->title;
        }
        $data['hot_view_stories'] = $this->story_model->get_pagination(
            'get',
            'story',
            array(
                'top_hot'=>1,
                'story_slug !='=>$slug
            ),
            10,
            0,
            'id,title,img,update_unixtime,total_view,category_slug,category_name,story_slug',
            'update_unixtime'
        );
        $data['view'] = 'detail_view';
        $this->load->view('index_view',$data);
    }
}