valid_script = true;  
trans_nota_grup_url = 'ajax.handler.php?id=' + page;  
{  // variable
{ //combo pertama : Nama transaksi dstrans05	cmbTrans05  trans_id
var dstrans05 = new Ext.data.JsonStore({
	id:dstrans05,
	url:trans_nota_grup_url,
	totalProperty:'total',
	baseParams:{
		action:'getcmbnmtransgrup05'
	},
	sortInfo:{
		field:'nama_trans',
		direction:'ASC'
	},
	remoteSort:true,
	root:'data',
	model: 'Post',
	fields: [{name:'id'},{ name:'nama_trans'}]
});

    dstrans05.load({
	params:{
		start:0,
		limit:25
	}
});

var cmbTrans05 = new Ext.form.ComboBox(
{	id:'cmbTrans05',
	anchor:'100%',
	store:dstrans05,
	//name:'id',
	valueField: 'id',
	displayField: 'nama_trans',
	hiddenValue : 'id',
	hiddenName : 'trans_id',
	fieldLabel: 'Transaksi',
	emptyText : 'Nama transaksi...',
	triggerAction: 'all',
	mode: 'remote',
	editable: true,
	autocomplete: true,
	hideTrigger: false, //SEMBUNYIKAN BUTTON COMBO?
	forceSelection : true,
	allowBlank: false,
	pageSize: 25,
	      });
}

{ //combo kedua : Nama equipment dsgrup05	cmbgrup05  eq_nama
var dsGrup05 = new Ext.data.JsonStore({
	id:dsGrup05,
	url:trans_nota_grup_url,
	totalProperty:'total',
	baseParams:{
		action:'getcmbGrup05'
	},
	sortInfo:{
		field:'nama',
		direction:'ASC'
	},
	remoteSort:true,
	root:'data',
	fields: [{name:'id'},{ name:'nama'}]
});

    dsGrup05.load({
	params:{
		start:0,
		limit:1000
	}
});

var cmbGrup05 = new Ext.form.ComboBox(
{	id:'cmbGrup05',
	anchor:'100%',
	store:dsGrup05,
	//name:'id',
	valueField: 'id',
	displayField: 'nama',
	hiddenValue : 'id',
	hiddenName : 'eq_nama',
	fieldLabel: 'Equipment',
	emptyText : 'Nama equipment...',
	triggerAction: 'all',
	mode: 'remote',
	editable: true,
	autocomplete: true,
	forceSelection : true,
	allowBlank: false,
	pageSize: 1000
	      });
}


{ //combo pertama : Nama transaksi dstrans05	cmbTrans05  trans_id
var dseventgrup05 = new Ext.data.JsonStore({
	id:dseventgrup05,
	url:trans_nota_grup_url,
	totalProperty:'total',
	baseParams:{
		action:'getcmbEventgrup05'
	},
	sortInfo:{
		field:'grup',
		direction:'ASC'
	},
	remoteSort:true,
	root:'data',
	fields: [{name:'id'},{ name:'grup'}]
});

    dseventgrup05.load({
	params:{
		start:0,
		limit:25
	}

});

var cmbEventsitem05 = new Ext.form.ComboBox(
{	id:'cmbEventsitem05',
	anchor:'100%',
	store:dseventgrup05,
	//name:'id',
	valueField: 'id',
	displayField: 'grup',
	hiddenValue : 'id',
	hiddenName : 'event_id',
	fieldLabel: 'Nama sistem',
	emptyText : 'Pilih sistem...',
	triggerAction: 'all',
	mode: 'remote',
	editable: true,
	autocomplete: true,
	hideTrigger: false, //SEMBUNYIKAN BUTTON COMBO?
	forceSelection : true,
	allowBlank: false,
	pageSize: 25
	      });
}
}

