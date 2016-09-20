import MediumEditor from 'medium-editor';

export default MediumEditor.Extension.extend({

    /**
     * Name of the extension
     */
    name: 'media-selector',

    /**
     * Initializes the extension
     */
    init() {
        this.registerEvents();

        setTimeout(() => {
            this.createToolbars();
            this.createImageOverlay();

            this.registerToolbarActionEvents();
        },50);
    },

    /**
     * Registers Event Listeners.
     */
    registerEvents() {
        this.root = this.getEditorElements()[0];

        this.on(this.root,"click", event => {
            if(event.target.tagName === "IMG") {
                this.selectImage(event.target);
            } else {
                this.deselectImage();
            }
        });
    },

    /**
     * Selects an image.
     *
     * @param image
     */
    selectImage(image) {
        this.selectedImage = image;
        this.imageContainer = this.selectedImage.parentElement;

        this.showActionToolbar();
        this.showImageOverlay();
    },

    /**
     * Deselects the image.
     */
    deselectImage: function () {
        this.hideActionToolbar();
        this.hideImageOverlay();

        this.selectedImage = null;
        this.imageContainer = null;
    },

    /**
     * Shows action toolbar.
     */
    showActionToolbar() {
        this.toolbar.style.display = "block";

        this.autoRepositionToolbars();
    },

    /**
     * Hides action toolbar.
     */
    hideActionToolbar() {
        this.toolbar.style.display = "none";
    },

    /**
     * Adds overlay on top of selected image.
     */
    showImageOverlay() {
        this.imageOverlay.style.display = "block";

        this.autoRepositionOverlay();
    },

    /**
     * Hides overlay on top of image.
     */
    hideImageOverlay() {
        this.imageOverlay.style.display = "none";
    },

    /**
     * Creates and appends toolbar to DOM.
     */
    createToolbars() {
        this.toolbar = document.createElement("div");
        this.toolbar.id = "media-selector-toolbar";
        this.toolbar.style.display = "none";

        document.querySelector("body").appendChild(this.toolbar);

        this.toolbar.innerHTML = this.createActionToolbar() + this.createDeleteToolbar();

        this.actionToolbar = this.toolbar.childNodes[0];
        this.deleteToolbar = this.toolbar.childNodes[1];
    },

    /**
     * Creates action toolbar.
     *
     * @returns {*|string}
     */
    createActionToolbar() {
        let actionToolbarTemplate = this.getActionToolbarTemplate();

        return this.buildToolbarFromSkeleton(actionToolbarTemplate,{
            class: "media-selector-action-toolbar",
            hasArrow: true,
        });
    },

    /**
     * Creates delete toolbar.
     *
     * @returns {*|string}
     */
    createDeleteToolbar() {
        let deleteToolbarTemplate = this.getDeleteToolbarTemplate();

        return this.buildToolbarFromSkeleton(deleteToolbarTemplate,{
            class: "media-selector-delete-toolbar"
        });
    },

    /**
     * Builds toolbar from skeleton.
     *
     * @param toolbarTemplate
     * @param options
     * @returns {string}
     */
    buildToolbarFromSkeleton(toolbarTemplate,options) {
        let toolbar = [
            '<div class="media-selector-action-toolbar medium-editor-toolbar medium-editor-toolbar-active',
            (options['class'])?(' ' + options['class']):'',
            (options['hasArrow'])?' medium-toolbar-arrow-under':'',
            '">',
            '<ul class="medium-editor-toolbar-actions">'
        ];

        // Creating list of toolbar buttons.
        for(let key in toolbarTemplate) {
            toolbar.push('<li>' + toolbarTemplate[key].join('') + '</li>');
        }

        // Finalizing toolbar.
        toolbar.push(
            '</ul>',
            '</div>'
        );

        return toolbar.join('');
    },

    /**
     * Returns action toolbar template.
     *
     * @returns {*[]}
     */
    getActionToolbarTemplate() {
        let template = [];

        template.push([
            '<button class="medium-editor-action" title="align left" data-action="alignLeft">',
            (this.getEditorOption('buttonLabels') === 'fontawesome')?'<i class="fa fa-align-left"></i>':'L',
            '</button>'
        ]);

        template.push([
            '<button class="medium-editor-action" title="center" data-action="center">',
            (this.getEditorOption('buttonLabels') === 'fontawesome')?'<i class="fa fa-align-center"></i>':'C',
            '</button>'
        ]);

        template.push([
            '<button class="medium-editor-action" title="align right" data-action="alignRight">',
            (this.getEditorOption('buttonLabels') === 'fontawesome')?'<i class="fa fa-align-right"></i>':'R',
            '</button>'
        ]);

        template.push([
            '<button class="medium-editor-action" title="stretch" data-action="stretch">',
            (this.getEditorOption('buttonLabels') === 'fontawesome')?'<i class="fa fa-expand"></i>':'S',
            '</button>'
        ]);

        template.push([
            '<button class="medium-editor-action" title="original" data-action="original">',
            (this.getEditorOption('buttonLabels') === 'fontawesome')?'<i class="fa fa-compress"></i>':'O',
            '</button>'
        ]);

        return template;
    },

    /**
     * Returns delete toolbar template.
     *
     * @returns {*[]}
     */
    getDeleteToolbarTemplate() {
        return [
            [
                '<button class="medium-editor-action" title="delete" data-action="delete">',
                (this.getEditorOption('buttonLabels') === 'fontawesome')?'<i class="fa fa-close"></i>':'X',
                '</button>'
            ]
        ];
    },

    /**
     * Repositions toolbars automatically.
     */
    autoRepositionToolbars() {
        setInterval(() => {
            this.repositionToolbars();
        },0);
    },

    /**
     * Repositions toolbars.
     */
    repositionToolbars() {
        if(this.selectedImage != null && this.toolbar.style.display !== "none") {
            let imageRect = this.selectedImage.getBoundingClientRect();
            let actionToolbarRect = this.actionToolbar.getBoundingClientRect();
            let deleteToolbarRect = this.deleteToolbar.getBoundingClientRect();

            this.actionToolbar.style.top = imageRect.top - actionToolbarRect.height - 8 + "px";
            this.actionToolbar.style.left = imageRect.left + imageRect.width / 2 - actionToolbarRect.width / 2 + "px";

            this.deleteToolbar.style.top = imageRect.top + "px";
            this.deleteToolbar.style.left = imageRect.left + imageRect.width - deleteToolbarRect.width + "px";
        }
    },

    /**
     * Creates an image overlay.
     */
    createImageOverlay() {
        this.imageOverlay = document.createElement("div");

        this.imageOverlay.className = "media-selector__img-overlay";

        document.querySelector("body").appendChild(this.imageOverlay);
    },

    /**
     * Repositions overlay automatically.
     */
    autoRepositionOverlay() {
        setInterval(() => {
            this.repositionOverlay();
        },0);
    },

    /**
     * Repositions overlay.
     */
    repositionOverlay() {
        if (this.selectedImage != null && this.imageOverlay.style.display !== "none") {
            let imageRect = this.selectedImage.getBoundingClientRect();

            this.imageOverlay.style.left = imageRect.left + "px";
            this.imageOverlay.style.width = imageRect.width + "px";

            this.imageOverlay.style.top = imageRect.top + "px";
            this.imageOverlay.style.height = imageRect.height + "px";
        }
    },

    /**
     * Registers toolbar action events.
     */
    registerToolbarActionEvents() {
        let actionButtons = this.actionToolbar.querySelectorAll("button");
        let deleteButton = this.deleteToolbar.querySelector("button");

        for(let key in actionButtons) {
            this.on(actionButtons[key],"click",(e) => {
                e.cancelBubble = true;

                let actionName = (e.target.getAttribute("data-action") || e.target.parentElement.getAttribute("data-action"));
                this.executeAction(actionName);
            });
        }

        this.on(deleteButton,"click",(e) => {
            this.executeAction(e.target.getAttribute("data-action"));
        });
    },

    /**
     * Executes an action method.
     *
     * @param action
     * @returns {*}
     */
    executeAction(action) {
        let methodName = this.getActionMethodName(action);

        if(methodName !== "" && this[methodName]) {
            this[methodName]();
            this.triggerInput();
        }
    },

    /**
     * Generates an action method name.
     *
     * @param actionName
     * @returns {string}
     */
    getActionMethodName(actionName) {
        if( ! actionName) {
            return "";
        }

        return "action" + actionName.charAt(0).toUpperCase() + actionName.slice(1)
    },

    //
    // Action Methods.
    //

    /**
     * Performs align center action on the selected image.
     */
    actionCenter() {
        this.imageContainer.style.textAlign = "center";
    },

    /**
     * Performs align left action on the selected image.
     */
    actionAlignLeft() {
        this.imageContainer.style.textAlign = "left";
    },

    /**
     * Performs align right action on the selected image.
     */
    actionAlignRight() {
        this.imageContainer.style.textAlign = "right";
    },

    /**
     * Stretches the image to 100%.
     */
    actionStretch() {
        this.selectedImage.style.width = "100%";
    },

    /**
     * Sets the image size to original.
     */
    actionOriginal() {
        this.selectedImage.style.width = "auto";
    },

    /**
     * Deletes the image from the editor.
     */
    actionDelete() {
        this.hideImageOverlay();
        this.hideActionToolbar();

        this.imageContainer.innerHTML = "";

        this.selectedImage = null;
    },

    /**
     * Triggers an editable input event.
     */
    triggerInput() {
        this.trigger("editableInput",null,this.imageContainer);
    }
});