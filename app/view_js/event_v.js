valid_script = true;  
event_url = 'ajax.handler.php?id=' + page;  

function reportSelect(bt){
  dynamic_grid_event03.getTopToolbar().get(8).setText(bt.text); 
  dynamic_grid_event03.getTopToolbar().get(8).mode = bt.mode;   
}

var dynamic_grid_event03 = new Ext.ux.DynamicGroupingGrid({
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:event_url,
    groupTpl:'[{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})]',
    sortInfo:{field:'id',direction:'ASC'}, //must declaration
    baseParams:{
      action:'read'
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
        options = dynamic_grid_event03.getParamsFilter();
        report_link = 'report.php?id=' + page;
        options = Ext.apply(options,{mode:this.mode}); 
        winReport({
            id : this.id,
            title : 'Informasi Nama Event',
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
      Ext.getCmp('win_nama_event03').getForm().reset();
      win_reg_nama_event03.setTitle('Registrasi nama event'); 
      win_reg_nama_event03.show(bt.id); 
    },
    onEditData:function(bt,rec){
      win_reg_nama_event03.setTitle('Ubah informasi event');
      win_reg_nama_event03.show(bt.id); 
      Ext.getCmp('win_nama_event03').getForm().load({
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
        url: event_url, 
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
var win_nama_event03 = {
    id: 'win_nama_event03',
    xtype:'form',
    region: 'center',
    labelAlign:'left',
    labelWidth: 100,
    autoHeight:true,
    border:false,
    bodyStyle:'padding: 10 0 0 10; background: url('+ Ext.BLANK_IMAGE_URL +');',
    defaultType:'textfield',
    waitMsgTarget: true,
    url:event_url,
    defaults:{
      anchor:'97%',
      labelSeparator:''
    },
    items:[
	{xtype:'hidden', name:'id'},
	{xtype:'textfield',id:'evNama', name:'event',fieldLabel:'Nama Event',allowBlank:false},
	{
                xtype: 'container',
                fieldLabel: 'Waktu & durasi',
                combineErrors: true,
                layout: 'hbox',
                defaults: {
                    flex: 1,
                    hideLabel: true
                },
                items: [
                    {
                        xtype     : 'timefield',
                        name      : 'waktu',
                        fieldLabel: 'Waktu',
			hideTrigger: false,
			format     : 'H:i',
                        margin: '0 5 0 0',
                        allowBlank: true
                    },
                    {
                        xtype     : 'numberfield',
                        name      : 'durasi',
                        fieldLabel: 'Durasi',
                        allowBlank: true
                    }
                ]
            },
	      {
                xtype: 'fieldset',
                title: 'Keterangan',
                collapsible: true,
		labelWidth: 90,
                items: [{
                xtype:'textarea', id:'evKeterangan', anchor: '100%', name:'keterangan',fieldLabel:'Keterangan',allowBlank:true}
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

win_reg_nama_event03 = new Ext.Window({
	id:'win-reg-nama-event03',
	iconCls:n.attributes.iconCls,
        layoutConfig: {
    	padding:'5',
    	pack:'center',
    	align:'middle'
	},
  layout:'border',
  height:250,
  closeAction:'hide',
  closable:true,
  width:400,
  modal: true,
  plain:true,
  frame:true,
  items:[userPic,win_nama_event03],
  buttons:[
  {
    text:'Save',
    handler:function()
    {	if(!Ext.getCmp('win_nama_event03').getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
      }
      
      id_data = Ext.getCmp('win_nama_event03').getForm().getValues().id; 
      action = (id_data?'update':'create'); 
      Ext.getCmp('win_nama_event03').getForm().submit({
          params:{action:action,
	  usr_id:userid},
          waitMsg : 'Saving Data',
          success:function(){
            win_reg_nama_event03.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            dynamic_grid_event03.store.reload(); 
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
      win_reg_nama_event03.hide(); 
    }
  }
  ]
}); 

/**end of form**/


var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  items : [dynamic_grid_event03],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-reg-nama-event03');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 
