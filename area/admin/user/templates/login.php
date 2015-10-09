<form method="POST">
  <p><?php echo $Controller->getMessage(); ?></p>
  <?php echo $Controller->getUsername(); ?>
  <?php echo $Controller->getPassword(); ?>
  <input type="submit" value="Login" />
</form>