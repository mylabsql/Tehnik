<?php
class equ01 extends msDB { //class Hwd dengan extend/parameter msDB//
    var $grid; //variabel $grid

    function  __construct() { //fungsi construc//
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('equipment');
        $this->grid->addField(
                array(
                     'field' => 'id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true)
                    )
                ));
		$this->grid->addField(
                array(
                    'field' => 'nama_id',
                    'name'  => 'nama_id',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Nama','width' => 125,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'sn',
                    'name'  => 'sn',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Serial-no','width' => 75,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'model',
                    'name'  => 'model',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Model','width' => 100,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'merk',
                    'name'  => 'merk',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Merk','width' => 100,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'daya',
                    'name'  => 'daya',
                    'meta' => array(
                      'st' => array('type' => 'int', 'allowBlank' => true), 
                      'cm' => array('header' => 'Daya','width' => 50,'sortable' => true),
                      'filter' => array('type' => 'int')
			)
                ));
		$this->grid->addField(
                array(
                     'field' => 'admin',
                    'name'  => 'admin',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true)
                    )
                ));
		$this->grid->addField(
		array(
                    'field' => 'keterangan',
                    'name' => 'keterangan',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Keterangan', 'width' => 500, 'sortable' => true)
                    )                  
                  )
                );  
    }

    function create($request){ //fungsi create + return data//
         $data = array(
          'nama_id' => $request['nama_id'],
	  'sn' => $request['sn'],
	  'model' => $request['model'],
	  'merk' => $request['merk'],
	  'daya' => $request['daya'],
          'keterangan' => $request['keterangan'],
	  'admin' => $request['usr_id']
        );                
        return $this->grid->doCreate(json_encode($data));
}

    function edit($id,$request){ //fungsi edit//
       $this->grid->loadSingle = true;
       $this->grid->setManualFilter(" and id = $id"); 
       return $this->grid->doRead($request); 
    }
    
    function read($request){ // fungsi memabaca + return data //
        $eq_edit = new Grid;
        $eq_edit->setTable('equipment');	
        $eq_edit->setJoin('inner join eq_nama on eq_nama.id=equipment.nama_id');
        $eq_edit->addField(
                array(
                     'field' => 'equipment.id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true)
                    )
                ));		
		$eq_edit->addField(
                array(
                    'field' => 'eq_nama.kategori',
                    'name'  => 'kategori',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Kategori','width' => 125,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$eq_edit->addField(
                array(
                    'field' => 'eq_nama.nama',
                    'name'  => 'nama_id',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Nama','width' => 125,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$eq_edit->addField(
                array(
                    'field' => 'sn',
                    'name'  => 'sn',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Serial-no','width' => 75,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$eq_edit->addField(
                array(
                    'field' => 'model',
                    'name'  => 'model',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Model','width' => 100,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$eq_edit->addField(
                array(
                    'field' => 'merk',
                    'name'  => 'merk',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Merk','width' => 100,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$eq_edit->addField(
                array(
                    'field' => 'daya',
                    'name'  => 'daya',
                    'meta' => array(
                      'st' => array('type' => 'int', 'allowBlank' => true), 
                      'cm' => array('header' => 'Daya','width' => 50,'sortable' => true),
                      'filter' => array('type' => 'int')
			)
                ));
		$eq_edit->addField(
                array(
                     'field' => 'equipment.admin',
                    'name'  => 'admin',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true)
                    )
                ));
		$eq_edit->addField(
		array(
                    'field' => 'equipment.keterangan',
                    'name' => 'keterangan',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Keterangan', 'width' => 500, 'sortable' => true)
                    )                  
                  )
                );  
       return $eq_edit->doRead($request); 

    }
    function update($request){  //fungsi update + return data
        $data = array(
          'id' => $request['id'],
          //'nama_id' => $request['nama_id'],
	  'sn' => $request['sn'],
	  'model' => $request['model'],
	  'merk' => $request['merk'],
	  'daya' => $request['daya'],
          'keterangan' => $request['keterangan'],
	  'admin' => $request['usr_id']
	  );
        return $this->grid->doUpdate(json_encode($data));
    }
    
    function doReport($request){
      return $this->grid->dosql($request); 
    }

    function destroy($request){
        return $this->grid->doDestroy($request);
    }
    function getcmbnama01($request){

		$sql = "select count(*) from eq_nama"; 
		$data = array();
		$rsTotal = mysql_query($sql); 
      while($rows = mysql_fetch_array($rsTotal))
{      $total = $rows[0];}
		$data = Array();
		$start=$request['start'];
                $limit=$request['limit'];
		$sql = "select id, nama from eq_nama order by nama limit $start,$limit";
		$rsData = mysql_query($sql); 
if(mysql_num_rows($rsData)>0){
      while($rows = mysql_fetch_array($rsData))
      			{$data[]=array(
'id' => $rows["id"],
'nama' => $rows["nama"]
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
