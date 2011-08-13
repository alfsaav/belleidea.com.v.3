<?php foreach($posts as $post):?>
  <h1><?php echo $post['title'];?></h1>
  <?php echo $post['url_l'];?>
 <hr />
<?php endforeach;?>