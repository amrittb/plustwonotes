<template>
    <div class="post-editor mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label for="post-editor" class="post-editor__label mdl-textfield__label textfield__label--non-floating">Post Body</label>
        <medium-editor id="post-editor" name="post_body mdl-textfield__input" :content="content"></medium-editor>
    </div>
</template>

<script>
    export default {
        props: {
            content: {
                type: String,
                required: false,
                default: ''
            }
        }
    }


</script>