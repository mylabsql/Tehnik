Ext.ux.TwinCombo = Ext.extend(Ext.form.ComboBox,{
    initComponent: Ext.form.TwinTriggerField.prototype.initComponent,
    getTrigger: Ext.form.TwinTriggerField.prototype.getTrigger,
    initTrigger: Ext.form.TwinTriggerField.prototype.initTrigger,
    onTrigger1Click: Ext.form.ComboBox.prototype.onTriggerClick,
    trigger1Class: Ext.form.ComboBox.prototype.triggerClass,
    onTrigger2Click : function(){
        var v = this.getRawValue();
        alert (v);
    },
    validationEvent:false,
    validateOnBlur:false,
    trigger1Class:'x-form-clear-trigger',
    trigger2Class:'x-form-search-trigger'
    //hideTrigger1:true
});