 <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Customer</th>
                        <th>Product / Services</th>
                        <th>Status</th>
                        <th>Source</th>
                        <th>Number</th>
                        <th>Followup Date</th>
                        <th>Next Action</th>
                        <th>Call Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    
                                        <button type="button" class="btn btn-outline-primary"
                                                onclick="openInteractionModal(<?php echo e($lead->id); ?>, '<?php echo e($lead->followup_date); ?>', '<?php echo e($lead->status_id); ?>', '<?php echo e($lead->call_status); ?>')">
                                            <i class="bi bi-pencil"></i>
                                        </button>


                                     
                                        <form action="<?php echo e(route('leads.destroy', $lead->id)); ?>" method="POST" onsubmit="return confirm('Are you sure?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-outline-danger" type="submit">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                </div>
                            </td>
                            <td><?php echo e($lead->customer); ?></td>
                            <td><?php echo e($lead->product->name ?? '-'); ?></td>

                            <td>
                                <span class="badge" style="background-color: <?php echo e($lead->status->color ?? '#808080'); ?>;">
                                    <?php echo e($lead->status->name ?? 'Unknown'); ?>

                                </span>
                            </td>
                            <td><?php echo e($lead->source); ?></td>
                            <td><?php echo e($lead->number); ?></td>
                           <td><?php echo e(\Carbon\Carbon::parse($lead->followup_date)->format('d M, Y')); ?></td>

                            <td><?php echo e($lead->next_action); ?></td>


                            <?php
                                $statusColors = [
                                    'Pending' => 'bg-warning text-white',
                                    'Completed' => 'bg-success text-white',
                                    'Scheduled' => 'bg-primary text-white',
                                    'Not Reached' => 'bg-danger text-white',
                                    'In Progress' => 'bg-info text-white',
                                ];
                            ?>
                           <td>
                                <span class="badge <?php echo e($statusColors[$lead->call_status] ?? 'bg-secondary'); ?>">
                                    <?php echo e($lead->call_status); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

            </table><?php /**PATH C:\xampp\htdocs\CRM-1\resources\views/leads/partials/table.blade.php ENDPATH**/ ?>