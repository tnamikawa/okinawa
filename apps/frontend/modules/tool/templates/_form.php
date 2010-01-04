<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('tool/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('tool/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'tool/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['filename']->renderLabel() ?></th>
        <td>
          <?php echo $form['filename']->renderError() ?>
          <?php echo $form['filename'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['comment']->renderLabel() ?></th>
        <td>
          <?php echo $form['comment']->renderError() ?>
          <?php echo $form['comment'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['width']->renderLabel() ?></th>
        <td>
          <?php echo $form['width']->renderError() ?>
          <?php echo $form['width'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['height']->renderLabel() ?></th>
        <td>
          <?php echo $form['height']->renderError() ?>
          <?php echo $form['height'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['thumb_width']->renderLabel() ?></th>
        <td>
          <?php echo $form['thumb_width']->renderError() ?>
          <?php echo $form['thumb_width'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['thumb_height']->renderLabel() ?></th>
        <td>
          <?php echo $form['thumb_height']->renderError() ?>
          <?php echo $form['thumb_height'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['icon_width']->renderLabel() ?></th>
        <td>
          <?php echo $form['icon_width']->renderError() ?>
          <?php echo $form['icon_width'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['icon_height']->renderLabel() ?></th>
        <td>
          <?php echo $form['icon_height']->renderError() ?>
          <?php echo $form['icon_height'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['wander_width']->renderLabel() ?></th>
        <td>
          <?php echo $form['wander_width']->renderError() ?>
          <?php echo $form['wander_width'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['wander_height']->renderLabel() ?></th>
        <td>
          <?php echo $form['wander_height']->renderError() ?>
          <?php echo $form['wander_height'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['slide_width']->renderLabel() ?></th>
        <td>
          <?php echo $form['slide_width']->renderError() ?>
          <?php echo $form['slide_width'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['slide_height']->renderLabel() ?></th>
        <td>
          <?php echo $form['slide_height']->renderError() ?>
          <?php echo $form['slide_height'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['longitude']->renderLabel() ?></th>
        <td>
          <?php echo $form['longitude']->renderError() ?>
          <?php echo $form['longitude'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['latitude']->renderLabel() ?></th>
        <td>
          <?php echo $form['latitude']->renderError() ?>
          <?php echo $form['latitude'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['shot_date']->renderLabel() ?></th>
        <td>
          <?php echo $form['shot_date']->renderError() ?>
          <?php echo $form['shot_date'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['open_date']->renderLabel() ?></th>
        <td>
          <?php echo $form['open_date']->renderError() ?>
          <?php echo $form['open_date'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['modified_date']->renderLabel() ?></th>
        <td>
          <?php echo $form['modified_date']->renderError() ?>
          <?php echo $form['modified_date'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['metamodified_date']->renderLabel() ?></th>
        <td>
          <?php echo $form['metamodified_date']->renderError() ?>
          <?php echo $form['metamodified_date'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['filemtime']->renderLabel() ?></th>
        <td>
          <?php echo $form['filemtime']->renderError() ?>
          <?php echo $form['filemtime'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
