
<?php if (isset($error) AND ! empty($error)): ?>
    <div class="alert alert-danger alert-dismissable" id="errorMessage">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-ban"></i>&nbsp;<?php echo $error; ?>
    </div>
<?php endif; ?>
<?php if (isset($success) AND ! empty($success)): ?>
<div class="alert alert-success alert-dismissable" id="successMessage">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-check"></i>&nbsp;<?php echo $success; ?>
    </div>
<?php endif; ?>
