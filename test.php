<?php
echo password_hash("sdf5475SDa", PASSWORD_DEFAULT);

$testGD = get_extension_funcs("gd"); // Grab function list 
if (!$testGD){ echo "GD not even installed."; exit; }
echo"<pre>".print_r($testGD,true)."</pre>";

?>