<template>
    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect"
           for="{{ id }}" >
        <input type="checkbox"
               id="{{ id }}"
               name="{{ name }}"
               value="{{ value }}"
               @click="onClick"
               class="mdl-checkbox__input"
               :disabled="isDisabled"
        />
        <span class="mdl-checkbox__label">{{ label }}</span>
    </label>
</template>

<script>
    export default {
        ready() {
            this.checkbox =  new window.MaterialCheckbox(this.$el);

            this.setCheckboxState(this.checked);
        },
        props: {

            /**
             * Id of the checkbox.
             *
             * @type {String}
             */
            id: {
                type: String,
                required: true
            },

            /**
             * Name of the checkbox.
             *
             * @type {String}
             */
            name: {
                type: String,
                required: false,
                default: 'checkbox'
            },

            /**
             * Value for the checkbox.
             */
            value: {
                required: true
            },

            /**
             * Label for the checkbox.
             *
             * @type {String}
             */
            label: {
                type: String,
                required: false,
                default: 'Checkbox'
            },

            /**
             * Boolean to determine if the checkbox is checked.
             *
             * @type {Boolean}
             */
            checked: {
                type: Boolean,
                required: false,
                default: false
            },

            /**
             * Boolean to determine if the checkbox is disabled.
             *
             * @type {Boolean}
             */
            isDisabled: {
                type: Boolean,
                required: false,
                default: false
            }
        },
        data() {
            return {

                /**
                 * Mdl Checkbox instance.
                 *
                 * @type {Object}
                 */
                checkbox: {},
            };
        },
        watch: {

            /**
             * Watcher for 'checked' prop.
             *
             * @param val
             */
            checked : function(val) {
                this.setCheckboxState(val);
            }
        },
        methods: {

            /**
             * Event Handler when the checkbox is clicked.
             */
            onClick() {
                this.$dispatch("Checkbox.Clicked",{
                    id: this.id,
                    value: this.value,
                    isChecked: this.isChecked()
                });
            },

            /**
             * Checks if the checkbox is checked.
             *
             * @returns {*}
             */
            isChecked() {
                return this.checkbox.inputElement_.checked;
            },

            /**
             * Sets the checkbox's state.
             *
             * @param state
             */
            setCheckboxState(state) {
                if(state && !this.isChecked()) {
                    this.check();
                } else if(!state && this.isChecked()){
                    this.unCheck();
                }
            },

            /**
             * Checks the checkbox.
             */
            check() {
                this.checkbox.check();
            },

            /**
             * Unchecks the checkbox.
             */
            unCheck() {
                this.checkbox.uncheck();
            }
        }
    }
</script>
