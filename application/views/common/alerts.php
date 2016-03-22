<div class="container">
    <?php if ($ERROR) : ?>
        <div class="alert alert-danger alert-dismissable">
            <button class="close" data-dismiss="alert"  aria-hidden="true">×</button>
            <strong>ERRO!</strong> <?php echo $ERROR; ?> 
        </div>
    <?php endif; ?>

    <?php if ($NOTICE) : ?>
        <div class="alert alert-info alert-dismissable">
            <button class="close" data-dismiss="alert">×</button>
            <strong>INFO!</strong> <?php echo $NOTICE; ?>
        </div>
    <?php endif; ?>

    <?php if ($SUCCESS) : ?>
        <div class="alert alert-success alert-dismissable">
            <button class="close" data-dismiss="alert">×</button>
            <strong>SUCESSO!</strong> <?php echo $SUCCESS; ?>
        </div>
    <?php endif; ?>
</div>