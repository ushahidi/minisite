<template>
<div class="reorder">
    <input type="text" id="reordered" v-model="reordered" name="reordered" style="visibility:hidden">

    <ul class="mdc-list reorder-list">
        <li  v-bind:key="item.id" v-for="(item, index) in items" class="mdc-list-item" tabindex="0">
            <span class="mdc-list-item__text">
                {{ item.name }}
            </span>
            <div class="reorder-buttons">
                <button type="button" class="mdc-button mdc-button--raised theme-neutral-bg theme-black" @click="move(index,index-1)" :disabled="index==0">
                    <div class="mdc-button__ripple"></div>
                    <span class="mdc-button__label">Up</span>
                </button>
                <button type="button" class="mdc-button mdc-button--raised theme-neutral-bg"  @click="move(index,index+1)"  :disabled="index==(items.length-1)">
                    <div class="mdc-button__ripple"></div>
                    <span class="mdc-button__label">Down</span>
                </button>
            </div>
        </li>
    </ul>
</div>
</template>
<style lang="css"  scoped>
p {
    margin-left: 20px;
    font-weight: bold;
}

button {
    color: green;
    height: 2em;
    width: 2em;
}

button[disabled] {
    color: red;
    cursor: not-allowed;
}
</style>

<script>
// Going to use this neat array function
Array.prototype.move = function(from, to) {
    this.splice(to, 0, this.splice(from, 1)[0]);
    return this;
};

export default {
    name: 'reorder',
    props: {
        blocks: {
            type: Array,
            required: true
        },
    },
    data(){
        return {
            items: this.blocks,
            reordered: JSON.stringify(this.items)
        }
    },
    methods: {
        move(from, to) {
            this.items.move(from, to);
            this.reordered = JSON.stringify(this.items);
        }
    }
};
</script>