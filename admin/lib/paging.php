
<?
//$page - 현재 페이지
//$page_row - 한페이지에 보일 글수
//$page_scale - 페이지 수
//$total_count - 전체 글 수 

	function paging($page, $page_row, $page_scale, $total_count, $search){
    $total_page  = ceil($total_count / $page_row);

    $paging_str = "";

    if ($page > 1) {
        $paging_str .= "<a href='".$_SERVER[PHP_SELF]."?page=1".$search."'>처음</a>";
    }

    $start_page = ( (ceil( $page / $page_scale ) - 1) * $page_scale ) + 1;

    $end_page = $start_page + $page_scale - 1;
    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1){
        $paging_str .= "<a href='".$_SERVER[PHP_SELF]."?page=".($start_page - 1).$search."'>이전</a>";
    }

    if ($total_page >= 1) {
        for ($i=$start_page;$i<=$end_page;$i++) {
            if ($page != $i) {
                $paging_str .= "<a href='".$_SERVER[PHP_SELF]."?page=".$i.$search."'><span>$i</span></a>";
            } else {
                $paging_str .= "<a class='page_now'>$i</a>";
            }
        }
    }

    if ($total_page > $end_page){
        $paging_str .= "<a href='".$_SERVER[PHP_SELF]."?page=".($end_page + 1).$search."'>다음</a>";
    }

    if ($page < $total_page) {
        $paging_str .= "<a href='".$_SERVER[PHP_SELF]."?page=".$total_page.$search."'>맨끝</a>";
    }

    return $paging_str;
}

?>
