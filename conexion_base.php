<?php
$link = mysql_connect('127.0.0.1', 'root', '')
    or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('pedidos') or die('No se pudo seleccionar la base de datos');


function estado_pedido($opcion)
{
 $res='PENDIENTE';
if ($opcion > 0)
{
$res='ENTREGADO';
}
return $res;
}

function asignado_pedido($opcion)
{
 $res='NO ASIGNADO';
if ($opcion > 0)
{
$res='ASIGNADO';
}
return $res;
}


function validar_cedula($cedula)
{

$res=false;
if(is_numeric($cedula))
{
$total_caracteres=strlen($cedula);
	if($total_caracteres==10)
		{
			$nro_region=substr($cedula, 0,2);//extraigo los dos primeros caracteres de izq a der
			if($nro_region>=1 && $nro_region<=24)
			{// compruebo a que region pertenece esta cedula//
				$ult_digito=substr($cedula, -1,1);//extraigo el ultimo digito de la cedula
				//extraigo los valores pares//
				$valor2=substr($cedula, 1, 1);
				$valor4=substr($cedula, 3, 1);
				$valor6=substr($cedula, 5, 1);
				$valor8=substr($cedula, 7, 1);
				$suma_pares=($valor2 + $valor4 + $valor6 + $valor8);
				//extraigo los valores impares//
				$valor1=substr($cedula, 0, 1);
				$valor1=($valor1 * 2);
				if($valor1>9){ $valor1=($valor1 - 9); }else{ }
				$valor3=substr($strCedula, 2, 1);
				$valor3=($valor3 * 2);
				if($valor3>9){ $valor3=($valor3 - 9); }else{ }
				$valor5=substr($cedula, 4, 1);
				$valor5=($valor5 * 2);
				if($valor5>9){ $valor5=($valor5 - 9); }else{ }
				$valor7=substr($cedula, 6, 1);
				$valor7=($valor7 * 2);
				if($valor7>9){ $valor7=($valor7 - 9); }else{ }
				$valor9=substr($cedula, 8, 1);
				$valor9=($valor9 * 2);
				if($valor9>9){ $valor9=($valor9 - 9); }else{ }
	
				$suma_impares=($valor1 + $valor3 + $valor5 + $valor7 + $valor9);
				$suma=($suma_pares + $suma_impares);
				$dis=substr($suma, 0,1);//extraigo el primer numero de la suma
				$dis=(($dis + 1)* 10);//luego ese numero lo multiplico x 10, consiguiendo asi la decena inmediata superior
				$digito=($dis - $suma);
				if($digito==10){ $digito='0'; }else{ }//si la suma nos resulta 10, el decimo digito es cero
			
				if ($digito==$ult_digito)
				{//comparo los digitos final y ultimo
				$res=true;
				}else
				{
				$res=false;
				}
			}
			else
			{
			$res=false;
			}
		}
		else
		{
		$res=false;
		}
}

else
{
$res=false;
}

return $res;
}


function validar_telefono($telefono)
{

$res=false;
if(is_numeric($telefono)) 
	{
	
	$total_caracteres=strlen($telefono);
	 if (($total_caracteres>=9) && ($total_caracteres<=10))
	  {
	  $res=true;
	  }
	}
	return $res;
}

function validar_nombre($nombre)
{

$res=false;
$total_caracteres=strlen($nombre);

        
        if (is_string($nombre))
		 {
            if ($total_caracteres>=5)
			{
				  $res=true;
			}
        }
        return $res;
}

function validar_direccion($direccion)
{
$total_caracteres=strlen($direccion);
$res=false;

       // $pattern = "/^[A-Z][a-zñÑáéíóúÁÉÍÓÚÄËÏÖÜäëïöüàèìòùÀÈÌÔÙ, ]{2,}$/";
      //  if (preg_match($pattern, $nombre))
		// {
            if ($total_caracteres>=5)
			{
				  $res=true;
			}
       // }
        return $res;
}
function validar_password($password)
{
$total_caracteres=strlen($password);
$res=false;

       // $pattern = "/^[A-Z][a-zñÑáéíóúÁÉÍÓÚÄËÏÖÜäëïöüàèìòùÀÈÌÔÙ, ]{2,}$/";
      //  if (preg_match($pattern, $nombre))
		// {
            if ($total_caracteres>=5)
			{
				  $res=true;
			}
       // }
        return $res;
}

