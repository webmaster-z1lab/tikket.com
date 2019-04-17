<template>
    <div>
        <div class="js-focus-state input-group u-form u-form--no-addon-brd">
            <input type="text" name="typeahead"  :class="classInput" :placeholder="placeholder" v-validate="validate" v-model="query"
                   @keydown.down="down"
                   @keydown.up="up"
                   @keyup.enter="hit"
                   @blur="reset"
                   @keydown.esc="resetFull">

            <div class="input-group-append u-form__append">
            <span class="input-group-text u-form__text">
                <span class="u-form__text-inner" :class="iconInput"></span>
            </span>
            </div>
        </div>

        <ul id="ul-typeaheader" tabindex="0" class="ui-menu ui-widget ui-widget-content ui-autocomplete ui-front" v-show="hasItems" style="">
            <li class="ui-menu-item item_text" v-for="(item, key) in items" @mousedown="hit"
                @mousemove="setActive(key)" :class="activeClass(key)">
                <span class="hd-doc-search__label" v-html="highlight(`${item.nome} - ${item.microrregiao.mesorregiao.UF.sigla}`)"></span>
            </li>
        </ul>
    </div>
</template>

<style>
    .input-group-text.u-form__text {
        border-top-right-radius: 0.25rem !important;
        border-bottom-right-radius: 0.25rem !important;
    }
    #ul-typeaheader {
        width: 100%;
        list-style-type: none;
        margin-bottom: 1px;
        position: absolute;
        background-color: white;
    }

    ul li, ol li, p, table {
        font-size: .9375rem;
    }

    .item_text {
        font-size: 0.875rem;
        color: #77838f;
        text-align: inherit;
    }

    .ui-autocomplete {
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
        padding-bottom: 1px;
        padding-left: 0;
        z-index: 91199;
    }

    .ui-autocomplete .left {
        float: left;
    }

    .ui-autocomplete .right {
        float: right;
    }

    .ui-autocomplete .ui-menu-item {
        padding: 0.425rem 1.25rem;
    }

    .ui-autocomplete .ui-menu-item:not(:last-child) {
        border-bottom: 1px solid #e7eaf3;
    }

    .ui-autocomplete .ui-menu-item-wrapper {
        display: block;
        color: inherit;
        background-color: transparent;
        border-color: transparent;
    }

    .ui-widget.ui-widget-content {
        border: thin solid #e7eaf3;
        box-shadow: 0 2px 16px 3px rgba(140, 152, 164, 0.135);
    }

    .ui-autocomplete .ui-menu-item-wrapper.ui-state-active, .ui-autocomplete .ui-menu-item-wrapper:hover {
        background-color: #377dff;
        color: white !important;
        text-decoration: none;
    }

    .ui-autocomplete .ui-menu-item:hover .ui-menu-item-wrapper {
        background-color: #377dff;
        border-color: transparent;
    }

    .ui-autocomplete-category {
        padding: 5px 15px;
        margin: 0;
        font-weight: bold;
    }

    .jvectormap-container {
        width: 100%;
        height: 100%;
    }

    .hd-doc-search__category {
        display: block;
        color: #377dff;
    }

    .ui-autocomplete-input.form-control:not(:last-child) {
        border-top-right-radius: .125rem;
        border-bottom-right-radius: .125rem;
    }
</style>

<script>
    import {getCounties} from "../vendor/api";

    export default {
        name: "Typeahead",
        inject: ['$validator'],
        data: () => ({
            data: [],
            items: [],
            query: '',
            current: -1
        }),
        props: {
            classInput: {
                default: 'form-control u-form__input',
                type: String
            },
            iconInput: {
                default: 'fa fa-map-marker-alt',
                type: String
            },
            validate: {
                default: '',
                type: String
            },
            placeholder: {
                default: '',
                type: String
            },
            value: {
                default: '',
                type: String
            }
        },
        watch: {
            query(value) {
                if (!_.isEmpty(value)) {
                    let collection = collect(this.data)

                    this.items = collection.filter((value, key) => value.nome.search(new RegExp(this.query, "i")) !== -1).all()
                    this.current = -1
                } else {
                    this.items = []
                }
            },
            value(value) {
                if (!_.isEmpty(value)) {
                    this.query = value
                    this.$emit('value', this.query)
                }
            }
        },
        computed: {
            hasItems() {
                return this.items.length > 0
            },
            isEmpty() {
                return !this.query
            },
            highlight() {
                return (text) => {
                    text = sanitize(text)
                    if (this.query.length === 0) {
                        return text
                    }
                    const re = new RegExp(this.escapedQuery, 'gi')

                    return text.replace(re, `<strong>$&</strong>`)
                }
            },
            escapedQuery() {
                return escapeRegExp(sanitize(this.query))
            }
        },
        methods: {
            resetFull() {
                this.current = -1
                this.items = []
                this.query = ''
            },
            reset() {
                this.current = -1
                this.items = []
            },
            setActive(index) {
                this.current = index
            },
            activeClass(index) {
                return {
                    'ui-menu-item-wrapper ui-state-active': this.current === index
                }
            },
            hit() {
                if (this.current !== -1) {
                    let item = this.items[this.current]
                    this.query = `${item.nome} - ${item.microrregiao.mesorregiao.UF.sigla}`
                    this.reset()

                    this.$emit('value', this.query)
                }
            },
            up() {
                if (this.current > 0) {
                    this.current--
                } else if (this.current === -1) {
                    this.current = this.items.length - 1
                } else {
                    this.current = -1
                }
            },
            down() {
                if (this.current < this.items.length - 1) {
                    this.current++
                } else {
                    this.current = -1
                }
            }
        },
        mounted() {
            if (!_.isEmpty(this.value)) {
                this.query = this.value
                this.$emit('value', this.query)
            }

            getCounties().then(response => this.data = response.data)
        }
    }

    function sanitize(text) {
        return text.replace(/</g, '&lt;').replace(/>/g, '&gt;')
    }

    function escapeRegExp(str) {
        return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')
    }
</script>
