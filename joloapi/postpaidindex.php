<html>
	<body>
<form name="prepaidrecharge" method="post" action="postpaid.php">
Enter Mobile Number: <input type="text" name="mobile" maxlength="10">
<br/>
Enter Amount: <input type="text" name="amount" maxlength="1000">
<br/>
Select Operator:
<select name="operator">
 <option value="">Choose</option>
<option value="APOS">Airtel</option>
 <option value="AL">Aircel</option>
 <option value="BS">BSNL</option>
 <option value="BSS">BSNL Special</option>
 <option value="IDX">Idea</option>
 <option value="VPOS">Vodafone</option>
</select>
<button type="submit">Recharge</button>
</form>
	</body>
</html>