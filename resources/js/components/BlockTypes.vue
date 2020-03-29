<template>

<form  @submit.prevent="submit" >
    
<div style="background-color:aliceblue; padding: 10px; margin-bottom:10px; margin-top:10px;" class="full">
    <div class="form-group row">
        <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
        <div class="col-md-6">
            <select @change="onBlockSelect($event)" name="type" id="type" class="form-control" v-model="selectedBlockType" required autofocus>
                <option value="">--{{ $I18n.trans('block.chooseBlockType') }}--</option>                
                <option :selected="blockType.id === fields.type" v-for="blockType in blockTypes" :key="blockType.id" :value="blockType.id">
                    {{ $I18n.trans(`block.${blockType.id}`) }}
                </option> 
            </select>
        </div>
    </div>
    <span v-for="blockField in blockFields" :key="blockField.id" >
        <div  class="form-group row" v-if="blockField.block_type === selectedBlockType">
            <label class="col-md-4 col-form-label text-md-right" v-if="blockField.block_type === selectedBlockType" :for="blockField.name">{{ $I18n.trans(`block.${blockField.name}`) }}</label >
            <div class="col-md-6" >
                    <input 
                        v-model="fields.blockFields[blockField.id]"
                        v-if="blockField.block_type === selectedBlockType && blockField.html_element_type=='text' && blockField.html_element==='input'"
                        type="text"
                        class="form-control"
                        required autofocus
                    >
                    <div class="editor" v-if="blockField.block_type === selectedBlockType && blockField.html_element=='textarea'">
                        <input style="visibility: hidden" id="editorBlockFieldId" type="text" v-model="fields.blockFields[blockField.id]" value="Active"/>
                        {{blockField.id}}
                        <editor
                            v-if="blockField.block_type === selectedBlockType && blockField.html_element=='textarea'"
                            @update="setContent"
                            v-bind:initialContent="fields.blockFields[blockField.id]"
                            v-bind:activeButtons="[
                                'bold',
                                'italic',
                                'strike',
                                'underline',
                                'code',
                                'paragraph',
                                'h1',
                                'h2',
                                'h3',
                                'bullet_list',
                                'ordered_list',
                                'blockquote',
                                'code_block',
                                'horizontal_rule',
                                'undo',
                                'redo'
                            ]"
                        />
                    </div>
            </div>
        </div>
    </span>
</div>
<div class="form-group row">
    <label for="visibility" class="col-md-4 col-form-label text-md-right"> {{ $I18n.trans('block.selectVisibility') }} </label>

    <div class="col-md-6">
        <select v-model="fields.visibility" name="visibility" id="visibility" class="form-control" required autofocus>
            <option value="">--{{ $I18n.trans('minisite.selectVisibility') }}--</option>
            <option :selected="block && 'neighbors' === block.visibility" value="neighbors">{{ $I18n.trans('block.neighbors') }}</option>
            <option :selected="block && 'public'=== block.visibility" value="public">{{ $I18n.trans('block.public') }}</option>
        </select>
        <span v-if="errors && errors.visibility" class="invalid-feedback" role="alert">
            <strong>{{ errors.visibility[0] }}</strong>
        </span>
    </div>
</div>
<div class="form-group row">
    <label for="position" class="col-md-4 col-form-label text-md-right"> {{ $I18n.trans('block.position') }} </label>

    <div class="col-md-6">
        <input id="position" v-model="fields.position" type="number" class="form-control" name="position" required autofocus>
        <span v-if="errors && errors.position" class="invalid-feedback" role="alert">
            <strong>{{ errors.position[0] }}</strong>
        </span>
    </div>
</div>
<div class="form-group row">
    <label for="enabled[]" class="col-md-4 col-form-label text-md-right"> {{ $I18n.trans('block.enabled') }} </label>

    <div class="col-md-6">
        <input v-model="fields.enabled" id="enabled" type="checkbox" class="form-control" name="enabled[]" required autofocus>
        <span v-if="errors && errors.enabled" class="invalid-feedback" role="alert">
            <strong>{{ errors.enabled[0] }}</strong>
        </span>
    </div>
</div>
<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary" v-on:click.capture="submit">
            {{ $I18n.trans('block.save') }}
        </button>
    </div>
</div>
</form>
</template>

<script>
    import Editor from './tiptap/index.js'

    export default {
        components: {
            Editor
        },
        beforeDestroy() {
            this.editor.destroy()
        },
        mounted() {
            console.log('Component mounted.')
        },
        props: ['blockTypes','blockFields', 'minisiteSlug', 'method', 'block'],
        data: function () {
            return {
                editorContent: '',
                editor: null,
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
            setContent(content) {
                this.editorContent = content;
            },
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
            getFreeformContentFieldId() {
                const blockField = this.blockFields.find(blockField => this.fields.name === blockField.block_type && blockField.name === 'Content' );
                return blockField.id;
            },
            submit($event) {
                if (this.fields.name === 'Free form') {
                    this.fields.blockFields[this.getFreeformContentFieldId().toString()] = this.editorContent;
                }
                
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


<style lang="scss">
.editor {
  align-items: center;
  color: #333;
}
</style>