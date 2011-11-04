<fieldset><div class="LL_box">
	<label for="name" class="column">We are</label><input type="text" name="name" value="<{$default.name}>" class="compulsory">,
	<div class="column">(name of the school; e.g. "School No. 123")</div>
	<span class="LL_clearer"></span>
	<label for="city" class="column">from the city of</label><input type="text" name="city" value="<{$default.city}>" class="compulsory">
	<span class="LL_clearer"></span>
	<label for="country" class="column">in the country of</label>
		<select name="country" class="compulsory">
		<{foreach from=$countries item=country}>
		<option value="<{$country.codenumber}>"<{if $default.country}><{selected value=$default.country current=$country.codenumber}><{else}><{selected value=$default.countryiso current=$country.iso}><{/if}>><{$country.name}></option>
		<{/foreach}>
		</select>.
	</div></fieldset>
	
	<fieldset><div class="LL_box">
	<label for="address" class="column">Our city address is</label><input type="text" name="address" value="<{$default.address}>" class="compulsory">,
	<div class="column">(please do not include post code, city or country name)</div>
	<span class="LL_clearer"></span>
	<label for="zipcode" class="column">with ZIP/post code</label><input type="text" name="zipcode" value="<{$default.zipcode}>">.
	<span class="LL_clearer" style="height: 2em"></span>
	
	You can reach us<br>
	<label for="tel" class="column">by telephone at</label><input type="text" name="tel" value="<{$default.tel}>">,
	<span class="LL_clearer"></span>
	<label for="fax" class="column">by fax at</label><input type="text" name="fax" value="<{$default.fax}>">,
	<span class="LL_clearer"></span>
	<div class="column">(provide international and regional code; e.g. + 44 123 ...)</div>
	<span class="LL_clearer" style="height: 1em"></span>
	
	<label for="email" class="column">by E-mail at</label><input type="text" name="email" value="<{$default.email}>">,
	<span class="LL_clearer"></span>
	<div class="column">(only one address; e.g. "friendship-schools@life-link.org")</div>
	<span class="LL_clearer" style="height: 1em"></span>
	<label for="website" class="column">or on the Internet Website</label><input type="text" name="website" value="<{$default.website}>">.
	</div></fieldset>
	
	<fieldset><div class="LL_box">
	Our Life-Link contacts will be<br>
	<label for="teachercontact" class="column">teacher(s)</label><input type="text" name="teachercontact" value="<{$default.teachercontact}>" class="compulsory">,
	<span class="LL_clearer"></span>
	<div class="column">(one or more teachers; separate teachers by comma)</div>
	<span class="LL_clearer"></span>
	<div class="column">(First Name Family/Surname; e.g. "John Forrester, Marie Gore")</div>
	<span class="LL_clearer" style="height: 1em"></span>
	
	<label for="teachercontactemail" class="column">using these E-mail(s)</label><input type="text" name="teachercontactemail" value="<{$default.teachercontactemail}>">,
	<span class="LL_clearer"></span>
	<div class="column">(one address/blank space per teacher; separate by comma)</div>
	<span class="LL_clearer"></span>
	<div class="column">(e.g. " , friendship-schools@life-link.org")</div>
	<span class="LL_clearer" style="height: 1em"></span>
	
	<label for="studentcontact" class="column">and students(s)</label><input type="text" name="studentcontact" value="<{$default.studentcontact}>" class="compulsory">,
	<span class="LL_clearer"></span>
	<div class="column">(one or more students; separate students by comma)</div>
	<span class="LL_clearer"></span>
	<div class="column">(First Name Family/Surname; e.g. "John Forrester, Marie Gore")</div>
	<span class="LL_clearer" style="height: 1em"></span>
	
	<label for="studentcontactemail" class="column">using these E-mail(s)</label><input type="text" name="studentcontactemail" value="<{$default.studentcontactemail}>">,
	<span class="LL_clearer"></span>
	<div class="column">(one address/blank space per student; separate by comma).</div>
	<span class="LL_clearer"></span>
	<div class="column">(e.g. "actions@life-link.org, ")</div>
	</div></fieldset>