<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 2/26/15
 * Time: 9:55 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/sqlite.php';
class Ngontinh_Sqlite extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('story_model');
    }
    public function story(){
        $path = './public/db';
        if(file_exists($path)){
            exec('rm -rf '.$path);
        }
        $db = new Sqlite('./public/db');
        $story_table = <<<EOF
            CREATE TABLE IF NOT EXISTS story
            (id INTEGER PRIMARY KEY NOT NULL,
              story_name           TEXT    NOT NULL,
              category_id INTEGER,
              status  INTEGER DEFAULT 0,
              updated_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              is_full integer default 0);
EOF;
        if(!$db->exec($story_table)){
            exit($db->lastErrorMsg());
        }
        $chapter_table = <<<EOF
            CREATE TABLE IF NOT EXISTS chapter
            (id INTEGER PRIMARY KEY AUTOINCREMENT,
              story_name TEXT,
              story_id INTEGER,
              chapter_name TEXT,
              chapter_number INTEGER,
              content         TEXT,
              read_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              save_time TIMESTAMP,
		status INTEGER DEFAULT 0,
		save_story INTEGER DEFAULT 0);
EOF;
        if(!$db->exec($chapter_table)){
            exit($db->lastErrorMsg());
        }
        $indexes = <<<EOF
	CREATE INDEX category_idx ON story(category_id);
	CREATE INDEX chapter_number ON chapter(chapter_number);
	CREATE INDEX story_chapter_number ON chapter(story_id,chapter_number);
	CREATE INDEX story_idx ON chapter(story_id);
	CREATE INDEX story_name ON story(story_name);
	CREATE INDEX status_idx ON chapter(status);
	CREATE INDEX updated_time_idx ON chapter(read_time);
EOF;
        if(!$db->exec($indexes)){
            exit($db->lastErrorMsg());
        }
        echo 'done';
        $db->close();
        $this->import_data();

    }

    public function import_data(){
        $db = new Sqlite('./public/db');
        if(!$db){
            die($db->lastErrorMsg());
        }

        $this->load->model('story_model');
        //doc du lieu tu mysql
        $categories = $this->story_model->get(
            'category',
            '',
            '',
            '',
            '',
            '',
            [4],
            'id'
        );

        $total = 0;
        foreach($categories as $c){
            /*$insert = "INSERT INTO category(id,category_name) values(:id,:category_name)";
            $smtp = $db->prepare($insert);

            $smtp->bindParam(':id', $c['id'], SQLITE3_INTEGER);
            $smtp->bindParam(':category_name', $c['category_name'], SQLITE3_TEXT);
            $smtp->execute();*/
            $category = $c['id'];
            $lists = $this->story_model->get(
                'story',
                array(
                    'hot'=>10
                ),
                '',
                'id',
                'ASC'
            );
            $storyIds = [];
            foreach($lists as $data) {
                if($data['status'] == 'Full'){
                    $isFull = 1;
                }else{
                    $isFull = 0;
                }
                $insert = "INSERT INTO story(id,story_name,category_id,is_full) values(:id,:story_name,:category_id,:is_full)";
                $smtp = $db->prepare($insert);

                $smtp->bindParam(':id', $data['id'], SQLITE3_INTEGER);
                $smtp->bindParam(':story_name', $data['story_name'], SQLITE3_TEXT);
                $smtp->bindParam(':category_id', $category, SQLITE3_TEXT);
                $smtp->bindParam(':is_full', $isFull, SQLITE3_TEXT);
                $smtp->execute();
                $storyIds[] = $data['id'];

                if($category){
                    $chapter_table = 'chapter_'.substr(trim($data['story_slug']),0,2);
                    if(preg_match('/^[\w\d]-/',substr(trim($data['story_slug']),0,2)) == true){
                        continue;
                    }
                    $chapters = $this->story_model->get(
                        $chapter_table,
                        array(
                            'story_id' => $data['id']
                        ),
                        '',
                        'chapter_number',
                        'ASC'
                    );
                    echo $data['story_name'].' total = '.count($chapters).PHP_EOL;
                    $total += count($chapters);
                    //continue;
                    $insert = "INSERT INTO chapter(story_name,story_id,chapter_name,
        chapter_number,content) values(:story_name,:story_id,:chapter_name,
        :chapter_number,:content)";
                    foreach ($chapters as $data) {
                        $smtp = $db->prepare($insert);
                        $smtp->bindParam(':story_name', $data['story_name'], SQLITE3_TEXT);
                        $smtp->bindParam(':story_id', $data['story_id'], SQLITE3_INTEGER);
                        $smtp->bindParam(':chapter_name', $data['chapter_name'], SQLITE3_TEXT);
                        $smtp->bindParam(':chapter_number', $data['chapter_number'], SQLITE3_INTEGER);
                        $smtp->bindParam(':content', $data['content'], SQLITE3_TEXT);
                        $smtp->execute();
                    }
                    if($isFull == 3 && count($chapters)<30){
                        $update = "UPDATE story SET is_full=1 WHERE id=".$data['id'];
                        $smtp = $db->prepare($update);
                        $smtp->execute();
                    }
                }
            }

        }



        echo 'het nhe total ='.$total;
    }
}
