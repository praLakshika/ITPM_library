<?php $__env->startSection('content'); ?>
    <!-- page content -->
   
    <!-- top tiles -->
  
    <!-- /top tiles -->

    
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3> ARD book renting Management System
                        </h3>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="row">
            <div class="container">
    
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                      </ol>
                  
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <img src="https://cdn-images-1.medium.com/max/1600/0*Ugp4QQOB6XvJwi-L" alt="Los Angeles" width="1800px" height="800px">
                        </div>
                  
                        <div class="item">
                          <img src="https://focusonbelgium.be/sites/default/files/styles/big_article_image/public/ku_leuven_rob_stevens_1.jpg?itok=ccpdnhlx" alt="Chicago" width="1800px" height="800px">
                        </div>
                      
                        <div class="item">
                          <img src="https://aatvos.com/wp-content/uploads/2018/10/Aatvos_Koln-Kalk_library-social-inclusion-1.jpg" alt="New york" width="1800px" height="800px">
                        </div>
                      </div>
                  
                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                  
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <?php echo e(Html::script(mix('assets/admin/js/dashboard.js'))); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
    <?php echo e(Html::style(mix('assets/admin/css/dashboard.css'))); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('member.layouts.member', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>