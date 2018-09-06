<?php
include("vendor/autoload.php");
use OntraportAPI\Ontraport;
$client = new Ontraport("2_165242_leJiCRh3x","OUnU0EmLXURF0kY");

$target_path = "assets/xlsx/";

$target_path = $target_path . date('YmdHis'). basename( $_FILES['archivo']['name']); 
echo $target_path;
move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path);



//1 : quitar los que no tienen correo
//2 : revisar que exista el contacto en ontraport, si existe, insertar oportunidad, si no existe continuar
//$tmpfname = "Workbook1.xlsx";
$tmpfname = $target_path;
$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);
$worksheet = $excelObj->getSheet(0);
$lastRow = $worksheet->getHighestRow();
$i = 1;
$countrequests = 0;
for ($row =7; $row <= $lastRow; $row++) {
	if($worksheet->getCell('J'.$row)->getValue()!=''){
		echo "Línea ".$i." procesada";
		echo "\n";
		$i++;
		// buscar en contacto ///////////////////////////////////////////////////////////////////////////////////
		$requestParams = array(
		    "listFields" => "id,firstname,lastname,email",
		    "search" => $worksheet->getCell('J'.$row)->getValue()
		);
		$response = json_decode($client->contact()->retrieveMultiple($requestParams));
		$countrequests ++;
		$data = $response->data;
		if(!empty($data)){
			// se encontró insertar oportunidad /////////////////////////////////////////////////////////////////
			$requestParams = array(
			    "objectID"  => 10000, // Object type ID: 0
			    "f1501" => $data[0]->id,
				//"f1510" => "",  ///descripcion sig. tarea
				//"f1511" => "",  ///Fase ciclo de ventas
				//"f1512" => "",  ///Solicitud de Lead
				//"f1508" => "",  ///Código Resultado
				//"f1507" => "",  ///Estado de proceso de lead 
				"f1503" => $worksheet->getCell('D'.$row)->getValue(),
				//"f1509" => "",   //Descripción
				"f1506" => $worksheet->getCell('F'.$row)->getValue(),
				"f1505" => $worksheet->getCell('E'.$row)->getValue(),
				"f1504" => $worksheet->getCell('B'.$row)->getValue(),
				"f1502" => $worksheet->getCell('A'.$row)->getValue(),
				"f1518" => $worksheet->getCell('G'.$row)->getValue(),
				"f1519" => $worksheet->getCell('H'.$row)->getValue(),
				"f1520" => $worksheet->getCell('C'.$row)->getValue()
			);
			$response = $client->object()->create($requestParams);
			$countrequests ++;
		}
	}	 
}
echo $countrequests;
?>


