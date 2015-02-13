<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tienn2t
 * Date: 12/25/13
 * Time: 2:23 PM
 * To change this template use File | Settings | File Templates.
 */
include_once 'constants.php';
include_once 'ganon.php';
$url = $_POST['url'];
$site = $_POST['site'];
//$url = 'http://kenh14.vn/doi-song.chn';
//$url = 'http://dantri.com.vn/xa-hoi.htm';
//$site = DANTRI;
//
//$site = VNEXPRESS;
//$url = 'http://hn.eva.vn/eva-tam-c66.html';
//$site = EVAVN;
switch ($site){
    case KENH14:
        $data = dataKenh14($url);
        break;
    case DANTRI:
        $data = dataDantri($url);
        break;
    case VNEXPRESS:
        $data = dataVnexpress($url);
        break;
    case EVAVN:
        $data = dataEva($url);
        break;
    case H24:
        $data = dataH24($url);
        break;
    case ZING:
        $data = dataZing($url);
        break;
    case YAN:
        $data = dataYan($url);
        break;
    case VIETNAMNET:
        $data = dataVietnamnet($url);
        break;
    case SOHA:
        $data = dataSoha($url);
        break;
    case GENK:
        $data = dataGenk($url);
        break;
    case BONGDAPLUS:
        $data = dataBongdaplus($url);
        break;
    case VNPLUS:
        $data = dataVnplus($url);
        break;
    case THETHAO:
        $data = dataThethao($url);
        break;
    case IONE:
        $data = dataIOne($url);
        break;
    case EDAILY:
        $data = dataEdaily($url);
        break;
}
exit(json_encode(array('data'=>$data)));

/**************EDAILY.VN *************/
function dataEdaily($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    //if($url=="http://edaily.vn/tinh-yeu-hon-nhan-c77/"||$url!="http://edaily.vn/chuyen-la-c64/"
    //    ||$url=="http://edaily.vn/doi-song-teen-c28/"){
        foreach ($html('div.alpha ul.thumb-view li.item') as $rs) {

            foreach($rs('a img') as $row){
                $data[$i]['link_img'] = $row->src;
            }
            foreach($rs('a') as $row){
                $data[$i]['link'] = $row->href;
                $data[$i]['title'] = $row->title;
                break;
            }
            if(!isset($data[$i]['link_img'])||!isset($data[$i]['link'])||!isset($data[$i]['title'])){
                unset($data[$i]);
            }else{
                $i++;
            }

        }
    /*}else{
        foreach ($html('div.alpha figure.item') as $rs) {

            foreach($rs('a img') as $row){
                $data[$i]['link_img'] = $row->src;
            }
            foreach($rs('a') as $row){
                $data[$i]['link'] = $row->href;
                $data[$i]['title'] = $row->title;
                break;
            }
            if(!isset($data[$i]['link_img'])||!isset($data[$i]['link'])||!isset($data[$i]['title'])){
                unset($data[$i]);
            }else{
                $i++;
            }

        }

    }*/
    return $data;

}



/***** END EDAILY.VN ****************/
/**************IONE.VN *************/
function dataIOne($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    foreach ($html('div.ione_hot_news_row div.content') as $rs) {

        foreach($rs('a.pics img') as $row){
            $data[$i]['link_img'] = $row->src;
        }
        foreach($rs('h3 a') as $row){
            $data[$i]['link'] = $row->href;
            $data[$i]['title'] = $row->getPlainText();
        }
        if(!isset($data[$i]['link_img'])||!isset($data[$i]['link'])||!isset($data[$i]['title'])){
            unset($data[$i]);
        }else{
            $i++;
        }

    }
    return $data;

}



/***** END IONE.VN ****************/

/**************YAN.VN *************/
function dataYan($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    foreach($html('div#dvCatContent div.col-xs-12') as $r){
        foreach($r('a') as $row){
            $data[$i]['link'] = YAN.$row->href;
            foreach($row('img') as $rs){
                $data[$i]['link_img'] = $rs->src;
                $data[$i]['title'] = $rs->alt;
            }
            break;
        }
        $i++;
    }
    return $data;

}



/***** END YAN.VN ****************/

