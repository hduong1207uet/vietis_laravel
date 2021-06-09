<template>
    <div>
        <h2>Component con</h2>
        <button v-on:click="childPlus"> Parent val: {{ parentCount }}</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            childCount : 0,
        }
    },

    computed: {
        getParentCount : {
            get() {
                return this.parentCount
            },
            set(val) {
                return val
            }
        }
    },

    props: ['parentCount'],

    methods: {
        childPlus : function () {
            // let val = '1998'
            this.$emit('plusToParent', 1998, 'LD')
        }
    }
}
</script>