function validar_email($email)
{
$total_caracteres=strlen($email);
$res=false;

       // $pattern = "/^[A-Z][a-zñÑáéíóúÁÉÍÓÚÄËÏÖÜäëïöüàèìòùÀÈÌÔÙ, ]{2,}$/";
      //  if (preg_match($pattern, $nombre))
		// {
            if ($total_caracteres>=10)
			{
				  $res=true;
			}
       // }
        return $res;
}

function validar_rol($rol)
{
$total_caracteres=strlen($rol);
$res=false;

       // $pattern = "/^[A-Z][a-zñÑáéíóúÁÉÍÓÚÄËÏÖÜäëïöüàèìòùÀÈÌÔÙ, ]{2,}$/";
      //  if (preg_match($pattern, $nombre))
		// {
            if ($total_caracteres>=1)
			{
				  $res=true;
			}
       // }
        return $res;
}



function validar_idcamion($id_camion)
{
$total_caracteres=strlen($id_camion);
$res=false;

       // $pattern = "/^[A-Z][a-zñÑáéíóúÁÉÍÓÚÄËÏÖÜäëïöüàèìòùÀÈÌÔÙ, ]{2,}$/";
      //  if (preg_match($pattern, $nombre))
		// {
            if ($total_caracteres>=5)
			{
				  $res=true;
			}
       // }
        return $res;
}

function validar_marca($marca)
{
$total_caracteres=strlen($marca);
$res=false;

       // $pattern = "/^[A-Z][a-zñÑáéíóúÁÉÍÓÚÄËÏÖÜäëïöüàèìòùÀÈÌÔÙ, ]{2,}$/";
      //  if (preg_match($pattern, $nombre))
		// {
            if ($total_caracteres>=5)
			{
				  $res=true;
			}
       // }
        return $res;
}

function validar_modelo($modelo)
{
$total_caracteres=strlen($modelo);
$res=false;

       // $pattern = "/^[A-Z][a-zñÑáéíóúÁÉÍÓÚÄËÏÖÜäëïöüàèìòùÀÈÌÔÙ, ]{2,}$/";
      //  if (preg_match($pattern, $nombre))
		// {
		if(is_numeric($modelo)) 
	{
            if ($total_caracteres==4)
			{
				  $res=true;
			}
	}
       // }
        return $res;
}
function validar_descripcion($descripcion)
{
$total_caracteres=strlen($descripcion);
$res=false;

       // $pattern = "/^[A-Z][a-zñÑáéíóúÁÉÍÓÚÄËÏÖÜäëïöüàèìòùÀÈÌÔÙ, ]{2,}$/";
      //  if (preg_match($pattern, $nombre))
		// {
            if ($total_caracteres>=5)
			{
				  $res=true;
			}
       // }
        return $res;
}

function validar_idcliente($id_cliente)
{
$total_caracteres=strlen($id_cliente);
$res=false;

       // $pattern = "/^[A-Z][a-zñÑáéíóúÁÉÍÓÚÄËÏÖÜäëïöüàèìòùÀÈÌÔÙ, ]{2,}$/";
      //  if (preg_match($pattern, $nombre))
		// {
		if(is_numeric($id_cliente)) 
	{
          
				  $res=true;
		
	}
       // }
        return $res;
}

function validar_ciudad($ciudad)
{
$total_caracteres=strlen($ciudad);
$res=false;

       // $pattern = "/^[A-Z][a-zñÑáéíóúÁÉÍÓÚÄËÏÖÜäëïöüàèìòùÀÈÌÔÙ, ]{2,}$/";
      //  if (preg_match($pattern, $nombre))
		// {
		 if ($total_caracteres>=1)
			{
				  $res=true;
			}
       // }
        return $res;
}

?>