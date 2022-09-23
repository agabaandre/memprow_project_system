 <style type="text/css">
 	.navi {
 		width: 500px;
 		margin: 5px;
 		padding: 2px 5px;
 		border: 1px solid #eee;
 	}

 	.show {
 		color: blue;
 		margin: 5px 0;
 		padding: 3px 5px;
 		cursor: pointer;
 		font: 15px/19px Arial, Helvetica, sans-serif;
 	}

 	.show a {
 		text-decoration: none;
 	}

 	.show:hover {
 		text-decoration: underline;
 	}


 	ul.setPaginate li.setPage {
 		padding: 15px 10px;
 		font-size: 14px;
 	}

 	ul.setPaginate {
 		margin: 0px;
 		padding: 0px;
 		height: 100%;
 		overflow: hidden;
 		font: 12px 'Tahoma';
 		list-style-type: none;
 	}

 	ul.setPaginate li.dot {
 		padding: 3px 0;
 	}

 	ul.setPaginate li {
 		float: left;
 		margin: 0px;
 		padding: 0px;
 		margin-left: 5px;
 	}



 	ul.setPaginate li a {
 		background: none repeat scroll 0 0 #ffffff;
 		border: 1px solid #cccccc;
 		color: #999999;
 		display: inline-block;
 		font: 15px/25px Arial, Helvetica, sans-serif;
 		margin: 5px 3px 0 0;
 		padding: 0 5px;
 		text-align: center;
 		text-decoration: none;
 	}

 	ul.setPaginate li a:hover,
 	ul.setPaginate li a.current_page {
 		background: none repeat scroll 0 0 #0d92e1;
 		border: 1px solid #000000;
 		color: #ffffff;
 		text-decoration: none;
 	}

 	ul.setPaginate li a {
 		color: black;
 		display: block;
 		text-decoration: none;
 		padding: 5px 8px;
 		text-decoration: none;
 	}
 </style>
 <?php

	function displayPaginationBelow($per_page, $page, $count, $url)
	{

		$page_url = $url;
		$total = $count;
		$adjacents = "2";

		$page = ($page == 0 ? 1 : $page);
		$start = ($page - 1) * $per_page;

		$prev = $page - 1;
		$next = $page + 1;
		$setLastpage = ceil($total / $per_page);
		$lpm1 = $setLastpage - 1;

		$setPaginate = "";
		if ($setLastpage > 1) {
			$setPaginate .= "<ul class='setPaginate'>";
			$setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
			if ($setLastpage < 7 + ($adjacents * 2)) {
				for ($counter = 1; $counter <= $setLastpage; $counter++) {
					if ($counter == $page)
						$setPaginate .= "<li><a class='current_page'>$counter</a></li>";
					else
						$setPaginate .= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";
				}
			} elseif ($setLastpage > 5 + ($adjacents * 2)) {
				if ($page < 1 + ($adjacents * 2)) {
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
						if ($counter == $page)
							$setPaginate .= "<li><a class='current_page'>$counter</a></li>";
						else
							$setPaginate .= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";
					}
					$setPaginate .= "<li class='dot'>...</li>";
					$setPaginate .= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
					$setPaginate .= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";
				} elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
					$setPaginate .= "<li><a href='{$page_url}page=1'>1</a></li>";
					$setPaginate .= "<li><a href='{$page_url}page=2'>2</a></li>";
					$setPaginate .= "<li class='dot'>...</li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
						if ($counter == $page)
							$setPaginate .= "<li><a class='current_page'>$counter</a></li>";
						else
							$setPaginate .= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";
					}
					$setPaginate .= "<li class='dot'>..</li>";
					$setPaginate .= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
					$setPaginate .= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";
				} else {
					$setPaginate .= "<li><a href='{$page_url}page=1'>1</a></li>";
					$setPaginate .= "<li><a href='{$page_url}page=2'>2</a></li>";
					$setPaginate .= "<li class='dot'>..</li>";
					for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
						if ($counter == $page)
							$setPaginate .= "<li><a class='current_page'>$counter</a></li>";
						else
							$setPaginate .= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";
					}
				}
			}

			if ($page < $counter - 1) {
				$setPaginate .= "<li><a href='{$page_url}page=$next'>Next</a></li>";
				$setPaginate .= "<li><a href='{$page_url}page=$setLastpage'>Last</a></li>";
			} else {
				$setPaginate .= "<li><a class='current_page'>Next</a></li>";
				$setPaginate .= "<li><a class='current_page'>Last</a></li>";
			}

			$setPaginate .= "</ul>\n";
		}


		return $setPaginate;
	}
