

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inventory list </title>

<script src="<?php echo base_url();?>scripts/form.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="../style/accform.css">
<style type="text/css">
#mainWrapper h3 {
	color: #666;
}
</style>
</head>

<body>
<td valign="top">
<table cellspacing="0" cellpadding="0" border="0" valign="top">
<tbody>
<tr>
<td valign="top">
<div class="contentN X_MarginRight">

<table class="OrderCss" width="540" cellspacing="5" cellpadding="5" border="0" align="center">
<tbody>
<tr>
<td class="OrderTopActive" width="120" align="center">Alışveriş Sepetim</td>
<td class="OrderTopActive" width="320" align="center">Fatura & Teslimat Bilgileri</td>
<td class="OrderTopPassive" width="100" align="center">Ödeme İşlemi</td>
</tr>
<tr>
<td height="30" background="../images/order2top.png" style="background-position:center; background-repeat:no-repeat;" colspan="3"></td>
</tr>
</tbody>
</table>
<form id="orderForm" onsubmit="return controlForm();" method="POST" action="index.php?do=catalog/order3" name="orderForm">
<table width="100%">
<tbody>
<tr>
<td>
<span class="OrderCss">
<table class="OrderHeader" width="100%" cellspacing="1" cellpadding="1" border="0">
<tbody>
<tr>
<td>Kişisel Bilgiler</td>
</tr>
</tbody>
</table>
<table class="OrderMiddle" width="100%">
<tbody>
<tr>
<td width="120" valign="top">
<strong>Adınız ve Soyadınız</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="p_fullname" class="OrderTextBox" type="text" value="" name="p_fullname">
<font color="Red" style="line-height: 22px;">*</font>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Email</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="p_email" class="OrderTextBox" type="text" value="" name="p_email">
<font color="Red" style="line-height: 22px;">*</font>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Email Tekrar</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="p_email2" class="OrderTextBox" type="text" value="" name="p_email2">
<font color="Red" style="line-height: 22px;">*</font>
<a onmouseout="HideTooltip()" onmouseover="ShowTooltip(event,'emailInfo')" href="#">
<img border="0" align="top" src="class/assets/webform/info.gif">
</a>
<div id="emailInfo" class="ToolTip" style="display:none;">Lütfen email adresinizi doğru giriniz.</div>
</td>
</tr>
</tbody>
</table>
</span>
</td>
</tr>
<tr>
<td valign="top">
<span class="OrderCss">
<table class="OrderHeader" width="100%" cellspacing="1" cellpadding="1" border="0">
<tbody>
<tr>
<td width="48%">Teslimat Bilgileri</td>
<td width="48%" valign="middle" colspan="3" style="text-align:right;">
<div id="s_addressWarningLabel" style="display: none; color: red; font-weight: bold;"></div>
</td>
<td width="4%">
<span id="preloader" style="visibility: hidden; float: right;">
<img src="class/assets/shared/spinner.gif">
</span>
</td>
</tr>
</tbody>
</table>
<table class="OrderMiddle" width="100%" cellspacing="1" cellpadding="1" border="0">
<tbody>
<tr>
<td valign="top">
<span id="s_addressNameLabel" style="display: none;">
<strong>Adres İsmi</strong>
</span>
</td>
<td valign="top" align="center">
<span id="s_addressNameColon" style="display: none;">
<b>:</b>
</span>
</td>
<td>
<input id="s_addressName" class="OrderTextBox" type="text" style="display: none;" name="s_addressName">
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Adı Soyadı</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="s_name" class="OrderTextBox" type="text" value=" " name="s_name">
<font color="Red" style="line-height: 22px;">*</font>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Adres</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<textarea id="s_address" class="OrderTextArea" rows="4" cols="30" name="s_address"></textarea>
<font color="Red" style="line-height: 22px;">*</font>
<a onmouseout="HideTooltip()" onmouseover="ShowTooltip(event,'addressinfo')" href="#">
<img border="0" align="top" src="class/assets/webform/info.gif">
</a>
<div id="addressinfo" class="ToolTip" style="display:none;">Lütfen bilgilerinizi tam ve doğru olarak giriniz.</div>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Ülke</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<div>
<div class="cmf-skinned-select" style="width: 60px; height: 16px; background-color: rgb(255, 255, 255); color: rgb(77, 77, 77); font-size: 11px; font-family: MS Shell Dlg; font-style: normal; position: relative;">
<div class="cmf-skinned-text" style="height: 21px; opacity: 100; overflow: hidden; position: absolute; text-indent: 0px; z-index: 1; left: 0px;">Türkiye</div>
<select id="s_country" class="DropDown" style="opacity: 0; position: relative; z-index: 100;" size="1" name="s_country" onchange="setCity(jQuery(this).val(),'s');">
<option value="170">KKTC</option>
<option selected="selected" value="1">Türkiye</option>
</select>
</div>
<font color="Red" style="line-height: 22px;">*</font>
</div>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Şehir</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<div id="s_city_content">
<div class="cmf-skinned-select" style="width: 104px; height: 16px; background-color: rgb(255, 255, 255); color: rgb(77, 77, 77); font-size: 11px; font-family: MS Shell Dlg; font-style: normal; position: relative;">
<div class="cmf-skinned-text" style="height: 21px; opacity: 100; overflow: hidden; position: absolute; text-indent: 0px; z-index: 1; left: 0px;">Seçiniz</div>
<select id="s_city" class="DropDown" style="opacity: 0; position: relative; z-index: 100;" size="1" name="s_city" onchange="calcShipping();">
<option value="">Seçiniz</option>
<option value="1">İstanbul-Avrupa</option>
<option value="2">İstanbul-Anadolu</option>
<option value="3">Ankara</option>
<option value="4">İzmir</option>
<option value="5">Adana</option>
<option value="6">Adıyaman</option>
<option value="7">Afyon</option>
<option value="8">Ağrı</option>
<option value="9">Aksaray</option>
<option value="10">Amasya</option>
<option value="11">Antalya</option>
<option value="12">Ardahan</option>
<option value="13">Artvin</option>
<option value="14">Aydın</option>
<option value="15">Balıkesir</option>
<option value="16">Bartın</option>
<option value="17">Batman</option>
<option value="18">Bayburt</option>
<option value="19">Bilecik</option>
<option value="20">Bingöl</option>
<option value="21">Bitlis</option>
<option value="22">Bolu</option>
<option value="23">Burdur</option>
<option value="24">Bursa</option>
<option value="25">Çanakkale</option>
<option value="26">Çankırı</option>
<option value="27">Çorum</option>
<option value="28">Denizli</option>
<option value="29">Diyarbakır</option>
<option value="30">Edirne</option>
<option value="31">Elazığ</option>
<option value="32">Erzincan</option>
<option value="33">Erzurum</option>
<option value="34">Eskişehir</option>
<option value="35">Gaziantep</option>
<option value="36">Giresun</option>
<option value="37">Gümüşhane</option>
<option value="38">Hakkari</option>
<option value="39">Hatay</option>
<option value="40">Iğdır</option>
<option value="41">Isparta</option>
<option value="42">İçel</option>
<option value="43">Kars</option>
<option value="44">Kastamonu</option>
<option value="45">Kayseri</option>
<option value="46">Kırıkkale</option>
<option value="47">Kırklareli</option>
<option value="48">Kırşehir</option>
<option value="49">Kocaeli</option>
<option value="50">Konya</option>
<option value="51">Kütahya</option>
<option value="52">Malatya</option>
<option value="53">Manisa</option>
<option value="54">Kahramanmaraş</option>
<option value="55">Karabük</option>
<option value="56">Karaman</option>
<option value="57">Kilis</option>
<option value="58">Mardin</option>
<option value="59">Muğla</option>
<option value="60">Muş</option>
<option value="61">Nevşehir</option>
<option value="62">Niğde</option>
<option value="63">Ordu</option>
<option value="64">Osmaniye</option>
<option value="65">Rize</option>
<option value="66">Sakarya</option>
<option value="67">Samsun</option>
<option value="68">Siirt</option>
<option value="69">Sinop</option>
<option value="70">Sivas</option>
<option value="71">Tekirdağ</option>
<option value="72">Tokat</option>
<option value="73">Trabzon</option>
<option value="74">Tunceli</option>
<option value="75">Şanlıurfa</option>
<option value="76">Şırnak</option>
<option value="77">Uşak</option>
<option value="78">Van</option>
<option value="79">Yalova</option>
<option value="80">Yozgat</option>
<option value="81">Zonguldak</option>
<option value="82">Düzce</option>
<option value="83">Kıbrıs - Mağusa</option>
<option value="84">Kıbrıs - Lefkoşa</option>
<option value="85">Kıbrıs - İskele</option>
<option value="86">Kıbrıs - Güzelyurt</option>
<option value="87">Kıbrıs - Girne</option>
</select>
</div>
<font id="s_citywarn" color="Red" style="line-height: 22px;">*</font>
</div>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>İlçe</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="s_district" class="OrderTextBox" type="text" value="" name="s_district">
<font color="Red" style="line-height: 22px;"></font>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Telefon</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="s_phone" class="OrderTextBox" type="text" value="" name="s_phone">
<font color="Red" style="line-height: 22px;">*</font>
</td>
</tr>
<tr>
<td valign="top">
<strong>Cep Telefonu</strong>
</td>
<td valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="s_cell" class="OrderTextBox" type="text" value="" name="s_cell">
</td>
</tr>
<tr>
<td valign="top">
<b>Kargo Firması</b>
</td>
<td valign="top" align="center">
<b>:</b>
</td>
<td height="23">
<div id="viewShippingCompaniesDiv"> </div>
<div>
<div class="cmf-skinned-select" style="width: 103px; height: 16px; background-color: rgb(255, 255, 255); color: rgb(77, 77, 77); font-size: 11px; font-family: MS Shell Dlg; font-style: normal; position: relative;">
<div class="cmf-skinned-text" style="height: 21px; opacity: 100; overflow: hidden; position: absolute; text-indent: 0px; z-index: 1; left: 0px;">SÜRAT KARGO</div>
<select id="s_company" class="DropDown" onchange="calcShipping()" name="s_company" style="opacity: 0; position: relative; z-index: 100;">
<option value="13">SÜRAT KARGO</option>
</select>
</div>
</div>
</td>
</tr>
<tr style="line-height:40px;">
<td valign="top">
<b>Kargo Ücreti</b>
</td>
<td valign="top" align="center">
<b>:</b>
</td>
<td height="25">
<div id="shippingSummary"> 0,00 TL </div>
</td>
</tr>
<tr>
<td valign="top" colspan="3">
<div id="payAtDeliveryInfo" class="Red"> </div>
</td>
</tr>
<tr>
<td height="20" colspan="3">
<div id="minShipping" class="Red">100,00 TL üzeri siparişlerinizde kargo ücretsizdir! (9999.00 desi'ye kadar)</div>
</td>
</tr>
<tr>
<td valign="top"> </td>
<td valign="top" align="center"> </td>
<td height="20"> </td>
</tr>
</tbody>
</table>
</span>
</td>
</tr>
<tr>
<td valign="top">
<span class="OrderCss">
<table class="OrderHeader" width="100%" cellspacing="1" cellpadding="1" border="0">
<tbody>
<tr>
<td>Fatura Bilgileri</td>
<td align="right">
<a class="ordercopylink" style="color:#224499;text-decoration:none;" href="Javascript:copyInfo()">
<img width="16px" height="16px" border="0" align="absmiddle" src="/images/icons/page_copy.png">
Teslimat Bilgilerinden Kopyala
</a>
</td>
</tr>
</tbody>
</table>
<table class="OrderMiddle" width="100%" cellspacing="1" cellpadding="1" border="0">
<tbody>
<tr>
<td valign="top">
<span id="b_addressNameLabel" style="display: none;">
<strong>Adres İsmi</strong>
</span>
</td>
<td valign="top" align="center">
<span id="b_addressNameColon" style="display: none;">
<b>:</b>
</span>
</td>
<td>
<input id="b_addressName" class="OrderTextBox" type="text" style="display: none;" name="b_addressName">
</td>
</tr>
<tr>
<td width="120"></td>
<td wdith="5"></td>
<td valign="middle" colspan="3">
<div id="b_addressWarningLabel" style="display: none; color: red; font-weight: bold;"></div>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Fatura Türü</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="b_type" type="radio" checked="" onclick="changeInvoice(0)" value="0" name="b_type">
Bireysel
<input id="b_type" type="radio" onclick="changeInvoice(1)" value="1" name="b_type">
Kurumsal
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>
<span id="b_name_label">Adı Soyadı</span>
</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="b_name" class="OrderTextBox" type="text" value=" " name="b_name">
<font color="Red" style="line-height: 22px;">*</font>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Adres</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<textarea id="b_address" class="OrderTextArea" rows="4" cols="30" name="b_address"></textarea>
<font color="Red" style="line-height: 22px;">*</font>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Ülke</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<div>
<div class="cmf-skinned-select" style="width: 60px; height: 16px; background-color: rgb(255, 255, 255); color: rgb(77, 77, 77); font-size: 11px; font-family: MS Shell Dlg; font-style: normal; position: relative;">
<div class="cmf-skinned-text" style="height: 21px; opacity: 100; overflow: hidden; position: absolute; text-indent: 0px; z-index: 1; left: 0px;">Türkiye</div>
<select id="b_country" class="DropDown" style="opacity: 0; position: relative; z-index: 100;" size="1" name="b_country" onchange="setCity(jQuery(this).val(),'b');">
<option value="170">KKTC</option>
<option selected="selected" value="1">Türkiye</option>
</select>
</div>
<font color="Red" style="line-height: 22px;">*</font>
</div>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Şehir</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<div id="b_city_content">
<div class="cmf-skinned-select" style="width: 104px; height: 16px; background-color: rgb(255, 255, 255); color: rgb(77, 77, 77); font-size: 11px; font-family: MS Shell Dlg; font-style: normal; position: relative;">
<div class="cmf-skinned-text" style="height: 21px; opacity: 100; overflow: hidden; position: absolute; text-indent: 0px; z-index: 1; left: 0px;">Seçiniz</div>
<select id="b_city" class="DropDown" style="opacity: 0; position: relative; z-index: 100;" size="1" name="b_city">
<option value="">Seçiniz</option>
<option value="1">İstanbul-Avrupa</option>
<option value="2">İstanbul-Anadolu</option>
<option value="3">Ankara</option>
<option value="4">İzmir</option>
<option value="5">Adana</option>
<option value="6">Adıyaman</option>
<option value="7">Afyon</option>
<option value="8">Ağrı</option>
<option value="9">Aksaray</option>
<option value="10">Amasya</option>
<option value="11">Antalya</option>
<option value="12">Ardahan</option>
<option value="13">Artvin</option>
<option value="14">Aydın</option>
<option value="15">Balıkesir</option>
<option value="16">Bartın</option>
<option value="17">Batman</option>
<option value="18">Bayburt</option>
<option value="19">Bilecik</option>
<option value="20">Bingöl</option>
<option value="21">Bitlis</option>
<option value="22">Bolu</option>
<option value="23">Burdur</option>
<option value="24">Bursa</option>
<option value="25">Çanakkale</option>
<option value="26">Çankırı</option>
<option value="27">Çorum</option>
<option value="28">Denizli</option>
<option value="29">Diyarbakır</option>
<option value="30">Edirne</option>
<option value="31">Elazığ</option>
<option value="32">Erzincan</option>
<option value="33">Erzurum</option>
<option value="34">Eskişehir</option>
<option value="35">Gaziantep</option>
<option value="36">Giresun</option>
<option value="37">Gümüşhane</option>
<option value="38">Hakkari</option>
<option value="39">Hatay</option>
<option value="40">Iğdır</option>
<option value="41">Isparta</option>
<option value="42">İçel</option>
<option value="43">Kars</option>
<option value="44">Kastamonu</option>
<option value="45">Kayseri</option>
<option value="46">Kırıkkale</option>
<option value="47">Kırklareli</option>
<option value="48">Kırşehir</option>
<option value="49">Kocaeli</option>
<option value="50">Konya</option>
<option value="51">Kütahya</option>
<option value="52">Malatya</option>
<option value="53">Manisa</option>
<option value="54">Kahramanmaraş</option>
<option value="55">Karabük</option>
<option value="56">Karaman</option>
<option value="57">Kilis</option>
<option value="58">Mardin</option>
<option value="59">Muğla</option>
<option value="60">Muş</option>
<option value="61">Nevşehir</option>
<option value="62">Niğde</option>
<option value="63">Ordu</option>
<option value="64">Osmaniye</option>
<option value="65">Rize</option>
<option value="66">Sakarya</option>
<option value="67">Samsun</option>
<option value="68">Siirt</option>
<option value="69">Sinop</option>
<option value="70">Sivas</option>
<option value="71">Tekirdağ</option>
<option value="72">Tokat</option>
<option value="73">Trabzon</option>
<option value="74">Tunceli</option>
<option value="75">Şanlıurfa</option>
<option value="76">Şırnak</option>
<option value="77">Uşak</option>
<option value="78">Van</option>
<option value="79">Yalova</option>
<option value="80">Yozgat</option>
<option value="81">Zonguldak</option>
<option value="82">Düzce</option>
<option value="83">Kıbrıs - Mağusa</option>
<option value="84">Kıbrıs - Lefkoşa</option>
<option value="85">Kıbrıs - İskele</option>
<option value="86">Kıbrıs - Güzelyurt</option>
<option value="87">Kıbrıs - Girne</option>
</select>
</div>
<font id="b_citywarn" color="Red" style="line-height: 22px;">*</font>
</div>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>İlçe</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="b_district" class="OrderTextBox" type="text" value="" name="b_district">
<font color="Red" style="line-height: 22px;"></font>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Telefon</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="b_phone" class="OrderTextBox" type="text" value="" name="b_phone">
<font color="Red" style="line-height: 22px;">*</font>
</td>
</tr>
<tr>
<td width="120" valign="top">
<strong>Cep Telefonu</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="b_cell" class="OrderTextBox" type="text" value="" name="b_cell">
<font color="Red" style="line-height: 22px;">*</font>
</td>
</tr>
<tr id="tcId">
<td width="120" valign="top">
<strong>T.C Kimlik No</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="b_tcId" class="OrderTextBox" type="text" value="" maxlength="11" name="b_tcId">
</td>
</tr>
<tr id="taxId" style="display:none;">
<td width="120" valign="top">
<strong>Vergi No</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="b_taxId" class="OrderTextBox" type="text" value="" name="b_taxId">
<font id="control2" color="Red"></font>
</td>
</tr>
<tr id="taxPlace" style="display:none;">
<td width="120" valign="top">
<strong>Vergi Dairesi</strong>
</td>
<td width="5" valign="top" align="center">
<strong>:</strong>
</td>
<td>
<input id="b_taxPlace" class="OrderTextBox" type="text" value="" name="b_taxPlace">
<font id="control3" color="Red"></font>
</td>
</tr>
</tbody>
</table>
</span>
</td>
</tr>
<tr>
<td valign="top">
<span class="OrderCss">


</span>
</td>
</tr>
</tbody>
</table>
<table width="100%">
<tbody>
<tr>
<td align="left" style="color:red"> </td>
<td align="right">
<input class="btn_gri2" type="button" value="Geri" onclick="window.location = 'index.php?do=catalog/order';" name="button">
<input class="btn_mavi3" type="submit" value="Ödeme">
</td>
</tr>
</tbody>
</table>
</form>

</div>
</td>
</tr>
</tbody>
</table>
</td>
</body></html>
