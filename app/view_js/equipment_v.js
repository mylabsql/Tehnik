valid_script = true;  
equ_ajax_url = 'ajax.handler.php?id=' + page;  

function reportSelect(bt){
  dynamic_grid_reg_equ01.getTopToolbar().get(8).setText(bt.text); 
  dynamic_grid_reg_equ01.getTopToolbar().get(8).mode = bt.mode;   
}
var dsequ01 = new Ext.data.JsonStore({
	id:dsequ01,
	url:equ_ajax_url,
	totalProperty:'total',
	baseParams:{
		action:'getcmbnama01',
		thisfilter:'equipment'
	},
	sortInfo:{
		field:'nama',
		direction:'ASC'
	},
	remoteSort:true,
	root:'data',
	fields: [{name:'id'},{ name:'nama'}]
});

    dsequ01.load({
	params:{
		start:0,
		limit:100
	}
});

var cmbequ01 = new Ext.form.ComboBox(
{	
	anchor:'100%',
	store:dsequ01,
	//name:'id',
	valueField: 'id',
	displayField: 'nama',
	hiddenValue : 'id',
	hiddenName : 'nama_id',
	fieldLabel: 'Nama equipment',
	emptyText : 'Nama equipment...',
	triggerAction: 'all',
	mode: 'remote',
	editable: true,
	autocomplete: true,
	forceSelection : true,
	pageSize : 100
	      });

var dynamic_grid_reg_equ01 = new Ext.ux.DynamicGroupingGrid({
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:equ_ajax_url,
    groupTpl:'[{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})]',
    sortInfo:{field:'nama_id',direction:'ASC'}, //must declaration
    baseParams:{
      action:'read',
      thisfilter:'equipment'
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
        options = dynamic_grid_reg_equ01.getParamsFilter();
        report_link = 'report.php?id=' + page;
        options = Ext.apply(options,{mode:this.mode}); 
        winReport({
            id : this.id,
            title : 'Informasi Nama equipment',
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
      Ext.getCmp('win_equ01').getForm().reset();
      win_reg_equ01.setTitle('Registrasi equipment'); 
      win_reg_equ01.show(bt.id); 
    },
    onEditData:function(bt,rec){
      win_reg_equ01.setTitle('Ubah informasi equipment');
      win_reg_equ01.show(bt.id); 
      Ext.getCmp('win_equ01').getForm().load({
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
        url: equ_ajax_url, 
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
var win_equ01 = {
    id: 'win_equ01',
    xtype:'form',
    region: 'center',
    labelAlign:'left',
    labelWidth: 100,
    autoHeight:true,
    border:false,
    bodyStyle:'padding: 10 0 0 10; background: url('+ Ext.BLANK_IMAGE_URL +');',
    defaultType:'textfield',
    waitMsgTarget: true,
    url:equ_ajax_url,
    defaults:{
      anchor:'97%',
      labelSeparator:''
    },
    items:[
	{xtype:'hidden', name:'id'},
	cmbequ01,
	{xtype:'textfield', name:'sn',fieldLabel:'Nomer seri',allowBlank:false},
	{xtype:'textfield', name:'model',fieldLabel:'Model',allowBlank:false},
	{xtype:'textfield', name:'merk',fieldLabel:'Merek',allowBlank:false},
	{xtype:'textfield', name:'daya',fieldLabel:'Daya',allowBlank:true},
	{xtype:'textfield', name:'partno',fieldLabel:'Partno',allowBlank:true},
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

win_reg_equ01 = new Ext.Window({
	id:'win-reg-equ01',
	iconCls:n.attributes.iconCls,
        layoutConfig: {
    	padding:'5',
    	pack:'center',
    	align:'middle'
	},
  layout:'border',
  height:350,
  closeAction:'hide',
  closable:true,
  width:550,
  modal: true,
  plain:true,
  frame:true,
  items:[userPic,win_equ01],
  buttons:[
  {
    text:'Save',
    handler:function()
    {	if(!Ext.getCmp('win_equ01').getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
      }
      
      id_data = Ext.getCmp('win_equ01').getForm().getValues().id; 
      action = (id_data?'update':'create'); 
      Ext.getCmp('win_equ01').getForm().submit({
          params:{action:action,thisfilter:'equipment',
	  usr_id:userid},
          waitMsg : 'Saving Data',
          success:function(){
            win_reg_equ01.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            dynamic_grid_reg_equ01.store.reload(); 
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
      win_reg_equ01.hide(); 
    }
  }
  ]
}); 

/**end of form**/


var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  items : [dynamic_grid_reg_equ01],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-reg-equ01');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 
