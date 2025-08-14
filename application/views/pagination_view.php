<style>
	.pagination li.active a.page-link {
	  //background: #D32F3C; !important; 
		//background: green; !important; 
	  color: #fff; !important; 
	}
</style>
	<?php
	if($this->pagination['total']>1) {
	?>
	<nav class="pagination text-center" role="navigation " aria-label="pagination">
	  <!--
	  <a class="pagination-previous"><i class="fa fa-chevron-circle-left"></i></a>
	  <a class="pagination-next"><i class="fa fa-chevron-circle-right"></i></a>
	  -->
	  

	  <ul class="pagination pagination-sm justify-content-center">
		<?php
		
		$total=intval($this->pagination['total']);
		$page_num=intval($this->pagination['page_num']);
		$data_per_page=intval($this->pagination['data_per_page']);
		$last_page=intval($this->pagination['last_page']);
		
		$a=1;
		$active='';
		if($last_page<=5){
			for($a=1; $a<=$last_page; $a++){
				$active='';
				if($a==$page_num) { $active='active'; }
				echo '<li class="page-item '.$active.'"><a class="page-link" id="page_num" value="'.$a.'">'.$a.'</a></li>';
			}
		} else {
			
			// link to first page
			echo '<li class="page-item">
				  <a class="page-link" value="1"aria-label="Прва страна">
					<i class="fa fa-angle-double-left"></i>
				  </a>
				</li>';
				
			// link to previous page
			if($page_num==1) { 
				$tmp = 1;
			} else {
				$tmp = $page_num-1;
			}
			echo '<li class="page-item">
				  <a class="page-link" value="'.$tmp.'"aria-label="Претходна страна">
					<i class="fa fa-chevron-circle-left"></i>
				  </a>
				</li>';
			$b=0;
			
			if($page_num<=4) { $b=7; 
				for($a=1; $a<=$b; $a++){
					$active='';
					if($a==$page_num) { 
						$active='active'; 
					}
					If(($a>0) and ($a<=$last_page)) {
						echo '<li class="page-item '.$active.'"><a class="page-link" id="page_num" value="'.$a.'">'.$a.'</a></li>';
					}
				}
			} elseif( ($page_num>4) and ($page_num-3<=$last_page) ) { 
				if( ($page_num-7<=$last_page) and ($page_num>$last_page-7) ) {
					$b=$last_page-6; 
					for($a=$b; $a<=$last_page; $a++){
						$active='';
						if($a==$page_num) {
							$active='active';
						}
						If(($a>0) and ($a<=$last_page)) {
							echo '<li class="page-item '.$active.'"><a class="page-link" id="page_num" value="'.$a.'">'.$a.'</a></li>';
					}	
					}
				} else {
					$b=$page_num; 
					for($a=$b-3; $a<=$b+3; $a++){
						$active='';
						if($a==$page_num) {
							$active='active';
						}
						echo '<li class="page-item '.$active.'"><a class="page-link" id="page_num" value="'.$a.'">'.$a.'</a></li>';
					}
				}
			}

			// link to next page
			if($page_num==$last_page) { 
				$tmp = $last_page;
			} else {
				$tmp = $page_num+1;
			}			
			echo '<li class="page-item">
				  <a class="page-link" value="'.$tmp.'"aria-label="Следећа страна">
					<i class="fa fa-chevron-circle-right"></i>
				  </a>
				</li>';
				
			// link to last page
			echo '<li class="page-item">
				  <a class="page-link" value="'.$last_page.'"aria-label="Последња страна">
					<i class="fa fa-angle-double-right"></i>
				  </a>
				</li>';
			
		}
		?>
		
	  </ul>
	</nav>
<?php
	}
?>