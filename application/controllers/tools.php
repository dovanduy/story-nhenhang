<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 12/17/14
 * Time: 7:28 PM
 */include_once $_SERVER['DOCUMENT_ROOT'].'/constants.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/ganon.php';
class Tools extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('mysql_model');
    }

    public function add(){
        $data = array(
            /*array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/su-kien.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/xa-hoi.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/the-gioi.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/the-thao.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/giao-duc-khuyen-hoc.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/tam-long-nhan-ai.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/kinh-doanh.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/van-hoa.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/giai-tri.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/phap-luat.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/nhip-song-tre.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/tinh-yeu-gioi-tinh.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/suc-khoe.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/suc-manh-tri-thuc.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/o-to-xe-may.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Dân trí',
                'link'=>'http://dantri.com.vn/chuyen-la.htm',
                'site_link'=>'http://dantri.com.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/star.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/musik.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/cine.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/tv-show.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/fashion.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/doi-song.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/xa-hoi.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/suc-khoe-gioi-tinh.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/made-by-me.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/la.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/sport.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/kham-pha.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/2-tek.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/goc-trai-tim.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Kênh 14',
                'link'=>'http://kenh14.vn/hoc-duong.chn',
                'site_link'=>'http://kenh14.vn'
            ),
            array(
                'site_name'=>'Eva.vn',
                'link'=>'http://hn.eva.vn/eva-tam-c66.html',
                'site_link'=>'http://eva.vn'
            ),
            array(
                'site_name'=>'Eva.vn',
                'link'=>'http://hn.eva.vn/lang-sao-c20.html',
                'site_link'=>'http://eva.vn'
            ),
            array(
                'site_name'=>'Eva.vn',
                'link'=>'http://hn.eva.vn/thoi-trang-c36.html',
                'site_link'=>'http://eva.vn'
            ),
            array(
                'site_name'=>'Eva.vn',
                'link'=>'http://hn.eva.vn/lam-dep-c58.html',
                'site_link'=>'http://eva.vn'
            ),
            array(
                'site_name'=>'Eva.vn',
                'link'=>'http://hn.eva.vn/ba-bau-c85.html',
                'site_link'=>'http://eva.vn'
            ),array(
                'site_name'=>'Eva.vn',
                'link'=>'http://hn.eva.vn/lam-me-c10.html',
                'site_link'=>'http://eva.vn'
            ),array(
                'site_name'=>'Eva.vn',
                'link'=>'http://hn.eva.vn/tinh-yeu-gioi-tinh-c3.html',
                'site_link'=>'http://eva.vn'
            ),
            array(
                'site_name'=>'Eva.vn',
                'link'=>'http://hn.eva.vn/bep-eva-c162.html',
                'site_link'=>'http://eva.vn'
            ),array(
                'site_name'=>'Eva.vn',
                'link'=>'http://hn.eva.vn/nha-dep-c169.html',
                'site_link'=>'http://eva.vn'
            ),
            array(
                'site_name'=>'Eva.vn',
                'link'=>'http://hn.eva.vn/suc-khoe-c131.html',
                'site_link'=>'http://eva.vn'
            ),
            array(
                'site_name'=>'Vnexpress',
                'link'=>'http://vnexpress.net/tin-tuc/thoi-su',
                'site_link'=>'http://vnexpress.net'
            ),
            array(
                'site_name'=>'Vnexpress',
                'link'=>'http://vnexpress.net/tin-tuc/the-gioi',
                'site_link'=>'http://vnexpress.net'
            ),
            array(
                'site_name'=>'Vnexpress',
                'link'=>'http://vnexpress.net/tin-tuc/phap-luat',
                'site_link'=>'http://vnexpress.net'
            ),
            array(
                'site_name'=>'Vnexpress',
                'link'=>'http://vnexpress.net/tin-tuc/khoa-hoc',
                'site_link'=>'http://vnexpress.net'
            ),
            array(
                'site_name'=>'Vnexpress',
                'link'=>'http://vnexpress.net/tin-tuc/oto-xe-may',
                'site_link'=>'http://vnexpress.net'
            ),
            array(
                'site_name'=>'Vnexpress',
                'link'=>'http://vnexpress.net/tin-tuc/cong-dong',
                'site_link'=>'http://vnexpress.net'
            ),array(
                'site_name'=>'Vnexpress',
                'link'=>'http://vnexpress.net/tin-tuc/tam-su',
                'site_link'=>'http://vnexpress.net'
            ),array(
                'site_name'=>'Vnexpress',
                'link'=>'http://vnexpress.net/tin-tuc/cuoi',
                'site_link'=>'http://vnexpress.net'
            ),array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/tin-tuc-trong-ngay-c46.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/bong-da-c48.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/an-ninh-hinh-su-c51.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/thoi-trang-c78.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/thoi-trang-hi-tech-c407.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/tai-chinh-bat-dong-san-c161.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/am-thuc-c460.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/lam-dep-c145.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/phim-c74.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/giao-duc-du-hoc-c216.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/phi-thuong-ky-quac-c159.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/o-to-xe-may-c77.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/thi-truong-tieu-dung-c52.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/du-lich-c76.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),array(
                'site_name'=>'24h.com.vn',
                'link'=>'http://hn.24h.com.vn/cuoi-24h-c70.html',
                'site_link'=>'http://hn.24h.com.vn'
            ),
            array(
                'site_name'=>'Zing News',
                'link'=>'http://news.zing.vn/xa-hoi.html',
                'site_link'=>'http://news.zing.vn'
            ),
            array(
                'site_name'=>'Zing News',
                'link'=>'http://news.zing.vn/the-gioi.html',
                'site_link'=>'http://news.zing.vn'
            ),
            array(
                'site_name'=>'Zing News',
                'link'=>'http://news.zing.vn/thi-truong.html',
                'site_link'=>'http://news.zing.vn'
            ),
            array(
                'site_name'=>'Zing News',
                'link'=>'http://news.zing.vn/the-thao.html',
                'site_link'=>'http://news.zing.vn'
            ),
            array(
                'site_name'=>'Zing News',
                'link'=>'http://news.zing.vn/song-tre.html',
                'site_link'=>'http://news.zing.vn'
            ),
            array(
                'site_name'=>'Zing News',
                'link'=>'http://news.zing.vn/phap-luat.html',
                'site_link'=>'http://news.zing.vn'
            ),
            array(
                'site_name'=>'Zing News',
                'link'=>'http://news.zing.vn/the-gioi-sach.html',
                'site_link'=>'http://news.zing.vn'
            ),
            array(
                'site_name'=>'Zing News',
                'link'=>'http://news.zing.vn/giai-tri.html',
                'site_link'=>'http://news.zing.vn'
            ),
            array(
                'site_name'=>'Zing News',
                'link'=>'http://news.zing.vn/am-nhac.html',
                'site_link'=>'http://news.zing.vn'
            ),
            array(
                'site_name'=>'Zing News',
                'link'=>'http://news.zing.vn/phim-anh.html',
                'site_link'=>'http://news.zing.vn'
            ),
            array(
                'site_name'=>'Vietnamnet',
                'link'=>'http://vietnamnet.vn/vn/xa-hoi/',
                'site_link'=>'http://vietnamnet.vn'
            ),

            array(
                'site_name'=>'Vietnamnet',
                'link'=>'http://vietnamnet.vn/vn/giao-duc/',
                'site_link'=>'http://vietnamnet.vn'
            ),

            array(
                'site_name'=>'Vietnamnet',
                'link'=>'http://vietnamnet.vn/vn/chinh-tri/',
                'site_link'=>'http://vietnamnet.vn'
            ),

            array(
                'site_name'=>'Vietnamnet',
                'link'=>'http://vietnamnet.vn/vn/doi-song/',
                'site_link'=>'http://vietnamnet.vn'
            ),

            array(
                'site_name'=>'Vietnamnet',
                'link'=>'http://vietnamnet.vn/vn/kinh-te/',
                'site_link'=>'http://vietnamnet.vn'
            ),

            array(
                'site_name'=>'Vietnamnet',
                'link'=>'http://vietnamnet.vn/vn/quoc-te/',
                'site_link'=>'http://vietnamnet.vn'
            ),

            array(
                'site_name'=>'Vietnamnet',
                'link'=>'http://vietnamnet.vn/vn/khoa-hoc/',
                'site_link'=>'http://vietnamnet.vn'
            ),
            array(
                'site_name'=>'Vietnamnet',
                'link'=>'http://vietnamnet.vn/vn/cong-nghe-thong-tin-vien-thong/',
                'site_link'=>'http://vietnamnet.vn'
            ),

            array(
                'site_name'=>'Vietnamnet',
                'link'=>'http://vietnamnet.vn/vn/ban-doc-phap-luat/',
                'site_link'=>'http://vietnamnet.vn'
            ),

            array(
                'site_name'=>'Genk',
                'link'=>'http://genk.vn/',
                'site_link'=>'http://genk.vn'
            ),

            array(
                'site_name'=>'Genk',
                'link'=>'http://genk.vn/dien-thoai.chn',
                'site_link'=>'http://genk.vn'
            ),

            array(
                'site_name'=>'Genk',
                'link'=>'http://genk.vn/internet.chn',
                'site_link'=>'http://genk.vn'
            ),

            array(
                'site_name'=>'Genk',
                'link'=>'http://genk.vn/tin-ict.chn',
                'site_link'=>'http://genk.vn'
            ),

            array(
                'site_name'=>'Genk',
                'link'=>'http://genk.vn/pc-do-choi-so.chn',
                'site_link'=>'http://genk.vn'
            ),
            array(
                'site_name'=>'Genk',
                'link'=>'http://genk.vn/cafe-cong-nghe.chn',
                'site_link'=>'http://genk.vn'
            ),
            array(
                'site_name'=>'Genk',
                'link'=>'http://genk.vn/kham-pha.chn',
                'site_link'=>'http://genk.vn'
            ),
            array(
                'site_name'=>'Soha.vn',
                'link'=>'http://soha.vn/kinh-doanh.htm',
                'site_link'=>'http://soha.vn'
            ),
            array(
                'site_name'=>'Soha.vn',
                'link'=>'http://soha.vn/xa-hoi.htm',
                'site_link'=>'http://soha.vn'
            ),
            array(
                'site_name'=>'Soha.vn',
                'link'=>'http://soha.vn/quoc-te.htm',
                'site_link'=>'http://soha.vn'
            ),
            array(
                'site_name'=>'Soha.vn',
                'link'=>'http://soha.vn/quan-su.htm',
                'site_link'=>'http://soha.vn'
            ),
            array(
                'site_name'=>'Soha.vn',
                'link'=>'http://soha.vn/phap-luat.htm',
                'site_link'=>'http://soha.vn'
            ),
            array(
                'site_name'=>'Soha.vn',
                'link'=>'http://soha.vn/van-hoa.htm',
                'site_link'=>'http://soha.vn'
            ),
            array(
                'site_name'=>'Soha.vn',
                'link'=>'http://soha.vn/giai-tri.htm',
                'site_link'=>'http://soha.vn'
            ),
            array(
                'site_name'=>'Soha.vn',
                'link'=>'http://soha.vn/cong-nghe.htm',
                'site_link'=>'http://soha.vn'
            ),
            array(
                'site_name'=>'Soha.vn',
                'link'=>'http://soha.vn/the-thao.htm',
                'site_link'=>'http://soha.vn'
            ),
            array(
                'site_name'=>'Soha.vn',
                'link'=>'http://soha.vn/song-khoe.htm',
                'site_link'=>'http://soha.vn'
            ),
            array(
                'site_name'=>'Soha.vn',
                'link'=>'http://soha.vn/the-gioi-do-day.htm',
                'site_link'=>'http://soha.vn'
            ),
            array(
                'site_name'=>'Soha.vn',
                'link'=>'http://soha.vn/cu-dan-mang.htm',
                'site_link'=>'http://soha.vn'
            ),
            array(
                'site_name'=>'Vietnamplus',
                'link'=>'http://www.vietnamplus.vn/kinhte.vnp',
                'site_link'=>'http://www.vietnamplus.vn'
            ),
            array(
                'site_name'=>'Vietnamplus',
                'link'=>'http://www.vietnamplus.vn/chinhtri.vnp',
                'site_link'=>'http://www.vietnamplus.vn'
            ),
            array(
                'site_name'=>'Vietnamplus',
                'link'=>'http://www.vietnamplus.vn/xahoi.vnp',
                'site_link'=>'http://www.vietnamplus.vn'
            ),
            array(
                'site_name'=>'Vietnamplus',
                'link'=>'http://www.vietnamplus.vn/thegioi.vnp',
                'site_link'=>'http://www.vietnamplus.vn'
            ),
            array(
                'site_name'=>'Vietnamplus',
                'link'=>'http://www.vietnamplus.vn/doisong.vnp',
                'site_link'=>'http://www.vietnamplus.vn'
            ),
            array(
                'site_name'=>'Vietnamplus',
                'link'=>'http://www.vietnamplus.vn/vanhoa.vnp',
                'site_link'=>'http://www.vietnamplus.vn'
            ),
            array(
                'site_name'=>'Vietnamplus',
                'link'=>'http://www.vietnamplus.vn/khoahoc.vnp',
                'site_link'=>'http://www.vietnamplus.vn'
            ),
            array(
                'site_name'=>'Vietnamplus',
                'link'=>'http://www.vietnamplus.vn/khoahoc.vnp',
                'site_link'=>'http://www.vietnamplus.vn'
            ),
            array(
                'site_name'=>'Thethao247',
                'link'=>'http://thethao247.vn/bong-da-anh-c8/',
                'site_link'=>'http://thethao247.vn'
            ),
            array(
                'site_name'=>'Thethao247',
                'link'=>'http://thethao247.vn/bong-da-tay-ban-nha-c9/',
                'site_link'=>'http://thethao247.vn'
            ),
            array(
                'site_name'=>'Thethao247',
                'link'=>'http://thethao247.vn/bong-da-italia-c10/',
                'site_link'=>'http://thethao247.vn'
            ),
            array(
                'site_name'=>'Thethao247',
                'link'=>'http://thethao247.vn/bong-da-duc-c11/',
                'site_link'=>'http://thethao247.vn'
            ),
            array(
                'site_name'=>'Thethao247',
                'link'=>'http://thethao247.vn/bong-da-phap-c12/',
                'site_link'=>'http://thethao247.vn'
            ),
            array(
                'site_name'=>'Thethao247',
                'link'=>'http://thethao247.vn/champions-league-c13/',
                'site_link'=>'http://thethao247.vn'
            ),
            array(
                'site_name'=>'Thethao247',
                'link'=>'http://thethao247.vn/europa-league-c75/',
                'site_link'=>'http://thethao247.vn'
            ),
            array(
                'site_name'=>'Thethao247',
                'link'=>'http://thethao247.vn/tin-chuyen-nhuong-c14/',
                'site_link'=>'http://thethao247.vn'
            ),
            array(
                'site_name'=>'Thethao247',
                'link'=>'http://thethao247.vn/cac-giai-bong-da-quoc-te-khac-c34/',
                'site_link'=>'http://thethao247.vn'
            ),
            array(
                'site_name'=>'Thethao247',
                'link'=>'http://thethao247.vn/world-cup-2014-c35/',
                'site_link'=>'http://thethao247.vn'
            ),*/
            array(
                'site_name'=>'YAN News',
                'link'=>'http://www.yan.vn/chuyen-muc-sao/viet-nam-1.html',
                'site_link'=>'http://www.yan.vn'
            ),
            array(
                'site_name'=>'YAN News',
                'link'=>'http://www.yan.vn/chuyen-muc-sao/chau-a-2.html',
                'site_link'=>'http://www.yan.vn'
            ),
            array(
                'site_name'=>'YAN News',
                'link'=>'http://www.yan.vn/chuyen-muc-sao/au-my-3.html',
                'site_link'=>'http://www.yan.vn'
            ),
            array(
                'site_name'=>'YAN News',
                'link'=>'http://www.yan.vn/chuyen-muc-video/showbiz-360-4.html',
                'site_link'=>'http://www.yan.vn'
            ),
            array(
                'site_name'=>'YAN News',
                'link'=>'http://www.yan.vn/chuyen-muc-dinh/tong-hop-8.html',
                'site_link'=>'http://www.yan.vn'
            ),
            array(
                'site_name'=>'YAN News',
                'link'=>'http://www.yan.vn/chuyen-muc-choi/tong-hop-11.html',
                'site_link'=>'http://www.yan.vn'
            ),
            array(
                'site_name'=>'YAN News',
                'link'=>'http://www.yan.vn/chuyen-muc-dep/thoi-trang-27.html',
                'site_link'=>'http://www.yan.vn'
            ),
            array(
                'site_name'=>'YAN News',
                'link'=>'http://www.yan.vn/chuyen-muc-dep/trang-diem-28.html',
                'site_link'=>'http://www.yan.vn'
            ),
            array(
                'site_name'=>'YAN News',
                'link'=>'http://www.yan.vn/chuyen-muc-tre/hoc-duong-21.html',
                'site_link'=>'http://www.yan.vn'
            ),
            array(
                'site_name'=>'YAN News',
                'link'=>'http://www.yan.vn/chuyen-muc-tre/yeu-22.html',
                'site_link'=>'http://www.yan.vn'
            ),
            array(
                'site_name'=>'YAN News',
                'link'=>'http://www.yan.vn/chuyen-muc-tre/cong-dong-mang-23.html',
                'site_link'=>'http://www.yan.vn'
            ),
            array(
                'site_name'=>'YAN News',
                'link'=>'http://www.yan.vn/c/mlog-1.html',
                'site_link'=>'http://www.yan.vn'
            )

        );
        $this->mysql_model->insert_batch(
            'links',
            $data
        );
    }
    public function index(){
        $data = $this->mysql_model->get_one(
            'links',
            array(
                'status'=>0
            )
        );
        if(!$data){
            //update lai trang thai status
            $this->mysql_model->update(
                'links',
                '',
                array(
                    'status'=>0
                )
            );
            $data = $this->mysql_model->get_one(
                'links',
                array(
                    'status'=>0
                )
            );
        }
        $site = $data->site_link;
        $url = $data->link;
        $id = $data->id;
        switch ($site){
            case KENH14:
                $data = $this->dataKenh14($url);
                break;
            case DANTRI:
                $data = $this->dataDantri($url);
                break;
            case VNEXPRESS:
                $data = $this->dataVnexpress($url);
                break;
            case EVAVN:
                $data = $this->dataEva($url);
                break;
            case H24:
                $data = $this->dataH24($url);
                break;
            case ZING:
                $data = $this->dataZing($url);
                break;
            case YAN:
                $data = $this->dataYan($url);
                break;
            case VIETNAMNET:
                $data = $this->dataVietnamnet($url);
                break;
            case SOHA:
                $data = $this->dataSoha($url);
                break;
            case GENK:
                $data = $this->dataGenk($url);
                break;
            case BONGDAPLUS:
                $data = $this->dataBongdaplus($url);
                break;
            case VNPLUS:
                $data = $this->dataVnplus($url);
                break;
            case THETHAO:
                $data = $this->dataThethao($url);
                break;
            case IONE:
                $data = $this->dataIOne($url);
                break;
            case EDAILY:
                $data = $this->dataEdaily($url);
                break;
        }
        if(count($data)){
            echo '<pre>'.$url;
            print_r($data);
            echo '</pre>';
            foreach($data as $row){
                //check link xem ton tai chua
                if($this->mysql_model->get_limit(
                    'total',
                    'sites',
                    array(
                        'link'=>$row['link']
                    )
                )){
                    continue;
                }
                $row['time'] = time();
                $row['site_name'] = $site;
                $row['site_link']= $url;
                $this->mysql_model->insert(
                    'sites',
                    $row
                );
            }
            echo 'Co '.count($data).' records insert';
        }else{
            echo 'Khong co du lieu nao';
        }
        //update id len status=1
        $this->mysql_model->update(
            'links',
            array(
                'id'=>$id
            ),
            array(
                'status'=>1,
                'run_time'=>time(),
                'day'=>date('Y-m-d H:i:s')
            )
        );
    }

    public function clone_data(){
        $link = $this->input->post('link');
        $data = $this->mysql_model->get_one(
            'links',
            array(
                'link'=>$link
            )
        );
        if(!$data){
            exit('link khong ton tai');
        }
        $site = $data->site_link;
        $url = $data->link;
        $id = $data->id;
        switch ($site){
            case KENH14:
                $data = $this->dataKenh14($url);
                break;
            case DANTRI:
                $data = $this->dataDantri($url);
                break;
            case VNEXPRESS:
                $data = $this->dataVnexpress($url);
                break;
            case EVAVN:
                $data = $this->dataEva($url);
                break;
            case H24:
                $data = $this->dataH24($url);
                break;
            case ZING:
                $data = $this->dataZing($url);
                break;
            case YAN:
                $data = $this->dataYan($url);
                break;
            case VIETNAMNET:
                $data = $this->dataVietnamnet($url);
                break;
            case SOHA:
                $data = $this->dataSoha($url);
                break;
            case GENK:
                $data = $this->dataGenk($url);
                break;
            case BONGDAPLUS:
                $data = $this->dataBongdaplus($url);
                break;
            case VNPLUS:
                $data = $this->dataVnplus($url);
                break;
            case THETHAO:
                $data = $this->dataThethao($url);
                break;
            case IONE:
                $data = $this->dataIOne($url);
                break;
            case EDAILY:
                $data = $this->dataEdaily($url);
                break;
        }
        if(count($data)){
            echo '<pre>'.$url;
            print_r($data);
            echo '</pre>';
            foreach($data as $row){
                //check link xem ton tai chua
                if($this->mysql_model->get_limit(
                    'total',
                    'sites',
                    array(
                        'link'=>$row['link']
                    )
                )){
                    continue;
                }
                $row['time'] = time();
                $row['site_name'] = $site;
                $row['site_link']= $url;
                $this->mysql_model->insert(
                    'sites',
                    $row
                );
            }
            echo 'Co '.count($data).' records insert';
        }else{
            echo 'Khong co du lieu nao';
        }
        //update id len status=1
        $this->mysql_model->update(
            'links',
            array(
                'id'=>$id
            ),
            array(
                'status'=>1,
                'run_time'=>time(),
                'day'=>date('Y-m-d H:i:s')
            )
        );
    }
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
        if(count($data)==0){
            foreach($html('ul#tiles li') as $r){
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
                $data[$i]['link'] = 'http://m.soha.vn'.$row->href;
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
                $data[$i]['link'] = 'http://m.soha.vn'.$row->href;
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
                $data[$i]['link'] = 'http://m.kenh14.vn'.$row->href;
            }
            $i++;
        }
        foreach($html('div.newslistpannel ul li.item') as $rs){
            foreach ($rs('div.img img') as $row) {
                $data[$i]['link_img'] = $row->src;
            }
            foreach ($rs('h4.title a') as $row) {
                $data[$i]['title'] = $row->getPlainText();
                $data[$i]['link'] = 'http://m.kenh14.vn'.$row->href;
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
    public function test(){
        $url = '';
        $d =  $this->mysql_model->get_limit(
            'get',
            'sites',
            array(
                'link'=>$url
            ),
            '',
            20,
            0
        );
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }
}