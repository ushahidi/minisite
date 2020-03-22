<template>
<div style="background-color:aliceblue; padding: 10px; margin-bottom:10px; margin-top:10px;" class="full">
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
    <div class="form-group row" v-for="blockField in fields" :key="blockField.id" >
        <label class="col-md-4 col-form-label text-md-right" v-if="blockField.block_type === selectedBlockType" :for="blockField.name">{{blockField.name}}</label >
        <div class="col-md-6">
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
