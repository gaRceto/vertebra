<?php
	$json=json_decode(file_get_contents('php://input'));
	$url=$json->url;
/*	$url="http://www.lavanguardia.com/20120611/54309586928/cha-propone-ampliar-el-cercanias-a-plaza-y-arcosur-alagon-el-burgo-zuera-y-los-poligonos.html";
	$url="http://www.elperiodicodearagon.com/noticias/aragon/inversion-cercanias-dara-solo-4-apeaderos-mas_695604.html";
	$url="https://www.heraldo.es/noticias/zaragoza/renfe_descarta_alargar_las_cercanias_hasta_alagon_por_sus_400_000_euros_coste_anual.html";
	$url="https://www.heraldo.es/noticias/aragon/zaragoza-provincia/zaragoza/2017/11/27/la-dga-descarta-prolongar-las-cercanias-hasta-alagon-por-coste-millonario-baja-demanda-1210409-301.html";
	$url="https://www.elindependiente.com/economia/2017/11/12/estaciones-ave-espana-menos-viajeros/";
	$url="http://www.publico.es/espana/estaciones-fantasma-del-ave.html";
	$url="https://elpais.com/economia/2017/03/01/actualidad/1488362770_011434.html";*/
	$result = peticion($url, "http://www.google.com/", "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8", 5);
	$line=PHP_EOL;
    $line.="\t\t\t<a href='".$result['url']."' target='_blank'>".PHP_EOL;
    $line.="\t\t\t\t<h3>".$result['site_name']."</h3>".PHP_EOL;
    $line.="\t\t\t\t<h4>".$result['title']."</h4>".PHP_EOL;
    $line.="\t\t\t\t<img src='".$result['image']."'/>".PHP_EOL;
    $line.="\t\t\t\t<p>".$result['description']."</p>".PHP_EOL;
    $line.="\t\t\t</a>".PHP_EOL;
    echo $line;
	function peticion($url,$referer,$agent){
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	    curl_setopt($ch, CURLOPT_REFERER, NULL);
	    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	 
	    $result["EXE"] = curl_exec($ch);
	    $result["INF"] = curl_getinfo($ch);
	    $result["ERR"] = curl_error($ch);
	    $texto=$result['EXE'];
	    //preg_match_all("/<meta(.*)content=\"(.*)\"/", $result["EXE"], $matches);
	    $utf8=preg_match('/charset=utf-8/',$texto);
	    $utf8=($utf8||preg_match('/charset=\"UTF-8\"/',$texto));

	    $tituletes=array("url","site_name","title","image","description");
	    $anuncio=array();
	    foreach($tituletes as $titulo){
	    	preg_match('/<meta(.*)property=\"og:'.$titulo.'\"(.*)>/',$texto,$tras);
	    	$buc=(strlen($tras[1])==1)?$tras[2]:$tras[1];
	    	preg_match("/content=\"(.*)\"/",$buc,$tres);
	    	if(preg_match('/\"/',$tres[1])>0)
	    		$tres[1]=substr($tres[1],0,strpos($tres[1],'"'));
	    	if(!$utf8){
	    		if(preg_match('/elpais.com/',$url))
	    			$anuncio[$titulo]=utf8_encode(utf8_decode($tres[1]));
	    		else
	    			$anuncio[$titulo]=utf8_encode($tres[1]);
	    	}
	    	else
		    	$anuncio[$titulo]=$tres[1];

	    }

	    return $anuncio;
	}
?>