/**************THETHAO.VN *************/
function dataThethao($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    foreach ($html('div.left div.cat-top a') as $rs) {
        $data[$i]['link'] = $rs->href;
        foreach($rs('img') as $row){
            $data[$i]['link_img'] = $row->src;
            $data[$i]['title'] = $row->alt;
        }
        if(!isset($data[$i]['link_img'])||!isset($data[$i]['link'])||!isset($data[$i]['title'])){
            unset($data[$i]);
        }else{
            $i++;
        }
        break;

    }
    foreach ($html('div.left div.subleft div.cat-row') as $r) {
        foreach ($r('a') as $rs) {
            $data[$i]['link'] = $rs->href;
            foreach($rs('img') as $row){
                $data[$i]['link_img'] = $row->src;
                $data[$i]['title'] = $row->alt;
            }
            if(!isset($data[$i]['link_img'])||!isset($data[$i]['link'])||!isset($data[$i]['title'])){
                unset($data[$i]);
            }else{
                $i++;
            }
            break;
        }

    }

    return $data;

}



/***** END BONGDA24H.VN ****************/

/**************VIETNAMPLUS.VN *************/
function dataVnplus($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    foreach ($html('div.story-listing article.story p.thumbnail a') as $rs) {
        $data[$i]['link'] = VNPLUS.$rs->href;
        foreach($rs('img') as $row){
            $data[$i]['link_img'] = $row->src;
            $data[$i]['title'] = $row->alt;
        }
        if(!isset($data[$i]['link_img'])||!isset($data[$i]['link'])||!isset($data[$i]['title'])){
            unset($data[$i]);
        }else{
            $i++;
        }

    }
    return $data;

}



/***** END VIETNAMPLUS.VN ****************/


/**************BONGDAPLUS.VN *************/
function dataBongdaplus($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    /*foreach ($html('div.lftcol div.grd6 a img') as $rs) {
        $data[$i]['link_img'] = $rs->src;
    }
    foreach ($html('div.lftcol div.grd5 a') as $rs) {
        $data[$i]['link'] = $rs->href;
        foreach ($rs('h3.cap') as $row) {
            $data[$i]['title'] = $row->getPlainText();
        }

    }
    $i++;
    foreach ($html('div.lftcol div.mediabar ul.bar li a') as $rs) {
        $data[$i]['link'] = BONGDAPLUS.$rs->href;
        $data[$i]['title'] = $rs->title;
        foreach($rs('img') as $row){
            $data[$i]['link_img'] = $row->src;
        }
        if(!isset($data[$i]['link_img'])||!isset($data[$i]['link'])||!isset($data[$i]['title'])){
            unset($data[$i]);
        }else{
            $i++;
        }

    }*/
    foreach ($html('div.cat_news div.news_item a') as $rs) {
        $data[$i]['link'] = BONGDAPLUS.$rs->href;
        foreach($rs('img') as $row){
            $data[$i]['link_img'] = $row->src;
        }
        foreach($rs('h6') as $row){
            $data[$i]['title'] = $row->getPlainText();
        }
        $i++;
    }


    return $data;
}



/***** END BONGDAPLUS.VN ****************/

/**************GENK.VN *************/
function dataGenk($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    foreach ($html('div.list-news div.list-news-img') as $rs) {
        foreach ($rs('a') as $row) {
            foreach ($row('img') as $r) {
                $data[$i]['link_img'] = $r->src;
            }
            $data[$i]['title'] = $row->title;
            $data[$i]['link'] = GENK.$row->href;
            if(!isset($data[$i]['link_img'])||!isset($data[$i]['title'])||!isset($data[$i]['link'])){
                unset($data[$i]);
                $i--;
            }
            break;
        }
        $i++;
    }

    return $data;
}



/***** END GENK.VN ****************/


