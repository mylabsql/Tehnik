Ext.ux.DynamicGridPanel = Ext.extend(Ext.grid.GridPanel, {
    autoLoadStore: true,
    start: 0,
    limit: 25,
    remoteSort: false,
    hiddenCombo: false,
    localFilter: false,
    forceFit: false,
    sortInfo: { field: '', direction: '' },
    initComponent: function () {    
    	config = {
            viewConfig:new Ext.grid.GroupingView({
                 forceFit: this.forceFit,
                 groupTextTpl: this.groupTpl
            }),
            enableCollock: false,
            loadMask: true,
            stripeRows: true,
            ds: this.createStore(),
            cm: this.defaultColModel(),
            bbar: this.createPagingBar(this.storeJson)
        };
        this.filterPlugin = 0;
        this.loadMeta = false;
        Ext.apply(this, config);
        Ext.apply(this.initialConfig, config);
        Ext.ux.DynamicGroupingGrid.superclass.initComponent.apply(this, arguments);
        
        this.on('celldblclick',
          function(){
            if (!this.tbarDisable.edit){
              the_rec = this.getSelectionModel().getSelected(); 
              this.onEditData(this.topBar.get(2),the_rec);
            }
          },
          this
        )
    },
    onRender: function (ct, position) {
        this.getColumnModel().defaultSortable = true;
        Ext.ux.DynamicGroupingGrid.superclass.onRender.call(this, ct, position);
        if (this.autoLoadStore)
            this.store.load({
                params: {
                    start: this.start,
                    limit: this.limit
                }
            });

    },
    defaultColModel: function () {
        return new Ext.grid.ColumnModel({
            defaults: { align: 'left', resizable: true, sortable: true, width: 50 }
        });
    },
    formatRender: function (col_model) {
        result = [];
        Ext.each(col_model, function (col) {
            if (col.renderer) {
                string_render = col.renderer;
                col.renderer = function (val) {
                    return eval(string_render);
                }
            }
            result.push(col);
        });
        return result;
    },
    createStore: function () {
        this.storeJson = new Ext.data.GroupingStore({
            url: this.storeUrl,
            root: 'data',
            baseParams: this.baseParams,
            autoLoad: false,
            remoteSort: this.remoteSort,
            sortInfo: this.sortInfo,
            groupField: this.groupField,
            reader: new Ext.data.JsonReader({}),
            listeners: {
                metachange: function (st, meta) {
                    if (!this.loadMeta) {
                        this.loadMeta = true;
                        cm = this.getColumnModel();
                        cmModel = this.formatRender(meta.colModel);
                        cm.setConfig(cmModel);
                        if (meta.filterList.length) {
                            this.filterPlugin = new Ext.ux.grid.GridFilters({
                                local: this.localFilter,
                                filters: meta.filterList
                            });
                            this.initPlugin(this.filterPlugin);
                            this.paging.initPlugin(this.filterPlugin);
                            this.paging.get(12).enable();
                        } else {
                            this.paging.get(12).disable();
                        }
                    }
                },
                exception: function (DataProxy, type, action, options, response, arg) {
                    if (type == 'remote') {
                        Ext.MessageBox.alert('Failure', response.raw.message);
                    } else {
                        Ext.MessageBox.alert('Failure', 'Ajax Communication failed');
                    }
                },
                scope: this
            }
        });
        return this.storeJson
    },
    createPagingBar: function (the_store) {
        this.paging = new Ext.PagingToolbar({
            store: the_store,
            pageSize: this.limit,
            displayInfo: true,
            displayMsg: 'Displaying Data {0} - {1} of {2}',
            emptyMsg: "No Data to display",
            items: ['-', this.createClearFilterButton(), '-', 'Display Per Page ', this.createComboPaging()]
        });
        return this.paging;
    },
    createComboPaging: function () {
        this.comboPaging = new Ext.form.ComboBox({
            typeAhead: true,
            mode: 'local',
            triggerAction: 'all',
            width: 45,
            hidden: this.hiddenCombo,
            displayField: 'limit',
            valueField: 'limit',
            store: new Ext.data.SimpleStore({
                fields: ['limit'],
                data: [[25], [50], [100]]
            }),
            listeners: {
                render: function (cmb) {
                    cmb.setValue(this.limit);
                },
                select: function (cmb, rec) {
                    this.paging.pageSize = parseInt(rec.data.limit);
                    this.storeJson.load({
                        params: { start: 0, limit: parseInt(rec.data.limit) }
                    });
                },
                scope: this
            }
        });
        return this.comboPaging;
    }
    ,
    createClearFilterButton: function () {
        this.buttonClear = {
            scope: this,
            tooltip: {
                title: 'Clear Filter',
                text: 'Clear Searching Filter'
            },
            iconCls: 'drop',
            disabled: true,
            handler: function () {
                this.filterPlugin.clearFilters();
            }
        }
        return this.buttonClear;
    },

    getParamsFilter: function () {
        if (this.filterPlugin) {
            the_filter = this.filterPlugin.buildQuery(this.filterPlugin.getFilterData());
            return Ext.apply(the_filter, this.store.lastOptions.params);
        } else {
            return this.store.lastOptions.params;
        }
    }

});