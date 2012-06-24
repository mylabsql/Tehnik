<?php
class Nequ01 extends msDB { //class Hwd dengan extend/parameter msDB//
    var $grid; //variabel $grid

    function  __construct() { //fungsi construc//
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('eq_nama');
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
                    'field' => 'kategori',
                    'name'  => 'kategori',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Kategori','width' => 125,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'nama',
                    'name'  => 'nama',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Nama Equipment','width' => 200,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'grup',
                    'name'  => 'grup',
                    'meta' => array('st' => array('type' => 'int'),
				    'cm' => array('header' => 'Grup', 'groupable' => false, 'align'=>'center','width' => 75,'sortable' => false, 
					'renderer' => "(val)?'<a><center><img src=\"images/icon/award_star_bronze_3.png\"></img></center></a>':'<a><center><img src=\"images/icon/award_star_silver_3.png\"></img></center></a>'"),
				    'filter' => array('type' => 'boolean')
					)

                ));
		$this->grid->addField(
                array(
                    'field' => 'keterangan',
                    'name'  => 'keterangan',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Keterangan','width' => 400,'sortable' => true),
                      'filter' => array('type' => 'string')
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
    }

    function create($request){ //fungsi create + return data//
         $data = array(
          'kategori' => $request['kategori'],
	  'nama' => $request['nama'],
	  'grup' => $request['grup'],
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
        return $this->grid->doRead($request);
    }
    function update($request){  //fungsi update + return data
        $data = array(
          'id' => $request['id'],
          'kategori' => $request['kategori'],
	  'nama' => $request['nama'],
	  'grup' => $request['grup'],
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
		//image path
}
?>
