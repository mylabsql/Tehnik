<?php

/**
 * Equ Class to Build Recursive Tree Equ 
 * Extends msDB Database 
 */
class Equ extends msDB {
	private $text = "";
	
	/**
	 * Variable to show checked mode on Json Equ
	 * Use Value 0 or 1 
	 * @var integer
	 */
	
	private $group= -1; 
	
	private $allmenu =0; 
	
	/**
	 * Constructor to connect Database
	 * Using true 
	 * @param boolean $connection
	 */
	function __construct($connection) {
		$this->messsage = "initialize class";
		if ($connection ==true) {
			$radiochecked = $this->connect();
		}
	}
	
	function __destruct() {
		unset($radiochecked);
	}
	
	/**
	 * Get Child Node on Table 
	 *
	 * @param integer $group
	 * @return recordset
	 */
	function getChild($group) {

			$str_sql = 
				"SELECT equipment.id AS id, eq_nama.nama AS equipment, equipment.sn as sn, equipment.model as model, equipment.merk as merk, equipment.daya as daya, equipment.group AS `group`
				FROM equipment inner join eq_nama on eq_nama.id=equipment.nama_id
				WHERE equipment.group=?
				ORDER BY equipment.id";
				$args = array($group,$this->group);	
		
		
		if ($this->allmenu){
			$str_sql = "SELECT * from equipment
						WHERE group=?
						ORDER BY id
						";
			$args = Array($group); 
		}
		$rs = $this->execSQL($str_sql, $args);
		return $rs;
	}

	/**
	 * Creating Json Equ 
	 *
	 * @param integer $group
	 * @return recordset
	 */
	function getEquJson($group) {
		$rs = $this->getChild($group);
		$temp = "";
		while ($row=$rs->FetchNextObject()) {
			$temp = ($temp=="")?$temp:$temp.",";
				$temp .= $this->tagJson($row->EQUIPMENT,
						    $this->getEquJson($row->ID),
						    $row->ID,
						    $row->SN,
						    $row->MODEL,
						    $row->MERK,
						    $row->DAYA
					);
		}
		return $temp;
	}
	/**
	 * Format Json Array Equ
	 *
	 * @param string $tag_name
	 * @param string $value
	 * @param integer $id
	 * @param string $iconCls
	 * @param boolean $check
	 * @return string
	 */
	function tagJson($tag_name, $value,$id=0,$sn, $model="",$merk="", $daya="") {
		$tmp = "{"."id: '$id'"; 
		if (!$id){
			if ($this->group > -1)
                            $tmp .=",expanded : true"; //jika child tidak di expand
                        if (!$this->allmenu)
                            $tmp .= ",cls:'feeds-node'";
		}
		$tmp .=",equipment:'$tag_name'";
		$tmp .=",sn:'$sn'"; 
		$tmp .=",model:'$model'";
		$tmp .=",merk:'$merk'";
		$tmp .=",daya:'$daya'"; 
		if ($value){
			if ($this->group > -1)
				$tmp .= ",expanded:true"; //agar child nampak/dibuka
			$tmp .= ", children:["."$value"."]"; 
		} else {
			$tmp .= ",leaf:true"; 
		} 
		$tmp .= "}";
		return $tmp; 
	}
	/**
	 * Get Equ on Json Format or Text Format
	 *
	 * @param string $root_title
	 * @param string:json/text $mode
	 * @param integer $allEqu
	 * @param boolean $check
	 * @return string
	 */
	function getAllEqu($root_title,$mode='json') {

	$temp = "[". $this->tagJson($root_title, $this->getEquJson(0),0,"base")."]";

		return $temp;
	}
}

?>