{ //combo keempat :	BULAN	
var list_bulangrup05 = new Ext.data.SimpleStore({
	fields : ['id','bulan'],
	data : [[1, 'Januari'], [2, 'Febuari'], [3, 'Maret'], [4, 'April'], [5, 'Mei'], [6, 'Juni'], [7, 'Juli'], [8, 'Agustus'], [9, 'September'], [10, 'Oktober'], [11, 'November'], [12, 'Desember']]
		// from states.js
	});

var cmbbulan05 = new Ext.form.ComboBox({        
		xtype:'combo',
		id:'cmbbulan05',
		fieldLabel:'bulan',
		allowBlank:false,
		store:list_bulangrup05,
		anchor: '100%',
		displayField:'bulan',
		valueField:'id',
		hiddenName:'id',
		mode : 'local',
		triggerAction:'all',
		emptyText: 'Pilih bulan'
		});

}

cmbbulan05.on("select", function() {//kalo bulan sudah dipilih => tampilkan seloruh nota yg telah tercatat didatabase
  list_notagrup05.store.baseParams.cmbbulan05 = cmbbulan05.getValue(); //tampilkan nota dengan parameter bulan yg dipilih
  grid_list_grup05.store.baseParams.nota_id = 0; //tampilkan grid_list_grup05 dari parameter default nota
  list_notagrup05.store.reload(); //eksekusi
  grid_list_grup05.store.reload();  //eksekusi
  
		});



grup_editor05 = Ext.extend(Ext.grid.EditorGridPanel, {
    title: 'List detail',
    region: 'center',
    clicksToEdit:1,
    loadMask:true,
    removeData:[],
         
    store: new Ext.data.JsonStore({
      url:trans_nota_grup_url, 
      root:'data', 
      successProperty:'success',
      totalProperty:'total',
      autoLoad: false,
      remoteSort:false, 
      baseParams:{
        action :'getListgrup05', 
        nota_id:0,
        //usr_id:userid
      }, 
      fields:[
      {name:'id', type:'int'},
      {name:'eq_nama', type:'string'},
      {name:'jumlah', type:'int'},
      {name:'keterangan', type:'string'}
      ]
    }), 
    
    initComponent: function() {
        this.createTbar();
		
        this.columns = [
	        {
		xtype:'gridcolumn', 
		hidden:true,
		dataIndex:'id', 
		hideable:false
	        },
            {
                xtype: 'gridcolumn',
                header: 'Kategori',
                sortable: true,
                dataIndex: 'kategori',
                width: 100
            },
            {
                xtype: 'gridcolumn',
                dataIndex: 'eq_nama',
                header: 'Nama equipment',
                hidden:false,
                sortable: true,
		width: 200,
		editor: new Ext.grid.GridEditor(cmbGrup05),
		renderer: function(val){
						index = dsGrup05.findExact('id',val); 
						if (index != -1){
							rs = dsGrup05.getAt(index).data; 
							return rs.nama; 
						}}

            },
            {
                xtype: 'gridcolumn',
                dataIndex: 'jumlah',
		header: 'Jumlah',
                sortable: true,
		editor:{xtype: 'numberfield'}
            },
            {
                xtype: 'gridcolumn',
                header: 'Keterangan',
                sortable: true,
                dataIndex: 'keterangan',
                width: 500,
                editor:{xtype: 'textfield'}
            }
            
        ];
        grup_editor05.superclass.initComponent.call(this);
    }, 
    createTbar:function(){
      this.tbar = [
{
        text:'Add Data',
        iconCls:'add-data', 
        scope:this,
        handler:function(){
          rec = new this.store.recordType({});
          this.store.insert(0,rec);
          this.getView().refresh();
          this.startEditing(0,1);                
        }
      },
      	{
        text:'Remove Data',
        iconCls:'table-delete',
        scope:this,
        handler:function(){
          this.stopEditing();
          rec = this.getSelectionModel().getSelectedCell(); 
          if (!rec){
             Ext.example.msg('Peringatan','Seleksi data terlebih dahulu');
             return false;
          }
          record_data = this.store.getAt(rec[0]); 
          if (record_data.data.id){   // id diganti sesuai nama id pada detailnya
            this.removeData.push(record_data.data.id);             // id diganti sesuai nama id pada detailnya
          }
	      this.store.remove(this.store.getAt(rec[0]));
	      this.getView().refresh();
	      if (this.store.getCount() > 0){
	        if (rec[0] > 0)
	          this.getSelectionModel().select(rec[0] - 1, rec[1]);
	        else
	          this.getSelectionModel().select(rec[0], rec[1]);
	      }          
        }
      }
      ]
    },
    getRemoveData:function(){
      return this.removeData; 
    }
});

