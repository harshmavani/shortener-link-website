<?php  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL
    $url.= $_SERVER['REQUEST_URI'];    
      
    $array_link = explode("maft.ml/s/",$url);
    $req_ext = $array_link['1'];
    $req_ext_final = substr($req_ext,0,10);
    $link =(mysqli_connect("localhost","root","","admin_panel"));

	$sql = "SELECT link FROM shortaner_data WHERE uniq_ext ='".$req_ext_final."'";

			$query = mysqli_query($link,$sql);

			$res= mysqli_fetch_assoc($query);

            if (empty($res['link'])) {
                header('location: ../404.php');
                exit();
            }
			
?>   
<script>
	window.open("<?php echo $res['link']; ?>","_self");
</script>
