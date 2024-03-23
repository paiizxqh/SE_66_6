

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Products
                    <div class="float-end">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-create')): ?>
                            <a class="btn btn-success" href="<?php echo e(route('products.create')); ?>"> Create New Product</a>
                        <?php endif; ?>
                    </div>
                </h2>
            </div>
        </div>
    </div>


    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>

    <table class="table table-striped table-hover">
        <tr>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($product->name); ?></td>
                <td><?php echo e($product->detail); ?></td>
                <td>
                    <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST">
                        <a class="btn btn-info" href="<?php echo e(route('products.show', $product->id)); ?>">Show</a>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-edit')): ?>
                            <a class="btn btn-primary" href="<?php echo e(route('products.edit', $product->id)); ?>">Edit</a>
                        <?php endif; ?>


                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-delete')): ?>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        <?php endif; ?>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SE_66_6\se-project\resources\views/products/index.blade.php ENDPATH**/ ?>