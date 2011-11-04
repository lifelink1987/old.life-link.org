<h1>School Information</h1>

<blockquote>
	<h2><{$school.name}> from <strong><{$school.city}>, <{$school.countryname}></strong></h2>
	<{if $school.registered}>
		registered with no. <{$school.schoolnumber}>
	<{/if}>
	
	<br><br>
	<blockquote>
		<strong>Address</strong>: <{$school.address}><br>
		<strong>City/Village, ZipCode/PostCode, Country</strong>: <{$school.city}>, <{$school.zipcode}>, <{$school.countryname|upper}>
		
		<br><br>
		<strong>Telephone(s)</strong>: <{$school.tel}><br>
		<strong>Fax(s)</strong>: <{$school.fax}>
		
		<br><br>
		<strong>E-mail(s)</strong>: <{$school.email}><br>
		<strong>Website</strong>: <{$school.website}>
		
		<br><br>
		<strong>Contact Student(s)</strong>: <{$school.studentcontact}><br>
		<strong>Contact Teacher(s)</strong>: <{$school.teachercontact}>
	</blockquote>
</blockquote>