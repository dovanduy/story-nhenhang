<header>
    <h1 class="heading_supersize">Nhenhang.com</h1>
    <h2 class="welcome_text">Truyện mới nhất, hay nhất hiện nay!</h2>
</header>

<!-- ######################## Section ######################## -->

<section class="section_light">

    <div class="section_main">

        <div class="row">

            <section class="eight columns">

                <h2><?=$story->category_name;?></h2>

                <article class="blog_post">

                    <div class="three columns">
                        <img src="<?=$story->img;?>" alt="<?=$story->title;?>" title="<?=$story->title;?>">
                        <br>
                        <span>
                            <?=($story->update_unixtime>0)?date('d-m-Y',$story->update_unixtime):date('d-m-Y');?>
                        </span>

                    </div>
                    <div class="nine columns">
                        <a href="#"><h3><?=$story->title;?></h3></a>
                        <div class="fb-like" data-href="<?=base_url(substr($_SERVER['REQUEST_URI'],1));?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                        <p>
                            <?=$story->content;?>
                        </p>
                    </div>
                    <div class="fb-comments" data-href="<?=base_url(substr($_SERVER['REQUEST_URI'],1));?>" data-numposts="5" data-colorscheme="light"></div>
                </article>


            </section>

            <section class="four columns">
                <h2>Xem nhiều nhất</h2>
                <div class="panel">
                    <h3>heading</h3>
                    <p> Vivamus tortor tellus, rutrum sit amet mollis vel, imperdiet consectetur orci. Mauris pharetra congue enim, et sagittis lectus congue ut. Cum sociis natoque penatibus. Vivamus tortor tellus, rutrum sit amet mollis vel.</p>

                    <h3>Accordion Panel</h3>

                    <ul class="accordion">
                        <li class="active">
                            <div class="title">
                                <h5>Accordion Panel 1</h5>
                            </div>
                            <div class="content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <h5>Accordion Panel 2</h5>
                            </div>
                            <div class="content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <h5>Accordion Panel 3</h5>
                            </div>
                            <div class="content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                            </div>
                        </li>
                    </ul>



                </div>
            </section>

        </div>

    </div>

</section>

<!-- ######################## Section ######################## -->

<section  class="section_dark">

    <div class="row">

        <h2>Truyện được xem nhiều nhất</h2>
        <?php foreach($hot_view_stories as $row):?>
        <div class="two columns">
            <a href="<?=base_url('story/detail/'.$row['id'])?>" title="<?=$row['title']?>" class="th">
                <img src="<?=$row['img']?>" width="100" height="100" title="<?=$row['title']?>" alt="<?=$row['title']?>">
            </a>

        </div>
        <?php endforeach;?>


    </div>

</section>

<!-- ######################## Section ######################## -->

<section class="section_main">

    <h2 style="text-align:center">Discover Hidden Treasures</h2>

    <div class="row">

        <article class="six columns">
            <div class="panel">
                <h3>Lorem Ipsum</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec cursus fermentum metus, id commodo sapien. Donec cursus fermentum metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec cursus fermentum metus, id commodo sapien. Donec cursus fermentum metus.</p>
                <a href="#" class="button secondary small radius">Learn More &raquo;</a>
            </div>
        </article>


        <article class="six columns">
            <div class="panel">
                <h3>Lorem Ipsum</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec cursus fermentum metus, id commodo sapien. Donec cursus fermentum metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec cursus fermentum metus, id commodo sapien. Donec cursus fermentum metus.</p>
                <a href="#" class="button secondary small radius">Learn More &raquo;</a>
            </div>
        </article>

    </div>


</section>