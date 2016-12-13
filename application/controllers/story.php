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
        $slug = explode('_',$slug);
        if(count($slug)>1){
            $start = (int)$slug[1];
            $slug = $slug[0];
        }else{
            $start = 0;
            $slug = $slug[0];
        }
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
        //check xem co phai cate la truyen-ngan hay khong
        if($data['story']->category_slug=='truyen-ngan'){
            $data['view'] = 'detail_view';
        }else{
            $limit = 30;
            //lay cac chuong cua truyen
            $data['view'] = 'chapter_view';
            $table = strtoupper(substr($data['story']->story_slug,0,1)).'_story';
            $total = $this->story_model->get_pagination(
                'total',
                $table,
                array(
                    'story_id'=>$data['story']->id
                )
            );
            if($total){
                $data['chapter'] = $this->story_model->get_pagination(
                    'get',
                    $table,
                    array(
                        'story_id'=>$data['story']->id
                    ),
                    $limit,
                    $start,
                    '',
                    'chapter_number',
                    'ASC'
                );

            }else{
                $data['chapter'] = array();
            }
            $link= base_url('story/'.$slug);
            $this->load->library('paginate');
            $data['page_nav'] = $this->paginate->paging($total,$limit,$start,$link);
            $data['total'] = $total;
        }
        $this->load->view('index_view',$data);
    }

    public function chapter($story_slug,$chapter_slug){
        $story_slug = trim($story_slug);
        $chapter_slug = trim($chapter_slug);
        $table = strtoupper(substr($story_slug,0,1)).'_story';
        //lay thong tin truyen
        $data['story'] = $this->story_model->get_one(
            $table,
            array(
                'story_slug'=>$story_slug,
                'chapter_slug'=>$chapter_slug
            )
        );
        if($data['story']){
            $data['title'] = $data['story']->story_name.'-'.$data['story']->chapter_name;
            $info = $this->story_model->get_one(
                'story',
                array(
                    'story_slug'=>$story_slug
                )
            );
            $info->content = $data['story']->content;
            $data['story'] = $info;
        }
        $data['hot_view_stories'] = $this->story_model->get_pagination(
            'get',
            'story',
            array(
                'top_hot'=>1,
                'story_slug !='=>$story_slug
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