notagrup_form05 = Ext.extend(Ext.Window, {
    title: 'Nota Perubahan Sistem',
    width: 530,
    height: 459,
    layout: 'border',
    border: false,
    closeAction: 'hide',
    id: 'notagrupWindow05',
    modal:true,
    initComponent: function() {
        this.buttons = this.createButton(); 
        this.grid = new grup_editor05({}); 
        this.items = [
            {
                xtype: 'form',
                region: 'north',
                border: false,
                frame: true,
                url:trans_nota_grup_url, 
                autoHeight: true,
                layoutConfig: {
                    labelSeparator: ' '
                },
                items: [
                    {
                        xtype: 'hidden',
                        fieldLabel: 'id',
                        anchor: '100%',
                        name: 'id'
                    },
                    {
                        xtype: 'datefield',
                        fieldLabel: 'Tanggal',
						format:'Y/m/d',
                        anchor: '100%',
                        name: 'tanggal',
                        allowBlank: false,
			disabled:false,
			listeners: 
{
    render: function(trx2Tanggal) {
        trx2Tanggal.setValue(new Date());
    }
}},
                    cmbTrans05,
		    cmbEventsitem05,
		    /*{
                        xtype: 'textfield',
			enableKeyEvents: true,
    style : {textTransform: "uppercase"},
                        fieldLabel: 'Nomer transaksi',
                        anchor: '100%',
                        name: 'nota',
                        allowBlank: false,
			listeners:{
        change: function(field, newValue, oldValue){
                       field.setValue(newValue.toUpperCase());
                  }
     }
			
			//plugins:[new Ext.ux.InputTextMask('999-999999', true)]
                    }
                    ,*/
		    {
                xtype: 'fieldset',
                title: 'Keterangan',
                collapsible: true,
		labelWidth: 90,
                items: [{
                xtype:'textarea', anchor: '100%', name:'keterangan',fieldLabel:'Keterangan',allowBlank:true}
]	    }
                    
                ]
            },this.grid
        ];
        notagrup_form05.superclass.initComponent.call(this);
    }, 
    createButton:function(){
      this.botBar = [
      {
        text:'Save',
        scope:this,
        handler:function(){
          this.saveData(); 
        }
      },
      	{
        text:'Close',
        scope:this,
        handler:function(){
          this.hide(); 
        }
      }
      ]; 
      return this.botBar; 
    },
    saveData:function(){
      form = this.get(0).form; 
      if (!form.isValid()){
        Ext.example.msg('Peringatan','Ada data yang tidak valid!'); 
        return false;
      }
      data =[]; 
      this.grid.store.each(function(r,i){
        data.push(r.data);
      });
      id_data = form.getValues().id;
      action = (id_data)?'update':'create'; 
      form.submit({
        scope:this,
        params:{
          action:action,
          detail:Ext.encode(data),
          remove:this.grid.getRemoveData().join(',')
        }, 
        waitMsg:'Saving Data', 
        success:function(){
          this.hide(); 
          this.onSuccess(action); 
        },
        failure:function(form,action){          
        	switch (action.failureType) {
 
	            case Ext.form.Action.CLIENT_INVALID:
	                Ext.MessageBox.alert('Failure', 'Form fields may not be submitted with invalid values');
	                break;
	            case Ext.form.Action.CONNECT_FAILURE:
	                Ext.MessageBox.alert('Failure', 'Ajax communication failed');
	                break;
	            case Ext.form.Action.SERVER_INVALID:
	                Ext.MessageBox.alert('Failure', action.result.message);
	                break;
	        }  
          
        }
      });
    }, 
    onSuccess:function(action){
      
    },
    onAddData:function(){
      this.get(0).form.reset(); 
      this.grid.store.baseParams.nota_id = 0; /* acara */
      this.grid.store.reload(); 
    },
    reloadGrid:function(nota_id){ /*acara_id*/
      this.grid.store.baseParams.nota_id = nota_id;/*acara_id*/
      this.grid.store.reload(); 
    }    
});

