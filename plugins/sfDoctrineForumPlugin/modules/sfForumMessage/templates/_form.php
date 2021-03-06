<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php $topic_id = ($form->getObject()->getTopicId()==0)?$sf_request->getParameter('topic_id'):$form->getObject()->getTopicId(); ?>

<form action="<?php echo url_for('sfForumMessage/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

    <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>

    <input type="hidden" value="<?php echo $topic_id ?>" name="sf_forum_message[topic_id]" id="sf_forum_message_topic_id" />
    <input type="hidden" value="<?php echo $sf_user->getGuardUser()->getId() ?>" name="sf_forum_message[author]" id="sf_forum_message_author" />

    <?php echo $form->renderHiddenFields(); ?>
    <?php echo $form->renderGlobalErrors() ?>
    <?php echo $form['author']->renderError() ?>
    <?php // echo $form['topic_id']->renderError() ?>

    <table id="sfForumMessage">
        <tfoot>
            <tr>
                <td colspan="2">
                    <?php if (!$form->getObject()->isNew()): ?>
                    <?php echo link_to('Delete', 'sfForumMessage/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
                    <?php endif; ?>
                    <input type="submit" value="Save" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <th><?php echo $form['content']->renderLabel() ?>:</th>
                <td>
                    <?php echo $form['content']->renderError() ?>
                    <?php echo $form['content'] ?>
                </td>
            </tr>
        </tbody>
    </table>
    
</form>
