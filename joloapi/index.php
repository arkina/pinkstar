<html>
	<body>
<form name="prepaidrecharge" method="post" action="b.php">
Enter Mobile Number: <input type="text" name="mobile" maxlength="10">
<br/>
Enter Amount: <input type="text" name="amount" maxlength="1000">
<br/>
Select Operator:
<select name="operator">
 <option value="">Choose</option>
<option value="AT">Airtel</option>
 <option value="AL">Aircel</option>
 <option value="BS">BSNL</option>
 <option value="BSS">BSNL Special</option>
 <option value="IDX">Idea</option>
 <option value="VF">Vodafone</option>
</select>
<button type="submit">Recharge</button>
</form>
	</body>
</html>