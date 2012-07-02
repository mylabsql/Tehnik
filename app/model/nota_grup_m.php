<?php
class Listnotagrup extends msDB {
  private $grid; 
  
  function __construct(){
    $this->connect(); 
    $this->grid = new Grid; 
    $this->grid->setTable("trans_nota"); 
    $this->grid->setJoin('inner join trans on trans.id=trans_nota.trans_id
                         inner join equipment on equipment.id=trans_nota.event_id
                         inner join eq_nama on eq_nama.id=equipment.nama_id
                         ');
    //$this->grid->setJoin('inner join event on event.id=trans_nota.event_id');    
    $this->grid->setManualFilter('AND trans_nota.locked=0');    
    $this->grid->addField(
                array(
                    'field' => 'trans_nota.id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false)
                    )      
    ));
    $this->grid->addField(
            array(
                'field' => 'tanggal',
                'name'  => 'tanggal',
                'meta' => array(
                  'st' => array('type' => 'date'), 
                  'cm' => array('header' => 'Tanggal','width' => 70,'sortable' => true,'renderer' => "Ext.util.Format.date(val,'d/m/Y')"),
                  'filter' => array('type' => 'date'),
                )
            )); 
    $this->grid->addField(
            array(
                'field' => 'trans.nama_trans',
                'name'  => 'trans_id',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Transaksi','width' => 170,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));
    $this->grid->addField(
            array(
                'field' => "concat(eq_nama.nama, '-', sn, '-', model)",
                'name'  => 'event_id',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Grup','width' => 150,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));     
    $this->grid->addField(
            array(
                'field' => 'nota',
                'name'  => 'nota',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Nota','width' => 100,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));      
            $this->grid->addField(
            array(
                'field' => 'trans_nota.keterangan',
                'name'  => 'keterangan',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Keterangan','width' => 500,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));             
  }
  
  function getnotagrup05($cmbbulan05, $usr_id, $request){
     $this->grid->setManualFilter(" and month(trans_nota.tanggal) = $cmbbulan05 and trans_nota.locked=0 and trans.grup=1 and trans_nota.admin = $usr_id"); 
    return $this->grid->doRead($request); 
  }
  
  function edit($id,$request){
    $grid_edit = new Grid; 
    $grid_edit->setTable("trans_nota");
    $grid_edit->setManualFilter('AND trans_nota.locked=0');    
    $grid_edit->addField(
                array(
                    'field' => 'trans_nota.id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false)
                    )      
    ));
    $grid_edit->addField(
            array(
                'field' => 'tanggal',
                'name'  => 'tanggal',
                'meta' => array(
                  'st' => array('type' => 'date'), 
                  'cm' => array('header' => 'Tanggal','width' => 100,'sortable' => true,'renderer' => "Ext.util.Format.date(val,'d/m/Y')"),
                  'filter' => array('type' => 'date'),
                )
            )); 
    $grid_edit->addField(
            array(
                'field' => 'trans_id',
                'name'  => 'trans_id',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Transaksi','width' => 200,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));
    $grid_edit->addField(
            array(
                'field' => 'event_id',
                'name'  => 'event_id',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Event','width' => 125,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));     
    /*$grid_edit->addField(
            array(
                'field' => 'nota',
                'name'  => 'nota',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Nota','width' => 150,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));    */   
            $grid_edit->addField(
            array(
                'field' => 'trans_nota.keterangan',
                'name'  => 'keterangan',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Keterangan','width' => 100,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));             
	 $grid_edit->loadSingle = true;
     $grid_edit->setManualFilter(" and trans_nota.id = $id"); 
     return $grid_edit->doRead($request); 
  }
  function getListgrup05($nota_id,/*$usr_id,*/$request){ //editornya
    $grid_Listgrup05 = new Grid; 
    $grid_Listgrup05->setTable('trans_list');
    $grid_Listgrup05->setJoin('inner join eq_nama on eq_nama.id=trans_list.eq_nama');
    $grid_Listgrup05->setManualFilter(" and nota_id = $nota_id");

    $grid_Listgrup05->addField(
                  array(
                    'field' => 'trans_list.id',
                    'name' => 'id',
                    'primary' => true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false)
                    )                      
                  )
                );
    $grid_Listgrup05->addField(
                  array(
                    'field' => 'jumlah',
                    'name' => 'jumlah',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Jumlah', 'sortable' => true)
                    )
                  )
                );
        $grid_Listgrup05->addField(
                  array(
                    'field' => 'eq_nama',
                    'name' => 'eq_nama',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Nama equipment', 'width' => 250, 'sortable' => true)
                    )
                  )
                );
    $grid_Listgrup05->addField(
                  array(
                    'field' => 'trans_list.keterangan',
                    'name' => 'keterangan',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Keterangan', 'width' => 500, 'sortable' => true)
                    )                  
                  )
                );   

  return $grid_Listgrup05->doRead($request);                 
                    
  } 
  function getListgrup205($nota_id,/*$usr_id,*/$request){
    $grid_Listsiste205 = new Grid; 
    $grid_Listsiste205->setTable('trans_list');
    $grid_Listsiste205->setJoin('inner join eq_nama on eq_nama.id=trans_list.eq_nama');
    $grid_Listsiste205->setManualFilter(" and nota_id = $nota_id");
    $grid_Listsiste205->addField(
                  array(
                    'field' => 'trans_list.id',
                    'name' => 'id',
                    'primary' => true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false)
                    )                      
                  )
                );
    $grid_Listsiste205->addField(
                  array(
                    'field' => 'kategori',
                    'name' => 'kategori',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Kategori', 'width' => 125, 'sortable' => true)
                    )
                  )
                );    
    $grid_Listsiste205->addField(
                  array(
                    'field' => 'nama',
                    'name' => 'eq_nama',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Nama equipment', 'width' => 250, 'sortable' => true)
                    )
                  )
                );
    $grid_Listsiste205->addField(
                  array(
                    'field' => 'jumlah',
                    'name' => 'jumlah',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Jumlah', 'sortable' => true)
                    )
                  )
                );
    $grid_Listsiste205->addField(
                  array(
                    'field' => 'trans_list.keterangan',
                    'name' => 'keterangan',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Keterangan', 'width' => 500, 'sortable' => true)
                    )                  
                  )
                );   

  return $grid_Listsiste205->doRead($request);                 
                    
  }    
  
  function create($post){
   
    /** start build query **/
    $this->db->BeginTrans(); 
    /** parent query **/     
    $str ="INSERT INTO trans_nota(tanggal, trans_id, event_id, keterangan, admin)VALUES('%s','%s','%s','%s',%s)"; 
    $query= sprintf($str,mysql_real_escape_string($post['tanggal']),
                                                 mysql_real_escape_string($post['trans_id']),
                                                 mysql_real_escape_string($post['event_id']),
						 mysql_real_escape_string($post['keterangan']),
						 mysql_real_escape_string($_SESSION['userid'])); 
                         
   $this->setSQL($query);   
    /** child query **/
   $ok = $this->executeSQL(); 
   if ($ok)
    if ($post['detail'] != '[]'){
      $sql = array(); 
      $nota_id = $this->getLastID(); 
      $detail = json_decode(stripslashes($post['detail'])); 
      foreach ($detail as $row){
        $col = array(); 
        $val = array(); 
        $col[]= 'nota_id'; 
        $val[]= $nota_id; 
        foreach ($row as $head=>$value){
          $col[] =  $head; 
          $val[] = "'". mysql_real_escape_string($value) ."'";     
        }
		$uid = $_SESSION['userid'];
        $sql[] = sprintf("INSERT INTO trans_list (%s,admin) VALUES (%s,'$uid')", implode(',',$col),implode(',',$val));
      }    
      
      foreach ($sql as $str){
        if ($ok){
          $this->setSQL($str);
          $ok = $this->executeSQL(); 
        }
      }
    }
    if ($ok)
      $this->db->CommitTrans(); 
    else
      $this->db->RollbackTrans(); 
    /** end build query **/

    $result = new stdClass(); 
    $result->success = ($ok)?true:false; 
    $result->message = $this->db->ErrorMsg(); 
    
    return json_encode($result); 
  }
  
  function update($post)
  {
   
    /** start build query **/
    $this->db->BeginTrans(); 
    /** parent query **/    
    $str ="UPDATE trans_nota SET tanggal='%s', trans_id='%s', event_id='%s', keterangan='%s' WHERE id = '%s'"; 
    $query= sprintf($str,mysql_real_escape_string($post['tanggal']),
			 mysql_real_escape_string($post['trans_id']),
                         mysql_real_escape_string($post['event_id']),
                         mysql_real_escape_string($post['keterangan']), 
                         mysql_real_escape_string($post['id']));  
                                               
   $this->setSQL($query);   
   $ok = $this->executeSQL();
   /** child query update **/ 
   if ($ok)
    if ($post['detail'] != '[]')
    {
      $sql = array(); 
      $detail = json_decode(stripslashes($post['detail'])); 
      foreach ($detail as $row)
      {
        if (isset($row->id))
        { //id dari table master
            $fields = array();
            $id = 0; //id dari table master
            foreach ($row as $head=>$value)
            {
              if ($head != 'id')
              { //id dari table master
                $fields[] = $head . '='. "'".mysql_real_escape_string($value)."'";
              }
              else
              {
                $id = $value; //id dari table master
              }
    
            }
		   //$uid = $_SESSION['userid'];
           $query = "UPDATE trans_list SET %s WHERE id=%s"; //id dari table master
           $query = sprintf($query,implode(',',$fields),$id); //id dari table master
           $sql[] = $query;           
        }
        else
        {
          $col = array(); 
          $val = array(); 
          $col[]= 'nota_id'; 
          $val[]= $post['id']; 
          foreach ($row as $head=>$value)
          {
            $col[] =  $head; 
            $val[] = "'". mysql_real_escape_string($value) ."'";     
          }
		  $uid = $_SESSION['userid'];
          $sql[] = sprintf("INSERT INTO trans_list (%s,admin) VALUES (%s,'$uid')", implode(',',$col),implode(',',$val)); 
        }

      }    
      
      foreach ($sql as $str)
      {
        if ($ok)
        {
          $this->setSQL($str);
          $ok = $this->executeSQL(); 
        }
      }
    }
    
    if ($post['remove'])
      if ($ok)
      {
        $sql = "DELETE FROM trans_list WHERE id IN (%s)"; //id dari table master
        $query = sprintf($sql,$post['remove']); 
        $this->setSQL($query);
        $ok = $this->executeSQL(); 
      }
      
    if ($ok)
    {
      $this->db->CommitTrans(); 
    }
    else
    {
      $this->db->RollbackTrans(); 
    }
    /** end build query **/

    $result = new stdClass(); 
    $result->success = ($ok)?true:false; 
    $result->message = $this->db->ErrorMsg();  
    return json_encode($result); 
  }
  
  
  function destroy($data)
  {
    $this->db->BeginTrans();     
    $sql = "DELETE FROM trans_list WHERE nota_id in(%s)"; 
    $query = sprintf($sql,$data);    
    $this->setSQL($query);
    $ok = $this->executeSQL();
    if ($ok)
    {
      $sql = "DELETE FROM trans_nota WHERE id in (%s)"; 
      $query = sprintf($sql,$data);
      $this->setSQL($query);
      $ok = $this->executeSQL();
    }
        
    if ($ok)
    {
      $this->db->CommitTrans(); 
    }
    else
    {
      $this->db->RollbackTrans(); 
    }      
    $result = new stdClass(); 
    $result->success = ($this->db->ErrorMsg()!='')?false:true; 
    $result->message = $this->db->ErrorMsg(); 
    
    return json_encode($result); 
  }
 
  function lock($data){
    $this->db->BeginTrans();     
    $sql = "UPDATE trans_nota SET locked=1 WHERE id in(%s)"; 
    $query = sprintf($sql,$data);    
    $this->setSQL($query);
    $ok = $this->executeSQL();
/*    if ($ok){
      $sql = "DELETE FROM trans_nota WHERE id in (%s)"; 
      $query = sprintf($sql,$data);
      $this->setSQL($query);
      $ok = $this->executeSQL();
    }*/
        
    if ($ok)
      $this->db->CommitTrans(); 
    else
      $this->db->RollbackTrans(); 
          
    $result = new stdClass(); 
    $result->success = ($this->db->ErrorMsg()!='')?false:true; 
    $result->message = $this->db->ErrorMsg(); 
    
    return json_encode($result); 
  }
 
  function getcmbnmtransgrup05($request){

		$sql = "select count(*) from trans"; 
		$data = array();
		$rsTotal = mysql_query($sql); 
      while($rows = mysql_fetch_array($rsTotal))
{      $total = $rows[0];}
		$data = Array();
                $start=$request['start'];
                $limit=$request['limit'];
		$sql = "select id, nama_trans from trans where grup=1 order by nama limit $start,$limit";
		$rsData = mysql_query($sql); 
if(mysql_num_rows($rsData)>0){
      while($rows = mysql_fetch_array($rsData))
      			{$data[]=array(
'id' => $rows["id"],
'nama_trans' => $rows["nama_trans"]
);}
    } else {
      $data = array("empty");      // failure
    }


		

		$result = new stdClass(); 
		$result->success = true; 
		$result->total = $total; 
		$result->data = $data; 
		
		return json_encode($result); 

}
 function getcmbgrup05($request){

		$sql = "select count(*) from eq_nama"; 
		$data = array();
		$rsTotal = mysql_query($sql); 
      while($rows = mysql_fetch_array($rsTotal))
{      $total = $rows[0];}
		$data = Array();                
                $start=$request['start'];
                $limit=$request['limit'];
		$sql = "select id, nama from eq_nama limit $start,$limit";
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

}
  function getcmbeventgrup05($request){

		$sql = "select count(*) from equipment"; 
		$data = array();
		$rsTotal = mysql_query($sql); 
      while($rows = mysql_fetch_array($rsTotal))
{      $total = $rows[0];}
		$data = Array();
                $start=$request['start'];
                $limit=$request['limit'];
		$sql = "select equipment.id, concat(eq_nama.nama, '-', sn, '-', model) as grup from equipment inner join eq_nama on eq_nama.id=equipment.nama_id
                where eq_nama.grup=1 limit $start,$limit";
		$rsData = mysql_query($sql); 
if(mysql_num_rows($rsData)>0){
      while($rows = mysql_fetch_array($rsData))
      			{$data[]=array(
'id' => $rows["id"],
'grup' => $rows["grup"]
);}
    } else {
      $data = array("empty");      // failure
    }


		

		$result = new stdClass(); 
		$result->success = true; 
		$result->total = $total; 
		$result->data = $data; 
		
		return json_encode($result); 

}

}
?>