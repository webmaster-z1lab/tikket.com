<template>
    <input class="form-control"  :name="data.name" :id="data.name" v-validate="validate" :data-vv-as="data.label" v-model.lazy="data.value"/>
</template>

<style>
    .input-vue .flatpickr-months .cur-month, .input-vue .flatpickr-months .cur-year {
        color: #fff;
    }
    .input-vue .numInputWrapper span.arrowUp, .input-vue .numInputWrapper span.arrowDown {
        display: none;
    }
    .input-vue .flatpickr-current-month, .input-vue .flatpickr-prev-month, .input-vue .flatpickr-next-month {
        padding: 0;
    }
    .input-vue .flatpickr-prev-month.flatpickr-prev-month, .input-vue .flatpickr-next-month.flatpickr-prev-month {
        left: .75rem;
    }
    .input-vue .flatpickr-prev-month.flatpickr-next-month, .input-vue .flatpickr-next-month.flatpickr-next-month {
        right: .75rem;
    }
    .input-vue .flatpickr-months {
        position: relative;
        background-color: #377dff;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
        padding: .75rem;
    }
    .input-vue .flatpickr-calendar {
        top: 3.75rem !important;
        left: 0 !important;
        box-shadow: 0 0.375rem 1.5rem 0 rgba(140, 152, 164, 0.125);
    }
    .input-vue .flatpickr-prev-month, .input-vue .flatpickr-next-month {
        top: 50%;
         -webkit-transform: translate(0, -50%);
        transform: translate(0, -50%);
    }
    .input-vue .flatpickr-current-month, .input-vue .flatpickr-prev-month, .input-vue .flatpickr-next-month {
        padding: 0;
    }
    .input-vue .flatpickr-prev-month svg, .input-vue .flatpickr-next-month svg {
        fill: rgba(255, 255, 255, 0.7);
    }
    .input-vue .flatpickr-weekday {
        color: #1e2022;
        text-transform: uppercase;
        font-weight: 500;
    }
    .input-vue .flatpickr-day.prevMonthDay, .input-vue .flatpickr-day.nextMonthDay {
        color: #e7eaf3;
    }
    .input-vue .flatpickr-day {
        color: #1e2022;
        border-color: transparent;
    }
    .input-vue .flatpickr-day {
        color: #1e2022;
        border-color: transparent;
    }
    .input-vue .flatpickr-day.selected {
        color: #377dff;
        background-color: transparent;
        border-color: #377dff;
    }
    .input-vue .flatpickr-day {
        color: #1e2022;
        border-color: transparent;
    }
    .input-vue .flatpickr-day.today {
        color: #fff;
        background-color: #377dff;
    }
    .input-vue .flatpickr-day {
        color: #1e2022;
        border-color: transparent;
    }
</style>

<script>
    import flatpickr from "flatpickr"

    require('flatpickr/dist/flatpickr.min.css');

    const Portuguese = require("flatpickr/dist/l10n/pt.js").default.pt;
    flatpickr.localize(Portuguese);

    export default {
        name: "date-input",
        inject: ['$validator'],
        computed: {
            validate() {
                if (typeof this.data.validate === "string") {
                    return this.data.validate
                } else if (this.data.validate === undefined) {
                    return ''
                } else {
                    return 'required'
                }
            }
        },
        props: {
            data: {
                required: true,
                type: [Array, String, Object]
            }
        },
        updated() {
            flatpickr(`#${this.data.name}`, {
                minDate: this.data.min_date ? this.data.min_date : '',
                maxDate: this.data.max_date ? this.data.max_date : '',
                time_24hr: this.data.time_24hr || true,
                altInput: this.data.altInput || true,
                defaultDate: this.data.value,
                enableTime: this.data.time || false,
                dateFormat: this.data.format || 'Y-m-d'
            });

            for (let element of document.querySelectorAll('.flatpickr-calendar')) {
                element.classList.add('input-vue')
            }
        }
    }
</script>
