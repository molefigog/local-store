@php $editing = isset($owner) @endphp

<div class="row">
    <x-inputs.group class="col-sm-6">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $owner->email : ''))"
            maxlength="255"
            placeholder="Email"
            :required="!$editing"
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-6">
        <x-inputs.text
            name="whatsapp"
            label="Whatsapp"
            :value="old('whatsapp', ($editing ? $owner->whatsapp : ''))"
            maxlength="255"
            placeholder="eg. 26659073443"
            :required="!$editing"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-6">
        <x-inputs.text
            name="facebook"
            label="Facebook"
            :value="old('facebook', ($editing ? $owner->facebook : ''))"
            maxlength="255"
            placeholder="Facebook"
            :required="!$editing"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-6">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $owner->address : ''))"
            maxlength="255"
            placeholder="Address"
            :required="!$editing"
        ></x-inputs.text>
    </x-inputs.group>
</div>
