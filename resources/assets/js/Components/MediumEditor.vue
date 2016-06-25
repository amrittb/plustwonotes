<template>
    <textarea name="{{ name }}" id="{{ id }}" class="editor post__body" placeholder="Write here...">{{ content }}</textarea>
</template>

<script>
    import MediumEditor from 'medium-editor';
    import MediumEditorAutoList from './MediumEditor/AutoList';
    import AttributeModifier from './MediumEditor/AttributeModifier';

    export default {
        ready() {
            this.editor = new MediumEditor(this.$el,{
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
                        "attributeModifier"
                    ]
                },
                placeholder: {
                    text: 'Write Here...'
                },
                extensions: {
                    'autolist' : new MediumEditorAutoList(),
                    'attributeModifier' : new AttributeModifier()
                }
            });

            this.editor.subscribe('editableInput',function(event,editable){
                this.content = editable.innerHTML;
            }.bind(this));
        },
        data() {
            return {
                editor: {}
            }
        },
        props: {
            name: {
                type: String,
                required: false,
                default: ''
            },
            id: {
                type: String,
                required: false,
                default: ''
            },
            content: {
                type: String,
                required: false,
                default: ''
            }
        }
    }
</script>
