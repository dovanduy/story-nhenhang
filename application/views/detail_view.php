<header>
    <h1 class="heading_supersize">Nhenhang.com</h1>
    <h2 class="welcome_text">Truyện mới nhất, hay nhất hiện nay!</h2>
</header>

<!-- ######################## Section ######################## -->

<section class="section_light">

    <div class="section_main">

        <div class="row">
            <section class="eight columns">

                <?php if($story):?>
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
                <?php else:?>
                    <h3>Không tìm thấy truyện tương ứng.</h3>
                <?php endif;?>


            </section>

            <section class="four columns">
                <h2>Xem nhiều nhất</h2>
                <div class="panel">
                    <h3>Giới thiệu</h3>
                    <p> Tuyển tập những truyện mới nhất, hay nhất hiện nay.</p>

                    <h3>Truyện</h3>

                    <ul style="list-style: decimal;">
                        <?php foreach($hot_view_stories as $row):?>
                        <li>
                            <a href="<?=base_url('story/detail/'.$row['story_slug'])?>" title="<?=$row['story_slug'];?>"><?=$row['title']?></a>
                        </li>
                        <?php endforeach;?>
                    </ul>



                </div>
                <!-- CPM AFFILIATION TAG RECTANGLE 300X250 (nhenhang.com) -->
                <script type='text/javascript'>
                    var cpma_rnd=Math.floor(Math.random()*99999999999);
                    document.write("<scr"+"ipt type='text/javascript' src='http://www.cpmaffiliation.com/44683-300x250.js?rnd="+cpma_rnd+"'></scr"+"ipt>");
                </script>
                <!-- FIN TAG CPM AFFILIATION -->
                <!-- CPM AFFILIATION TAG SKYSCRAPER 300X600 (nhenhang.com) -->
                <script type='text/javascript'>
                    var cpma_rnd=Math.floor(Math.random()*99999999999);
                    document.write("<scr"+"ipt type='text/javascript' src='http://www.cpmaffiliation.com/44683-300x600.js?rnd="+cpma_rnd+"'></scr"+"ipt>");
                </script>
                <!-- FIN TAG CPM AFFILIATION -->
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
            <a href="<?=base_url('story/detail/'.$row['story_slug'])?>" title="<?=$row['title']?>" class="th">
                <img src="<?=$row['img']?>" width="100" height="100" title="<?=$row['title']?>" alt="<?=$row['title']?>">
            </a>

        </div>
        <?php endforeach;?>


    </div>

</section>

<!-- ######################## Section ######################## -->

<section class="section_main">

    <!-- CPM AFFILIATION TAG MEGABANNER 728X90 (nhenhang.com) -->
    <script type='text/javascript'>
        var cpma_rnd=Math.floor(Math.random()*99999999999);
        document.write("<scr"+"ipt type='text/javascript' src='http://www.cpmaffiliation.com/44683-728x90.js?rnd="+cpma_rnd+"'></scr"+"ipt>");
    </script>
    <!-- FIN TAG CPM AFFILIATION -->
    <!-- CPM AFFILIATION TAG BANNER 468X60 (nhenhang.com) -->
    <script type='text/javascript'>
        var cpma_rnd=Math.floor(Math.random()*99999999999);
        document.write("<scr"+"ipt type='text/javascript' src='http://www.cpmaffiliation.com/44683-468x60.js?rnd="+cpma_rnd+"'></scr"+"ipt>");
    </script>
    <!-- FIN TAG CPM AFFILIATION -->

    <div class="row">

        <article class="six columns">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- nhenhang.com -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:336px;height:280px"
                 data-ad-client="ca-pub-4844837048893553"
                 data-ad-slot="5121243026"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </article>


        <article class="six columns">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- nhenhang.com -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:336px;height:280px"
                 data-ad-client="ca-pub-4844837048893553"
                 data-ad-slot="5121243026"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </article>

    </div>


</section>