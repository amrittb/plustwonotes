<template>
    <div class="post-editor mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label for="post-editor" class="post-editor__label mdl-textfield__label textfield__label--non-floating">Post Body</label>
        <textarea name="post_body" id="post-editor" class="editor post__body" placeholder="Write here...">
            {{ content }}
        </textarea>
    </div>
</template>

<script>
    import MediumEditor from 'medium-editor';
    import MediumButton from "./MediumEditor/MediumButton";
    import MediumEditorAutoList from './MediumEditor/AutoList';
    import AttributeModifier from './MediumEditor/AttributeModifier';
    import MediaAttachment from "./MediumEditor/MediaAttachment";
    import MediaSelector from "./MediumEditor/MediaSelector";

    import { openMediaAttachment } from "../vuex/actions";

    export default {
        ready() {
            this.initEditor();
            this.hookUpListeners();
        },
        data() {
            return {
                editor: null
            }
        },
        props: {
            content: {
                type: String,
                required: false,
                default: ''
            }
        },
        methods: {

            /**
             * Initializes Editor.
             */
            initEditor() {
                this.editor = new MediumEditor(this.$el.querySelector("#post-editor"),{
                    toolbar: {
                        buttons: [
                            "bold",
                            "italic",
                            "anchor",
                            "h2",
                            "h3",
                            "h4",
                            "quote",
                            "subscript",
                            "superscript",
                            "justifyLeft",
                            "justifyCenter",
                            "justifyRight",
                            "justifyFull",
                            "attribute-modifier",
                            "media-attachment"
                        ]
                    },
                    placeholder: {
                        text: 'Write Here...'
                    },
                    extensions: {
                        'autolist' : new MediumEditorAutoList(),
                        'attribute-modifier' : new AttributeModifier(),
                        'media-attachment' : new MediaAttachment(),
                        "media-selector" : new MediaSelector(),
                    },
                    buttonLabels: 'fontawesome',
                    autoLink: true,
                });
            },

            /**
             * Registers Event listeners.
             */
            hookUpListeners() {
                this.editor.subscribe('editableInput',function(event,editable){
                    this.content = editable.innerHTML;
                }.bind(this));
            }
        },
        vuex: {
            actions: {
                openMediaAttachment
            }
        }
    }
</script>