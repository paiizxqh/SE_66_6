


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2> Show Product
                    <div class="float-end">
                        <a class="btn btn-primary" href="<?php echo e(route('products.index')); ?>"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Name:</strong>
                <?php echo e($product->name); ?>

            </div>
        </div>
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Details:</strong>
                <?php echo e($product->detail); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SE_66_6\se-project\resources\views/products/show.blade.php ENDPATH**/ ?>