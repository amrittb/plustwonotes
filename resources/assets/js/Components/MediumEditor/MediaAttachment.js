import MediumEditor from 'medium-editor';
import { openMediaAttachment } from "../../vuex/actions";

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

        openMediaAttachment(window.app,this.selection);

        return false;
    },

    /**
     * Updates DOM based upon the attachment.
     *
     * @param e
     */
    updateDOM(e) {
        e.target.innerHTML = "<img src='" + event.detail.publicUrl + "' >";

        this.trigger('editableInput',{},e.target);

        this.selection.removeEventListener("MediaAttacher.attachImage",this.updateDom);
    }
});