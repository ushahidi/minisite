<template>
<form @submit.prevent="submit">
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right"> Name </label>

    <div class="col-md-6">
        <input id="name" v-model="fields.name" type="text" class="form-control" name="name" required autofocus>
        <span v-if="errors && errors.name" class="invalid-feedback" role="alert">
            <strong>{{ errors.name[0] }}</strong>
        </span>
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-right"> Description</label>

    <div class="col-md-6">
        <input id="description" v-model="fields.description" type="text" class="form-control" name="description" required autofocus>
        <span v-if="errors && errors.description" class="invalid-feedback" role="alert">
            <strong>{{ errors.description[0] }}</strong>
        </span>
    </div>
</div>
<div style="background-color:aliceblue; padding: 10px; margin-bottom:10px; margin-top:10px;" class="full">
    <div class="form-group row">
        <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
        <div class="col-md-6">
            <select @change="onBlockSelect($event)" name="type" id="type" class="form-control" v-model="selectedBlockType" required autofocus>
                <option value="">--Please choose a block type--</option>                
                <option v-for="blockType in blockTypes" :key="blockType.id" :value="blockType.id">
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
            <option value="neighbors">neighbors</option>
            <option value="public">public</option>
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
        props: ['blockTypes','blockFields'],
        data: () => {
            return {
                fields: {
                    type: '',
                    blockFields: {}
                },
                errors: {},
                selectedBlockType: '',
                selectedFieldTypes: []
            }
        },
        methods: {
            onBlockSelect(event) {
                this.selectedFieldTypes = [];
                this.fields.blockFields = {};
                this.fields.type = event.target.value;
            },
            submit() {
                this.errors = {};
                axios.post('/minisite/peninsula/block', this.fields).then(response => {
                    alert('Message sent!');
                }).catch(error => {
                    if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                    }
                });
            },
        },
    }
</script>
