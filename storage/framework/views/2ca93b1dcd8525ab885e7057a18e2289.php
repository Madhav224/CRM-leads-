

<?php $__env->startSection('title', 'kanban page'); ?>


<?php $__env->startSection('content'); ?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0">Leads Kanban View</h3>
                        <a href="<?php echo e(route('leads.index')); ?>" class="btn btn-primary">← Back to Lead View</a>
                    </div>

    <div class="row">
        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header text-white fw-bolder" style="background-color: <?php echo e($status->color ?? '#6c757d'); ?>">
                        <?php echo e($status->name); ?>

                    </div>
                    <div class="card-body" style="min-height: 300px; background-color: #f8f9fa;">
                        <?php $__empty_1 = true; $__currentLoopData = $status->leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="card mb-2 mt-1 shadow-lg">
                                <div class="card-body p-2">
                                    <h6 class="mb-1"><?php echo e($lead->customer); ?></h6>
                                    <small class="text-muted">📞 <?php echo e($lead->number); ?></small><br>
                                    <small>📆 <?php echo e($lead->followup_date ? \Carbon\Carbon::parse($lead->followup_date)->format('d M Y') : 'No Date'); ?></small>
                                    <?php if($lead->call_status): ?>

                                     <?php
                                $statusColors = [
                                    'Pending' => 'bg-warning text-white',
                                    'Completed' => 'bg-success text-white',
                                    'Scheduled' => 'bg-primary text-white',
                                    'Not Reached' => 'bg-danger text-white',
                                    'In Progress' => 'bg-info text-white',
                                ];
                            ?>
                                        <div class="mt-2">
                                            <span class="badge <?php echo e($statusColors[$lead->call_status] ?? 'bg-secondary'); ?>">
                                    <?php echo e($lead->call_status); ?>

                                </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-muted">No leads</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    </div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\CRM-1\resources\views/leads/kanban.blade.php ENDPATH**/ ?>