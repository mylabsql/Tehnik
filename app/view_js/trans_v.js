valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;  

function reportSelect(bt){
  dynamic_grid_trans01.getTopToolbar().get(8).setText(bt.text); 
  dynamic_grid_trans01.getTopToolbar().get(8).mode = bt.mode;   
}

var dynamic_grid_trans01 = new Ext.ux.DynamicGroupingGrid({
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:ajax_url,
    region: 'center',
    autoheight:true,
    groupTpl:'[{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})]',
    sortInfo:{field:'nama_trans',direction:'ASC'}, //must declaration
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
        options = dynamic_grid_trans01.getParamsFilter();
        report_link = 'report.php?id=' + page;
        options = Ext.apply(options,{mode:this.mode}); 
        winReport({
            id : this.id,
            title : 'Informasi Nama Transaksi',
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
      remove:!ROLE.REMOVE_DATA
    },
   
    onAddData:function(bt){
      Ext.getCmp('win_trans').getForm().reset();
      win_reg_trans01.setTitle('Registrasi transaksi'); 
      win_reg_trans01.show(bt.id); 
    },
    onEditData:function(bt,rec){
      win_reg_trans01.setTitle('Ubah informasi transaksi');
      win_reg_trans01.show(bt.id); 
      Ext.getCmp('win_trans').getForm().load({
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
        url: ajax_url, 
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
var win_trans = {
    id: 'win_trans',
    xtype:'form',
    region: 'north',
    labelAlign:'left',
    labelWidth: 100,
                border: false,
                frame: true,
                autoHeight: true,
    bodyStyle:'padding: 10 0 0 10; background: url('+ Ext.BLANK_IMAGE_URL +');',
    defaultType:'textfield',
    waitMsgTarget: true,
    url:ajax_url,
    defaults:{
      anchor:'97%',
      labelSeparator:''
    },
    items:[
	{xtype:'hidden', name:'id'},
	{xtype:'textfield',id:'trxNama', name:'nama_trans',fieldLabel:'Nama transaksi',allowBlank:false},
	                        {
                xtype: 'fieldset',
                title: 'Keterangan',
                collapsible: true,
		labelWidth: 90,
                items: [{
                xtype:'textarea', id:'trxKeterangan', anchor: '100%', name:'keterangan',fieldLabel:'Keterangan',allowBlank:true}
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

win_reg_trans01 = new Ext.Window({
	id:'win-reg-trans01',
	iconCls:n.attributes.iconCls,
        layoutConfig: {
    	padding:'5',
    	pack:'center',
    	align:'middle'
	},
  layout:'border',
  height:300,
  closeAction:'hide',
  closable:true,
  width:425,
  modal: true,
  plain:true,
  frame:true,
  items:[userPic,win_trans],
  buttons:[
  {
    text:'Save',
    handler:function()
    {	if(!Ext.getCmp('win_trans').getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
      }
      
      id_data = Ext.getCmp('win_trans').getForm().getValues().id; 
      action = (id_data?'update':'create'); 
      Ext.getCmp('win_trans').getForm().submit({
          params:{action:action,
	  usr_id:userid},
          waitMsg : 'Saving Data',
          success:function(){
            win_reg_trans01.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            dynamic_grid_trans01.store.reload(); 
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
      win_reg_trans01.hide(); 
    }
  }
  ]
}); 

/**end of form**/


var main_content = {
  id : id_panel,  
  title:n.text,  
  layout: 'border',
  iconCls:n.attributes.iconCls,  
  items : [win_trans, dynamic_grid_trans01],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-reg-trans01');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 
