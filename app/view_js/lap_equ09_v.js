valid_script = true;  
lap_equ09_url = 'ajax.handler.php?id=' + page;  

function reportSelect(bt){
  dynamic_grid_lap_equ09.getTopToolbar().get(8).setText(bt.text); 
  dynamic_grid_lap_equ09.getTopToolbar().get(8).mode = bt.mode;   
}

var dynamic_grid_lap_equ09 = new Ext.ux.DynamicGridPanel({
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:lap_equ09_url,
    groupTpl:'[{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})]',
    sortInfo:{field:['kategori'], direction:'ASC'}, //must declaration
    groupField:'eq_nama.id',
    baseParams:{
      action:'read',
      blimit:', nama'
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
        options = dynamic_grid_lap_equ09.getParamsFilter();
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
    ]
}); 

var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  items : [dynamic_grid_lap_equ09],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('dynamic_grid_lap_equ09');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 
