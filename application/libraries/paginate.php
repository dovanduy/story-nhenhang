<?php
/**
 * User: hungdp
 * Date: 3/12/13
 * Time: 10:20 AM
 */
class Paginate{

    var $pagination;
    function get_html($current_page,$num_record,$num_display)
    {
        $this->pagination=new CI_Pagination();
        /*$current_page : trang hien tai
        $num_record : tong so ban ghi
        $num_display : so ban ghi tren 1 trang
        */
        $config['uri_segment'] = 4;
        $config['base_url'] = $current_page;
        $config['total_rows'] = $num_record;
        $config['per_page'] = $num_display;
        //tag of current link
        $config['cur_tag_open'] = '<a class="active"> ';
        $config['cur_tag_close'] = '</a>';
        //first link
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<a>';
        $config['first_tag_close'] = '</a>';
        //Ten cua last link
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<a>';
        $config['last_tag_close'] = '</a>';

        //next
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<a>';
        $config['next_tag_close'] = '</a>';
        //prev
        //next
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<a>';
        $config['prev_tag_close'] = '</a>';
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function pagenav($total,$limit,$start){
        $total_pages = ceil($total/$limit);
        if($total_pages==1){
            return '';
        }
        $page = $start/$limit+1;
        $page_nav = "<div align='center' id='paginator_id'>";

        // Tạo liên kết đến trang trước trang đang xem
        if($page > 1){
            $prev = ($page - 1);
            $page_nav.= "<a num='".(($prev-1)*$limit)."' class='btn'><<</a>&nbsp;";
        }
        if($total_pages<13){
            for($i=1;$i<=$total_pages;$i++){
                if($i==$page){
                    $page_nav.="<span class='btn btn-danger'>$i</span>&nbsp;";
                }else{
                    $page_nav.="<a num='".(($i-1)*$limit)."' class='btn'>$i</a>&nbsp;";
                }
            }
        }else if($page<9){
            for($i=1;$i<=10;$i++){
                if($i==$page){
                    $page_nav.="<span class='btn btn-danger'>$i</span>&nbsp;";
                }else{
                    $page_nav.="<a num='".(($i-1)*$limit)."' class='btn'>$i</a>&nbsp;";
                }
            }
            $page_nav.="&hellip;";
            $page_nav.="<a num='".(($total_pages-2)*$limit)."' class='btn'>".($total_pages-1)."</a>&nbsp;";
            $page_nav.="<a num='".(($total_pages-1)*$limit)."' class='btn'>".$total_pages."</a>&nbsp;";
        }else if($page>$total_pages-8){
            $page_nav.="<a num='0' class='btn'>1</a>&nbsp;";
            $page_nav.="<a num='".$limit."' class='btn'>2</a>&nbsp;";
            $page_nav.="&hellip;";
            for($i=$total_pages-9;$i<=$total_pages;$i++){
                if($i==$page){
                    $page_nav.="<span class='btn btn-danger'>$i</span>&nbsp;";
                }else{
                    $page_nav.="<a num='".(($i-1)*$limit)."' class='btn'>$i</a>&nbsp;";
                }
            }
        }else{
            $page_nav.="<a num='0' class='btn'>1</a>&nbsp;";
            $page_nav.="<a num='".$limit."' class='btn'>2</a>&nbsp;";
            $page_nav.="&hellip;";
            for($i=$page-5;$i<$page+5;$i++){
                if($i==$page){
                    $page_nav.="<span class='btn btn-danger'>$i</span>&nbsp;";
                }else{
                    $page_nav.="<a num='".(($i-1)*$limit)."' class='btn'>$i</a>&nbsp;";
                }
            }
            $page_nav.="&hellip;";
            $page_nav.="<a num='".(($total_pages-2)*$limit)."' class='btn'>".($total_pages-1)."</a>&nbsp;";
            $page_nav.="<a num='".(($total_pages-1)*$limit)."' class='btn'>".$total_pages."</a>&nbsp;";
        }

        if($page < $total_pages){
            $next = ($page + 1);
            $page_nav.= "<a num='".(($next-1)*$limit)."' class='btn'>>></a>";
        }
        $page_nav.= "</div>";
        return $page_nav;
    }

    public function pagenav_dealer($total,$limit,$start){
        $total_pages = ceil($total/$limit);
        if($total_pages==1){
            return '';
        }
        $page = $start/$limit+1;
        $page_nav = '<ul class="pagination">';

        // Tạo liên kết đến trang trước trang đang xem
        if($page > 1){
            $prev = ($page - 1);
            $page_nav.= "<li><a num='".(($prev-1)*$limit)."' class='choose-page'><<</a></li>";
        }
        if($total_pages<13){
            for($i=1;$i<=$total_pages;$i++){
                if($i==$page){
                    $page_nav.="<li class='active'><a href='javascript:void(0);'>$i</a></li>";
                }else{
                    $page_nav.="<li><a num='".(($i-1)*$limit)."' class='choose-page'>$i</a></li>";
                }
            }
        }else if($page<9){
            for($i=1;$i<=10;$i++){
                if($i==$page){
                    $page_nav.="<li class='active'><a href='javascript:void(0);'>$i</a></li>";
                }else{
                    $page_nav.="<li><a num='".(($i-1)*$limit)."' class='choose-page'>$i</a></li>";
                }
            }
            $page_nav.="<li><a hre='#'>&hellip;</a></li>";
            $page_nav.="<li><a num='".(($total_pages-2)*$limit)."' class='choose-page'>".($total_pages-1)."</a></li>";
            $page_nav.="<li><a num='".(($total_pages-1)*$limit)."' class='choose-page'>".$total_pages."</a></li>";
        }else if($page>$total_pages-8){
            $page_nav.="<li><a num='0' >1</a></li>";
            $page_nav.="<li><a num='".$limit."' class='choose-page'>2</a></li>";
            $page_nav.="<li><a hre='#'>&hellip;</a></li>";
            for($i=$total_pages-9;$i<=$total_pages;$i++){
                if($i==$page){
                    $page_nav.="<li class='active'><a href='javascript:void(0);'>$i</a></li>";
                }else{
                    $page_nav.="<li><a num='".(($i-1)*$limit)."' class='choose-page'>$i</a></li>";
                }
            }
        }else{
            $page_nav.="<li><a num='0' class='choose-page'>1</a></li>";
            $page_nav.="<li><a num='".$limit."' class='choose-page'>2</a></li>";
            $page_nav.="<li><a hre='#'>&hellip;</a></li>";
            for($i=$page-5;$i<$page+5;$i++){
                if($i==$page){
                    $page_nav.="<li class='active'><a href='javascript:void(0);'>$i</a></li>";
                }else{
                    $page_nav.="<li><a num='".(($i-1)*$limit)."' class='choose-page'>$i</a></li>";
                }
            }
            $page_nav.="<li><a hre='#'>&hellip;</a></li>";
            $page_nav.="<li><a num='".(($total_pages-2)*$limit)."' class='choose-page'>".($total_pages-1)."</a></li>";
            $page_nav.="<li><a num='".(($total_pages-1)*$limit)."' class='choose-page'>".$total_pages."</a></li>";
        }

        if($page < $total_pages){
            $next = ($page + 1);
            $page_nav.= "<li><a num='".(($next-1)*$limit)."' class='choose-page'>>></a></li>";
        }
        $page_nav.= "</ul>";
        return $page_nav;
    }

    public function paging($totalRecord, $limit,$start,$link='') {
        // var_dump($link); die;
        $totalPage = ceil($totalRecord/$limit);
        $page = $start/$limit+1;
        $paging ='<ul class="pagination">';

            $segment = 2;

        if ($totalPage>1){
            if ($page > 1) {
                $previous = $page-1;
                $paging .="<li><a num='0' class='choose-page' href='".$link.".html'>Trang đầu</a></li>";
                $paging .="<li><a num='".(($previous-1)*$limit)."' class='choose-page' href='".$link."_".(($previous-1)*$limit).".html'>«</a></li>";

            }

            if ($page <= $segment) {
                if ($segment + $page <=$totalPage){
                    for ($i = 1; $i <= ($segment+$page); $i++) {
                        if ($page == $i) {
                            $paging .= "<li class='active'><a href='javascript:void(0);'>$i</a></li>";
                        } else {
                            $paging .="<li><a href='".$link."_".(($i-1)*$limit).".html' num='".(($i-1)*$limit).".html' class='choose-page' >$i</a></li>";
                        }
                    }
                } else{
                    for ($i = 1; $i <= $totalPage; $i++) {
                        if ($page == $i) {
                            $paging .= "<li class='active'><a href='javascript:void(0);'>$i</a></li>";
                        } else {
                            $paging .="<li><a href='".$link."_".(($i-1)*$limit).".html' num='".(($i-1)*$limit)."' class='choose-page'>$i</a></li>";

                        }
                    }
                }
            }
            elseif ($page > ($totalPage-$segment)) {
                for ($i = ($totalPage-$segment); $i <= $totalPage; $i++) {
                    if ($page == $i) {
                        $paging .= "<li class='active'><a href='javascript:void(0);'>$i</a></li>";

                    } /*else {
                        $paging .="<li><a num='".(($i-1)*$limit)."' class='choose-page'>$i</a></li>";

                    }*/
                }
            } else {
                for ($i = ($page-$segment); $i <=($page+$segment); $i++) {
                    if ($page == $i) {
                        $paging .= "<li class='active'><a href='javascript:void(0);'>$i</a></li>";

                    } /*else {
                        $paging .="<li><a num='".(($i-1)*$limit)."' class='choose-page'>$i</a></li>";

                    }*/
                }
            }
            if ($page < $totalPage){
                $next = $page+1;
                    $paging .="<li><a href='".$link."_".(($next-1)*$limit).".html' num='".(($next-1)*$limit)."' class='choose-page'>»</a></li>";
                    $paging .="<li><a href='".$link."_".(($totalPage-1)*$limit).".html' num='".(($totalPage-1)*$limit)."' class='choose-page'>Trang cuối</a></li>";

            }
            $paging .='</ul>';
            return $paging;
        } else {
            $paging = '';
            return $paging;
        }

    }
}
