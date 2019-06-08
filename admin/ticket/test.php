<?
	session_start();
	
		include "conn.php";
		include "../lib/paging.php";
		
		$fld1 = $_POST['find'];
		$search1 =$_POST['search']; 

		$cnt_qurey = "select *  from ticket $fld1 $serch_1  ";
		$cnt_result = mysql_query($cnt_qurey,$connect);
		$row =mysql_num_rows($cnt_result);
		$fld = $_GET['fld'];
		$search = $_GET['search'];
		$fld1 = $_POST['find'];
		$search =$_POST['search'];
		$serch_1 = '%$search1%';
		
		echo $cnt_qurey;
		//echo $fld1;
		//echo $search1;

		
			// paging 변수 선언
		if($_GET[page] && $_GET[page] > 0){
				$page = $_GET[page];
			}else{
				$page = 1;
			}
		$page_row = 5;
		$page_scale = 5;
		$from_record = ($page - 1) * $page_row;
		
		// paging 함수 호출
		$paging = paging($page, $page_row, $page_scale, $row);

		$page_que = "select * from ticket order by date desc limit  $from_record, $page_row";
		$result =mysql_query($page_que,$connect);
		$page_arr=mysql_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>test</title>
</head>
<body class="a_menu1">
 <div id="free_row">
          <form name="board_form" method="post" action="test.php">
            <div id="listearch">
              <div id="list_search_total_text">
                * 총 <b><?=$row?></b> 개의 게시물이 있습니다.
              </div>
              <div id="list_search_select_menu">
                <span>SELECT</span>
                <select name="find">
					<option value="where1" selected='selected'>선택</option>
					<option value="where idno like">아이디</option>
					<option value="where name like">회원명</option>
					<option value="where date like">예약일</option>
                </select>
              </div>
              <div id="list_search_input">
                <input type="text" name="search"></input>
                <input type="submit" value="검색하기"></input>
              </div>
            </div>
          </form>
</body>
</html>