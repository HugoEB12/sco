<?php

	//CLASS_START
	class PaginationModel {
		
		private $url;
		private $all_rows;
		private $page_size;
		private $page;
		private $start;
		private $total_pages;

		//CONSTRUCTOR
		public function __construct($view, $all_rows, $page_size){
			$this->url = $view;
			$this->all_rows = $all_rows;
			$this->page_size = $page_size;
		}

		public function setStart($current_page)
		{
			$this->page = $current_page;
			if (!$this->page) {
        $this->start = 0;
        $this->page = 1;
      } else {
        $this->start = ($this->page - 1) * $this->page_size;
      }
      $this->total_pages = ceil($this->all_rows / $this->page_size);	
		}

		public function getStart(){
			return $this->start;
		}

		public function getPage(){
			return $this->page;
		}

		public function getAllRows(){
			return $this->all_rows;
		}

		public function getPageSize(){
			return $this->page_size;
		}

		public function getTotalPages(){
			return $this->total_pages;
		}

		public function getUrl(){
			return $this->url;
		}

		public function setAllRows($all_rows)
		{
			$this->all_rows = $all_rows;
		}

		public function placePagination(){
      if ($this->total_pages > 1) {
      	echo '<nav aria-label="Page navigation example">';
      		/**/
          echo '<ul class="pagination justify-content-center">';
          /**/
	        if ($this->page != 1) {
	        	echo '
	        	<li class="page-item">
	            <a class="page-link" href="'.$this->url.'?page='.($this->page-1).'" tabindex="-1">Anterior</a>
	          </li>';
	        } else {
	        	echo '
	        	<li class="page-item disabled">
	            <a class="page-link" href="#" tabindex="-1">Anterior</a>
	          </li>';
	        }
	        /**/
	        for ($i = 1; $i <= $this->total_pages; $i++) {
	          if ($this->page == $i) {
	            echo '<li class="page-item active"><a class="page-link" href="#">'.$this->page.'</a></li>';
	          } else {
	            echo '
	            <li class="page-item">
	              <a class="page-link" href="'.$this->url.'?page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
	            </li>';
	          }
	        }
	        /**/
	        if ($this->page != $this->total_pages){
	          echo '
	          <li class="page-item">
	            <a class="page-link" href="'.$this->url.'?page='.($this->page+1).'">Siguiente</a>
	          </li>';
	        } else {
	        	echo '
	        	<li class="page-item disabled">
	            <a class="page-link" href="#" tabindex="+1">Siguiente</a>
	          </li>';
	        }
	        /**/
        	echo "</ul>";
        	/**/
      	echo "</nav>";
      }
		}

	}
	//CLASS_END

?>