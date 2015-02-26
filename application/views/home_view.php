<header>
    <!--<h1 class="heading_supersize">Nhenhang.com</h1>-->
    <h2 class="welcome_text">Truyện mới nhất, hay nhất hiện nay!</h2>
</header>

<!-- ######################## Section ######################## -->

<section class="section_light">

    <div class="row">

        <h1>Truyện hot nhất trong tháng.</h1>
            <?php
                $i = 0;
                foreach($hot_stories as $row):
                $i++;
                    if($i%3==1){
                        echo '<div class="row">';
                    }
            ?>
            <article class="four columns featured_post">

                <b><a href="<?=base_url('story/detail/'.$row['story_slug'])?>"><?=$row['title'];?></a></b>
                <a href="<?=base_url('story/detail/'.$row['story_slug'])?>" title="<?=$row['title']?>">
                    <img src="<?=$row['img']?>" alt="desc" width="220px;" title="<?=$row['title']?>" alt="<?=$row['title']?>">
                </a>
                <div class="post_meta">
                    <span class="lsf-icon" title="calender"><?=($row['update_unixtime']>0)?date('d-m-Y',$row['update_unixtime']):date('d-m-Y');?></span>
                    <span class="lsf-icon" title="user" style="margin-left:15px"><a href="<?=base_url(''.$row['category_slug'])?>.html"><?=$row['category_name'];?></a></span>
                </div>

            </article>

            <?php
                if($i%3==0){
                    echo '</div>';
                }
                endforeach;
            if($i%3>0){
                echo '</div>';
            }
            ?>




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
