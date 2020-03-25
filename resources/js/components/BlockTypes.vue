<template>
<form @submit.prevent="submit">

<div style="background-color:aliceblue; padding: 10px; margin-bottom:10px; margin-top:10px;" class="full">
    <div class="form-group row">
        <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
        <div class="col-md-6">
            <select @change="onBlockSelect($event)" name="type" id="type" class="form-control" v-model="selectedBlockType" required autofocus>
                <option value="">--Please choose a block type--</option>                
                <option :selected="blockType.id === fields.type" v-for="blockType in blockTypes" :key="blockType.id" :value="blockType.id">
                    {{blockType.id}}
                </option> 
            </select>
        </div>
    </div>
    <div class="form-group row" v-for="blockField in blockFields" :key="blockField.id" >
        <label class="col-md-4 col-form-label text-md-right" v-if="blockField.block_type === selectedBlockType" :for="blockField.name">{{blockField.name}}</label >
        <div class="col-md-6">
                <input 
                    v-model="fields.blockFields[blockField.id]"
                    v-if="blockField.block_type === selectedBlockType && blockField.html_element_type=='text' && blockField.html_element==='input'"
                    type="text"
                    class="form-control"
                    required autofocus
                >
                <textarea 
                    v-model="fields.blockFields[blockField.id]"
                    v-if="blockField.block_type === selectedBlockType && blockField.html_element=='textarea'"
                    class="form-control"
                    required autofocus
                ></textarea>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="visibility" class="col-md-4 col-form-label text-md-right"> Visibility </label>
    
    <div class="col-md-6">
        <select v-model="fields.visibility" name="visibility" id="visibility" class="form-control" required autofocus>
            <option value="">--Please choose a visibility level--</option>
            <option :selected="'neighbors' === block.visibility" value="neighbors">neighbors</option>
            <option :selected="'public'=== block.visibility" value="public">public</option>
        </select>
        <span v-if="errors && errors.visibility" class="invalid-feedback" role="alert">
            <strong>{{ errors.visibility[0] }}</strong>
        </span>
    </div>
</div>
<div class="form-group row">
    <label for="position" class="col-md-4 col-form-label text-md-right"> Position </label>

    <div class="col-md-6">
        <input id="position" v-model="fields.position" type="number" class="form-control" name="position" required autofocus>
        <span v-if="errors && errors.position" class="invalid-feedback" role="alert">
            <strong>{{ errors.position[0] }}</strong>
        </span>
    </div>
</div>
<div class="form-group row">
    <label for="enabled[]" class="col-md-4 col-form-label text-md-right"> Enabled </label>

    <div class="col-md-6">
        <input v-model="fields.enabled" id="enabled" type="checkbox" class="form-control" name="enabled[]" required autofocus>
        <span v-if="errors && errors.enabled" class="invalid-feedback" role="alert">
            <strong>{{ errors.enabled[0] }}</strong>
        </span>
    </div>
</div>
<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </div>
</div>
</form>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['blockTypes','blockFields', 'minisiteSlug', 'method', 'block'],
        data: function () {
            return {
                fields: {
                    type: '',
                    blockFields: this.block ? JSON.parse(this.block.content) : {},
                    ...this.block 
                },
                errors: {},
                selectedBlockType: this.block ? this.block.type : '',
                selectedFieldTypes: []
            }
        },
        methods: {
            onBlockSelect(event) {
                this.selectedFieldTypes = [];
                this.fields.blockFields = {};
                this.fields.type = event.target.value;
                /**
                 * Since I wasn't sure if I wanted a block name and desc for potential needs in the future
                 * for now we autofill those based on blockType.
                 */
                this.fields.name = event.target.value;
                this.fields.description = this.blockTypes.find((blockType) => blockType.id === event.target.value).description;

            },
            submit() {
                this.errors = {};
                let submit = axios.post;
                let success = 'Block created';
                let url = '/minisite/' + this.minisiteSlug + '/block';
                if (this.method === 'PUT') {
                    submit = axios.put;
                    url = '/minisite/' + this.minisiteSlug + '/block/' + this.block.id;
                    success = 'Block updated';
                }
                submit(url, this.fields).then(response => {
                    // @TODO: add flash/ok message in the minisite view to send back the feedback
                    window.location	= '/neighborhood'
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            },
        },
    }
</script>
