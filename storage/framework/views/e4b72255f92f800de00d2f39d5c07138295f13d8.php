<?php $__env->startSection('content'); ?>
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  <?php if(session()->get('success')): ?>
    <div class="alert alert-success">
      <?php echo e(session()->get('success')); ?>  
    </div><br />
  <?php endif; ?>
  <table class="table table-striped">
    <thead>
    <tr>
    <td colspan=8>
    <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-danger">
    Add Post
    </td>
    </tr>
        <tr>
          <td>ID</td>
          <td>Post Name</td>
          <td>Post Description</td>
          <td>Post Heading</td>
          <td>Post ShortStory</td>
          <td>Post FullStory</td>
          <td>Category Name</td>
          <td>User Id</td>
          <td>Status</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->id); ?></td>
            <td><?php echo e($item->title); ?></td>
            <td><?php echo e($item->description); ?></td>
            <td><?php echo e($item->heading); ?></td>
            <td><?php echo e($item->shortstory); ?></td>
            <td><?php echo e($item->fullstory); ?></td>
            <td><?php echo e($item->name); ?></td>
            <td><?php echo e($item->user_id); ?></td>
            <td><?php echo e($item->status); ?></td>
            <td><a href="<?php echo e(route('posts.edit',$item->id)); ?>" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="<?php echo e(route('posts.destroy', $item->id)); ?>" method="post">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
<div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\blog\resources\views/back/posts/index.blade.php ENDPATH**/ ?>