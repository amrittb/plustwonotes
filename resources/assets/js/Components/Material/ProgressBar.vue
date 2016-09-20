<template>
    <div class="mdl-progress mdl-js-progress"></div>
</template>

<script>
    export default {
        ready() {
            var self = this;
            this.$el.addEventListener("mdl-componentupgraded",function() {
                this.MaterialProgress.setProgress(self.progress);
            });

        },
        data() {
            return {
                progress : 0,
                progressBarUpdateEvent: new Event("mdl-componentupgraded")
            };
        },
        events: {

            /**
             * Updates Progressbar.
             *
             * @param val
             * @constructor
             */
            "ProgressBar.Update": function(val) {
                this.progress = val;
                this.$el.dispatchEvent(this.progressBarUpdateEvent);
            }
        }
    }
</script>