<?php
class trans01 extends msDB { //class Hwd dengan extend/parameter msDB//
    var $grid; //variabel $grid

    function  __construct() { //fungsi construc//
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('trans');
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
                    'field' => 'nama_trans',
                    'name'  => 'nama_trans',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Nama transaksi','width' => 125,'sortable' => true),
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
          'nama_trans' => $request['nama_trans'],
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
        $trx_edit = new Grid;
        $trx_edit->setTable('trans');	
		$trx_edit->addField(
                array(
                     'field' => 'trans.id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true)
                    )
                ));
		$trx_edit->addField(
                array(
                    'field' => 'nama_trans',
                    'name'  => 'nama_trans',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Nama transaksi','width' => 125,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$trx_edit->addField(
                array(
                     'field' => 'admin',
                    'name'  => 'admin',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true)
                    )
                ));
		$trx_edit->addField(
		array(
                    'field' => 'keterangan',
                    'name' => 'keterangan',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Keterangan', 'width' => 500, 'sortable' => true)
                    )                  
                  )
                );  
       return $trx_edit->doRead($request); 

    }
    function update($request){  //fungsi update + return data
        $data = array(
          'id' => $request['id'],
          'nama_trans' => $request['nama_trans'],
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
  
}
?>
