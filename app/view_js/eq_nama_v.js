valid_script = true;  
eq_nama_url = 'ajax.handler.php?id=' + page;  

function reportSelect(bt){
  dynamic_grid_reg_nama_eq01.getTopToolbar().get(8).setText(bt.text); 
  dynamic_grid_reg_nama_eq01.getTopToolbar().get(8).mode = bt.mode;   
}
var kategori01 = new Ext.data.SimpleStore({
	fields : ['kat01'],
	data : [['Equipment'],['Sparepart'],['Grup'],['Sistem']]
		// from states.js
	});

var eqKat01 = new Ext.form.ComboBox({        
		xtype:'combo',
		id:'kat01', //akan ditampilkan pada combo/harus sama pada displayField n fields pd id simplestore
		name:'kategori',
		fieldLabel:'Kategori',
		allowBlank:false,
		store:kategori01,
		anchor: '100%',
		displayField:'kat01',
		mode : 'local',
		triggerAction:'all',
		emptyText: 'Pilih kategori'
		});

var dsgrup01 = new Ext.data.SimpleStore({
	fields : ['id','grup'],
	data : [[1, 'Grup'], [0, 'Non-grup']]
		// from states.js
	});

var cmbgrup01 = new Ext.form.ComboBox({        
		xtype:'combo',
		//id:'grup',
		fieldLabel:'Grup',
		allowBlank:false,
		store:dsgrup01,
		anchor: '100%',
		displayField:'grup',
		valueField:'id',
		hiddenName:'grup',
		mode : 'local',
		triggerAction:'all',
		emptyText: 'Pilih grup'
		});


var dynamic_grid_eq_nama01 = new Ext.ux.DynamicGroupingGrid({
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:eq_nama_url,
    groupTpl:'[{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})]',
    sortInfo:{field:'kategori',direction:'ASC'}, //must declaration
    baseParams:{
      action:'read',
      blimit:',nama'
    },
    tbar:[
    '-',{
      text:'Print Mode',
      iconCls:'report-mode',
      menu:{
        items:[
        {text:'PDF',mode:'pdf',handler:reportSelect},
        {text:'XLS',mode:'xls',handler:reportSelect}
        ]
      }
    },'-',{
      text:'Print PDF',
      iconCls:'report-mode',
      mode:'pdf',
      handler:function(){
        options = dynamic_grid_eq_nama01.getParamsFilter();
        report_link = 'report.php?id=' + page;
        options = Ext.apply(options,{mode:this.mode}); 
        winReport({
            id : this.id,
            title : 'Informasi Standart Nama Equipment',
            url : report_link,
            type : this.mode,
            params:options        
        }); 
      }
    }
    ],
    tbarDisable:{  //if not declaration default is true
      add:!ROLE.ADD_DATA,
      edit:!ROLE.EDIT_DATA,
      remove:!ROLE.REMOVE_DATA,
      lock:!ROLE.LOCK_DATA
    },
   
    onAddData:function(bt){
      Ext.getCmp('win_nama_eqnama01').getForm().reset();
      win_reg_nama_eqnama01.setTitle('Registrasi nama standart equipment'); 
      win_reg_nama_eqnama01.show(bt.id); 
    },
    onEditData:function(bt,rec){
      win_reg_nama_eqnama01.setTitle('Ubah nama standart equipment');
      win_reg_nama_eqnama01.show(bt.id); 
      Ext.getCmp('win_nama_eqnama01').getForm().load({
          waitMsg:'Loading Data..',
          params:{action:'edit',id:rec.data.id}
      }); 
    },
    onRemoveData:function(bt,rec){
      data = []; 
      Ext.each(rec,function(r){
        data.push(r.data.id); 
      }); 
      Ext.Ajax.request({
        url: eq_nama_url, 
        params:{
          action:'destroy',
          data:data.join(",")
        },
        success:function(){
          this.store.reload(); 
        },
        scope:this
      });       
    }
}); 




/**form edit dan form add **/ 
var win_nama_eqnama01 = {
    id: 'win_nama_eqnama01',
    xtype:'form',
    region: 'center',
    labelAlign:'left',
    labelWidth: 100,
    autoHeight:true,
    border:false,
    bodyStyle:'padding: 10 0 0 10; background: url('+ Ext.BLANK_IMAGE_URL +');',
    defaultType:'textfield',
    waitMsgTarget: true,
    url:eq_nama_url,
    defaults:{
      anchor:'97%',
      labelSeparator:''
    },
    items:[
	{xtype:'hidden', name:'id'},
	eqKat01,
	{xtype:'textfield',name:'nama',fieldLabel:'Nama standart',allowBlank:false},
	cmbgrup01,
	      {
                xtype: 'fieldset',
                title: 'Keterangan',
                collapsible: true,
		labelWidth: 90,
                items: [{
                xtype:'textarea', anchor: '100%', name:'keterangan',fieldLabel:'Keterangan',allowBlank:true}
]	    }
    ]
}
var userPic = {
   bodyStyle: 'padding:0px',
   xtype: 'box',
   region:'west',
   width: 130,
   autoEl: { tag: 'div',
			 html: '<img id="pic" src=images/gnome-fs-client.png style="background:transparent;" />'
	}

};

win_reg_nama_eqnama01 = new Ext.Window({
	id:'win-reg-nama-eqnama01',
	iconCls:n.attributes.iconCls,
        layoutConfig: {
    	padding:'5',
    	pack:'center',
    	align:'middle'
	},
  layout:'border',
  height:275,
  closeAction:'hide',
  closable:true,
  width:500,
  modal: true,
  plain:true,
  frame:true,
  items:[userPic,win_nama_eqnama01],
  buttons:[
  {
    text:'Save',
    handler:function()
    {	if(!Ext.getCmp('win_nama_eqnama01').getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
      }
      
      id_data = Ext.getCmp('win_nama_eqnama01').getForm().getValues().id; 
      action = (id_data?'update':'create'); 
      Ext.getCmp('win_nama_eqnama01').getForm().submit({
          params:{action:action,
	  usr_id:userid},
          waitMsg : 'Saving Data',
          success:function(){
            win_reg_nama_eqnama01.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            dynamic_grid_eq_nama01.store.reload(); 
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
      
    }
  },{
    text:'Close',
    handler:function(){
      win_reg_nama_eqnama01.hide(); 
    }
  }
  ]
}); 

/**end of form**/


var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  items : [dynamic_grid_eq_nama01],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-reg-nama-eqnama01');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 
