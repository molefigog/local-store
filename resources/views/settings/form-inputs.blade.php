@php $editing = isset($setting) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="site"
            label="Site"
            :value="old('site', ($editing ? $setting->site : ''))"
            maxlength="255"
            placeholder="Site"
            :required="!$editing"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            :required="!$editing"
        >{{ old('description', ($editing ? $setting->description : '')) }}</x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="tagline"
            label="Tagline"
            :value="old('tagline', ($editing ? $setting->tagline : ''))"
            maxlength="255"
            placeholder="Tagline"
            :required="!$editing"
        ></x-inputs.text>
    </x-inputs.group>

    <div class="col-sm-12">
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control-file" accept="image/png, image/jpeg">
            
            <!-- Show the image -->
            @if ($editing && $setting->image)
                <img src="{{ \Storage::url($setting->image) }}" class="d-block rounded" height="50" width="70">
            @else
                <p>No image available.</p>
            @endif
            
            @error('image') @include('components.inputs.partials.error') @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" name="logo" id="logo" class="form-control-file" accept="image/png, image/jpeg">
            
            <!-- Show the image -->
            @if ($editing && $setting->logo)
                <img src="{{ \Storage::url($setting->logo) }}" class="d-block rounded" height="50" width="70">
            @else
                <p>No logo available.</p>
            @endif
            
            @error('logo')  @include('components.inputs.partials.error') @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label for="favicon">Favicon</label>
            <input type="file" name="favicon" id="favicon" class="form-control-file" accept="image/png, image/jpeg">
            
            <!-- Show the image -->
            @if ($editing && $setting->favicon)
                <img src="{{ \Storage::url($setting->favicon) }}" class="d-block rounded" height="50" width="50">
            @else
                <p>No favicon available.</p>
            @endif
            
             @error('favicon') @include('components.inputs.partials.error')
            @enderror
        </div>
    </div>
</div>
