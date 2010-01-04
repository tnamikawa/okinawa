<h1>Photos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Filename</th>
      <th>Comment</th>
      <th>Width</th>
      <th>Height</th>
      <th>Thumb width</th>
      <th>Thumb height</th>
      <th>Icon width</th>
      <th>Icon height</th>
      <th>Wander width</th>
      <th>Wander height</th>
      <th>Slide width</th>
      <th>Slide height</th>
      <th>Longitude</th>
      <th>Latitude</th>
      <th>Shot date</th>
      <th>Open date</th>
      <th>Modified date</th>
      <th>Metamodified date</th>
      <th>Filemtime</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Photos as $Photo): ?>
    <tr>
      <td><a href="<?php echo url_for('tool/edit?id='.$Photo->getId()) ?>"><?php echo $Photo->getId() ?></a></td>
      <td><?php echo $Photo->getTitle() ?></td>
      <td><?php echo $Photo->getFilename() ?></td>
      <td><?php echo $Photo->getComment() ?></td>
      <td><?php echo $Photo->getWidth() ?></td>
      <td><?php echo $Photo->getHeight() ?></td>
      <td><?php echo $Photo->getThumbWidth() ?></td>
      <td><?php echo $Photo->getThumbHeight() ?></td>
      <td><?php echo $Photo->getIconWidth() ?></td>
      <td><?php echo $Photo->getIconHeight() ?></td>
      <td><?php echo $Photo->getWanderWidth() ?></td>
      <td><?php echo $Photo->getWanderHeight() ?></td>
      <td><?php echo $Photo->getSlideWidth() ?></td>
      <td><?php echo $Photo->getSlideHeight() ?></td>
      <td><?php echo $Photo->getLongitude() ?></td>
      <td><?php echo $Photo->getLatitude() ?></td>
      <td><?php echo $Photo->getShotDate() ?></td>
      <td><?php echo $Photo->getOpenDate() ?></td>
      <td><?php echo $Photo->getModifiedDate() ?></td>
      <td><?php echo $Photo->getMetamodifiedDate() ?></td>
      <td><?php echo $Photo->getFilemtime() ?></td>
      <td><?php echo $Photo->getCreatedAt() ?></td>
      <td><?php echo $Photo->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tool/new') ?>">New</a>
