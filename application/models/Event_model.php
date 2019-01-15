<?php if(!defined('BASEPATH')) exit('Hack attemp?');

class Event_model extends Ext_Model{

	function __construct(){
		parent::__construct();
	}
	
	function getAllEvents() {
		$sql = "select * from msEvent";
		return $this->fetch_multi_row($sql);
	}

	function addEvent($data)
	{
		$result = $this->db->insert('msEvent', $data);
		return $result;
	}

	function editEvent($data)
	{
		$this->db->where('eventId', $data['eventId']);
		$result = $this->db->update('msEvent', $data);
		return $result;
	}

	function deleteEvent($data)
	{
		$result = $this->db->delete('msEvent', $data);
		return $result;
	}

	function getParticipantFromEvent($id)
	{
		$sql = "select p.*,max(e2.eventId) as maxEventId from trEventParticipant e1 join trEventParticipant e2 on e1.peopleId=e2.peopleId join msPeople p on e1.peopleId=p.peopleId where e1.eventId=$id group by e1.peopleId";
		return $this->fetch_multi_row($sql);
	}

}