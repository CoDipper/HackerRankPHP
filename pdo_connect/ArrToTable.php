<?php

class TableModel{
	private $data;
	
	function html_table(){
		echo "<pre>";
		//var_dump($this->data);
		echo "</pre>";
		$rows = array();
		//$head= implode('</th><th>', array_keys($this->data));
		array_push($rows,$head);
		foreach ($this->data as $row) {
			$cells = array();
			//array_push($cells,"<td>".$row."</td>");
			foreach ($row as $cell) {
				array_push($cells,"<td>".$cell."</td>");
			}
			array_push($rows,"<tr>" . implode('', $cells) . "</tr>");
		}
		return "<table class='hci-table' style='width:100%'>" . implode('', $rows) . "</table>";
	}
	public function set_data($data) {
		$this->data = $data;
	}
}
?>