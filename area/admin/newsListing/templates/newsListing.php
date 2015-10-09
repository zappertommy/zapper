<div><a href="">Add</a></div>
<div>
  <span style="width: 300px; display: inline-block; border-top: 1px solid #000; border-bottom: 2px solid #000;">Title</span>
  <span style="width: 100px; display: inline-block; border-top: 1px solid #000; border-bottom: 2px solid #000;">Category</span>
  <span style="width: 100px; display: inline-block; border-top: 1px solid #000; border-bottom: 2px solid #000;">Status</span>
  <span style="width: 100px; display: inline-block; border-top: 1px solid #000; border-bottom: 2px solid #000;">&nbsp;</span>
</div>
<?php foreach ($Controller->listings as $listing): ?>
  <span style="width: 300px; display: inline-block; border-bottom: 1px solid #000;"><?php echo $listing['news_listing__title']; ?></span>
  <span style="width: 100px; display: inline-block; border-bottom: 1px solid #000;"><?php echo $listing['news_listing__category_id']; ?></span>
  <span style="width: 100px; display: inline-block; border-bottom: 1px solid #000;"><?php echo $listing['news_listing__status_type_id']; ?></span>
  <span style="width: 100px; display: inline-block; border-bottom: 1px solid #000;">
    <a href="" style="text-align: left; width: 48px; display: inline-block;">Edit</a>
    <a href="" style="text-align: right; width: 48px; display: inline-block;">Delete</a>
  </span>
<?php endforeach; ?>
