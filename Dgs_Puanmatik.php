<style>

.button{
	background-color: #8D9293;
	transition-duration: 0.4s;
	padding: 16px 32px;
	border-radius: 12px
}
.button:hover {
   background-color: #F286B5;
  color: white;
}
.center{
	margin-top:200;
	margin-left:auto;
	margin-right:auto;
	
}
.center ,td{
	border: 1px solid black;
	border-radius: 10px;
	background-color:#B2BEB5;
}
.round{
	border-radius: 15px;
}
.sonuc{
	margin-left:auto;
	margin-right:auto;
	margin-top:80px;
	border: 1px solid black;
	border-radius: 10px;
	background-color:#B2BEB5;
}
</style>
<table class="center">
	<form method="post" action="Dgs_Puanmatik.php">
		<tr>
			<td colspan="3" align="center"><b>DGS Puanmatik</b></td>
		</tr>
		<tr>
			<td></td>
			<td align="center">Doğru</td>
			<td align="center">Yanlış</td>
		</tr>
		<tr>
			<td>Sayısal Testi</td>
			<td><input class="round" type="text" name="sayisalD"></td>
			<td><input class="round" type="text" name="sayisalY"></td>
		</tr>
		<tr>
			<td>Sözel Testi</td>
			<td><input class="round" type="text" name="sozelD"></td>
			<td><input class="round" type="text" name="sozelY"></td>
		</tr>
		<tr>
			<td>Önlisans Başarı Puanı(Zorunlu Alan)</td>
			<td><input class="round" type="number" name="onlisansD" required oninvalid="this.setCustomValidity('ÖBP alanını boş bıraktığınızdan puanınız hesaplanamamıştır')" ></td>
			
		</tr>
		<tr>
			<td>Alanınız</td>
			<td colspan="2">
				<input type="radio" name="alan" value="sayisal">Sayısal
				<input type="radio" name="alan" value="sozel">Sözel
				<input type="radio" name="alan" value="esitA">Eşit Ağırlık
			</td>
			
		</tr>
		<tr>
			<td>2024 öncesinde DGS ile bir programa yerleştirildiniz mi?</td>
			<td><input type="radio" name="yerlesme" value="yerlesmeE">Evet</td>
			<td><input type="radio" name="yerlesme" value="yerlesmeH">Hayır</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
			<input class="button" type="submit" name="kayıt" value="Hesapla">
			<input class="button" type="reset" name="temizle" value="Temizle" onclick="location.reload()" >
			</td>
			
		</tr>
	</form>
</table>

<?php
echo "<body style='background-color:#A1ABA3'>";
if(isset($_POST['temizle']))
{
header("Location: /index.php");
}
if(isset($_POST['kayıt'])){
$sayisalD=$_POST['sayisalD'];
$sayisalY=$_POST['sayisalY'];
$sayisalN;
$sayisalSp;
$dgsSayisal;

$sozelD=$_POST['sozelD'];
$sozelY=$_POST['sozelY'];
$sozelN;
$sozelSp;
$dgsSozel;

$esitASp;
$esitAN;
$dgsEA;

$onlisansP=$_POST['onlisansD'];

$radio=$_POST['alan'];

$yerlesme=$_POST['yerlesme'];

$dgsP;

while ($sayisalY>=1){
	$sayisalD -= 0.25;
	$sayisalY -= 1;
}

while ($sozelY>=1){
	$sozelD -= 0.25;
	$sozelY -= 1;
}

if($yerlesme =="yerlesmeE")
{
	$onlisansP *= 0.45;
}
if($yerlesme =="yerlesmeH")
{
	$onlisansP *= 0.6;
}
if($radio =="sayisal")
{
	$sayisalSp = $sayisalD * 3; 
	$sozelSp = $sozelD * 0.6;
	$dgsSayisal = $sayisalSp + $sozelSp + $onlisansP;
}
if($radio =="sozel")
{
	$sayisalSp = $sayisalD * 0.6; 
	$sozelSp = $sozelD * 3;
	$dgsSayisal = $sayisalSp + $sozelSp + $onlisansP;
}
if($radio =="esitA")
{
	$sayisalSp = $sayisalD * 1.8; 
	$sozelSp = $sozelD * 1.8;
	$dgsSayisal = $sayisalSp + $sozelSp + $onlisansP;
}

$dgsSozel = $sayisalSp + $sozelSp + $onlisansP;
$dgsEA = $sayisalSp + $sozelSp + $onlisansP; 
switch($radio)
{
	case "sayisal":
	$dgsSayisal += 255;
	
	break;
		
	case "sozel":
	$dgsSozel += 120;
	
	break;
	
	case "esitA":
	$dgsEA += 222;
	
	break;
	
}
if($sayisalD < 2.5 || $sozelD < 2.5)
{
	echo "Netiniz 2,5'den düşük olduğu için puanınız hesaplanmamıştır.";
}
else
{
 echo "<table class='sonuc'>";
 echo "<tr><td>Sayısal Netiniz:".$sayisalD."</td></tr>";
 echo "<tr><td>Sözel Netiniz:".$sozelD."</td></tr>";
 echo "<tr><td>Sayısal Puanınız:".$dgsSayisal."</td></tr>";
 echo "<tr><td>Sözel Puanınız:".$dgsSozel."</td></tr>";
 echo "<tr><td>Eşit A. Puanınız:".$dgsEA."</td></tr>";
 echo "</table>";
 
}
}

?>