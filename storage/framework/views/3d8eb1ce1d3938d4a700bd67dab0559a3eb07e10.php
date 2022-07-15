<?php if($paginator->hasPages()): ?>
    <ul class="pagination">
        
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-item disabled"><a class="page-link" href="#"><i class="la la-angle-double-left"></i></a></li>
        <?php else: ?>
            <li class="page-item"><a class="page-link" href="javascript:;" data-page="<?php echo e($paginator->currentPage() -1); ?>" rel="prev"><i class="la la-angle-double-left"></i></a></li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li class="page-item active disabled"><a class="page-link" href="javascript:;"><?php echo e($element); ?></a></li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                       
                        <li class="page-item active"><a class="page-link" ><?php echo e($page); ?></a></li>
                    <?php else: ?>
                        
                        <li class="page-item"><a class="page-link" href="javascript:;" data-page="<?php echo e($page); ?>"><?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item"><a class="page-link" href="javascript:;" data-page="<?php echo e($paginator->currentPage() +1); ?>" rel="next"><i class="la la-angle-double-right"></i></a></li>
        <?php else: ?>
            
            <li class="page-item disabled"><a class="page-link" href="javascript:;" rel="next"><i class="la la-angle-double-right"></i></a></li>
        <?php endif; ?>
    </ul>
<?php endif; ?><?php /**PATH /homepages/36/d911497826/htdocs/resources/views/pagination/ajax_pagination.blade.php ENDPATH**/ ?>