<?php $__env->startSection('title', 'คลังอุปกรณ์'); ?>
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('head', null, []); ?>
        <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
     <?php $__env->endSlot(); ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12 margin-tb mb-4">
                <div class="pull-left">
                    <h2>คลังอุปกรณ์</h2>
                </div>

                <div class="float-end">
                    <a class="btn btn-success" href="<?php echo e(route('products.create')); ?>"> เพิ่มรายการอุปกรณ์ </a>
                </div>

            </div>

            <?php if($message = Session::get('success')): ?>
                <div class="alert alert-success">
                    <p><?php echo e($message); ?></p>
                </div>
            <?php endif; ?>

            <table class="table table-striped table-hover">
                <tr>
                    <th>ภาพ</th>
                    <th>รายการอุปกรณ์</th>
                    <th>จำนวนคงเหลือ</th>
                    <th>หมวดหมู่</th>
                    <th>Action</th>
                </tr>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($product->image); ?></td>
                        <td><?php echo e($product->name); ?> <?php echo e($product->description); ?></td>
                        <td>
                            <?php if($product->remain <= $product->minimum): ?>
                                <div style="display: flex; align-items: center;">
                                    <span style="color:orange; font-weight:bold;"><?php echo e($product->remain); ?> </span>
                                    <form action="<?php echo e(route('products.show', $product->id)); ?>" method="POST"
                                        style="margin-left: 10px;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('POST'); ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-edit')): ?>
                                            <a class="btn btn-warning"
                                                href="<?php echo e(route('products.show', $product->id)); ?>">เพิ่มสต็อก</a>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            <?php else: ?>
                                <?php echo e($product->remain); ?>

                            <?php endif; ?>
                        </td>
                        <td><?php echo e($product->category->name); ?></td>
                        <td>
                            <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-edit')): ?>
                                    <a class="btn btn-primary" href="<?php echo e(route('products.edit', $product->id)); ?>">แก้ไข</a>
                                <?php endif; ?>

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-delete')): ?>
                                    <a href="<?php echo e(route('products.destroy', $product->id)); ?>" class="btn btn-danger"
                                        data-confirm-delete="true">ลบ</a>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
    </div>
    <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\SE_66_6\se-project\resources\views/products/index.blade.php ENDPATH**/ ?>
