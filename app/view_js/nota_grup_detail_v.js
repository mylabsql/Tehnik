valid_script = true;  
nota_grup_detail_url = 'ajax.handler.php?id=' + page;  
{  // variable
{ //combo pertama : Nota
var dsnota06 = new Ext.data.JsonStore({
	id:dsnota06,
	url:nota_grup_detail_url,
	totalProperty:'total',
	baseParams:{
		action:'getcmbnota06',

	},
	sortInfo:{
		field:'nota',
		direction:'ASC'
	},
	remoteSort:true,
	root:'data',
	model: 'Post',
	fields: [{name:'id'},{ name:'nota'},{ name:'user'},{ name:'grup'},{ name:'sis06'},{name:'proses'}]
});

    dsnota06.load({
	params:{
		start:0,
		limit:10
	}
});

var cmbNota06 = new Ext.form.ComboBox(
{	id:'cmbNota06',
	anchor:'100%',
	tpl: '<tpl for="."><div class="x-combo-list-item" ><span>{grup}<br/>{nota}<br/>{user}</span></div></tpl>', 
	store:dsnota06,
	//name:'id',
	valueField: 'id',
	displayField: ['nota'],
	hiddenValue : 'id',
	hiddenName : 'nota_id',
	fieldLabel: 'Nomer transaksi',
	emptyText : 'Nota...',
	triggerAction: 'all',
	mode: 'remote',
	editable: true,
	autocomplete: true,
	hideTrigger: false, //SEMBUNYIKAN BUTTON COMBO?
	forceSelection : true,
	width:200,
	allowBlank: false,	
            pageSize: 10,
	    listeners:{
		specialkey: function(o,e){enterFunct(o,e,Ext.getCmp('textSN06'));}
								}
	      });
}
var proses06= new Ext.form.TextField( 
    {   id: 'proses06',
        name: 'proses06'
    });
var grup06= new Ext.form.TextField( 
    {   id: 'grup06',
        name: 'grup06'
    });

cmbNota06.on("select", function() {//kalo nota sudah dipilih => tampilkan seloruh list nota yg telah tercatat didatabase
	detail_nota06.store.baseParams.cmbNota06 = cmbNota06.getValue(); //tampilkan nota dengan parameter bulan yg dipilih
	index = dsnota06.findExact('id',cmbNota06.getValue()); 
	rs = dsnota06.getAt(index).data; 
	proses06.setValue(rs.proses);
	grup06.setValue(rs.sis06);
	if(proses06.getValue()==0){listload='outlistnota06'}else{listload='inlistnota06'}
	detail_nota06.getStore().setBaseParam('action',listload);
	detail_nota06.store.reload(); //eksekusi
	Ext.getCmp('textSN06').focus('',10);
	Ext.getCmp('textSN06').selectText( 0, 100 );
  		});
}

