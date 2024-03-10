<?php $__env->startSection('content'); ?>
    <div class="card">
             <h6 class="text-center">Payment History</h1>
                <div class="table-responsive text-nowrap">
                    <?php if($payments->isEmpty()): ?>
                        <p>No payment history available.</p>
                    <?php else: ?>
                        <table class="table table-sm table-dark">
                            <thead>
                                <tr>
                                    <th>Ref</th>
                                    <th>Transaction ID</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Item Title</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($payment->item_number); ?></td>
                                        <td><?php echo e($payment->txn_id); ?></td>
                                        <td>$<?php echo e($payment->payment_gross); ?></td>
                                        <td><?php echo e($payment->payment_status); ?></td>
                
                                        
                                        <td>
                                            <?php if($payment->music): ?>
                                                <?php echo e($payment->music->title); ?>

                                            <?php else: ?>
                                               Joining Fee
                                            <?php endif; ?>
                                        </td>
                
                                        <td><?php echo e($payment->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
                
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/paypal/transaction.blade.php ENDPATH**/ ?>