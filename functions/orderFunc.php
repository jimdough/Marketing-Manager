<?PHP if (!empty($_GET['mode'])) { ?>
	
	<div class="orderFunction">
		<form  action="/functions/supplyOrderProcess.php" method="post" name="agreeform" onSubmit="return defaultagree(this)">
				<?PHP
				echo "<input type='hidden' value='" . $_POST['userID'] . "' name='userID'>";
				echo "<input type='hidden' value='" . $_POST['supplyID'] . "' name='supplyID'>";
				echo "<input type='hidden' value='" . $_POST['priceID'] . "' name='priceID'>";
				?>
				<input name="agreecheck" type="checkbox" onClick="agreesubmit(this)" /> I agree that all information on the business card is correct and ready to print.<br />
				<a href="../../edit-user.php?userID=<?PHP echo ($userInfo['id']); ?>">You can edit the user's information here</a><br>
				<input type="submit" name="submit" value="Submit Order" disabled>
		</form>
		<script>
				//change two names below to your form's names
				document.forms.agreeform.agreecheck.checked=false
	  </script>
	</div>
	
	<?PHP }; ?>
