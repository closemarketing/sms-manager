<?php
if(!function_exists('getCountryCodeFromIP')) {
	function getCountryCodeFromIP($ip) {
		$countries = array("AF"=>"93","AL"=>"355","DZ"=>"213","AD"=>"376","AO"=>"244","AI"=>"809","AG"=>"268","AR"=>"54","AM"=>"374","AW"=>"297","AU"=>"61","AT"=>"43","AZ"=>"994","BH"=>"973","BD"=>"880","BB"=>"246","BY"=>"375","BE"=>"32","BZ"=>"501","BJ"=>"229","BM"=>"809","BT"=>"975","BO"=>"591","BA"=>"387","BW"=>"267","BR"=>"55","IO"=>"246","BN"=>"673","BG"=>"359","BF"=>"226","BI"=>"257","KH"=>"855","CM"=>"237","CA"=>"1","CV"=>"238","KY"=>"345","TD"=>"235","CL"=>"56","CN"=>"86","CI"=>"225","CO"=>"57","CG"=>"242","CD"=>"243","HR"=>"385","CU"=>"53","CY"=>"357","CZ"=>"420","DK"=>"45","DJ"=>"253","DM"=>"767","DO"=>"809","TL"=>"670","EC"=>"593","EG"=>"20","SV"=>"503","GQ"=>"240","EE"=>"372","FK"=>"500","FO"=>"298","FJ"=>"679","FI"=>"358","FR"=>"33","GF"=>"594","PF"=>"689","GA"=>"241","GM"=>"220","GP"=>"590","GE"=>"995","DE"=>"49","GH"=>"233","GI"=>"350","GR"=>"30","GL"=>"299","GD"=>"473","GT"=>"502","GG"=>"32767","GY"=>"592","HT"=>"509","HN"=>"504","HK"=>"852","HU"=>"36","IS"=>"354","IN"=>"91","ID"=>"62","IR"=>"98","IQ"=>"964","IE"=>"353","IM"=>"44","IL"=>"972","IT"=>"39","JM"=>"876","JP"=>"81","JE"=>"44","JO"=>"962","KZ"=>"7","KE"=>"254","KR"=>"82","KW"=>"965","KG"=>"996","LV"=>"371","LB"=>"961","LS"=>"266","LR"=>"231","LY"=>"218","LI"=>"423","LT"=>"370","LU"=>"352","MO"=>"853","MK"=>"389","MG"=>"261","MW"=>"265","MY"=>"60","MV"=>"960","ML"=>"223","MT"=>"356","MQ"=>"596","MR"=>"222","MU"=>"230","MX"=>"52","MD"=>"373","MC"=>"33","MN"=>"976","ME"=>"382","MS"=>"473","MA"=>"212","MZ"=>"258","MM"=>"95","NA"=>"264","NP"=>"977","NL"=>"31","AN"=>"599","NC"=>"687","NZ"=>"64","NI"=>"505","NE"=>"227","NG"=>"234","MP"=>"1670","NO"=>"47","OM"=>"968","PK"=>"92","PS"=>"970","PA"=>"507","PY"=>"595","PE"=>"51","PH"=>"63","PL"=>"48","PT"=>"351","PR"=>"1787","QA"=>"974","RE"=>"262","RO"=>"40","RU"=>"7","RW"=>"250","KN"=>"1869","WL"=>"1758","WV"=>"1784","SA"=>"966","SN"=>"221","RS"=>"381","SC"=>"248","SL"=>"232","SG"=>"65","SK"=>"421","SI"=>"386","SO"=>"252","ZA"=>"27","ES"=>"34","LK"=>"94","SD"=>"249","SR"=>"597","SZ"=>"268","SE"=>"46","CH"=>"41","SY"=>"963","TW"=>"886","TJ"=>"7","TZ"=>"255","TH"=>"66","TG"=>"228","TO"=>"676","TT"=>"1868","TN"=>"216","TR"=>"90","TM"=>"993","UG"=>"256","UA"=>"380","AE"=>"971","GB"=>"44","US"=>"1","UY"=>"598","UZ"=>"7","VU"=>"678","VE"=>"58","VN"=>"84","VG"=>"1284","WF"=>"681","YE"=>"381","ZM"=>"260","ZW"=>"263","RD"=>"00");
		$url = 'http://api.ipinfodb.com/v2/ip_query_country.php?key=491b188e5578d0b516dcd088dbe423fdb3f16d03c13646d09c34c7789d461940&ip='.$ip;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$cdata = curl_exec($ch);
		curl_close($ch);
		$carr = simplexml_load_string($cdata);
		$return = $countries["{$carr->CountryCode}"];
		return $return;
	}
}

