<?php
class Grupdetailnota extends msDB {
  private $grid; 
  
  function __construct(){
    $this->connect(); 
    $this->grid = new Grid; 
    $this->grid->setTable("trans_list"); 
    $this->grid->setJoin('inner join eq_nama on eq_nama.id=trans_list.eq_nama
                inner join equipment on equipment.nama_id=eq_nama.id
                left join trans_detail_grup on trans_detail_grup.equipment=equipment.id
                AND trans_detail_grup.detail_nota=trans_list.nota_id');
    //$this->grid->setJoin('inner join event on event.id=trans_nota.event_id');    
    //$this->grid->setManualFilter('AND trans_nota.locked=0');    
    $this->grid->addField(
                array(
                    'field' => 'trans_list.id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false)
                    )      
    ));
    $this->grid->addField(
            array(
                'field' => 'eq_nama.kategori',
                'name'  => 'kategori',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Kategori','width' => 70,'sortable' => true),
                  'filter' => array('type' => 'string'),
                )
            )); 
    $this->grid->addField(
            array(
                'field' => 'eq_nama.nama',
                'name'  => 'nama_id',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Nama equipment','width' => 170,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));
    $this->grid->addField(
            array(
                'field' => 'trans_list.jumlah',
                'name'  => 'jumlah',
                'meta' => array(
                  'st' => array('type' => 'int'), 
                  'cm' => array('header' => 'Jumlah','sortable' => true),
                  'filter' => array('type' => 'int')
                )
            ));
    $this->grid->addField(
            array(
                'field' => 'count(trans_detail_grup.id)',
                'name'  => 'entry',
                'meta' => array(
                  'st' => array('type' => 'int'), 
                  'cm' => array('header' => 'Entry','sortable' => false),
                  'filter' => array('type' => 'int')
                )
            ));
            $this->grid->addField(
            array(
                'field' => 'trans_list.keterangan',
                'name'  => 'keterangan',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Keterangan','width' => 500,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));             
  }
  
  function  outlistnota06($cmbNota06, $request){
    $this->grid->setManualFilter(" and trans_list.nota_id = $cmbNota06 group by equipment.nama_id");
    return $this->grid->doRead($request); 
  }
  
    function  inlistnota06($cmbNota06, $request){
    $inlistnota06 = new Grid; 
    $inlistnota06->setTable("trans_list"); 
    $inlistnota06->setJoin('inner join eq_nama on eq_nama.id=trans_list.eq_nama
                inner join equipment on equipment.nama_id=eq_nama.id
                left join trans_detail_grup on trans_detail_grup.equipment=equipment.id
                AND trans_detail_grup.ref=trans_list.nota_id');
    //$inlistnota06->setJoin('inner join event on event.id=trans_nota.event_id');    
    //$inlistnota06->setManualFilter('AND trans_nota.locked=0');    
    $inlistnota06->addField(
                array(
                    'field' => 'trans_list.id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false)
                    )      
    ));
    $inlistnota06->addField(
            array(
                'field' => 'eq_nama.kategori',
                'name'  => 'kategori',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Kategori','width' => 70,'sortable' => true),
                  'filter' => array('type' => 'string'),
                )
            )); 
    $inlistnota06->addField(
            array(
                'field' => 'eq_nama.nama',
                'name'  => 'nama_id',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Nama equipment','width' => 170,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));
    $inlistnota06->addField(
            array(
                'field' => 'trans_list.jumlah',
                'name'  => 'jumlah',
                'meta' => array(
                  'st' => array('type' => 'int'), 
                  'cm' => array('header' => 'Jumlah','sortable' => true),
                  'filter' => array('type' => 'int')
                )
            ));
    $inlistnota06->addField(
            array(
                'field' => 'count(trans_detail_grup.id)',
                'name'  => 'entry',
                'meta' => array(
                  'st' => array('type' => 'int'), 
                  'cm' => array('header' => 'Entry','sortable' => false),
                  'filter' => array('type' => 'int')
                )
            ));
            $inlistnota06->addField(
            array(
                'field' => 'trans_list.keterangan',
                'name'  => 'keterangan',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Keterangan','width' => 500,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));   
    $inlistnota06->setManualFilter(" and trans_list.nota_id = $cmbNota06 group by eq_nama.id");
    return $inlistnota06->doRead($request); 
  }
  
  function edit($id,$request){ //fungsi edit//
       $this->grid->loadSingle = true;
       $this->grid->setManualFilter(" and trans_list.id = $id"); 
       return $this->grid->doRead($request); 
    }
  function getDetEqu06($nota_id,/*$usr_id,*/$request){ //editornya
    $grid_Listequ02 = new Grid; 
    $grid_Listequ02->setTable('trans_detail_grup');
    $grid_Listequ02->setJoin('inner join equipment on equipment.id=trans_detail_grup.equipment');
    $grid_Listequ02->setManualFilter(" and detail_nota = $detail_nota");

    $grid_Listequ02->addField(
                  array(
                    'field' => 'trans_detail_grup.id',
                    'name' => 'id',
                    'primary' => true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false)
                    )                      
                  )
                );
    $grid_Listequ02->addField(
                  array(
                    'field' => 'equipment.sn',
                    'name' => 'trans_detail_grup.equipment',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Serial-no', 'sortable' => true)
                    )
                  )
                );
  return $grid_Listequ02->doRead($request);                 
                    
  } 
  function getDetEq06($detail_nota,/*$usr_id,*/$request){
    $getDetEq06 = new Grid; 
    $getDetEq06->setTable('trans_detail_grup');
    $getDetEq06->setJoin('inner join trans_list on trans_list.id=trans_detail_grup.detail_nota
                          inner join equipment on equipment.id=trans_detail_grup.equipment');
    $getDetEq06->setManualFilter(" and detail_nota = $detail_nota");
    $getDetEq06->addField(
                  array(
                    'field' => 'trans_detail_grup.id',
                    'name' => 'id',
                    'primary' => true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false)
                    )                      
                  )
                );
    $getDetEq06->addField(
                  array(
                    'field' => 'equipment.sn',
                    'name' => 'sn',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Serial-no', 'width' => 175, 'sortable' => true)
                    )
                  )
                );    
    $getDetEq06->addField(
                  array(
                    'field' => 'equipment.model',
                    'name' => 'model',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Model', 'width' => 175, 'sortable' => true)
                    )
                  )
                );
    $getDetEq06->addField(
                  array(
                    'field' => 'equipment.merk',
                    'name' => 'merk',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Merk', 'width' => 175, 'sortable' => true)
                    )
                  )
                );
    $getDetEq06->addField(
                  array(
                    'field' => 'equipment.daya',
                    'name' => 'daya',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Daya', 'sortable' => true)
                    )
                  )
                );
    $getDetEq06->addField(
                  array(
                    'field' => 'equipment.keterangan',
                    'name' => 'keterangan',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Keterangan', 'width' => 500, 'sortable' => true)
                    )                  
                  )
                );   

  return $getDetEq06->doRead($request);                 
                    
  }    
  
  function create($post){
   
    /** start build query **/
    $this->db->BeginTrans(); 
    if ($post['detail'] != '[]'){
      $sql = array(); 
      $nota_id = $this->getLastID(); 
      $detail = json_decode(stripslashes($post['detail'])); 
      foreach ($detail as $row){
        $col = array(); 
        $val = array(); 
        $col[]= 'detail_nota'; 
        $val[]= $detail_nota; 
        foreach ($row as $head=>$value){
          $col[] =  $head; 
          $val[] = "'". mysql_real_escape_string($value) ."'";     
        }
		$uid = $_SESSION['userid'];
        $sql[] = sprintf("INSERT INTO trans_detail_grup (%s,admin) VALUES (%s,'$uid')", implode(',',$col),implode(',',$val));
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
  
  function update($post){
   
    /** start build query **/
    $this->db->BeginTrans(); 
    /** parent query **/    
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
           $query = "UPDATE trans_detail_grup inner join equipment on equipment.id=trans_detail_grup.equipment
           SET trans_detail_grup.equipment=equipment.id WHERE id=%s"; //id dari table master
           $query = sprintf($query,implode(',',$fields),$id); //id dari table master
           $sql[] = $query;           
        }
        else
        {
          $col = array(); 
          $val = array(); 
          $col[]= 'detail_nota'; 
          $val[]= $post['id']; 
          foreach ($row as $head=>$value)
          {
            $col[] =  $head; 
            $val[] = "'". mysql_real_escape_string($value) ."'";     
          }
		  $uid = $_SESSION['userid'];
          $sql[] = sprintf("INSERT INTO trans_detail_grup (%s,admin) VALUES (%s,'$uid')", implode(',',$col),implode(',',$val)); 
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
        $sql = "DELETE FROM trans_detail_grup WHERE id IN (%s)"; //id dari table master
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
  
  
  function destroy($data){
    $this->db->BeginTrans();     
    $sql = "DELETE FROM trans_detail_grup WHERE detail_nota in(%s)"; 
    $query = sprintf($sql,$data);    
    $this->setSQL($query);
    $ok = $this->executeSQL();
    if ($ok)
    {
      $sql = "DELETE FROM trans_list WHERE id in (%s)"; 
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
  function getcmbnota06($start, $limit, $request){

		$sql = "select count(*) from trans_nota where locked=0"; 
		$data = array();
		$rsTotal = mysql_query($sql); 
      while($rows = mysql_fetch_array($rsTotal))
{      $total = $rows[0];}
		$data = Array();
		$sql = "select trans_nota.id, CONCAT(trans_nota.nota,'        ',trans.nama_trans) AS nota, users.user_name as 'user', concat(sn, '-', model) as 'grup',trans_nota.event_id as 'sis06', trans.proses from trans_nota
                inner join users on users.user_id = trans_nota.admin
                inner join equipment on equipment.id = trans_nota.event_id
                inner join eq_nama on eq_nama.id = equipment.nama_id
                inner join trans on trans.id = trans_nota.trans_id
                where locked=0 AND trans.grup=1 limit $start,$limit";
		$rsData = mysql_query($sql); 
if(mysql_num_rows($rsData)>0){
      while($rows = mysql_fetch_array($rsData))
      			{$data[]=array(
'id' => $rows["id"],
'nota' => $rows["nota"],
'user' => $rows["user"],
'grup' => $rows["grup"],
'sis06' => $rows["sis06"],
'proses' => $rows["proses"]
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

  function cekSN06($sn, $request){//apakah sn sudah terdaftar?

		$sql = "select count(*) from equipment where sn='$sn'";
		$rsTotal = mysql_query($sql);
      while($rows = mysql_fetch_array($rsTotal))
{      $total = $rows[0];}
		$result = new stdClass(); 
		$result->success = ($total>0)?true:false; 
		return json_encode($result); 

}

function statusSN06($textSN06){

		$sql = "select used from equipment where sn='$textSN06'";
		$rsStatus = mysql_query($sql);
                    while($rows = mysql_fetch_array($rsStatus))
                    {$used = $rows[0];}
		$result = new stdClass(); 
		$result->success = (!$used)?true:false;
                $result->used = (!$used)?0:1;
		return json_encode($result); 

}

function assembly06($sn, $nota, $admin, $group){
      $this->db->BeginTrans();
      
                $sql = "SELECT eq_nama.ID from eq_nama
                        inner join equipment on equipment.nama_id=eq_nama.id
                        where equipment.sn='$sn' limit 1";
		$rsStatus = mysql_query($sql);
                $val=mysql_num_rows($rsStatus);
                if($val==0){
                  $message='Equipment tidak terdaftar';
                  $ok=false;
                }else {
                    while($rows = mysql_fetch_array($rsStatus))
                    {$equ = $rows[0];}    
        if($equ!=0) //definisikan nama equ-nya
                {//apakah permintaan masih kurang?
                $sql = "select (jumlah > (count(trans_detail_grup.id)))as max from trans_list
                inner join eq_nama on eq_nama.id=trans_list.eq_nama
                inner join equipment on equipment.nama_id=eq_nama.id
                left join trans_detail_grup on trans_detail_grup.equipment=equipment.id
                AND trans_detail_grup.detail_nota=trans_list.nota_id
                where trans_list.nota_id=$nota AND trans_list.eq_nama=$equ
                group by trans_list.eq_nama,trans_list.nota_id";
		 $rsStatus = mysql_query($sql);
                 $val=mysql_num_rows($rsStatus);
                if($val==0){
                      $over=0;//tidak terdefinisi
                    } else{
                    while($rows = mysql_fetch_array($rsStatus))
                    {$over = $rows[0];}
                    }
                if($over==1){//ada datanya?
                      //lanjutkan, blm melebihi list              
                     $sql = sprintf("insert into trans_detail_grup (detail_nota,equipment,admin)
                      select '$nota',id,'$admin' from equipment where sn='$sn'");
                      $this->setSQL($sql);
                      $ok = $this->executeSQL();
                      $hasil=mysql_affected_rows();
                      if($hasil==1)
                        {
                            $message='Status serial-no berhasil dimasukkan kedalam grup...';
                            $sql = sprintf("UPDATE equipment set `group`='$group', trans_ref='$nota' where sn='$sn'");
                            $this->setSQL($sql);
                            $ok = $this->executeSQL();
                            } else {
                                  $message='Gagal memproses, data salah atau terduplikasi...';
                                  $ok=false;
                        }
                    }
                    else {
                      $ok=false;
                    $message=sprintf('Proses dibatalkan, data tidak sesuai dengan list nota...');
                    }
                    }
                    else
                    {
                    $ok=false;
                    $message=sprintf('Proses dibatalkan, sn tidak terdaftar dalam list nota....');}
                    }                

    if ($ok)
    {
      $this->db->CommitTrans();
      $message='Serial-no berhasil diproses keluar!';
    }
    else
    {
      $this->db->RollbackTrans();
    }      
    $result = new stdClass(); 
    $result->success = ($ok)?true:false;
    $result->message = sprintf($message);
    return json_encode($result);  
}

function dissasembly06($sn, $nota, $admin, $group){
      $this->db->BeginTrans();     
                        $sql = "SELECT eq_nama.ID from eq_nama
                        inner join equipment on equipment.nama_id=eq_nama.id
                        inner join trans_list on trans_list.eq_nama=eq_nama.id
                        where equipment.sn='$sn' AND trans_list.nota_id=$nota limit 1";
                    $rsStatus = mysql_query($sql);
                    $val=mysql_num_rows($rsStatus);
                    if($val==0){
                      $equ=0;
                    } else{
                    while($rows = mysql_fetch_array($rsStatus))
                    {$equ = $rows[0];}
                    }
   
        if($equ!=0) //definisikan nama equ-nya
                {//apakah permintaan masih kurang?
                $sql = "select (jumlah > (count(trans_detail_grup.id)))as max from trans_list
                inner join eq_nama on eq_nama.id=trans_list.eq_nama
                inner join equipment on equipment.nama_id=eq_nama.id
                left join trans_detail_grup on trans_detail_grup.equipment=equipment.id
                AND trans_detail_grup.ref=trans_list.nota_id
                where trans_list.nota_id=$nota AND trans_list.eq_nama=$equ
                group by trans_list.eq_nama,trans_list.nota_id";
		 $rsStatus = mysql_query($sql);
                 $val=mysql_num_rows($rsStatus);
                if($val==0){
                      $over=0;//tidak terdefinisi
                    } else{
                    while($rows = mysql_fetch_array($rsStatus))
                    {$over = $rows[0];}
                    }
            if($over==1)
                {    
                $sql = "UPDATE equipment inner join trans_detail_grup on trans_detail_grup.equipment=equipment.id
                               inner join trans_list on trans_list.nota_id=trans_detail_grup.detail_nota
                               SET trans_detail_grup.ref=$nota, trans_detail_grup.admin2=$admin, equipment.`group`=0
                               where equipment.sn='$sn' AND equipment.`group`=$group AND trans_list.eq_nama=$equ";
                $this->setSQL($sql);
                $ok = $this->executeSQL();
                $hasil=mysql_affected_rows();
                  if($hasil==2)
                    {
                      $message='Seria-no berhasil dimasukan...';
                      $ok=true;
                    }
                    else {
                      $message='Gagal memproses, data salah atau terduplikasi...';
                      $ok=false;
                    }
                } 
                else
                {
                  $ok=false;
                  $message=sprintf('Proses dibatalkan, data tidak sesuai dengan list nota...');
                }
                } else
                {
                  $ok=false;
                  $message=sprintf('Proses dibatalkan, sn tidak terdaftar dalam list nota....');
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
    $result->success = ($ok)?true:false;
    $result->message = $message;
    return json_encode($result);  
}
}
?>