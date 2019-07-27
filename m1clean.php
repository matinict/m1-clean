
<?php

 

$captchaAdmin = glob('media/captcha/admin/*'); // get all file names
foreach($captchaAdmin as $ca){ // iterate files
  if(is_file($ca))
    unlink($ca); // delete file
}

$captchaBase = glob('media/captcha/base/*'); // get all file names
foreach($captchaBase as $cb){ // iterate files
  if(is_file($cb))
    unlink($cb); // delete file
}

$varReport= glob('var/report/*'); // get all file names
foreach($varReport as $vr){ // iterate files
  if(is_file($vr))
    unlink($vr); // delete file
}

$varSession= glob('var/session/*'); // get all file names
foreach($varSession as $vs){ // iterate files
    if(date("Ymdh", filemtime("$vs")) < date("Ymdh") ){ //check 1 day/h before
      if(is_file($vs))
        unlink($vs); // delete file
    }    
}

echo "File LogClean! Done!";




 

require_once('app/Mage.php');
Mage::app();
$connection = Mage::getSingleton('core/resource')->getConnection('core_write');

$connection->truncateTable('log_visitor_info');
$connection->truncateTable('log_url');
$connection->truncateTable('log_url_info');
$connection->truncateTable('log_visitor');
$connection->truncateTable('log_visitor_online');
$connection->truncateTable('log_customer');
$connection->truncateTable('captcha_log');
$connection->truncateTable('sendfriend_log');
$connection->truncateTable('log_summary_type');
$connection->truncateTable('log_summary');
$connection->truncateTable('log_quote');
$connection->truncateTable('dataflow_batch_import');
$connection->truncateTable('report_event');
$connection->truncateTable('report_viewed_product_index');
$connection->truncateTable('report_compared_product_index');

 $connection->query('DELETE FROM sales_flat_quote_shipping_rate WHERE updated_at < DATE_SUB(Now(),INTERVAL 30 DAY)');
 $connection->query('DELETE FROM sales_flat_quote_shipping_rate WHERE updated_at < DATE_SUB(Now(),INTERVAL 30 DAY)');
 $connection->query('DELETE FROM sales_flat_quote_item WHERE updated_at < DATE_SUB(Now(),INTERVAL 30 DAY)');
 $connection->query('DELETE FROM sales_flat_quote_address WHERE updated_at < DATE_SUB(Now(),INTERVAL 30 DAY)');	 
 $connection->query('DELETE FROM sales_flat_quote WHERE updated_at < DATE_SUB(Now(),INTERVAL 30 DAY)');	 
 $connection->query('DELETE FROM wishlist_item WHERE added_at < DATE_SUB(Now(),INTERVAL 30 DAY)');
 $connection->query('DELETE FROM index_event WHERE created_at < DATE_SUB(Now(),INTERVAL 30 DAY)');
 $connection->query('DELETE FROM catalogsearch_query WHERE updated_at < DATE_SUB(Now(),INTERVAL 30 DAY)');


echo "DB LogClean!!Done!";

 
 


?>
