<?php $__env->startSection('content'); ?>
    <div class="container">
        <br>
        <div class="searchbar mt-0 mb-4">
            <div class="row">

                <div class="col-md-6 text-center">
                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('products.index')); ?>"> Back</a>
                </div>
            </div>
        </div>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="card">
            <h5 class="card-header">Create Pages</h5>
            <div class="card-body">
                <form action="<?php echo e(route('products.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_need">Title *</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_need">category *</label>
                                    <<select id="form_need" name="category_name" class="form-control" required="required">
                                        <option value="category_name" selected disabled>--Select Category--</option>
                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->title); ?>" <?php echo e($category->title == $product->category_name ? 'selected' : ''); ?>>
                                                <?php echo e($category->title); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <div class="form-group">
                                <label for="form_need">Content *</label>
                                <textarea id="myTextarea" class="form-control" name="detail"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('tinymce'); ?>
    <script src="https://cdn.tiny.cloud/1/nxk4prfbs31hvdbw9gm9p620mx2kdsqfv8lqdytidhb0mrg9/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            content_css: '<?php echo e(asset('frontend/font/icomoon/style.css')); ?>'
            selector: "#myTextarea",
            plugins: "preview powerpaste casechange searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample advtable table charmap pagebreak nonbreaking anchor advlist lists checklist wordcount tinymcespellchecker a11ychecker help formatpainter permanentpen pageembed linkchecker emoticons export",
            height: '700px',
            toolbar_sticky: true,
            icons: 'thin',
            toolbar: 'fontawesome',
            extended_valid_elements: 'span[*]'
            autosave_restore_when_empty: true,
            images_upload_url: 'postAcceptor.php',

            /* we override default upload handler to simulate successful upload*/
            images_upload_handler: function(blobInfo, success, failure) {
                setTimeout(function() {
                    /* no matter what you upload, we will turn it into TinyMCE logo :)*/
                    success('http://moxiecode.cachefly.net/tinymce/v9/images/logo.png');
                }, 2000);
            },
            content_style: `
               body {
                   background: #fff;
               }

               @media (min-width: 840px) {
                   html {
                       background: #eceef4;
                       min-height: 100%;
                       padding: 0 .5rem
                   }

                   body {
                       background-color: #fff;
                       box-shadow: 0 0 4px rgba(0, 0, 0, .15);
                       box-sizing: border-box;
                       margin: 1rem auto 0;
                       max-width: 820px;
                       min-height: calc(100vh - 1rem);
                       padding:4rem 6rem 6rem 6rem
                   }
               }
           `,
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/products/create.blade.php ENDPATH**/ ?>