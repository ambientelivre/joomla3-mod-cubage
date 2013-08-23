<?php

// Copyright 2011 | Rafaela Raganhan - Ambiente Livre Tecnologia | http://www.ambientelivre.com.br
//
// Modulo  Nativo Joomla! 1.5 license GNU/GPL 3
//
// This Module Calc Cubage 
//
// History Log
// Version 2.0 de 06/05/2011
// - Add multiple lines calc
//
// Version 1.0 de 25/02/2011
// 



defined('_JEXEC') or die('Restricted access');

#Parameters Modulo Cubage

$link1 = $params->get('link1');
$link2 = $params->get('link2');
$link3 = $params->get('link3');
$link4 = $params->get('link4');
$testo_link1 = $params->get('testo_link1');
$testo_link2 = $params->get('testo_link2');
$testo_link3 = $params->get('testo_link3');
$testo_link4 = $params->get('testo_link4');
$value_cubage = $params->get('value_cubage');
$currentpage = JURI::current();

# Source of Modulo Cubage

$content = "<div align='left'>";
?>

<script type="text/javascript" src="/modules/mod_calc_cubage/js/jquery.js"></script>
<script type="text/javascript" src="/modules/mod_calc_cubage/js/cubage.js"></script>

<?php

	$qtdlinha   = $_POST["qtdlinha"];
	$addlinha   = $_POST["addlinha"];
	$limpalinha = $_POST["limpalinha"];

	if ( $limpalinha == "Limpar Tudo" )
		$qtdlinha = 1;	

	if ( $addlinha == "Adicionar Nova Linha" )
		$qtdlinha++;	

	if ( $qtdlinha == 0 )
		$qtdlinha++;	

	$i = 1;
	while ($i <= $qtdlinha) {

                $vardinamica = "altura_" . $i;
	        $altura[$i] = $_POST["$vardinamica"];
        	$altura[$i] = str_replace(",", ".",$altura[$i]);

                $vardinamica = "largura_" . $i;
	        $largura[$i] = $_POST["$vardinamica"];
	        $largura[$i] = str_replace(",", ".",$largura[$i]);

                $vardinamica = "quantidade_" . $i;
        	$quantidade[$i] = $_POST["$vardinamica"];
	        $quantidade[$i] = str_replace(",", ".",$quantidade[$i]);

                $vardinamica = "comprimento_" . $i;
        	$comprimento[$i] = $_POST["$vardinamica"];
	        $comprimento[$i] = str_replace(",", ".",$comprimento[$i]);

		$i++;
	 } 	

	if ( $limpalinha == "Limpar Tudo" )
           {
	        $altura[1] =  "";
	        $largura[1] = "";
        	$quantidade[1] = "";
        	$comprimento[1] = "";
		$cubagem[1] = "";
	        $peso[1] = "";
           }


?>

<link href="/modules/mod_calc_cubage/css/style.css" rel="stylesheet" type="text/css" />
<body>
        <form action=" <?php echo $currentpage ?>" method="POST">
	<br>
	<div align="left">
		<img class="box" src="modules/mod_calc_cubage/images/box.png" height="65" align="left" width="65" />
	</div> 
	<table class="CalculoCubage" cellspacing="0" align="left" >
   	 <thead>
       	 <tr>
           	 <th>Quantidade<br/> de volumes</th>
                 <th>Altura<br/> (m) <br/></th>
            	 <th>Largura<br/> (m)<br/></th>
             	 <th>Comprimento<br/> (m)<br/></th>             	         	
             	 <th>Cubagem<br/> (m³)<br/></th>             	         	
             	 <th>Peso<br/> (kg)<br/></th>             	         	
        </tr>
   	</thead>             
    	<tbody>

<?php 
	$i = 1;
	while ($i <= $qtdlinha) {

	$cubagem[$i] = $largura[$i] * $altura[$i] * $comprimento[$i] * $quantidade[$i];
        $peso[$i] = $cubagem[$i] * $value_cubage;

?>

        <tr>
            <td><input class="inputcubage" type="text"   value="<?php echo $quantidade[$i] ?>"  maxlength="6" name="<?php echo quantidade_ . $i ?>" /></td>
            <td><input class="inputcubage" type="text"   value="<?php echo $altura[$i] ?>"      maxlength="6" name="<?php echo altura_ . $i ?>"     /></td>
            <td><input class="inputcubage" type="text"   value="<?php echo $largura[$i] ?>"     maxlength="6" name="<?php echo largura_ . $i?>"     /></td>
            <td><input class="inputcubage" type="text"   value="<?php echo $comprimento[$i] ?>" maxlength="6" name="<?php echo comprimento_ . $i ?>"/></td>
            <td><input class="inputshadow" type="text"   value="<?php echo $cubagem[$i] ?>"     maxlength="6" disabled                              /></td>
            <td><input class="inputshadow" type="text"   value="<?php echo $cubagem[$i] *300 ?>"        maxlength="6" disabled                      /></td>
            <td><input class="inputcubage" type="hidden" value="<?php echo $qtdlinha ?>"        maxlength="6" name="qtdlinha"                       /></td>
       </tr> 
<?php


	$i++;

	 } 
?>

       </tbody>
      </table> 
	      	<input class="buttomlinha" type="submit" value="Adicionar Nova Linha" name="addlinha" >   
	      	<input class="buttomlinha" type="submit" value="Limpar Tudo" name="limpalinha" >   
	      	<input class="cubagebuttom" type="submit" value="  Calcular Cubagem  " name="calcular" ><BR><BR>   
     </form>

        <?php

	$i = 1;
        $loopvar = count($cubagem);
	while ($i <= $loopvar )
	{
	        $cubagemTot = $cubagemTot + $cubagem[$i];
        	$pesoTot    = $pesoTot +  $peso[$i];
		$i++;
	}
	
	echo "<div text-align='center' class='divcubage'>"; 			
        echo "Cubagem Total (m3): " . number_format($cubagemTot, 2, ",", "");
        echo "<br>";
        echo "Peso Total.........(Kg): " . $cubagemTot * 300;


	if($cubagemTot != 0){
                echo "<BR><BR> Você precisa de algum serviço de transporte ?";
                if ( $testo_link1 != "" )
 			echo "<li class='link_cubage' ><a name='link1' href='" . $link1 . "'>" . $testo_link1 . "</a></li>";
                if ( $testo_link2 != "" )
			echo "<li class='link_cubage' ><a name='link2' href='" . $link2 . "'>" . $testo_link2 . "</a></li>";
                if ( $testo_link3 != "" )
			echo "<li class='link_cubage' ><a name='link3' href='" . $link3 . "'>" . $testo_link3 . "</a></li>";
                if ( $testo_link4 != "" )
			echo "<li class='link_cubage' ><a name='link4' href='" . $link4 . "'>" . $testo_link4 . "</a></li>";
	}
	echo "</div>";

        ?>
</body>
