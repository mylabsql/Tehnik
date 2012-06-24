<?php
class Lapequ09 extends msDB { //class Hwd dengan extend/parameter msDB//
    var $grid; //variabel $grid

    function  __construct() { //fungsi construc//
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('eq_nama');
	$this->grid->setjoin('left join equipment on equipment.nama_id=eq_nama.id');
        $this->grid->addField(
                array(
                     'field' => 'eq_nama.id',
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
				    'cm' => array('header' => 'Grup?', 'groupable' => false, 'align'=>'center','width' => 75,'sortable' => false, 
					'renderer' => "(val)?'<a><center><img src=\"images/icon/car.png\"></img></center></a>':'<a><center><img src=\"images/icon/bullet_star.png\"></img></center></a>'"),
				    'filter' => array('type' => 'boolean')
					)

                ));
		$this->grid->addField(
                array(
                    'field' => 'count(sn)',
                    'name'  => 'jumlah',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Jumlah','width' => 60,'sortable' => true, 'align' => 'center'),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'ifnull(sum(used),0)',
                    'name'  => 'used',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Digunakan','width' => 60,'sortable' => true, 'align' => 'center'),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => '(count(sn)-ifnull(sum(used),0))',
                    'name'  => 'bebas',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Bebas','width' => 60,'sortable' => true, 'align' => 'center'),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'eq_nama.keterangan',
                    'name'  => 'keterangan',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Keterangan','width' => 400,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
	$this->grid->addField(
                array(
                     'field' => 'eq_nama.admin',
                    'name'  => 'admin',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true)
                    )
                ));
    }

    function read($request){ // fungsi memabaca + return data //
	$this->grid->setGroupBy("EQ_NAMA.ID");
        return $this->grid->doRead($request);
    }

    function doReport($request){
      return $this->grid->dosql($request); 
    }

		//image path
}
?>
