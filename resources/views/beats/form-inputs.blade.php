@php $editing = isset($beat) @endphp

<div class="row">
    <div class="col-lg-7 mx-auto">
       
        <div class="card mt-2 mx-auto p-4 bg-transparent">
            
                <div class="controls">
                    
                    @if($editing && $beat->image)
                    <div class="row">
                        <div class="col-md-12 text-center"> <!-- Adjust the column width and alignment -->
                            <div class="form-group mb-3">
                                <img src="{{ \Storage::url($beat->image) }}" alt="Image"
                                    class="img-fluid bg-gradient bg-dark mx-auto" id="dImage"
                                    style="width: 100px; height: 100px;" 
                                   
                                >
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-12 text-center"> <!-- Adjust the column width and alignment -->
                            <div class="form-group mb-3">
                                <img src="{{ asset('assets/images/music-logo.jpg') }}" alt="Image"
                                    class="img-fluid bg-gradient bg-dark mx-auto" id="dImage"
                                    style="width: 100px; height: 100px;" 
                                   
                                >
                            </div>
                        </div>
                    </div>
                   @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_name">Artist *</label>
                                <input id="form_name" type="text" name="artist" class="form-control"
                                    placeholder="Please enter your firstname *" required="required"
                                    data-error="Firstname is required."
                                    value="{{ old('artist', $editing ? $beat->artist : '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_lastname">Title *</label>
                                <input id="form_lastname" type="text" name="title" class="form-control"
                                    placeholder="Please enter your lastname *" required="required"
                                    data-error="Lastname is required."
                                    value="{{old('title', $editing ? $beat->title : '')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_email">Amount *</label>
                                <input id="form_email" type="number" name="amount" class="form-control"
                                    placeholder="Please enter your amount *" step="0.01" required="required"
                                    data-error="Valid email is required."
                                    value="{{old('amount', $editing ? $beat->amount : '')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_need">Genre *</label>
                                <select id="form_need" name="genre_id" class="form-control" required="required"
                                    data-error="Please specify your need."
                                    value="{{old('genre_id', $editing ? $beat->genre_id : '')}}">
                                    <option value="" selected disabled>--Select Genre--</option>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">Art Covert *</label>
                                <input id="cover" type="file" name="image" class="form-control"
                                    placeholder="Please enter your image "
                                    data-error="Valid Image is required."
                                    value="{{old('image', $editing ? $beat->image : '')}}" accept="image/*"
                                    onchange="displayImg(this,'dImage')">
                                @error('image')
                                    @include('components.inputs.partials.error')
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="music">Beat *</label>
                                <input id="music" type="file" name="file" class="form-control"
                                    placeholder="Please enter your amount *"
                                    data-error="Valid Music is required."
                                    value="{{old('amount', $editing ? $beat->amount : '')}}" accept=".mp3,.m4a,.mpeg">
                                @if ($editing && $beat->file)
                                    <div class="mt-2">
                                        <a href="{{ \Storage::url($beat->file) }}" target="_blank"><i
                                                class="icon ion-md-download"></i>&nbsp;Download</a>
                                    </div>
                                @endif @error('file')
                                @include('components.inputs.partials.error')
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Description *</label>
                            <textarea id="form_message" name="description" class="form-control" placeholder="about your song." rows="4"
                                required="required" data-error="Please, description." :required="!$editing">{{ old('description', $editing ? $beat->description : '') }}</textarea>
                        </div>
                    </div>
                </div>
            

        </div>
    </div>
</div>
