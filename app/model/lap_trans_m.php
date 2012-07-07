<?php
class Laptrans extends msDB {
  private $grid; 
  private $text = "";
  function __construct(){
    $this->connect(); 
    $this->grid = new Grid; 
    $this->grid->setTable("trans_detail"); 
    $this->grid->setJoin('INNER JOIN `equipment` ON `equipment`.`id` = `trans_detail`.`equipment` 
INNER JOIN `eq_nama` ON `eq_nama`.`id` = `equipment`.`nama_id`
INNER JOIN  `trans_nota` as `nm` ON `nm`.`id` = `trans_detail`.`detail_nota`  
INNER JOIN `trans_nota` as `nk` on `nk`.`id` = `trans_detail`.`ref`');
    //$this->grid->setJoin('inner join event on event.id=trans_nota.event_id');    
    //$this->grid->setManualFilter('AND trans_nota.locked=0');    
    $this->grid->addField(
                array(
                    'field' => 'trans_detail.id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false)
                    )      
    ));
    $this->grid->addField(
            array(
                'field' => '`eq_nama`.`Kategori`',
                'name'  => 'kategori',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('hidden' => true,'header' => 'Kategori','width' => 125,'sortable' => true),
                  'filter' => array('type' => 'string'),
                )
            ));
    $this->grid->addField(
            array(
                'field' => '`equipment`.`sn`',
                'name'  => 'sn',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Serial-no','width' => 60,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));
    $this->grid->addField(
            array(
                'field' => '`nm`.`tanggal`',
                'name'  => 'tanggal',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Tanggal','width' => 75,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));
    $this->grid->addField(
            array(
                'field' => '`nm`.`nota`',
                'name'  => 'nota',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Nota keluar','width' => 100,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));
    $this->grid->addField(
            array(
                'field' => '`nk`.`tanggal`',
                'name'  => 'tanggal',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Tanggal','width' => 75,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));       
            $this->grid->addField(
            array(
                'field' => '`nk`.`nota`',
                'name'  => 'ref',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Nota masuk','width' => 100,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            )); 
    $this->grid->addField(
            array(
                'field' => '`eq_nama`.`Nama`',
                'name'  => 'nama',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Nama standar','width' => 250,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));  
    $this->grid->addField(
            array(
                'field' => '`equipment`.`model`',
                'name'  => 'model',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Model','width' => 100,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            )); 
    $this->grid->addField(
            array(
                'field' => '`equipment`.`merk`',
                'name'  => 'merk',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Merk','width' => 100,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            )); 
    $this->grid->addField(
            array(
                'field' => '`equipment`.`partno`',
                'name'  => 'partno',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Part-no','width' => 75,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));            
  }
  
  function getlapTrans10($request){
    return $this->grid->doRead($request); 
  }

}
?>