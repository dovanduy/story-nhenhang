<header>
    <h2 class="welcome_text">Truyện mới nhất, hay nhất hiện nay!</h2>
    <script type="text/javascript"><!--
        document.write('<s'+'cript type="text/javascript" src="http://cpm.edomz.com/show.php?z=41&pl=25046&j=1&code='+new Date().getTime()+'"></s'+'cript>');
        // --></script>
    <noscript>
        <iframe src="http://cpm.edomz.com/show.php?z=41&pl=25046" width="738" height="90" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>
    </noscript>
</header>
<section>

    <div class="section_main">

        <div class="row">

            <section class="eight columns">

                <h2><?=(isset($list_apps[0]['category_name']))?$list_apps[0]['category_name']:'Truyện mới nhất';?></h2>
                <?php if(count($list_apps)):?>
                    <?php foreach($list_apps as $row):?>
                        <article class="blog_post">

                            <div class="three columns">
                                <a title="<?=$row['story_slug'];?>" href="<?=base_url('story/'.$row['story_slug'])?>" class="th"><img width="150px" src="<?=$row['img'];?>" alt="desc"></a>
                            </div>
                            <div class="nine columns">
                                <a title="<?=$row['story_slug'];?>" href="<?=base_url('story/'.$row['story_slug'])?>"><h3><?=$row['title'];?></h3></a>
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
                                <a href="<?=base_url('story/'.$row['story_slug'])?>" title="<?=$row['story_slug'];?>"><?=$row['title']?></a>
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
                <script type="text/javascript"><!--
                    document.write('<s'+'cript type="text/javascript" src="http://cpm.edomz.com/show.php?z=62&pl=25121&j=1&code='+new Date().getTime()+'"></s'+'cript>');
                    // --></script>
                <noscript>
                    <iframe src="http://cpm.edomz.com/show.php?z=62&pl=25121" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>
                </noscript>
            </section>

        </div>
        <div class="row">
            <?=$page_nav;?>
        </div>

    </div>
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

</section>