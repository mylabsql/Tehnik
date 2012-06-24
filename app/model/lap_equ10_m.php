<?php
class Lap_equ10 extends msDB { //class Hwd dengan extend/parameter msDB//
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
        $lp_equ10 = new Grid;
        $lp_equ10->setTable('eq_nama');
	$lp_equ10->setjoin('left join equipment on equipment.nama_id=eq_nama.id');
	$lp_equ10->setG(" group by eq_nama.id");
        $lp_equ10->addField(
                array(
                     'field' => 'eq_nama.id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true)
                    )
                ));
		$lp_equ10->addField(
                array(
                    'field' => 'kategori',
                    'name'  => 'kategori',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Kategori','width' => 125,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$lp_equ10->addField(
                array(
                    'field' => 'nama',
                    'name'  => 'nama',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Nama Equipment','width' => 200,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$lp_equ10->addField(
                array(
                    'field' => 'sistem',
                    'name'  => 'sistem',
                    'meta' => array('st' => array('type' => 'int'),
				    'cm' => array('header' => 'Sistem?', 'groupable' => false, 'align'=>'center','width' => 75,'sortable' => false, 
					'renderer' => "(val)?'<a><center><img src=\"images/icon/car.png\"></img></center></a>':'<a><center><img src=\"images/icon/bullet_star.png\"></img></center></a>'"),
				    'filter' => array('type' => 'boolean')
					)

                ));
		$lp_equ10->addField(
                array(
                    'field' => 'count(sn)',
                    'name'  => 'jumlah',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Jumlah','width' => 60,'sortable' => true, 'align' => 'center'),
                      'filter' => array('type' => 'string')
			)
                ));
		$lp_equ10->addField(
                array(
                    'field' => 'ifnull(sum(used),0)',
                    'name'  => 'used',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Digunakan','width' => 60,'sortable' => true, 'align' => 'center'),
                      'filter' => array('type' => 'string')
			)
                ));
		$lp_equ10->addField(
                array(
                    'field' => '(count(sn)-ifnull(sum(used),0))',
                    'name'  => 'bebas',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Bebas','width' => 60,'sortable' => true, 'align' => 'center'),
                      'filter' => array('type' => 'string')
			)
                ));
		$lp_equ10->addField(
                array(
                    'field' => 'eq_nama.keterangan',
                    'name'  => 'keterangan',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Keterangan','width' => 400,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
	$lp_equ10->addField(
                array(
                     'field' => 'eq_nama.admin',
                    'name'  => 'admin',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true)
                    )
                ));
        return $lp_equ10->doRead($request);

    }
    
 
    
    function doReport($request){
      return $this->grid->dosql($request); 
    }

}
?>
