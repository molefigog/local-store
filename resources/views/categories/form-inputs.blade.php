@php $editing = isset($category) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $category->title : ''))"
            maxlength="255"
            placeholder="Title"
            :required="!$editing"
        ></x-inputs.text>
    </x-inputs.group>
</div>
