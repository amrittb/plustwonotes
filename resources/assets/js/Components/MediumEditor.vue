<template>
    <textarea name="{{ name }}" id="{{ id }}">{{ content }}</textarea>
</template>


<script>
    import MediumEditor from 'medium-editor';

    export default {
        ready() {
            this.editor = new MediumEditor(this.$el);
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