detail_grup_equ_editor06 = Ext.extend(Ext.grid.EditorGridPanel, {
    title: 'Detail SISTEM',
    region: 'center',
    clicksToEdit:1,
    loadMask:true,
    removeData:[],
         
    store: new Ext.data.JsonStore({
      url:nota_grup_detail_url, 
      root:'data', 
      successProperty:'success',
      totalProperty:'total',
      autoLoad: false,
      remoteSort:false, 
      baseParams:{
        action :'getDetEqu06', 
        detail_nota:0
        //usr_id:userid
      }, 
      fields:[
      {name:'id', type:'int'},
      {name:'equipment', type:'string'}
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
                header: 'sn',
                sortable: true,
                dataIndex: 'sn',
                width: 100,
		editor:{xtype: 'textfield'}
            },
            {
                xtype: 'gridcolumn',
                dataIndex: 'model',
                header: 'model',
                hidden:false,
                sortable: true,
		width: 200
            },
            {
                xtype: 'gridcolumn',
                dataIndex: 'merk',
		header: 'Merk',
                sortable: true,
            },
	    {
                xtype: 'gridcolumn',
                dataIndex: 'daya',
		header: 'Daya',
                sortable: true,
            },
            {
                xtype: 'gridcolumn',
                header: 'Keterangan',
                sortable: true,
                dataIndex: 'keterangan',
                width: 500
            }
            
        ];
        detail_grup_equ_editor06.superclass.initComponent.call(this);
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


edit_detail_form06 = Ext.extend(Ext.Window, {
    title: '<center>*---------------------------------------------------------------------*</center>',
    width: 530,
    height: 459,
    layout: 'border',
    border: false,
    closeAction: 'hide',
    id: 'notadetailWindow06',
    modal:true,
    initComponent: function() {
        this.buttons = this.createButton(); 
        this.grid = new detail_grup_equ_editor06({}); 
        edit_detail_form06.superclass.initComponent.call(this);
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
      this.grid.store.baseParams.detail_nota = 0; /* acara */
      this.grid.store.reload(); 
    },
    reloadGrid:function(detail_nota){ /*acara_id*/
      this.grid.store.baseParams.detail_nota = detail_nota;/*acara_id*/
      this.grid.store.reload(); 
    }    
});

win_edit_detail_form06 = new edit_detail_form06({
   onSuccess:function(action){
    detail_nota06.store.reload();    
   }
});

/*----end window---- */
//Form utama => List nota
{
var detail_nota06 = new Ext.ux.DynamicGridPanel({
    region:'center', 
    border:false,
 //   groupField:'event_id', // select the field for grouping  
    groupTpl:'[{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})]',
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:nota_grup_detail_url,
    autoheight:true,
    sortInfo:{field:'id',direction:'ASC'}, //must declaration
    baseParams:{
      action:'inlistnota06',//getRacara
      cmbNota06:0
	//usr_id:userid
    },
	onAddData:function(bt){
     Ext.example.msg('Info','Aplikasi anda tidak memiliki otoritas menambahkan data');
   },
    onEditData:function(bt,rec){
      win_edit_detail_form06.setTitle('Perubahan detail perangkat siaran');
      win_edit_detail_form06.show(bt.id); 
      win_edit_detail_form06.get(0).getForm().load({
          waitMsg:'Loading Data..',
          params:{action:'edit',id:rec.data.id}
      }); 
      win_edit_detail_form06.reloadGrid(rec.data.id); 
    },   
    onRemoveData:function(bt,rec)
    {
 Ext.example.msg('Info','Aplikasi anda tidak memiliki otoritas menghapus data');
 },   
    onLockData:function(bt,rec){
      data = []; 
      Ext.each(rec,function(r){
        data.push(r.data.id); 
      }); 
      Ext.Ajax.request({
        url: nota_grup_detail_url, 
        params:{
		
          action:'lock',
          data:data.join(",")
        },
        success:function(res)
	{
          result = Ext.decode(res.responseText);
          if (result.success)
	  {
	          this.store.reload();		  
          }
	  else
	  {
            Ext.MessageBox.alert('Error',result.message);
          }

        },
        scope:this
      });       
    }   
}); 

detail_nota06.getSelectionModel().on('rowselect',function(sel,index,rec){

}); 


}

var userForm06 = {
					
			title:'<center>FORM ENTRY PERANGKAT SISTEM</center>',
					xtype: 'form',
					region: 'north',
					labelAlign:'left',
					id:'userForm06',
					labelWidth: 100,
					border: false,
                frame: true,
                autoHeight: true,
		bodyStyle:'padding: 20 0 20 20; background: url('+ Ext.BLANK_IMAGE_URL +');',
		defaultType:'textfield',
		waitMsgTarget: true,
		url:nota_grup_detail_url ,
		defaults:{
      anchor:'97%',
      labelSeparator:''
    },
	items: [cmbNota06,
		{
                xtype: 'textfield',
		id : 'textSN06',
		fieldLabel: 'Serial-no',
		tooltip : 'Serial-no yg akan diproses',
		allowBlank:false,
			listeners:{
				specialkey: function(o, e)
				{
					if (e.getKey() == e.ENTER)
					{
					btn = Ext.getCmp('sendSN06'); 
					btn.handler.call(btn.scope); 
				}
				}
								}
		}],
	bbar:  ['->',{
		name : 'sendSN',
		id : 'sendSN06',
		text : 'Submit',
		iconCls : 'add-data',
		tooltip : 'Add New Sn',
		handler : function() {
			dataSN06 = Ext.getCmp('userForm06').getForm().getValues();
			if (Ext.getCmp('userForm06').getForm().isValid())
			{
			form = Ext.getCmp('userForm06').getForm(); 
			Ext.getCmp(id_panel).body.mask('Ceck serial-no...','x-mask-loading');	
				form.submit({
					url:nota_grup_detail_url,
					params: {
						action:'cekSN06',
						},
					success:function() {								
//SN TERDAFTAR => LANJUTKAN PROSES (TRANS=IN AND USED=0) : 
Ext.Ajax.request({
url:nota_grup_detail_url,
params: {
	action:'statusSN06',
	textSN06:dataSN06.textSN06
	},
success:function(response) {
	Ext.getCmp(id_panel).body.mask('Memproses serial-no...','x-mask-loading');
	res = Ext.decode(response.responseText);
	$used= res.used;
	if((proses06.getValue()==0) && ($used==0))
	{	Ext.Ajax.request({
		url:nota_grup_detail_url,
		params: {
		action:'assembly06',
		nota_id:dataSN06.nota_id,
		textSN06:dataSN06.textSN06,
		usr_id:userid,
		group:grup06.getValue()
		},
	success:function(response) {
		res = Ext.decode(response.responseText);
		$msg = res.message;
		Ext.example.msg('Info',$msg);
		Ext.getCmp(id_panel).body.unmask();
		detail_nota06.store.baseParams.cmbNota06 = cmbNota06.getValue(); //tampilkan nota dengan parameter bulan yg dipilih
		detail_nota06.store.reload();
		},
	failure:function(){
		Ext.example.msg('Alert','Error tidak terdefinisi...!');
		Ext.getCmp(id_panel).body.unmask();
		}
	});
		
	}
	else if((proses06.getValue()==0) && ($used==1))
	{		Ext.example.msg('Alert','Gagal memproses, serial-no sudah terdaftar pada nota keluar!');
			Ext.getCmp(id_panel).body.unmask();
			}
	else if((proses06.getValue()==1) && ($used==0))
	{	Ext.Ajax.request({
		url:nota_grup_detail_url,
		params: {
		action:'dissasembly06',
		nota_id:dataSN06.nota_id,
		textSN06:dataSN06.textSN06,
		usr_id:userid,
		group:grup06.getValue()
		},
	success:function(response) {
		res = Ext.decode(response.responseText);
		$msg = res.message;
		Ext.example.msg('Info',$msg);
		Ext.getCmp(id_panel).body.unmask();
		detail_nota06.store.baseParams.cmbNota06 = cmbNota06.getValue(); //tampilkan nota dengan parameter bulan yg dipilih
		detail_nota06.store.reload();
		},
	failure:function(){
		Ext.example.msg('Alert','Error tidak terdefinisi...!');
		Ext.getCmp(id_panel).body.unmask();
	}
});	
	}
	else if((proses06.getValue()==1) && ($used==1))
			{Ext.example.msg('Alert','Gagal memproses, serial-no sedang terdaftar pada nota keluar!');
			Ext.getCmp(id_panel).body.unmask();
			}

	},
failure:function(){
	Ext.example.msg('Alert','Ada kesalahan yang tidak terdefinisi!');
	Ext.getCmp(id_panel).body.unmask();
	}
});
							},
					failure:function()
					{
						Ext.example.msg('Alert','Serial tidak terdaftar');
						Ext.getCmp(id_panel).body.unmask();
							
					}
					});		
			}
			else
			{
					
				Ext.example.msg('Info','Nota atau serial yang akan diproses masih kosong');
				Ext.getCmp(id_panel).body.unmask();
			}
			
			
	Ext.getCmp('textSN06').selectText( 0, 100 );	
				}
		},'-',''
	],
   
		listeners: {
            
        }
					
};
 

var main_content ={
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  layout:'border', //split for 2 column layout
  items : [userForm06,detail_nota06],
  listeners:
  {
    destroy:function()
    {
      my_win = Ext.getCmp('notadetailWindow06');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 