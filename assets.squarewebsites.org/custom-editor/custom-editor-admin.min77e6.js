(function() {
    var styles = ".extend-edit-mount [title=\"Remove\"]{position:absolute;right:0;top:0}.sqstp-extended-editor-using .sqs-preview-frame:after{content:'Extended Editor Enabled';display:block;position:absolute;z-index:1000;bottom:0;left:45%;margin:0;box-sizing:border-box;padding:0 10px;background-color:#333;color:#fff;font-size:12px}";

    function debounce(func, wait, immediate, cancel) {
        var timeout;
        return function() {
            var context = this,
                args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    function createStyle(css, id, context) {
        context = context ? context : window;
        if (!context.document.getElementById(id)) {
            var style = context.document.createElement('style');
            style.type = 'text/css';
            style.id = id;
            if (style.styleSheet) {
                style.styleSheet.cssText = css;
            } else {
                style.appendChild(context.document.createTextNode(css));
            }
            context.document.querySelectorAll('body')[0].appendChild(style);
        }
    }

    function checkForCustomHTML(html) {
        var custom = html.indexOf(' background-color:') || html.indexOf(' color:') || html.indexOf(' span') || html.indexOf(' img') || html.indexOf(' script') || html.indexOf(' table') || html.indexOf(' iframe');
        return custom > -1;
    }

    function getObjects(obj, key, val, factor, options) {
        var objects = [];
        for (var i in obj) {
            if (!obj.hasOwnProperty(i)) continue;
            if (typeof obj[i] == 'object') {
                objects = objects.concat(getObjects(obj[i], key, val, factor, options));
            } else if (i == key && obj[i] == val || i == key && val == '') {
                if (factor === 'html2markdown') {
                    if (obj.value && obj.value.html) {
                        if (checkForCustomHTML(obj.value.html)) {
                            obj.type = 44;
                            obj.value.wysiwig = {
                                "source": obj.value.html,
                                "isSource": false,
                                "mode": "markdown",
                                "engine": "source"
                            };
                            obj.value.engine && delete obj.value.engine;
                            obj.value.source && delete obj.value.source;
                        }
                    }
                }
                objects.push(obj);
            } else if (obj[i] == val && key == '') {
                if (objects.lastIndexOf(obj) == -1) {
                    if (factor === 'html2markdown') {
                        if (obj.value && obj.value.html) {
                            if (checkForCustomHTML(obj.value.html)) {
                                obj.type = 44;
                                obj.value.wysiwig = {
                                    "source": obj.value.html,
                                    "isSource": false,
                                    "mode": "markdown",
                                    "engine": "source"
                                };
                                obj.value.engine && delete obj.value.engine;
                                obj.value.source && delete obj.value.source;
                            }
                        }
                    }
                    objects.push(obj);
                }
            }
        }
        return objects;
    }

    function bindEditBlocksButtons(context) {
        var orig_render = context.Y.Squarespace.Block.Editor.ButtonContainer.prototype.renderUI;
        context.Y.Squarespace.Block.Editor.ButtonContainer.prototype.renderUI = function() {
            orig_render.apply(this, arguments);
            Y.Global.fire('editButtonsRendered', { widg: this, context: context });
        }
        //console.log('bindEditBlocksButtons', context)
    }

    function setMarkdownModel(block, model, e) {
        var data = e.replace(/ id="(yui_3.*?)"/g, '') || '';
        data = data.replace(/ data-preserve-html-node=".*"/g, '');
        if (block.one('.sqs-placeholder')) {
            if (data) {
                block.one('.sqs-placeholder').hide();
            } else {
                block.one('.sqs-placeholder').show();
            }
        }
        if (model) {
            model.set('wysiwyg.source', data);
            model.set('html', data);
        }
    }

    function destructJodit(widg, block) {
        setTimeout(function() {
            if (widg.ext_editor) {
                widg.ext_editor.destruct();
                widg.ext_editor = null;
            }
            block.removeClass('inline-editor-used');
            block.removeClass('sqs-edit-dialog-open');
            block.one('.sqs-block-content').setStyle('display', '');
            block.one('.sqs-block-content-custom') && block.one('.sqs-block-content-custom').remove();
        }, 50)
    }

    function buildExtendedEditorButton(obj) {
        if (!obj.widg) return;
        var buttWidg = obj.widg;
        var context = obj.context;
        var blockName = buttWidg.get('blockName');
        var container = buttWidg.get('contentBox');
        var block = container.ancestor('.sqs-block');
        var widg = false;
        if (block && blockName == 'Markdown' && container && !container.one('.extended-editor-button') && !container.one('.custom-table-block')) {
            widg = context.Y.Widget.getByNode(block);
            var model = widg.get('model');
            var blockEditor = widg.blockEditor;
            var dialog_events = false;
            widg.after('render', function(e) {
                widg = e.target;
                setTimeout(function() {
                    model = widg.get('model');
                    blockEditor = widg.blockEditor;
                    block = widg.get('contentBox').ancestor('.sqs-block');
                    //console.log('Widget rendered', block);
                    if (block && block._node && !block._extendedEditActive && !block.one('.extended-editor-button') && !block.one('.custom-table-block')) {
                        block._extendedEditActive = true;
                        //console.log(block, widg, model);
                        widg.after('focusedChange', function(e) {
                            if (widg.ext_editor) {
                                if (e.newVal) {
                                    block.addClass('sqs-edit-dialog-open');
                                    block.one('.sqs-block-content').setStyle('display', 'none');
                                } else {
                                    block.removeClass('sqs-edit-dialog-open');
                                    block.one('.sqs-block-content').setStyle('display', '');
                                }
                            }
                            blockEditor = widg.blockEditor;
                            if (blockEditor && blockEditor.configDialog && !dialog_events) {
                                var dialog = blockEditor.configDialog.get('dialog');
                                if (dialog) {
                                    dialog.before('rendered', function() {
                                        if (widg.ext_editor) {
                                            //console.log('OPEN Dialog')
                                            destructJodit(widg, block);
                                        }
                                    })
                                }
                                if (blockEditor.editingEventListeners) {
                                    blockEditor.editingEventListeners[0].detach();
                                }
                                dialog_events = true;
                            }
                        })
                        if (model && model.get('html')) {
                            block.one('.sqs-placeholder') && block.one('.sqs-placeholder').hide();
                        }

                        var extended_button = context.Y.Node.create('<div style="float:right;margin-right: 44px!important" class="extended-editor-button yui3-widget sqs-widget sqs-data-widget sqs-dialog-field sqs-button-vanilla normal-button data-state-loaded" data-test="button" title="Extended Edit"><div class="sqs-button-vanilla-content active"><div class="label">Extended Edit</div></div></div>');
                        container && container.addClass('extend-edit-mount').append(extended_button);
                        extended_button.on('click', function(e) {
                            e.halt();
                            //console.log(widg.getAttrs());
                            widg.set("editing", !0);
                            block.addClass('sqs-edit-dialog-open sqs-selected');
                            if (!widg.ext_editor) {
                                var options = {
                                    "defaultMode": "1",
                                    autofocus: !0,
                                    inline: false,
                                    beautifyHTML: true,
                                    placeholder: 'Type smth With Extended Editor',
                                    toolbarStickyOffset: 44,
                                    extraButtons: [{
                                        name: 'Save Block',
                                        icon: 'save',
                                        exec: function() {
                                            setMarkdownModel(block, model, widg.ext_editor.getEditorValue());
                                            destructJodit(widg, block);
                                        }
                                    }],
                                    events: {
                                        change: function(e) {
                                            setMarkdownModel(block, model, e);
                                        },
                                        afterClose: function(e) {
                                            //console.log(e)
                                        },
                                        afterOpen: function(e) {
                                            //console.log(e)
                                        },
                                        beforeOpen: function(e) {
                                            //console.log(e)
                                        },
                                        afterInit: function(e) {
                                            //console.log('INIT')
                                            e.editor && e.editor.setAttribute('contenteditable', true);
                                            block.one('.sqs-placeholder').hide();
                                        }
                                    },
                                    "defaultActionOnPaste": "insert_clear_html",
                                    "toolbarButtonSize": "large",
                                    "buttons": "font,fontsize,paragraph,brush,|,bold,strikethrough,underline,italic,|,superscript,subscript,|,ul,ol,|,outdent,indent,|,image,video,table,link,|,align,undo,redo,cut,hr,eraser,copyformat,|,symbol,fullsize,selectall,source",
                                    /*                    uploader: {
                                                            url: "/api/commondata/SaveGlobalMedia"
                                                        },*/
                                    /*                    filebrowser: {
                                                            ajax: {
                                                                url: "/api/content-items?orderBy=addedOn&orderDirection=2&recordType=19&pageAction=2&limit=250",
                                                                method: 'GET'
                                                            }
                                                        }*/
                                };
                                var that = this;
                                var customContent = this.get('contentBox');
                                widg.ext_editor && widg.ext_editor.destruct();
                                var init_data = model.get('html') || '';
                                customContent = block.one('.sqs-block-content-custom') || Y.Node.create('<div class="sqs-block-content sqs-block-content-custom">' + init_data + '</div>');
                                block.append(customContent);
                                block.addClass('inline-editor-used');
                                widg.ext_editor = new context.Jodit(customContent.getDOMNode(), options);
                            }
                        })
                        buttWidg.before('destroy', function(e) {
                            if (widg.ext_editor) {
                                //console.log('DESTROY')
                                destructJodit(widg, block);
                            }
                        })
                        buttWidg.after('destroy', function(e) {
                            widg.ext_editor = null;
                        })
                    }
                }, 1000);
            })
        }
    }

    function bindHtmlBlockCustom(context) {
        context = context || window.top;
        context.document.body.classList.add('sqstp-extended-editor-using');
        context.Y.SQS.LayoutEngine.Layout.Builder.prototype._cleanupImportedHTML = function(n) {
            var custom_html = getObjects(n, 'type', '2', 'html2markdown');
            return n;
        }
        loadJodit(context);
        createStyle(styles, 'extended-editor-enabled', context);
        context.__extendedEditorLoaded = true;
        //console.log('Loaded Editor Button Hook', context.__bindHtmlBlockCustom);
        if (!context.__bindHtmlBlockCustom) {
            bindEditBlocksButtons(context);
            Y.Global.after('editButtonsRendered', buildExtendedEditorButton);

            /*            var LayoutEditor = context.Y.Squarespace.LayoutEngine.EditController.getInstance();
                        LayoutEditor.on('editingChange', function(e) {
                            //console.log('EDD',e)
                        })
                        //console.log(LayoutEditor)
                        context.__bindHtmlBlockCustom = true;*/
        }
    }

    function injectScript(file, node, id, callback, remove) {
        var script = document.createElement("script");
        script.src = file + '?cache=' + (new Date().getTime() + '').substr(0, 8);
        //script.async = true;
        script.id = id;
        script.onload = function() {
            remove && this.remove();
            if (callback) {
                callback(this);
            }
        };
        node.appendChild(script);
    }

    function addStyleSheet(file, node, id, callback) {
        var link = document.createElement("link");
        link.rel = "stylesheet";
        link.type = "text/css";
        link.href = file + '?cache=' + (new Date().getTime() + '').substr(0, 8);
        link.media = "all";
        link.id = id;
        link.onload = function() {
            if (callback) {
                callback(this);
            }
        }
        node.appendChild(link);
    };

    function loadJodit(context) {
        context = context || window.top;
        if (!context.document.getElementById('custom-text-blocks-jodit-theme')) {
            addStyleSheet('../assets.squarewebsites.org/custom-editor/jodit/jodit.min.css', context.document.getElementsByTagName('head')[0], 'custom-text-blocks-jodit-theme', function() { console.log('Jodit CSS added') });
        }
        if (!context.document.getElementById('custom-text-blocks-jodit-js') && !context.Jodit) {
            injectScript('../assets.squarewebsites.org/custom-editor/jodit/jodit.min.js', context.document.getElementsByTagName('head')[0], 'custom-text-blocks-jodit-js', function() { console.log('Jodit JS added') });
        }
    }
    var intervalRun = null;

    function init() {
        if (!window.top.__sqs_custom_text_block_inited) {
            bindHtmlBlockCustom(window.top);
            window.custom_text_block_inited = true;
            window.top.__sqs_custom_text_block_inited = true;
        }
        bindHtmlBlockCustom(document.getElementById('sqs-site-frame').contentWindow);
        console.log('Extended Editor Admin init');
        if (intervalRun) {
            window.clearInterval(intervalRun);
            intervalRun = null;
        }
        document.getElementById('sqs-site-frame').onload = function(e){
        	//console.log('HEYY, Iframe loaded', e);
        	bindHtmlBlockCustom(document.getElementById('sqs-site-frame').contentWindow);
        }
    }

    function initMarkdownBlockAdmin() {
        if (document.body.className.indexOf('sqs-frame-loaded') == -1 && !intervalRun) {
            intervalRun = setInterval(function() {
                var loaded = document.body.className && document.body.className.indexOf('sqs-frame-loaded') > -1;
                //console.log(loaded, document.body)
                if (loaded) {
                    init();
                }
            }, 100)
        } else {
            init();
        }

    }

    if (!window.custom_text_block_inited) {
        initMarkdownBlockAdmin();
    } else {
        console.log('Seems Extended Editor already initialized.');
    }
})();