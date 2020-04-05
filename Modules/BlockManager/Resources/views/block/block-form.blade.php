    
@foreach ($fields as $field)
    {{-- blockField.block_type === selectedBlockType && blockField.html_element_type=='text' && blockField.html_element==='input' --}}
    @if ($field->html_element_type=='text' && $field->html_element==='input')
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-text-field">
                <input value="{{$blockFields ? $blockFields->{$field->id} : ''}}" name="fields[{{$field->id}}]" class="mdc-text-field__input" required>
                <div class="mdc-line-ripple"></div>
                <label for="community-name" class="mdc-floating-label">{{$field->name}}</label>
            </div>
        </div>
    @endif
    @if ($field->html_element==='textarea' && $field->block_type !== 'Free form')
    <div class="mdc-layout-grid__cell--span-12">

        {{-- @change read rules of field <div class="mdc-text-field-character-counter">0 / 200</div> --}}
        {{-- @change ids and aria-labelledby="description" should be dynamic or it won't work with multiple text areas --}}
        {{-- @change  maxlength="200" should be dynamic by form field rules --}}
        <div class="mdc-text-field text-field mdc-text-field--fullwidth mdc-text-field--no-label mdc-text-field--textarea">
            {{-- <div class="mdc-text-field-character-counter">0 / 200</div> --}}
            <textarea name="fields[{{$field->id}}]" class="mdc-text-field__input" rows="6"
                cols="40" required></textarea>
            <div class="mdc-notched-outline">
                <div class="mdc-notched-outline__leading"></div>
                <div class="mdc-notched-outline__notch" style="">
                    <span class="mdc-floating-label">{{$field->name}}</span>
                </div>
                <div class="mdc-notched-outline__trailing"></div>
            </div>
        </div>
    </div>
    @endif
    @if ($field->html_element==='textarea' && $field->block_type === 'Free form')
        <div class="mdc-layout-grid__cell--span-12">
            <div class="editor">
                <editor
                    initial-content='{{$initialContent}}'
                    :active-buttons="[
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
                <input type="text" style="visibility:hidden" value="{{$field->id}}" name="free_form_content_field_id"/>
            </div>
        </div>
    @endif

@endforeach

<div class="mdc-layout-grid__cell--span-12">
    <div class="">
        <select name="visibility" id="visibility" class="form-control @error('visibility') is-invalid @enderror" required>
            <option value="">--@lang('minisite.selectVisibility')--</option>
            <option selected value="community">@lang('minisite.visibleTo.communityMembers')</option>
            <option value="public">@lang('minisite.visibleTo.public')</option>
        </select>
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<input type="text" value="{{$blockType->id}}" name="name" style="visibility:hidden">
<input type="text" value="{{$blockType->id}}" name="type" style="visibility:hidden">
<input type="text" value="1" name="enabled" style="visibility:hidden">
<input type="text" value="1" name="position" style="visibility:hidden">