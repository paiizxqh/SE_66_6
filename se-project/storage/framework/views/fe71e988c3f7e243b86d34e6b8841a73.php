<?php $__env->startSection('title', 'ข้อมูลพนักงาน'); ?>
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
                    <h2>เพิ่มข้อมูลพนักงาน</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="<?php echo e(route('users.index')); ?>">ย้อนกลับ</a>
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

        <form action="<?php echo e(route('users.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
<<<<<<< HEAD
                <label for="employee_id" class="form-label">Employee ID:</label>
                <input type="text" id="employee_id" name="employee_id" class="form-control" placeholder="Employee ID">
=======
                <label for="employee_id" class="form-label">รหัสพนักงาน:</label>
                <input type="text" id="employee_id" name="employee_id" class="form-control"
                placeholder="รหัสพนักงาน" value="<?php echo e($newEmployeeId); ?>">         
>>>>>>> 0a5b828cbad0cb94a81e2a8bec078159a3d9a7be
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ-สกุล:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="ชื่อ-สกุล">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="รหัสผ่าน">
            </div>

            <div class="mb-3">
                <label for="confirm-password" class="form-label">ยืนยันรหัสผ่าน:</label>
                <input type="password" id="confirm-password" name="confirm-password" class="form-control"
                    placeholder="ยืนยันรหัสผ่าน">
            </div>

            <div class="mb-3">
                <label for="roles" class="form-label">บทบาทพนักงาน:</label>
                <select id="roles" class="form-control multiple" multiple name="roles[]">
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($role); ?>"><?php echo e($role); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>
            </div>

            <div class="text-center">
                <button class="btn btn-primary">ยืนยัน</button>
            </div>
        </form>
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
<?php /**PATH C:\xampp\htdocs\SE_66_6\se-project\resources\views/users/create.blade.php ENDPATH**/ ?>