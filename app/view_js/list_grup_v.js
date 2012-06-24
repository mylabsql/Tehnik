valid_script = true;  
list_grup_ajax_url = 'ajax.handler.php?id=' + page;  

var dsgrup07 = new Ext.data.JsonStore({
	id:dsgrup07,
	url:list_grup_ajax_url,
	totalProperty:'total',
	baseParams:{
		action:'getcmbgrup07'
	},
	sortInfo:{
		field:'grup',
		direction:'ASC'
	},
	remoteSort:true,
	root:'data',
	fields: [{name:'id'},{ name:'grup'}]
});

    dsgrup07.load({
	params:{
		start:0,
		limit:100
	}
});

var cmbgrup07 = new Ext.form.ComboBox(
{	id:'grup07',
	anchor:'100%',
	store:dsgrup07,
	//name:'id',
	valueField: 'id',
	displayField: 'grup',
	hiddenValue : 'id',
	hiddenName : 'id',
	fieldLabel: 'Nama grup',
	emptyText : 'Nama grup...',
	triggerAction: 'all',
	mode: 'remote',
	editable: true,
	autocomplete: true,
	forceSelection : true,
	pageSize : 100
	      });
cmbgrup07.on("select", function() {
	dynamic_grid_list_grup07.store.baseParams.grupid = cmbgrup07.getValue(); //tampilkan nota dengan parameter bulan yg dipilih
  	dynamic_grid_list_grup07.store.reload();
		});
var dynamic_grid_list_grup07 = new Ext.ux.DynamicGridPanel({
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:list_grup_ajax_url,
    groupTpl:'[{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})]',
    sortInfo:{field:'nama_id',direction:'ASC'}, //must declaration
    baseParams:{
      action:'read',
      grupid:-1
    },
    tbar:['->','Grup : ',cmbgrup07]
}); 



win_list_grup07 = new Ext.Window({
	id:'win-list-grup07',
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
  items:[],
  buttons:[
  {
    text:'Save',
    handler:function()
    {	if(!Ext.getCmp('win_list_grup07').getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
      }
      
      id_data = Ext.getCmp('win_list_grup07').getForm().getValues().id; 
      action = (id_data?'update':'create'); 
      Ext.getCmp('win_list_grup07').getForm().submit({
          params:{action:action,
	  usr_id:userid},
          waitMsg : 'Saving Data',
          success:function(){
            win_list_grup07.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            dynamic_grid_list_grup07.store.reload(); 
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
      win_list_grup07.hide(); 
    }
  }
  ]
}); 

/**end of form**/


var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  items : [dynamic_grid_list_grup07],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-list-grup07');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 