/**************KENH 14 *************/
function dataSoha($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    foreach($html('li.slide-item') as $rs){
        foreach ($rs('a') as $row) {
            foreach ($row('img') as $r) {
                $data[$i]['link_img'] = $r->src;
            }
            $data[$i]['title'] = $row->title;
            $data[$i]['link'] = SOHA.$row->href;
            if(!isset($data[$i]['link_img'])||!isset($data[$i]['title'])||!isset($data[$i]['link'])){
                unset($data[$i]);
                $i--;
            }
            break;
        }
        $i++;
    }
    foreach ($html('div.list-wrapper1 ul.list li[data-boxtype=timelineposition]') as $rs) {
        foreach ($rs('a') as $row) {
            foreach ($row('img') as $r) {
                $data[$i]['link_img'] = $r->src;
            }
            $data[$i]['title'] = $row->title;
            $data[$i]['link'] = SOHA.$row->href;
            if(!isset($data[$i]['link_img'])||!isset($data[$i]['title'])||!isset($data[$i]['link'])){
                unset($data[$i]);
                $i--;
            }
            break;
        }
        $i++;
    }

    return $data;
}

/***** END SOHA.VN ****************/

/**************VIETNAMNET *************/
function dataVietnamnet($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    foreach ($html('div.CategorySubCateItem div.Content') as $rs) {
        foreach ($rs('img') as $row) {
            $data[$i]['link_img'] = $row->src;

        }
        foreach ($rs('h2.title a') as $row) {
            $data[$i]['title'] = $row->title;
            $data[$i]['link'] = VIETNAMNET.$row->href;
        }
        $i++;

    }
    foreach ($html('div.ArticleCateList div.ArticleCateItem') as $rs) {
        foreach ($rs('img') as $row) {
            $data[$i]['link_img'] = $row->src;
        }
        foreach ($rs('h2.title a') as $row) {
            $data[$i]['title'] = $row->title;
            $data[$i]['link'] = VIETNAMNET.$row->href;
        }
        if(!isset($data[$i]['link_img'])||!isset($data[$i]['link'])||!isset($data[$i]['title'])){
            unset($data[$i]);
        }else{
            $i++;
        }

    }

    return $data;
}
/***************END VIETNAMNET *******/

/**************NEWS.ZING.VN *************/
function dataBongda($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    if($url==BONGDA){
        foreach ($html('div.headlines div.article table') as $rs) {
            foreach ($rs('div.title a') as $row) {
                $data[$i]['link'] = BONGDA.$row->href;
                foreach ($row('b') as $r) {
                    $data[$i]['title'] = $r->getPlainText();
                }

            }
            foreach ($rs('div.articleQuote div.article img') as $row) {
                $data[$i]['link_img'] = $row->src;
            }
            $i++;
        }
    }else{
        foreach ($html('table.article tr') as $rs) {
            foreach ($rs('td a.read_more') as $row) {
                $data[$i]['link'] = BONGDA.$row->href;
                $data[$i]['title'] = $row->getPlainText();

            }
            foreach ($rs('td img[width]') as $row) {
                $data[$i]['link_img'] = $row->src;
            }
            if(isset($data[$i]['link_img'])){
                $i++;
            }
        }
    }

    return $data;
}
/***************END BONGDA.COM.VN *******/

/**************NEWS.ZING.VN *************/
function dataZing($url){
    $html = file_get_dom($url);
    $i=0;
    echo $url;
    $data = array($html);
    /*foreach ($html('section.featured article') as $rs) {
        echo $i;
        foreach ($rs('div.cover') as $row) {
            $url = substr($row->style,(strpos($row->style,'(')+1),-1);
            $data[$i]['link_img'] = $url;

        }
        foreach ($rs('header h1 a') as $row) {
            $data[$i]['link'] = ZING.$row->href;
            $data[$i]['title'] = $row->getPlainText();
        }
        $i++;
    }*/

    foreach ($html('section.cate_content article') as $rs) {
        foreach ($rs('div.cover') as $row) {
            $url = substr($row->style,(strpos($row->style,'(')+1),-1);
            $data[$i]['link_img'] = $url;

        }
        foreach ($rs('header h1 a') as $row) {
            $data[$i]['link'] = ZING.$row->href;
            $data[$i]['title'] = $row->getPlainText();
        }
        $i++;
        $data[] = $i;
    }
    return $data;
}
/***************END ZING NEWS *******/

