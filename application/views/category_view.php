<section>

    <div class="section_main">

        <div class="row">

            <section class="eight columns">

                <h2><?=(isset($list_apps[0]['category_name']))?$list_apps[0]['category_name']:'Truyện mới nhất';?></h2>
                <?php if(count($list_apps)):?>
                    <?php foreach($list_apps as $row):?>
                        <article class="blog_post">

                            <div class="three columns">
                                <a title="<?=$row['story_slug'];?>" href="<?=base_url('story/detail/'.$row['story_slug'])?>" class="th"><img width="150px" src="<?=$row['img'];?>" alt="desc"></a>
                            </div>
                            <div class="nine columns">
                                <a title="<?=$row['story_slug'];?>" href="<?=base_url('story/detail/'.$row['story_slug'])?>"><h3><?=$row['title'];?></h3></a>
                                <p>Cập nhật ngày: <?=date('d-m-Y',$row['update_unixtime']);?></p>
                            </div>

                        </article>
                    <?php endforeach;?>
                <?php else:?>
                <article class="blog_post">
                    <h3>Đang cập nhật truyện, vui lòng quay lại sau.</h3>
                </article>
                <?php endif;?>

            </section>

            <section class="four columns">
                <h2>Xem nhiều nhất</h2>
                <div class="panel">
                    <h3>Giới thiệu</h3>
                    <p> Tuyển tập những truyện mới nhất, hay nhất hiện nay.</p>

                    <h3>Truyện hay khác</h3>

                    <ul style="list-style: decimal;">
                        <?php foreach($hot_view_stories as $row):?>
                            <li>
                                <a href="<?=base_url('story/detail/'.$row['story_slug'])?>" title="<?=$row['story_slug'];?>"><?=$row['title']?></a>
                            </li>
                        <?php endforeach;?>
                    </ul>



                </div>
            </section>

        </div>
        <div class="row">
            <?=$page_nav;?>
        </div>

    </div>

</section>