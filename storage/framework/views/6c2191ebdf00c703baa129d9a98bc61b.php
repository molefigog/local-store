<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card bg-transparent">
        <div class="card-body bg-transparent">
            <h4 class="card-title text-center">
                <a href="<?php echo e(route('all-music.index')); ?>" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                <?php echo app('translator')->get('music'); ?>
            </h4>
            <?php if(Auth::user()->upload_status == 1): ?>
            <?php if (isset($component)) { $__componentOriginalf9a5f060e1fbbcbc7beb643b113b10ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf9a5f060e1fbbcbc7beb643b113b10ab = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['action' => '','id' => 'music-form','hasFiles' => true,'class' => 'mt-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => '','id' => 'music-form','has-files' => true,'class' => 'mt-4']); ?>
                <?php echo $__env->make('all_music.form-inputs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="mt-4 text-center">
                    <a
                        href="<?php echo e(route('all-music.index')); ?>" class="btn btn-light text-center">
                        <i class="icon-arrow-left"></i>
                        <?php echo app('translator')->get('back'); ?>
                    </a>
                    <button type="submit" class="btn btn-primary text-center" form="music-form">
                        <i class="fa fa-save"></i>
                        <?php echo app('translator')->get('create'); ?>
                    </button>
                </div>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf9a5f060e1fbbcbc7beb643b113b10ab)): ?>
<?php $attributes = $__attributesOriginalf9a5f060e1fbbcbc7beb643b113b10ab; ?>
<?php unset($__attributesOriginalf9a5f060e1fbbcbc7beb643b113b10ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf9a5f060e1fbbcbc7beb643b113b10ab)): ?>
<?php $component = $__componentOriginalf9a5f060e1fbbcbc7beb643b113b10ab; ?>
<?php unset($__componentOriginalf9a5f060e1fbbcbc7beb643b113b10ab); ?>
<?php endif; ?>
            <?php else: ?>
            <p> </p>
            <div class="alert alert-danger justify-content-center" role="alert">
                <p class="text-center" id="text">pay R100 to upload up to 12 songs! </p>
                <a class="btn btn-success btn-sm text-center" href="<?php echo e(route('top-up')); ?>">click here to activate</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('tinymce'); ?>
<script>
    const mp3StoreRoute = "<?php echo e(route('all-music.store')); ?>";
    const MusicIndexPage = "<?php echo e(url('all-music')); ?>";
  </script>
<script src="https://cdn.tiny.cloud/1/nxk4prfbs31hvdbw9gm9p620mx2kdsqfv8lqdytidhb0mrg9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
       tinymce.init({
           // Select the element(s) to add TinyMCE to using any valid CSS selector
           selector: "#myTextarea",
           plugins: "preview powerpaste casechange searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample advtable table charmap pagebreak nonbreaking anchor advlist lists checklist wordcount tinymcespellchecker a11ychecker help formatpainter permanentpen pageembed linkchecker emoticons export",
           height: '700px',
           toolbar_sticky: true,
           icons: 'thin',
           autosave_restore_when_empty: true,
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

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/all_music/create.blade.php ENDPATH**/ ?>