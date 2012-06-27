valid_script = true;  
group_list_grup_ajax_url = 'ajax.handler.php?id=' + page;  

var dsgrup08 = new Ext.data.JsonStore({
	id:dsgrup08,
	url:group_list_grup_ajax_url,
	totalProperty:'total',
	baseParams:{
		action:'getcmbgrup08'
	},
	sortInfo:{
		field:'grup',
		direction:'ASC'
	},
	remoteSort:true,
	root:'data',
	fields: [{name:'id'},{ name:'grup'}]
});

    dsgrup08.load({
	params:{
		start:0,
		limit:100
	}
});

var cmbgrup08 = new Ext.form.ComboBox(
{	id:'grup08',
	anchor:'100%',
	store:dsgrup08,
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
	width:250,
	pageSize : 100
	      });
cmbgrup08.on("select", function() {
	dynamic_grid_group_list_grup08.store.baseParams.grupid08 = cmbgrup08.getValue(); //tampilkan nota dengan parameter bulan yg dipilih
  	dynamic_grid_group_list_grup08.store.reload();
		});
var dynamic_grid_group_list_grup08 = new Ext.ux.DynamicGridPanel({
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:group_list_grup_ajax_url,
    groupTpl:'[{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})]',
    sortInfo:{field:'nama_id',direction:'ASC'}, //must declaration
    baseParams:{
      action:'read',
      grupid08:-1
    },
    tbar:['->','grup : ',cmbgrup08]
}); 

/**end of form**/

var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  items : [dynamic_grid_group_list_grup08],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-group-list-grup08');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 
