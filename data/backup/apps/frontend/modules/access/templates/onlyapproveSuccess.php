<a href="#formregs" class="three_days"></a>
<div  align="center" id="formregs">
    <h1><?php echo __('Only for approved users!')?></h1>
<?php if ($sf_user->isAuthenticated() ): ?>
    <a style="color: red" href="<?= url_for('@sf_guard_signout')?>"><?= __('Please click here to close the window') ?></a>
        <?php endif; ?>

</div>
<script type="text/javascript">

    $(".three_days").colorbox({open: true, inline:true, width:"50%"});

</script>



