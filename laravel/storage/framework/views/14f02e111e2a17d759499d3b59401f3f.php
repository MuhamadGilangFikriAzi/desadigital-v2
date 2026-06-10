

<?php $__env->startSection("content"); ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Roles</b></div>

                <div class="card-body">
                    <?php if(session("status")): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session("status")); ?>

                        </div>
                    <?php endif; ?>

                    <a class="btn btn-sm btn-dark mb-2 float-right" href="<?php echo e(route("roles.create")); ?>" role="button">New
                        Role</a>
                    <a class="btn btn-sm btn-dark mb-2 mr-2 float-right" href="<?php echo e(route("roles.create")); ?>"
                        role="button">New Role Has Permission</a>

                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Guard</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $roles): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($roles->name); ?></td>
                                    <td><?php echo e($roles->guard_name); ?></td>
                                    <td>
                                        <?php $__empty_1 = true; $__currentLoopData = $roles->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <span class="badge badge-pill badge-success"><?php echo e($permission->name); ?></span>
                                            <?php if($loop->iteration % 4 == 0): ?>
                                                <br>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Setting
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="<?php echo e(route("roles.show", $roles->id)); ?>">Show</a>
                                                <a class="dropdown-item" href="<?php echo e(route("roles.edit", $roles->id)); ?>">Ubah</a>
                                                <a class="dropdown-item"
                                                    href="<?php echo e(route("roles.destroy", $roles->id)); ?>">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/role/index.blade.php ENDPATH**/ ?>