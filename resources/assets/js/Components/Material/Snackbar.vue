<template>
    <div class="mdl-js-snackbar mdl-snackbar">
        <div class="mdl-snackbar__text"></div>
        <button class="mdl-snackbar__action" type="button"></button>
    </div>
</template>

<script>
    export default {
        events: {

            /**
             * Shows success message.
             *
             * @param message
             * @constructor
             */
            "Snackbar.ShowSuccess": function(message) {
                this.showSnackbar({ message });
            },

            /**
             * Shows error message.
             *
             * @param message
             * @constructor
             */
            "Snackbar.ShowError": function(message) {
                this.showSnackbar({ message });
            }
        },
        methods: {

            /**
             * Displays snackbar.
             *
             * @param data
             */
            showSnackbar(data) {
                this.$el.MaterialSnackbar.showSnackbar(data);
            }
        }
    }
</script>