win_notagrup_form05 = new notagrup_form05({
   onSuccess:function(action){
    list_notagrup05.store.reload(); 
    grid_list_grup05.store.reload();
    
   }
}); 

/*----end window---- */
//Form utama => List Jadwal Acara & List Activity crew 
{
var list_notagrup05 = new Ext.ux.DynamicGroupingGrid({
    title:'Nota Perubahan Sistem', 
    region:'center', 
    border:false,
 //   groupField:'event_id', // select the field for grouping  
    groupTpl:'[{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})]',
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:trans_nota_grup_url,
    sortInfo:{field:'id',direction:'ASC'}, //must declaration
    baseParams:{
      action:'getnotagrup05',//getRacara
      cmbbulan05:0,
	usr_id:userid
    }, 
    tbarDisable:{  //if not declaration default is true
      add:!ROLE.ADD_DATA,
      edit:!ROLE.EDIT_DATA,
      remove:!ROLE.REMOVE_DATA,
      lock:!ROLE.LOCK_DATA
    },
    tbar: ['->',' Periode waktu: ',cmbbulan05],
    onAddData:function(bt){
      win_notagrup_form05.setTitle('Nota Perubahaan Sistem');
      win_notagrup_form05.show(bt.id);    
      win_notagrup_form05.onAddData(); 
   },
    onEditData:function(bt,rec){
      win_notagrup_form05.setTitle('Edit Data');
      win_notagrup_form05.show(bt.id); 
      win_notagrup_form05.get(0).getForm().load({
          waitMsg:'Loading Data..',
          params:{action:'edit',id:rec.data.id}
      }); 
      win_notagrup_form05.reloadGrid(rec.data.id); 
    },   
    onRemoveData:function(bt,rec){
      data = []; 
      Ext.each(rec,function(r){
        data.push(r.data.id); 
      }); 
      Ext.Ajax.request({
        url: trans_nota_grup_url, 
        params:{
          action:'destroy',
          data:data.join(",")
        },
        success:function(res){
          result = Ext.decode(res.responseText); 
          if (result.success){
	          this.store.reload();
	          grid_list_grup05.store.reload();            
          }else{
            Ext.MessageBox.alert('Error',result.message);
          }

        },
        scope:this
      });       
    },   
    onLockData:function(bt,rec){
      data = []; 
      Ext.each(rec,function(r){
        data.push(r.data.id); 
      }); 
      Ext.Ajax.request({
        url: trans_nota_grup_url, 
        params:{
		
          action:'lock',
          data:data.join(",")
        },
        success:function(res){
          result = Ext.decode(res.responseText);
          if (result.success){
	          this.store.reload();
		  grid_list_grup05.store.baseParams.nota_id = -1;
	          grid_list_grup05.store.reload();
		  
          }else{
            Ext.MessageBox.alert('Error',result.message);
          }

        },
        scope:this
      });       
    }   
}); 

list_notagrup05.getSelectionModel().on('rowselect',function(sel,index,rec){
  grid_list_grup05.store.baseParams.nota_id = rec.data.id;
 // grid_list_grup05.store.baseParams.usr_id = userid;
  grid_list_grup05.store.reload(); 
}); 

var grid_list_grup05 = new Ext.ux.DynamicGridPanel({
  title :'List detail', 
  border:false,
  region:'south', 
  height:270,
  collapsible:true,  
  remoteSort:true,
  storeUrl:trans_nota_grup_url, 
  sortInfo:{field:'eq_nama', direction:'ASC'}, 
  baseParams:{
    action:'getListgrup205', 
    nota_id:0,
 //   usr_id:userid
  }
}); 
}
var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  layout:'border', //split for 2 column layout
  items : [list_notagrup05,grid_list_grup05],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('notagrupWindow05');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 