<template>
<div class="edit-block">
    <form  @submit.prevent="submit" >
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-select">
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
        </div>
        <div class="mdc-layout-grid__cell--span-12" v-for="blockField in blockFields.filter(b => b.block_type === selectedBlockType)" :key="blockField.id" >
            <label class="col-md-4 col-form-label text-md-right" v-if="blockField.block_type === selectedBlockType" :for="blockField.name">{{ $I18n.trans(`block.${blockField.name}`) }}</label >
            <div class="mdc-text-field"
                v-if="blockField.block_type === selectedBlockType && blockField.html_element_type=='text' && blockField.html_element==='input'"
            >
                <input 
                    v-model="fields.blockFields[blockField.id]"
                    v-if="blockField.block_type === selectedBlockType && blockField.html_element_type=='text' && blockField.html_element==='input'"
                    type="text"
                    class="mdc-text-field__input"
                    required autofocus
                />
                <div class="mdc-line-ripple"></div>
                <!-- @change Missing label for= -->
                <label class="mdc-floating-label">{{selectedBlockType.name}}</label>
            </div>
            <textarea 
                v-model="fields.blockFields[blockField.id]"
                aria-labelledby="description"
                v-if="blockField.block_type === selectedBlockType && blockField.html_element=='textarea' && fields.name !== 'Free form'"
                class="mdc-text-field__input"
                required autofocus
            ></textarea>                       
            <div class="mdc-notched-outline"
                v-if="blockField.block_type === selectedBlockType && blockField.html_element=='textarea' && fields.name !== 'Free form'"
            >
                <div class="mdc-notched-outline__leading"></div>
                <div class="mdc-notched-outline__notch" style="">
                    <span class="mdc-floating-label" id="description">{{selectedBlockType.description}}</span>
                </div>
                <div class="mdc-notched-outline__trailing"></div>
            </div>

            <div class="editor" v-if="blockField.block_type === selectedBlockType && blockField.html_element=='textarea' && fields.name == 'Free form'">
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
        <div class="mdc-layout-grid__cell--span-12">
            <label for="visibility" class="col-md-4 col-form-label text-md-right"> {{ $I18n.trans('block.selectVisibility') }} </label>
            <div class="col-md-6">
                <select v-model="fields.visibility" name="visibility" id="visibility" class="form-control" required autofocus>
                    <option value="">--{{ $I18n.trans('minisite.selectVisibility') }}--</option>
                    <option :selected="block && 'community members' === block.visibility" value="community members">{{ $I18n.trans('block.community members') }}</option>
                    <option :selected="block && 'public'=== block.visibility" value="public">{{ $I18n.trans('block.public') }}</option>
                </select>
                <span v-if="errors && errors.visibility" class="invalid-feedback" role="alert">
                    <strong>{{ errors.visibility[0] }}</strong>
                </span>
            </div>
        </div>
        <div class="mdc-layout-grid__cell--span-4">
            <div class="button-group">
                <div class="mdc-layout-grid__inner">
                    <div class="grid-cell">
                        <button type="submit" class="mdc-button mdc-button--raised theme-secondary-bg">
                            <div class="mdc-button__ripple"></div>
                            <span class="mdc-button__label">{{ $I18n.trans('block.save') }}</span>
                        </button>
                    </div>
                    <div class="grid-cell">
                        <button disabled class="mdc-button mdc-button--raised theme-neutral-bg">
                            <div class="mdc-button__ripple"></div>
                            <span class="mdc-button__label">{{ $I18n.trans('block.delete') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
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
                    position: 1, //@todo change this once we have block sorting,
                    enabled: 1, //@todo change this when we have enabled/disabled blocks again
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
                let submittable = axios.post;
                let success = 'Block created';
                let url = '/blockmanager/' + this.minisiteSlug + '/block';
                if (this.method === 'PUT') {
                    submittable = axios.put;
                    url = '/blockmanager/' + this.minisiteSlug + '/block/' + this.block.id;
                    success = 'Block updated';
                }
                submittable(url, this.fields).then(response => {
                    // @TODO: add flash/ok message in the minisite view to send back the feedback
                    window.location	= '/blockmanager/' + this.minisiteSlug + '/edit'
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