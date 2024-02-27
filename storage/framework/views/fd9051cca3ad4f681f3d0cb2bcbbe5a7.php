<?php $editing = isset($music) ?>

<div class="row">
    <div class="col-lg-7 mx-auto">
       
        <div class="card mt-2 mx-auto p-4 bg-transparent">
            
                <div class="controls">
                    
                    <?php if($editing && $music->image): ?>
                    <div class="row">
                        <div class="col-md-12 text-center"> <!-- Adjust the column width and alignment -->
                            <div class="form-group mb-3">
                                <img src="<?php echo e(\Storage::url($music->image)); ?>" alt="Image"
                                    class="img-fluid bg-gradient bg-dark mx-auto" id="dImage"
                                    style="width: 100px; height: 100px;" 
                                   
                                >
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="row">
                        <div class="col-md-12 text-center"> <!-- Adjust the column width and alignment -->
                            <div class="form-group mb-3">
                                <img src="<?php echo e(asset('assets/images/music-logo.jpg')); ?>" alt="Image"
                                    class="img-fluid bg-gradient bg-dark mx-auto" id="dImage"
                                    style="width: 100px; height: 100px;" 
                                   
                                >
                            </div>
                        </div>
                    </div>
                   <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_name">Artist *</label>
                                <input id="form_name" type="text" name="artist" class="form-control"
                                    placeholder="Please enter your firstname *" required="required"
                                    data-error="Firstname is required."
                                    value="<?php echo e(old('artist', $editing ? $music->artist : '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_lastname">Title *</label>
                                <input id="form_lastname" type="text" name="title" class="form-control"
                                    placeholder="Please enter your lastname *" required="required"
                                    data-error="Lastname is required."
                                    value="<?php echo e(old('title', $editing ? $music->title : '')); ?>">
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
                                    value="<?php echo e(old('amount', $editing ? $music->amount : '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_need">Genre *</label>
                                <select id="form_need" name="genre_id" class="form-control" required="required"
                                    data-error="Please specify your need."
                                    value="<?php echo e(old('genre_id', $editing ? $music->genre_id : '')); ?>">
                                    <option value="" selected disabled>--Select Genre--</option>
                                    <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($genre->id); ?>"><?php echo e($genre->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                    value="<?php echo e(old('image', $editing ? $music->image : '')); ?>" accept="image/*"
                                    onchange="displayImg(this,'dImage')">
                                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo $__env->make('components.inputs.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="music">Music *</label>
                                <input id="music" type="file" name="file" class="form-control"
                                    placeholder="Please enter your amount *"
                                    data-error="Valid Music is required."
                                    value="<?php echo e(old('amount', $editing ? $music->amount : '')); ?>" accept=".mp3,.m4a,.mpeg">
                                <?php if($editing && $music->file): ?>
                                    <div class="mt-2">
                                        <a href="<?php echo e(\Storage::url($music->file)); ?>" target="_blank"><i
                                                class="icon ion-md-download"></i>&nbsp;Download</a>
                                    </div>
                                <?php endif; ?> <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <?php echo $__env->make('components.inputs.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Description *</label>
                            <textarea id="form_message" name="description" class="form-control" placeholder="about your song." rows="4"
                                required="required" data-error="Please, description." :required="!$editing"><?php echo e(old('description', $editing ? $music->description : '')); ?></textarea>
                        </div>
                    </div>
                </div>
            

        </div>
    </div>
</div>
<?php /**PATH /home/gw-ent.co.za/public_html/resources/views/all_music/form-inputs.blade.php ENDPATH**/ ?>