/**************24H.COM.VN *************/
function dataH24($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    foreach ($html('div.boxDoi-sub-Item-trangtrong span.imgFloat a') as $rs) {
        $data[$i]['link'] = H24.$rs->href;
        $data[$i]['title'] = $rs->title;
        foreach ($rs('img') as $row) {
            $data[$i]['link_img'] = $row->src;
        }
        $i++;
    }

    /*foreach ($html('div.boxDoi-sub-c div.boxDoi-sub-Item span.imgFloat a') as $rs) {
        $data[$i]['link'] = H24.$rs->href;
        $data[$i]['title'] = $rs->title;
        foreach ($rs('img') as $row) {
            $data[$i]['link_img'] = $row->src;
        }
        $i++;

    }*/
    return $data;
}
/***************END 24H *******/

/**************EVA *************/
function dataEva($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    foreach($html('div.news-special-trangtrong') as $rs){
        foreach($rs('div.breakingNews-trangtrong a') as $r1){
            $data[$i]['link'] = EVAVN.$r1->href;
            $data[$i]['title'] = $r1->title;
            foreach($r1('img') as $r2){
                $data[$i]['link_img'] = $r2->src;
            }
            break;
        }
        $i++;
        foreach($rs('div.newsSpecial-trangtrong div.newsSpecial-item-trangtrong span.imgFloat a') as $r1){
            $data[$i]['link'] = EVAVN.$r1->href;
            $data[$i]['title'] = $r1->title;
            foreach($r1('img') as $r2){
                $data[$i]['link_img'] = $r2->src;
            }
            $i++;
        }

    }
    foreach($html('div.boxDoi-sub-Item-trangtrong span.imgFloat a') as $r1){
        $data[$i]['link'] = EVAVN.$r1->href;
        $data[$i]['title'] = $r1->title;
        foreach($r1('img') as $r2){
            $data[$i]['link_img'] = $r2->src;
        }
        $i++;
    }
    return $data;
}
/***************END EVA *******/


/**************VNEXPRESS *************/
function dataVnexpress($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    foreach ($html('ul.list_news li div.block_image_news div.thumb a') as $rs) {
            $data[$i]['link'] = $rs->href;
            foreach ($rs('img') as $row) {
                $data[$i]['link_img'] = $row->src;
                $data[$i]['title'] = $row->alt;
            }
        $i++;
    }

    /*foreach ($html('div.content-center div.bgLeftWhite div.folder-news div.left-fnews a.aImg130') as $rs) {
        $data[$i]['link'] = $rs->href;
        foreach ($rs('img') as $row) {
            $data[$i]['link_img'] = $row->src;
            $data[$i]['title'] = $row->alt;
        }
        $i++;

    }*/
    return $data;
}
/***************END VNEXPRESS *******/


/**************DANTRI *************/
function dataDantri($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    foreach ($html('div.wid470 div.mt3') as $rs) {
        $is = 0;
        foreach ($rs('img') as $row) {
            $data[$i]['link_img'] = $row->src;
            $is++;
        }
        foreach ($rs('a') as $row) {
            $data[$i]['title'] = $row->title;
            $data[$i]['link'] = DANTRI.$row->href;
            $is++;
            break;
        }
        if($is==2){
            $i++;
        }else{
            unset($data[$i]);
        }

    }
    return $data;
}
/***************END DANTRI *******/



/**************KENH 14 *************/
function dataKenh14($url){
    $html = file_get_dom($url);
    $i=0;
    $data = array();
    foreach ($html('div.nextfocuspanel ul.nextfocus li') as $rs) {
        foreach ($rs('img') as $row) {
            $data[$i]['link_img'] = $row->src;
        }
        foreach($rs('h3 a') as $row){
            $data[$i]['title'] = $row->getPlainText();
            $data[$i]['link'] = KENH14.$row->href;
        }
        $i++;
    }
    foreach($html('div.newslistpannel ul li.item') as $rs){
        foreach ($rs('div.img img') as $row) {
            $data[$i]['link_img'] = $row->src;
        }
        foreach ($rs('h4.title a') as $row) {
            $data[$i]['title'] = $row->getPlainText();
            $data[$i]['link'] = KENH14.$row->href;
        }

        $i++;

    }
    return $data;
}


/***** END KENH 14 ****************/


function getLink($url){
    switch ($url){
        case KENH14:
            $data = array(
                'http://kenh14.vn/star.chn',
                'http://kenh14.vn/musik.chn',
                'http://kenh14.vn/cine.chn',
                'http://kenh14.vn/doi-song.chn'
            );
    }
    return $data;
}
