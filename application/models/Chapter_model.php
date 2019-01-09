<?php if(!defined('BASEPATH')) exit('Hack attemp?');

class Chapter_model extends Ext_Model{

	function __construct(){
		parent::__construct();
	}
	
	function getAllChapters() {
		$sql = "select * from msChapter";
		return $this->fetch_multi_row($sql);
	}

	function getActiveChapters() {
		$sql = "select * from msChapter where deleted <> 1";
		return $this->fetch_multi_row($sql);
	}

	function getSingleChapter($id) {
		$sql = "select * from msChapter where chapterId = $id";
		return $this->fetch_single_row($sql);
	}


}