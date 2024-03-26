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
                    <h2>แก้ไขรายการอุปกรณ์</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="<?php echo e(route('products.index')); ?>">ย้อนกลับ</a>
                </div>
            </div>
        </div>

        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div class="row">
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>รายการอุปกรณ์:</strong>
                        <input type="text" value="<?php echo e($product->name); ?>" name="name" class="form-control"
                            placeholder="รายการอุปกรณ์">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>รายละเอียด:</strong>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="รายละเอียด เช่น ขนาด ปริมาตร"> <?php echo e($product->description); ?> </textarea>
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>จำนวนอุปกรณ์:</strong>
                        <input type="text" value="<?php echo e($product->remain); ?>" name="remain" class="form-control"
                            placeholder="จำนวนเติมสต๊อก">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>minimum:</strong>
                        <input type="text" value="<?php echo e($product->minimum); ?>" name="minimum" class="form-control"
                            placeholder="จำนวนน้อยที่สุดของสินค้าที่ต้องทำการแจ้งเตือน">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <label for="categories">หมวดหมู่:</label>
                    <select name="categories" id="categories" class="form-control" required>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category); ?>"><?php echo e($category); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Upload image:</strong>
                        <input type="file" name="image" class="form-control" placeholder="Upload image">
                        <?php if($product->image): ?>
                            <img src="<?php echo e(asset($product->image)); ?>" alt="Product Image" style="max-width: 100px;">
                            <p>Path: <?php echo e($product->image); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xs-12 mb-3 text-center">
                    <button class="btn btn-primary">ยืนยัน</button>
                </div>
            </div>
        </form>
        <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
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
<?php /**PATH C:\xampp\htdocs\SE_66_6\se-project\resources\views/products/edit.blade.php ENDPATH**/ ?>