if(!function_exists('get_ip')) {
	function get_ip () {
		
		if (isset($_SERVER)) {
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) return $_SERVER["HTTP_X_FORWARDED_FOR"];
			if (isset($_SERVER["HTTP_CLIENT_IP"])) return $_SERVER["HTTP_CLIENT_IP"];
			return $_SERVER["REMOTE_ADDR"];
		}
		
		if (getenv('HTTP_X_FORWARDED_FOR')) {
			if (strstr(getenv('HTTP_X_FORWARDED_FOR'), ',')) {
				return trim(substr(getenv('HTTP_X_FORWARDED_FOR'), 0, strpos(getenv('HTTP_X_FORWARDED_FOR'), ',')));
			}
			else {
				return getenv('HTTP_X_FORWARDED_FOR');
			}
		}
		
		if (getenv('HTTP_CLIENT_IP')) 
			return getenv('HTTP_CLIENT_IP');
		
		return getenv('REMOTE_ADDR');
	}
}

if(!function_exists('countryDropDown')) {
	function countryDropDown() {
?>
	<select name="country" id="country"> 
	<option value = "0">please select...</option> 
	<option value="34">Spain</option> 
	<option value="93">Afghanistan</option> 
	<option value="355">Albania</option> 
	<option value="213">Algeria</option> 
	<option value="376">Andorra</option> 
	<option value="244">Angola</option> 
	<option value="809">Anguilla</option> 
	<option value="268">Antigua and Barbuda</option> 
	<option value="54">Argentina</option> 
	<option value="374">Armenia</option> 
	<option value="297">Aruba</option> 
	<option value="61">Australia</option> 
	<option value="43">Austria</option> 
	<option value="994">Azerbaijan</option> 
	<option value="973">Bahrain</option> 
	<option value="880">Bangladesh</option> 
	<option value="246">Barbados</option> 
	<option value="375">Belarus</option> 
	<option value="32">Belgium</option> 
	<option value="501">Belize</option> 
	<option value="229">Benin</option> 
	<option value="809">Bermuda</option> 
	<option value="975">Bhutan</option> 
	<option value="591">Bolivia</option> 
	<option value="387">Bosnia And Herzegovina</option> 
	<option value="267">Botswana</option> 
	<option value="55">Brazil</option> 
	<option value="246">British Indian Ocean Territory</option> 
	<option value="673">Brunei</option> 
	<option value="359">Bulgaria</option> 
	<option value="226">Burkina Faso</option> 
	<option value="257">Burundi</option> 
	<option value="855">Cambodia</option> 
	<option value="237">Cameroon</option> 
	<option value="1">Canada</option> 
	<option value="238">Cape Verde</option> 
	<option value="345">Cayman Islands</option> 
	<option value="235">Chad</option> 
	<option value="56">Chile</option> 
	<option value="86">China</option> 
	<option value="57">Colombia</option> 
	<option value="242">Congo</option> 
	<option value="243">Congo, Democratic Republic</option> 
	<option value="225">Cote d'Ivoire</option> 
	<option value="385">Croatia</option> 
	<option value="53">Cuba</option> 
	<option value="357">Cyprus</option> 
	<option value="420">Czech Republic</option> 
	<option value="45">Denmark</option> 
	<option value="253">Djibouti</option> 
	<option value="767">Dominica</option> 
	<option value="809">Dominican Republic</option> 
	<option value="670">East Timor</option> 
	<option value="593">Ecuador</option> 
	<option value="20">Egypt</option> 
	<option value="503">El Salvador</option> 
	<option value="240">Equatorial Guinea</option> 
	<option value="372">Estonia</option> 
	<option value="500">Falkland Islands (Malvinas)</option> 
	<option value="298">Faroe Islands</option> 
	<option value="679">Fiji</option> 
	<option value="358">Finland</option> 
	<option value="33">France</option> 
	<option value="594">French Guiana</option> 
	<option value="689">French Polynesia</option> 
	<option value="241">Gabon</option> 
	<option value="220">Gambia</option> 
	<option value="995">Georgia</option> 
	<option value="49">Germany</option> 
	<option value="233">Ghana</option> 
	<option value="350">Gibraltar</option> 
	<option value="30">Greece</option> 
	<option value="299">Greenland</option> 
	<option value="473">Grenada</option> 
	<option value="590">Guadeloupe</option> 
	<option value="502">Guatemala</option> 
	<option value="32767">Guernsey</option> 
	<option value="592">Guyana</option> 
	<option value="509">Haiti</option> 
	<option value="504">Honduras</option> 
	<option value="852">Hong Kong</option> 
	<option value="36">Hungary</option> 
	<option value="354">Iceland</option> 
	<option value="91">India</option> 
	<option value="62">Indonesia</option> 
	<option value="98">Iran</option> 
	<option value="964">Iraq</option> 
	<option value="353">Ireland</option> 
	<option value="44">Isle Of Man</option> 
	<option value="972">Israel</option> 
	<option value="39">Italy</option> 
	<option value="876">Jamaica</option> 
	<option value="81">Japan</option> 
	<option value="44">Jersey</option> 
	<option value="962">Jordan</option> 
	<option value="7">Kazakhstan</option> 
	<option value="254">Kenya</option> 
	<option value="82">Korea, South</option> 
	<option value="965">Kuwait</option> 
	<option value="996">Kyrgyzstan</option> 
	<option value="371">Latvia</option> 
	<option value="961">Lebanon</option> 
	<option value="266">Lesotho</option> 
	<option value="231">Liberia</option> 
	<option value="218">Libya</option> 
	<option value="423">Liechtenstein</option> 
	<option value="370">Lithuania</option> 
	<option value="352">Luxembourg</option> 
	<option value="853">Macao</option> 
	<option value="389">Macedonia</option> 
	<option value="261">Madagascar</option> 
	<option value="265">Malawi</option> 
	<option value="60">Malaysia</option> 
	<option value="960">Maldives</option> 
	<option value="223">Mali</option> 
	<option value="356">Malta</option> 
	<option value="596">Martinique </option> 
	<option value="222">Mauritania</option> 
	<option value="230">Mauritius</option> 
	<option value="52">Mexico</option> 
	<option value="373">Moldova</option> 
	<option value="33">Monaco</option> 
	<option value="976">Mongolia</option> 
	<option value="382">Montenegro</option> 
	<option value="473">Montserrat</option> 
	<option value="212">Morocco </option> 
	<option value="258">Mozambique</option> 
	<option value="95">Myanmar</option> 
	<option value="264">Namibia</option> 
	<option value="977">Nepal</option> 
	<option value="31">Netherlands</option> 
	<option value="599">Netherlands Antilles</option> 
	<option value="687">New Caledonia</option> 
	<option value="64">New Zealand</option> 
	<option value="505">Nicaragua</option> 
	<option value="227">Niger</option> 
	<option value="234">Nigeria</option> 
	<option value="1670">Northern Mariana Islands</option> 
	<option value="47">Norway</option> 
	<option value="968">Oman</option> 
	<option value="92">Pakistan</option> 
	<option value="970">Palestine</option> 
	<option value="507">Panama</option> 
	<option value="595">Paraguay</option> 
	<option value="51">Peru</option> 
	<option value="63">Philippines</option> 
	<option value="48">Poland</option> 
	<option value="351">Portugal </option> 
	<option value="1787">Puerto Rico</option> 
	<option value="974">Qatar</option> 
	<option value="262">Reunion</option> 
	<option value="40">Romania</option> 
	<option value="7">Russia</option> 
	<option value="250">Rwanda </option> 
	<option value="1869">Saint Kitts and Nevis</option> 
	<option value="1758">Saint Lucia</option> 
	<option value="1784">Saint Vincent</option> 
	<option value="966">Saudi Arabia</option> 
	<option value="221">Senegal</option> 
	<option value="381">Serbia</option> 
	<option value="248">Seychelles</option> 
	<option value="232">Sierra Leone</option> 
	<option value="65">Singapore</option> 
	<option value="421">Slovakia</option> 
	<option value="386">Slovenia</option> 
	<option value="252">Somalia</option> 
	<option value="27">South Africa</option> 
	<option value="94">Sri Lanka</option> 
	<option value="249">Sudan</option> 
	<option value="597">Suriname</option> 
	<option value="268">Swaziland</option> 
	<option value="46">Sweden</option> 
	<option value="41">Switzerland</option> 
	<option value="963">Syria</option> 
	<option value="886">Taiwan</option> 
	<option value="7">Tajikistan</option> 
	<option value="255">Tanzania</option> 
	<option value="66">Thailand</option> 
	<option value="228">Togo</option> 
	<option value="676">Tonga</option> 
	<option value="1868">Trinidad And Tobago</option> 
	<option value="216">Tunisia</option> 
	<option value="90">Turkey</option> 
	<option value="993">Turkmenistan</option> 
	<option value="256">Uganda</option> 
	<option value="380">Ukraine</option> 
	<option value="971">United Arab Emirates</option> 
	<option value="44">United Kingdom</option> 
	<option value="1">United States</option> 
	<option value="598">Uruguay</option> 
	<option value="7">Uzbekistan</option> 
	<option value="678">Vanuatu</option> 
	<option value="58">Venezuela</option> 
	<option value="84">Viet Nam</option> 
	<option value="1284">Virgin Islands, British</option> 
	<option value="681">Wallis And Futuna</option> 
	<option value="381">Yemen</option> 
	<option value="260">Zambia</option> 
	<option value="263">Zimbabwe</option> 
	</select>
<?php
	}
}
?>