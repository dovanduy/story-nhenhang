<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 2/26/15
 * Time: 9:55 AM
 */
require_once '/var/www/html/story-nhenhang/sqlite.php';
class Author_Sqlite extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('story_model');
    }
    public function story($author=''){
        $author = 'Tân Di Ổ';
        $path = './public/db';
        if(file_exists($path)){
            exec('rm -rf '.$path);
        }
        $db = new Sqlite($path);
        if(!$db){
            die($db->lastErrorMsg());
        }
        $story_table = <<<EOF
            CREATE TABLE IF NOT EXISTS story
            (id INTEGER PRIMARY KEY NOT NULL,
              story_name           TEXT    NOT NULL,
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
		status INTEGER DEFAULT 0);
EOF;
        if(!$db->exec($chapter_table)){
            exit($db->lastErrorMsg());
        }
        $indexes = <<<EOF
	CREATE INDEX chapter_number ON chapter(chapter_number);
	CREATE INDEX story_chapter_number ON chapter(story_id,chapter_number);
	CREATE INDEX story_idx ON chapter(story_id);
	CREATE INDEX status_idx ON chapter(status);
	CREATE INDEX updated_time_idx ON chapter(read_time);
EOF;
        if(!$db->exec($indexes)){
            exit($db->lastErrorMsg());
        }
        echo 'done';
        $db->close();
        $this->import_data($author);

    }

    public function import_data($author=''){
        echo $author.'aa';
        $db = new Sqlite('./public/db');
        if(!$db){
            die($db->lastErrorMsg());
        }

        $this->load->model('story_model');
        //doc du lieu tu mysql
        $lists = $this->story_model->getLike(
            'story',
            $author,
            '',
            'id',
            'ASC',
            100,
            '',
            ''
        );
        $storyIds = [];
        foreach($lists as $data) {
            if($data['status'] == 'Full'){
                $isFull = 3;
            }else{
                $isFull = 0;
            }
            $insert = "INSERT INTO story(id,story_name,is_full) values(:id,:story_name,:is_full)";
            $smtp = $db->prepare($insert);

            $smtp->bindParam(':id', $data['id'], SQLITE3_INTEGER);
            $smtp->bindParam(':story_name', $data['story_name'], SQLITE3_TEXT);
            $smtp->bindParam(':is_full', $isFull, SQLITE3_TEXT);
            $smtp->execute();
            $storyIds[] = $data['id'];

            if($author){
                $chapter_table = 'chapter_'.substr(trim($data['story_slug']),0,2);
                $chapters = $this->story_model->get(
                    $chapter_table,
                    array(
                        'story_id' => $data['id']
                    ),
                    '',
                    '',
                    ''
                );
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

        echo 'het nhe';
    }
}
