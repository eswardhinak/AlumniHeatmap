<?php
  require 'connectDB.php';
  if (!$addTable=$db->query("ALTER TABLE trial ADD country VARCHAR(60)"))
    die('There was an error connecting: queryError[' . $db->error . ']');
?>
