<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 12/30/14
 * Time: 9:31 PM
 */
class Story_api extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('story_model');
    }

    public function list_story(){
        $slug = trim($this->input->post('slug'));
        $data = $this->story_model->get_limit(
            'get',
            'story',
            array(
                'category_slug'=>$slug
            ),
            100,
            0,
            'id,title,img,update_time,total_view',
            'update_unixtime',
            'DESC'
        );
        exit(json_encode(array(
            'data'=>$data
        )));
    }

    public function detail(){
        $id = trim($this->input->post('id'));
        $data = $this->story_model->get_one(
            'story',
            array(
                'id'=>(int)$id
            )
        );
        exit(json_encode($data));
    }
}