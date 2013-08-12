Kirby-MailChimp
===============
###Step 1: newsletter.php

Create a template with the following code. 

      <?php snippet('header') ?>
    	<?php snippet('navigation') ?>
    
    	<div class="container">
    		<div class="grid full">
    			<div id="email">
    				
    				<form action="/subscribe.php" id="subscribe" method="POST" class="center">
    					<span>Enter your email to sign up</span>
    					<p><input type="text" placeholder="Firstname" name="fname" id="fname" /></p>
    					<p><input type="text" placeholder="Lastname" name="lname" id="lname" /></p>
    					<p><input type="text" placeholder="your@email.com*" name="email" id="address" /></p>
    					<p><input type="submit" value="Signup" /></p>
    					<p><span id="result"></span></p>
    				</form>
    				
    			</div>
    		</div>
    		<div class="cf"></div>
    	</div>
    
    	<?php snippet('panel') ?>
    	<?php snippet('footer') ?>

###Step 2: subscribe.php

      	<?php
      	    $apiKey = 'YOUR-API-KEY';
      	    $listId = 'YOUR-LIST-ID';
      	    $double_optin=false;
      	    $send_welcome=false;
      	    $email_type = 'html';
      	    $email = $_POST['email'];
      	    $fname = $_POST['fname'];
      	    $lname = $_POST['lname'];
      
      	    //replace us5 with your actual datacenter
      	    $submit_url = "http://us5.api.mailchimp.com/1.3/?method=listSubscribe";
      	    $data = array(
      	        'email_address'=>$email,
      	        'merge_vars' =>array('FNAME'=>$fname, 'LNAME'=>$lname), 
      	        'fname'=>$fname,
      	        'lname'=>$lname,
      	        'apikey'=>$apiKey,
      	        'id' => $listId,
      	        'double_optin' => $double_optin,
      	        'send_welcome' => $send_welcome,
      	        'email_type' => $email_type
      	    );
      	    $payload = json_encode($data);
      	     
      	    $ch = curl_init();
      	    curl_setopt($ch, CURLOPT_URL, $submit_url);
      	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      	    curl_setopt($ch, CURLOPT_POST, true);
      	    curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($payload));
      	     
      	    $result = curl_exec($ch);
      	    curl_close ($ch);
      	    $data = json_decode($result);
      
      	    if (isset($data->error)){
      	        echo $data->error;
      	    } else {
      	        echo "Got it, you've been added to our email list.";
      	    }

Add you API-key and Listid

		$apiKey = 'YOUR-API-KEY';
	    $listId = 'YOUR-LIST-ID';

Replace u5 with your actual datacenter

	    $submit_url = "http://us5.api.mailchimp.com/1.3/?method=listSubscribe";

###Step 3: Content files

Create this structure in your conten folder:

		newsletter/newsletter.txt
		subscribe/subscribe.txt

###Step 4: Add some Ajax

For this you need the jquery library. Add this script to functions.js for example and make sure it gets loaded.

	$(document).ready(function() {

		$('#subscribe').submit(function()
		{
			var action = $('#subscribe').attr('action');
			$.ajax({
				url: action,
				type: 'POST',
				data: {
					email: $('#address').val(),
					fname: $('#fname').val(),
					lname: $('#lname').val()
				},
				success: function(data){
					$('#result').html(data).css('color', 'green');
				},
				error: function() {
					$('#result').html('Sorry, an error occurred.').css('color', 'red');
				}
			});	

			return false;						
		});

	});

That's it, of course you can modify it towards your needs. I haven't added any validation, Mailchimp takes care of this. 

You can view the code live [here](http://janlenaerts.me/newsletter "Jan Lenaerts Newsletter"), and if you want you can subscribe
to my newsletter there.

