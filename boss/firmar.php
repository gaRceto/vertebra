<?php
$json=json_decode(file_get_contents('php://input'));
if(isset($json->email)){
	$name=trim($json->name);
	$apellidos=trim($json->apellidos);
	$dni=strtoupper(trim($json->dni));
	$profesion=trim($json->profesion);
	$email=trim($json->email);
	$localidad=trim($json->localidad);
	$sep=explode(" ",$localidad);
	$entero="";
	foreach($sep as $one)
      $entero.=($one!="de")?ucFirst(strtolower($one))." ":$one." ";
	$localidad=trim($entero);
	$localidad=($localidad=="Alagon")?"Alagón":$localidad;
	$localidad=($localidad=="Grisen")?"Grisén":$localidad;
	$localidad=($localidad=="Mallen")?"Mallén":$localidad;	
	$localidad=($localidad=="Torres de Berrellen")?"Torres de Berrellén":$localidad;
	$provincia=trim($json->provincia);
	$sep=explode(" ",$provincia);
	$entero="";
	foreach($sep as $one)
	  $entero.=ucFirst(strtolower($one))." ";
	$provincia=trim($entero);
	$cargo=$json->cargo;
	$privacidad=$json->privacidad;
	$fecha=Date("Y-m-d H:i:s");

	try{
				$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
				$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				$user = array('name'=>$name,'apellidos'=>$apellidos, 'dni'=>$dni,'profesion'=>$profesion,'email'=>$email,'localidad'=>$localidad, 'provincia'=>$provincia, 'cargo'=>$cargo, 'privacidad'=>$privacidad, 'fecha'=>$fecha);
				$result=$conn->prepare( "SELECT dni FROM firmas where dni='".$dni."';");
				$result->execute();
				$resultado = $result->fetch(PDO::FETCH_ASSOC);
				if($resultado['dni']==$dni)
					die("DNI existente");
				$consulta="INSERT INTO firmas(name, apellidos, dni, profesion, email, localidad, provincia, cargo, privacidad, fecha) 
					VALUES(:name, :apellidos, :dni, :profesion, :email, :localidad, :provincia, :cargo, :privacidad, :fecha);";
				//echo $consulta;	
				$result=$conn->prepare($consulta);
				$result->execute($user);
				$result=$conn->prepare( "SELECT CONCAT(name,' ', apellidos) as name, profesion, localidad, provincia, cargo FROM firmas ORDER BY id DESC LIMIT 20;");
				$result->execute();
				$resultado = $result->fetchAll();
				$consulta="SELECT id FROM firmas order by id desc limit 1;";
				$resulta=$conn->prepare($consulta);
				$resulta->execute();
				$resulto = $resulta->fetch(PDO::FETCH_ASSOC);
				$headers = "From: info@vetebraragon.es\r\n";
				$headers .= 'Bcc: jonangc@gmail.com;' . "\r\n";
				//$headers.='Bcc: guillermogarciarouge@gmail.com'. "\r\n";
				$headers .= 'MIME-Version: 1.0' . "\r\n";
				$headers .='Content-type: text/html; charset=utf-8' . "\r\n";
				$headers .='Content-Transfer-Encoding: 8bit';
				$elid=$resulto['id'];
				$asunto="Firmante ".($elid-1)." en #vertebrAragón";
				$mensaje ="<h3>".$name." ".$apellidos." de ".$localidad.", acaba de firmar</h3>";
				$mensaje .="<p class='fecha'>".date('H:i:s',strtotime('now'))."</p>";
				//$mensaje.="--->".$consulta."--".$elid."<---";
				$mensaje .="<a href='https://vertebraragon.es/sis/bofir.php?id=".$elid."'>Borrar firmante</a>";
				mail("info@vertebraragon.es",$asunto,$mensaje,$headers);
				$line="<div class='titulos'>".PHP_EOL;
				$line.="<div>Nombre</div>".PHP_EOL;
				//$line.="<div>Dni</div>".PHP_EOL;
				$line.="<div>Profesión/<span class='red'>Cargo</span></div>".PHP_EOL;
				$line.="<div>Localidad</div>".PHP_EOL;
				$line.="</div>".PHP_EOL;
				$line.="<div class='listado'>".PHP_EOL;
			    foreach ($resultado as $valor){
			    	$line.="<div class='linea";
			    	$line.=($valor["cargo"]==1)?" cargada'>":"'>";
			        	$line.="<div>".$valor["name"]."</div>";
				        //$line.="<div>".$valor["dni"]."</div>";
				        $line.="<div>".$valor["profesion"]."</div>";
				        $line.="<div>".$valor["localidad"]."(".$valor["provincia"].")</div>";
			        $line.="</div>".PHP_EOL;
			    }
			    $line.="</div>";
				echo $line;

	}catch(PDOException $e ){
			echo $e -> getMessage();
	}

	$conn = null; 

}
function nombre($nombre){
    $nwnm="";
	$nom=explode(" ",$nombre);
	foreach($nom as $prenom){
        $letra=eligeletra($prenom);
        $nwnm.=str_replace_first($letra, "*", $prenom)." ";
	}
return $nwnm;
}

function eligeletra($prenom){
    $num=rand(0,strlen($prenom)-1);
    $letra=substr($prenom,$num,1);   
    if(!comprueba($letra))
        return $letra;
    return eligeletra($prenom);
    
}
function comprueba($letra){
	$vuelta= preg_match('([^A-Za-z0-9])', $letra);
return $vuelta;    
}
function str_replace_first($from, $to, $subject)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $subject, 1);
}
?>