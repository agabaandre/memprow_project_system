<?php

function displayPaginationBelow($per_page, $page)
{
	include("db_connector/mysqli_conn.php");
	$page_url = "dashboard.php?action=manage_field_activities&";
	$query = mysqli_query($dbcon, "SELECT COUNT(field_activity_id) as totalCount from field_work");
	$rec = mysqli_fetch_array($query);
	$total = $rec['totalCount'];
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