<html>
	<head>
		<title>Membership Form</title>
		<style type="text/css">
			.error { background: red; color: white; padding: 0.2em; }
		</style>
	</head>
	<body>
	<?php
		if ( isset( $_POST["submitButton"] ) ) {
			processForm();
		} else {
			displayForm( array() );
		}

		function validateField( $fieldName, $missingFields ) {
			if ( in_array( $fieldName, $missingFields ) ) {
				echo " class='error'";
			}
		}
		
		function setValue( $fieldName ) {
			if ( isset( $_POST[$fieldName] ) ) {
					echo $_POST[$fieldName];
			}
		}
		
		function setChecked( $fieldName, $fieldValue ) {
			if ( isset( $_POST[$fieldName] ) and $_POST[$fieldName] == $fieldValue ) {
			echo "checked='checked'";
			}
		}
	
		function setSelected( $fieldName, $fieldValue ) {
			if ( isset( $_POST[$fieldName] ) and $_POST[$fieldName] == $fieldValue ) {
			echo  "selected='selected'";
			}
		}
		
		function processForm() {
			$requiredFields = array( "firstName", "lastName", "password1", "gender" ,"color");
			$missingFields = array();
			foreach ( $requiredFields as $requiredField ) {
				if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
					$missingFields[] = $requiredField;
				}
			}
			if ( $missingFields ) {
				displayForm( $missingFields );
			} else {
				displayThanks();
			}
		}
		
		function displayForm( $missingFields ) {
	?>
			<h1>Membership Form</h1>
			<?php if ( $missingFields ) { ?>
			<p class="error">There were some problems with the form you submitted. 
			Please complete the fields highlighted below and click Send Details to resend the form.</p>
			<?php } else { ?>
			<p>Thanks for choosing to join UoJ. To register, please fill in your details below and click Send Details. Fields marked with an asterisk (*) are required.</p>
			<?php } ?>
			<form action="registration.php" method="post">
			<div style="width: 30em;">
				<label for="firstName" <?php validateField( "firstName", $missingFields ) ?>>First name *</label>
				<input type="text" name="firstName" value="<?php setValue( "firstName" ) ?>" />
				<br><br>
				
				<label for="lastName"<?php validateField( "lastName", $missingFields ) ?>>Last name *</label>
				<input type="text" name="lastName" value="<?php setValue( "lastName" ) ?>" />
				<br><br>
				
				<label for="color"<?php validateField( "color", $missingFields ) ?>>Enter your favourite color *</label>
				<input type="text" name="color" value="<?php setValue( "color" ) ?>" />
				<br><br>
				
				<label  <?php validateField( "gender", $missingFields ) ?> for="genderDetail">Gender: * </label>
				<label for="male">Male</label>
				<input type="radio" name="gender" value="Male" <?php setChecked( "gender", "Male" )?> />
				<label for="female">Female</label>
				<input type="radio" name="gender" value="Female" <?php setChecked( "gender", "Female" )?> />
				<br><br>
				
				<label for="following course">which course are you following at UoJ ? *</label>
				<select name="course">
					<option value="Computer Science"<?php setSelected( "course", "Computer Science" ) ?>>Computer Science</option>
					<option value="Physical Science"<?php setSelected( "course", "Physical Science" )?>>Physical Science</option>
					<option value="Bio Science"<?php setSelected( "course", "Bio Science" )?>>Bio Science</option>
				</select>
				<br><br>
				
				<label for="password" <?php validateField( "password1", $missingFields )?>>Password *</label>
				<input type="password" name="password1" value="" />
				<br><br>
				
				<div style="clear: both;">
					<input type="submit" name="submitButton" value="Send Details" />
					<input type="reset" name="resetButton"   value="Reset Form" style="margin-right: 20px;" />
				</div>
				
			</div>
		</form>
			<?php
		}
		function displayThanks() {
		?>
			<h1>Thank You</h1>
			<p>Thank you, your application has been received.</p>
		<?php
		}
		?>
	</body>
</html>