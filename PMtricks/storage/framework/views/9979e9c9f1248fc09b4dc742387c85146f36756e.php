<?php $__env->startSection('content'); ?>
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card package">
                <div class="card-header">Contact Admin</div>
                <p style="color:brown; font-weight: bold;">
                    You can only send 5 messages per day !
                </p>

                <div class="card-body">
                    <form action="<?php echo e(route('user.send')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo e(Auth::user()->email); ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" rows="5" id="message" name="message"></textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <h1 class="">Inbox</h1>
                    <div class="table-responsive ">          
                        <table class="table ">
                            <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>Message</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = \App\Message::where('to_user_id', '=', Auth::user()->id)->where('to_user_type', '=', 'user')->orderBy('created_at','desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="font-weight: bold">Admin</td>
                                        <td><?php echo e($message->message); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>