<?php
class group_list_grup08 extends msDB { //class Hwd dengan extend/parameter msDB//
    var $grid; //variabel $grid

    function  __construct() { //fungsi construc//
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('equipment');  
        $this->grid->addField(
                 array(
                     'field' => 'equipment.id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true)
                    )
                ));		
		$this->grid->addField(
                array(
                    'field' => 'eq_nama.kategori',
                    'name'  => 'kategori',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Kategori','width' => 125,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'eq_nama.nama',
                    'name'  => 'nama_id',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Nama','width' => 125,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'count(sn)',
                    'name'  => 'jumlah',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Jumlah','width' => 75,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'sum(daya)',
                    'name'  => 'daya',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Daya','width' => 75,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
    }

    function read($grupid08, $request){ // fungsi memabaca + return data //	
        $this->grid->setJoin('inner join eq_nama on eq_nama.id=equipment.nama_id');
	$this->grid->setManualFilter("AND equipment.group=$grupid08");
	$this->grid->setgroupBy("eq_nama.nama");
       return $this->grid->doRead($request); 

    }
    function getcmbgrup08($request){

		$sql = "select count(*) from eq_nama"; 
		$data = array();
		$rsTotal = mysql_query($sql); 
      while($rows = mysql_fetch_array($rsTotal))
{      $total = $rows[0];}
		$data = Array();
		$start=$request['start'];
                $limit=$request['limit'];
		$sql = "select equipment.id, concat(sn, ' - ', eq_nama.nama,' - ', equipment.model, ' - ',  equipment.merk) as nama from eq_nama
		inner join equipment on equipment.nama_id=eq_nama.id
		where eq_nama.grup=1 order by eq_nama.nama limit $start,$limit";
		$rsData = mysql_query($sql); 
if(mysql_num_rows($rsData)>0){
      while($rows = mysql_fetch_array($rsData))
      			{$data[]=array(
'id' => $rows["id"],
'grup' => $rows["nama"]
);}
    } else {
      $data = array("empty");      // failure
    }


		

		$result = new stdClass(); 
		$result->success = true; 
		$result->total = $total; 
		$result->data = $data; 
		
		return json_encode($result); 

}		//image path
}
?>
