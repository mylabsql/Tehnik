valid_script = true;  
tgeque_ajax_url = 'ajax.handler.php?id=' + page;

var tree = new Ext.ux.tree.TreeGrid({
        title: 'Equipment description',
        renderTo: Ext.getBody(),
        enableDD: true,
	autoScroll: true,
        collapsible: false,
        useArrows: true,
        rootVisible: false,
        multiSelect: true,
        columns:[{
            header: 'Equipment',
            dataIndex: 'equipment',
            width: 300
        },{
            header: 'Serial-no',
            width: 75,
            dataIndex: 'sn'
        },{
            header: 'Model',
            width: 150,
            dataIndex: 'model'
        },
	{
            header: 'Merk',
            width: 150,
            dataIndex: 'merk'
        },
	{
            header: 'Daya',
            width: 75,
            dataIndex: 'daya',
            align: 'center',
            sortType: 'asFloat',
            tpl: new Ext.XTemplate('{daya:this.jumlah}', {
                jumlah: function(v) {
                    if(v < 1) {
                        return Math.round(v) + ' watt';
                    } else if (Math.floor(v) !== v) {
                        var watt = v - Math.floor(v);
                        return Math.floor(v) + 'watt';
                    } else {
                        return v + 'watt';
                    }
                }
            })
	}],

        dataUrl: 'treegrid-data.json.php'
    });

var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,
  items : [tree],
}; 
