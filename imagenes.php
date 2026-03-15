<?php
    $json = json_decode( file_get_contents( 'slider.json' ), true );
?>
<div id="images">
    <p class="medio">#vertebrAragón</p>
	<?php
	$comselec="";
    foreach ( $json['slider'] AS $lines=>$line ){
        if($lines<3){
        ?>
        <figure class="imagenes<?php echo ( $lines == 0 ) ? ' actiu' : ''; ?>">
            <a href="images/normal/<?php echo $line['img']; ?>" target="_blank">
                <img id="a<?php echo $lines; ?>" alt="<?php echo $line['title']; ?>" src="images/slides/<?php echo $line['img']; ?>" />
            </a>
            <figcaption><a class='enlaceSpan' href="<?php echo $line['url'];?>">
                <?php echo $line['title']; ?><span class="willy willy-mano"></span>
            </a></figcaption>
        </figure>
        <?php
        }
        $comselec.= '<option value="a' . $lines . '" data-url="'.$line['url'].'" data-id="a' . $lines . '" data-alt="' . $line['title'] . '">images/slides/' . $line['img'] . '</option>';
    }
    ?>
    <select class="ciego" id="figurinas"><?php echo $comselec; ?></select>
</div>