import MediumEditor from 'medium-editor';
import { openMediaAttachment } from "../../vuex/actions";
import { ATTACHMENT_MODE_EDITOR } from "../../constants";

export default MediumEditor.extensions.button.extend({

    /**
     * Name of the extension
     */
    name: 'media-attachment',

    /**
     * Default content
     */
    contentDefault: '<b>Attach</b>',

    /**
     * Font awesome content
     */
    contentFA: '<i class="fa fa-paperclip"></i>',

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

        this.selection.addEventListener("MediaAttacher.attachImage",this.updateDOM.bind(this));

        openMediaAttachment(window.app,{
            mode: ATTACHMENT_MODE_EDITOR,
            selection: this.selection,
        });

        return false;
    },

    /**
     * Updates DOM based upon the attachment.
     *
     * @param e
     */
    updateDOM(e) {
        e.target.innerHTML = "<img src='" + event.detail.getFullUrl() + "' >";

        this.trigger('editableInput',{},e.target);

        this.selection.removeEventListener("MediaAttacher.attachImage",this.updateDom);
    }
});