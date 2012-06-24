<?php
class Event03 extends msDB { //class Hwd dengan extend/parameter msDB//
    var $grid; //variabel $grid

    function  __construct() { //fungsi construc//
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('event');
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
                    'field' => 'event',
                    'name'  => 'event',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Event','width' => 125,'sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'waktu',
                    'name'  => 'waktu',
                    'meta' => array(
                      'st' => array('type' => 'timestamp', 'allowBlank' => true), 
                      'cm' => array('header' => 'Waktu','sortable' => true),
                      'filter' => array('type' => 'string')
			)
                ));
		$this->grid->addField(
                array(
                    'field' => 'durasi',
                    'name'  => 'durasi',
                    'meta' => array(
                      'st' => array('type' => 'int', 'allowBlank' => true), 
                      'cm' => array('header' => 'Durasi','sortable' => true),
                      'filter' => array('type' => 'int')
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
          'event' => $request['event'],
	  'waktu' => $request['waktu'],
	  'durasi' => $request['durasi'],
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
          'event' => $request['event'],
	  'waktu' => $request['waktu'],
	  'durasi' => $request['durasi'],
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
