<template>
<div>
    <div class="form-group row">
         <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
        <div class="col-md-6">
            <select @change="onBlockSelect($event)" name="type" id="type" class="form-control" v-model="selectedBlockType" required autofocus>
                <option value="">--Please choose a block type--</option>                
                <option v-for="blockType in types" :key="blockType.id" :value="blockType.id">
                    {{blockType.id}}
                </option> 
            </select>
        </div>
    </div>
    <label for="content" class="col-md-4 col-form-label text-md-right">Fields</label>
    <div class="form-group row">
        <div class="col-md-6">
            <div v-for="blockField in fields" :key="blockField.id" >
                <label v-if="blockField.block_type === selectedBlockType" :for="blockField.name">{{blockField.name}}</label >

                <input 
                    v-if="blockField.block_type === selectedBlockType && blockField.html_element_type=='text' && blockField.html_element==='input'"
                    type="text"
                    class="form-control"
                    required autofocus
                >
                <textarea 
                    v-if="blockField.block_type === selectedBlockType && blockField.html_element=='textarea'"
                    class="form-control"
                    required autofocus
                ></textarea>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['types','fields'],
        data: () => {
            return {
                selectedBlockType: '',
                selectedFieldTypes: []
            }
        },
        methods: {
            onBlockSelect(event) {
                this.selectedFieldTypes = []
            }
        }
    }
</script>
