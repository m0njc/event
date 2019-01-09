<?php if(!defined('BASEPATH')) exit('Hack attemp?');

class Subchapter_model extends Ext_Model{

	function __construct(){
		parent::__construct();
	}
	
	function getAllSubchapters() {
		$sql = "select s.*, c.* from msSubchapter s join msChapter c on c.chapterId=s.chapterId";
		return $this->fetch_multi_row($sql);
	}

	function getActiveSubchapters() {
		$sql = "select * from msSubchapter where deleted <> 1";
		return $this->fetch_multi_row($sql);
	}

	function getSingleSubchapter($id) {
		$sql = "select * from msSubchapter where SubchapterId = $id";
		return $this->fetch_single_row($sql);
	}


}