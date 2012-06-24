//validation vtype
Ext.apply(Ext.form.VTypes, {
    
    password : function(val, field)
	{
        if (field.initialPassField) {
            var login = Ext.getCmp(field.initialPassField);
            return (val == login.getValue());
        }
        return true;
    },
    passwordText : 'Passwords do not match' //alert if you enter a password that is not the same
});


Ext.onReady(function(){
    Ext.QuickTips.init();
 
    var login = new Ext.FormPanel({ 
        labelWidth:90,
        url:'login.php', 
        frame:true,         
        width:320,
		autoHeight:true,
		buttonAlign:'center',
        defaultType:'textfield',
	
        items:[{
			   	xtype:'box', //create image
				autoEl:{
					tag:'img',
					src:'im48x48.png'
				}
			},
			{ 
                fieldLabel:'Username', 
                name:'username', 				 
				width:190,
                allowBlank:false 
            },{ 
                fieldLabel:'Password', 
                name:'password', 
				width:190,
                inputType:'password', 
				id: 'pass',
                allowBlank:false 
            },
			{ 
                fieldLabel:'Confirm Password', 
                name:'password1', 
				width:190,
				inputType:'password',
                vtype:'password', 
				initialPassField: 'pass',
                allowBlank:false 
            }			
			],
   
        buttons:[{ 
                text:'Login',
                
                handler:function(){ 
                    login.getForm().submit({ 
                        method:'POST', 
                        waitTitle:'please wait.....', 
                        waitMsg:'Send data...',
  
                        success:function()
						{ 
                        	Ext.Msg.alert('Status', 'Success Login..!', function(btn, text)
							{
				   			
								if (btn == 'ok')
								{
								   var redirect = 'admin.php'; 
								   window.location = redirect;
								}
			       		 	});
                        },
 						
                        failure:function(form, action)
						{ 
                           if(action.failureType == 'server')
						   { 
                               obj = Ext.util.JSON.decode(action.response.responseText); 
                               Ext.Msg.alert('Login Failed!', obj.errors.reason); 
                           }
						else
						{ 
                           Ext.Msg.alert('Warning!', 'Authentication server is unreachable : ' + action.response.responseText + "abcd"); 
                            } 
                            login.getForm().reset(); 
                        } 
                    }); 
                } 
            },
			 {
				 text: 'Reset',
				 handler: function(){
                 login.getForm().reset();
			 }
			
			 }] 
    	}); 
	
		var loginwindow = new Ext.Window({
			frame:true,
			title:'Simple Form Login',
			width:330,
			autoHeight:true,
			closable: false,		
			items: login
			});		
			loginwindow.show();
});