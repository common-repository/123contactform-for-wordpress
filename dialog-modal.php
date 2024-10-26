<?php
require_once dirname(__FILE__). '/config.php';
require_once dirname(__FILE__). '/jsonwrapper_helper.php';
function request($api_key) {
    
        $url = "http://www.123formbuilder.com/wp_dispatcher.php";

        if (strpos($api_key, 'EU.') !== false || strpos($api_key, 'EU-') !== false) {
            $url = "http://eu.123formbuilder.com/wp_dispatcher.php";
        }
        
        $res = wp_remote_fopen("{$url}?api_key=".$api_key);
     
        if($res === false)
            return false;

        return json_decode($res);                
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        
    <title>123FormBuilder</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css">        
        body, input, select {
			font-family:Arial;
            font-size:14px;
        }
    </style>
	<script>
		var customVal = '';
		function contact123(apiKey) {
			customVal = document.getElementById('123_form_toembed').options[document.getElementById('123_form_toembed').selectedIndex].value;
			window.parent.postMessage([customVal, apiKey], '*');

			setTimeout(() => {
				self.parent.tb_remove();
			}, 500);
		}
    </script>
    </head>
    
    <body> 
		<style>		
			body {
				padding: 15px;
			}
			[class="123_formbuilder"] label {
				display: block;
				margin-bottom: 10px;
			}
			[class="123_form_group"] {
				width: 100%;
			}
			[class="123_formbuilder"] input, 
			[id="123_form_toembed"] {
				display: inline-block;
				width: 80%;
				padding: 6px 4px 4px;
				border: 1px solid #ddd;
				font-size: 0.75rem;
				border-radius: 3px;
				background-color: #fff;
			}

			[class="123_form_button"] {
				display: inline-block;
				text-decoration: none;
				font-size: 13px;
				line-height: 26px;
				height: 28px;
				padding: 0 10px 1px;
				cursor: pointer;
				border-width: 1px;
				border-style: solid;
				border-radius: 3px;
				white-space: nowrap;
				box-sizing: border-box;
			}
		</style>
		<?php 
		if (isset($_POST["apikey"]) && $_POST["apikey"]) {    
			$response = request($_POST["apikey"]);
			if ($response->status == "ok") {
		?>
			<p>Select the form you want to embed:</p>
			<select name="123_form_toembed" id="123_form_toembed">
				<?php foreach ($response->forms as $form) { ?>
					<option value="<?php echo $form->f_id;?>"><?php echo $form->f_name;?></option>
				<?php } ?>
			</select>
			<button type="submit" class="123_form_button" onclick='contact123("<?=$_POST["apikey"]?>")'>Embed</button>
		<?php 
			} else {
				echo "Fatal error - ".$response->status;
			}
		} else { ?>
			<p>Please enter your 123FormBuilder API Key.<p/>
			<p>If you don't know it, <a href="http://www.123formbuilder.com/index.php?p=login" target="_blank">login</a> to 123FormBuilder, then go to MyAccount.</p>
			<form class="123_formbuilder" method="post" action="">
				<label for="apikey">
					API Key:
				</label>
				<div class="123_form_group">
					<input type="text" id="apiKey" name="apikey">
					<button type="submit" class="123_form_button">Connect</button>
				</div>
			</form>
		<?php } ?>	
    </body>           
</html>

