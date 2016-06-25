import MediumEditor from 'medium-editor';

export default MediumEditor.extensions.form.extend({
    /**
     * Attribute Place holder text
     */
    attributePlaceHolderText: 'Attribute goes here...',

    /**
     * Value Place Holder text
     */
    valuePlaceHolderText: 'Value goes here...',

    /**
     * Name of the extension
     */
    name: 'attributeModifier',

    /**
     * Default content
     */
    contentDefault: '<b>Attr</b>',

    /**
     * Initializes the extension
     */
    init() {
        MediumEditor.extensions.form.prototype.init.apply(this, arguments);
    },

    /**
     * Handles Button click.
     *
     * @returns {boolean}
     */
    handleClick() {
        this.selection = this.base.getSelectedParentElement();

        if( ! this.isDisplayed()) {
            this.showForm();
        }

        return false;
    },

    /**
     * Returns form object.
     *
     * @returns {*}
     */
    getForm() {
        if( ! this.form) {
            this.form = this.createForm();
        }
        return this.form;
    },

    /**
     * Returns the template for the form
     *
     * @returns {string}
     */
    getTemplate() {
        var template = [
            '<input type="text" class="attr-input medium-editor-toolbar-input" placeholder="',this.attributePlaceHolderText,'">'
        ];

        template.push(
            '<input type="text" class="val-input medium-editor-toolbar-input" placeholder="',
            this.valuePlaceHolderText,
            '">'
        );

        template.push(
            '<a href="#" class="medium-editor-toolbar-save">',
            this.getEditorOption('buttonLabels') === 'fontawesome' ? '<i class="fa fa-check"></i>' : this.formSaveLabel,
            '</a>'
        );

        template.push(
            '<a href="#" class="medium-editor-toolbar-close">',
            this.getEditorOption('buttonLabels') === 'fontawesome' ? '<i class="fa fa-times"></i>' : this.formCloseLabel,
            '</a>'
        );


        return template.join('');
    },

    /**
     * Creates the form.
     *
     * @returns {Element}
     */
    createForm() {
        var doc = this.document,
            form = doc.createElement('div');

        form.className = 'medium-editor-toolbar-form';
        form.innerHTML = this.getTemplate();

        this.attachFormEvents(form);

        return form;
    },

    /**
     * Attaches form events.
     *
     * @param form
     */
    attachFormEvents(form) {
        this.attrInput = form.querySelector('.attr-input');
        this.valInput = form.querySelector('.val-input');
        this.saveBtn = form.querySelector('.medium-editor-toolbar-save');
        this.closeBtn = form.querySelector('.medium-editor-toolbar-close');

        this.on(this.attrInput,'keyup',this.handleAttrChanged.bind(this));

        this.on(this.valInput,'keyup',this.handleKeyDown.bind(this));

        this.on(this.saveBtn,'click',this.handleSaveClick.bind(this));

        this.on(this.closeBtn,'click',this.handleCloseClick.bind(this));
    },

    /**
     * Handles Attribute value changed.
     *
     * @param event
     */
    handleAttrChanged(event) {
        this.handleKeyDown(event);

        var target = event.target;

        if(this.selection.hasAttribute(target.value)) {
            this.valInput.value = this.selection.getAttribute(target.value);
        } else {
            this.valInput.value = "";
        }
    },

    /**
     * Handles Key down event in input fields.
     *
     * @param event
     */
    handleKeyDown(event) {
        if(event.keyCode === MediumEditor.util.keyCode.ENTER) {
            event.stopPropagation();
            event.preventDefault();

            this.doFormSave();

            return;
        }

        if(event.keyCode === MediumEditor.util.keyCode.ESCAPE) {
            event.preventDefault();
            this.doFormCancel();
        }
    },

    /**
     * Handles clicking of save button.
     *
     * @param event
     */
    handleSaveClick(event) {
        event.stopPropagation();
        event.preventDefault();

        this.doFormSave();
    },

    /**
     * Handles clicking of close button.
     *
     * @param event
     */
    handleCloseClick(event) {
        event.preventDefault();
        this.doFormCancel();
    },

    /**
     * Saves the form.
     */
    doFormSave() {
        if(this.attrInput.value.trim() != "" || this.valueInput.value.trim() != "") {
            var attr = this.attrInput.value.trim(),
                val = this.valInput.value.trim();

            this.attrInput.value = "";
            this.valInput.value = "";

            this.attrInput.focus();

            this.selection.setAttribute(attr, val);

            this.base.checkContentChanged(this.base.getFocusedElement());
        }
    },

    /**
     * Cancels the form.
     */
    doFormCancel() {
        this.base.restoreSelection();
        this.base.checkSelection();
    },

    /**
     * Shows the form.
     */
    showForm() {
        this.hideToolbarDefaultActions();
        MediumEditor.extensions.form.prototype.showForm.apply(this);
        this.setToolbarPosition();

        this.attrInput.focus();
    }
});