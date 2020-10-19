<?php

class Pagination {
	
	public static function initialize($config) {
		
		$pager = "";
			
		$count = $config["total_count"];
		$segment = $config["segment"];
		$per_page = $config["per_page"];
		$base_url = substr($config["base_url"],-1) == '/' ? $config["base_url"] : $config["base_url"] . '/';
		
		$page_no = empty($segment) ? 1 : $segment;
		$prev_page = $page_no - 1;
		$next_page = $page_no + 1;
		
		$ul_open = $config["ul_open_tag"];
		$ul_close = $config["ul_close_tag"];
		
		$li_open = $config["li_open_tag"];
		$li_close = $config["li_close_tag"];
		
		$prev = $config["prev_tag"];
		$next = $config["next_tag"];
		
		$prev_dis= $config["prev_tag_disable"];
		$next_dis = $config["next_tag_disable"];
		
		$first = $config["first_tag"];
		$last = $config["last_tag"];
		
		$active = $config["curr_page"];
		
		$pager .= $ul_open;
		
		if(!empty($first)) {
		
			if(strpos($first,"{first_link}")) {
	           	
	           if($page_no <= 1) {
	               $first = str_replace("{first_link}","/", $first);
	               $first = str_replace('<li class="','<li class="disabled ', $first);
			       $pager .= $first;
				} else {
					$first = str_replace("{first_link}", $base_url . "1", $first);
				    $pager .= $first;
				}
				
			  }
		
		}
		
		if(!empty($prev)) {
		
			if(strpos($prev,"{prev_link}")
	           || strpos($prev_dis,"{prev_link}")) {
	           	
	           if($page_no <= 1) {
	               $prev_dis = str_replace("{prev_link}","/", $prev_dis);
			       $pager .= $prev_dis;
				} else {
					$prev = str_replace("{prev_link}",$base_url . $prev_page, $prev);
				    $pager .= $prev;
				}
				
			  }
		
		}
		
		if(!empty($li_open) && !empty($li_close) && !empty($active)) {
		
			for($i = 1; $i <= $count; $i++) {
				
			   if ($i < $page_no) continue;
	           if ($i > $page_no + $per_page) break;
				
				if($i == $page_no) {
					$pager .= str_replace("{page_link}", $base_url . $i ,$active) . $i;
				} else {
					$pager .= str_replace("{page_link}", $base_url . $i ,$li_open) . $i;
				}
				
				$pager .= $li_close;
			}
		
		}
		
		if(!empty($next)) {
		
			if(strpos($next,"{next_link}")
	           || strpos($next_dis,"{next_link}")) {
	           	
	           if($page_no >= $count) {
	               $next_dis = str_replace("{next_link}","/", $next_dis);
			       $pager .= $next_dis;
				} else {
					$next = str_replace("{next_link}",$base_url . $next_page, $next);
				    $pager .= $next;
				}
				
			  }
		
		}
		
		if(!empty($last)) {
		
			if(strpos($last,"{last_link}")) {
	           	
	           if($page_no >= $count) {
	               $last = str_replace("{last_link}","/", $last);
	               $last = str_replace('<li class="','<li class="disabled ', $last);
			       $pager .= $last;
				} else {
					$last = str_replace("{last_link}", $base_url . $count, $last);
				    $pager .= $last;
				}
				
			  }
		
		}
		
	    $pager .= $ul_close;
		
		return $pager;
		
	}
	
}