<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->pheeList = array(
			array(
				"name"	=> "ที่ลงทะเบียนเข้าโครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์​เบื้องต้น ครั้งที่ 27", 
				"alias" => "comcamp", 
				"title"	=> "รายชื่อรวม",
				'startcolor' => 'FF131130',
				'endcolor'   => 'FF511F55'
			),array(
				"name"	=> "ผีทาโกรัส", 
				"alias" => "pheetagorous",
				'startcolor' => 'FF9CCB3B',
				'endcolor'   => 'FF72983E'
			),array(
				"name"	=> "ผีเดเตอร์", 
				"alias" => "pheedator",
				'startcolor' => 'FFBD92C3',
				'endcolor'   => 'FF41244E'
			),array(
				"name"	=> "ผีอีเห็ด", 
				"alias" => "phee-E-Lhed",
				'startcolor' => 'FFBD2626',
				'endcolor'   => 'FFEEA228'
			),array(
				"name"	=> "ผีน็อคคีโอ", 
				"alias" => "pheenocchio",
				'startcolor' => 'FFDDBB40',
				'endcolor'   => 'FFF7D764'
			),array(
				"name"	=> "ผีพุ่งไต้", 
				"alias" => "pheepoongtai",
				'startcolor' => 'FF58C1E1',
				'endcolor'   => 'FF3595CC'
			)
		);

		/*
		Error code
		1 => input
		101 : No input in
		102 : incorrect input type
		4=> data
		404 Data not found
		*/
	}

	function index(){
		$this->load->library('excel');
		$this->excel->getProperties()->setCreator("Comcamp 27th")
			 ->setLastModifiedBy("Comcamp 27th")
			 ->setTitle("รายชื่อนักเรียนที่ลงทะเบียนเข้าโครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์​เบื้องต้น ครั้งที่ 27")
			 ->setSubject("โครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์​เบื้องต้น ครั้งที่ 27")
			 ->setDescription("รายชื่อนักเรียนที่ลงทะเบียนเข้าโครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์​เบื้องต้น ครั้งที่ 27 เมื่อ".date('Y-m-d H:i:s'))
			 ->setKeywords("comcamp27 comcamp namelist")
			 ->setCategory("comcamp");
		$this->excel->getDefaultStyle()->getFont()->setName('TH SarabunPSK')->setSize(14);
		for($sheetIndex = 0; $sheetIndex <= 5; $sheetIndex++){
			if($sheetIndex > 0)
				$this->excel->createSheet(NULL, $sheetIndex);
			$currentSheet = $this->excel->setActiveSheetIndex($sheetIndex);
			$currentSheet->setTitle(substr(isset($this->pheeList[$sheetIndex]['title'])?$this->pheeList[$sheetIndex]['title']:$this->pheeList[$sheetIndex]['name'], 0, 30));
			//Header
			$currentSheet->mergeCells('A1:B1');
			$currentSheet->mergeCells('C1:N1');
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName($this->pheeList[$sheetIndex]['alias']);
			$objDrawing->setDescription($this->pheeList[$sheetIndex]['name']);
			$objDrawing->setPath(FCPATH.'/assets/'.$this->pheeList[$sheetIndex]['alias'].'.png');
			$objDrawing->setHeight(($sheetIndex <= 0)?42:80);
			$objDrawing->setCoordinates('A1');
			$objDrawing->setOffsetX(($sheetIndex <= 0)?0:32);
			$objDrawing->setOffsetY(($sheetIndex <= 0)?24:1);
			$objDrawing->setWorksheet($currentSheet);
			//Log Detail
			$currentSheet->mergeCells('A2:B2');
			$currentSheet->mergeCells('C2:O2');
			$currentSheet
				//Header
				->setCellValue('C1', sprintf('รายชื่อนักเรียน%s', $this->pheeList[$sheetIndex]['name']))
				//Log Detail
				->setCellValue('A2', 'ข้อมูลเมื่อ')
				->setCellValue('C2', PHPExcel_Shared_Date::PHPToExcel( time() ))
				//Table Header
				->setCellValue('A3', 'รหัส')
				->setCellValue('B3', 'ชื่อ')
				->setCellValue('C3', 'นามสกุล')
				->setCellValue('D3', 'ชื่อเล่น')
				->setCellValue('E3', 'E-mail')
				->setCellValue('F3', 'เบอร์น้อง')
				->setCellValue('G3', 'วันเกิด')
				->setCellValue('H3', 'อาการแพ้')
				->setCellValue('I3', 'อาหารที่แพ้')
				->setCellValue('J3', 'อาหารที่ต้องการทาน')
				->setCellValue('K3', 'การเดินทาง')
				->setCellValue('L3', 'ศาสนา')
				->setCellValue('M3', 'ผู้ปกครอง')
				->setCellValue('N3', 'โทร ผปค.')
				->setCellValue('O3', 'ความสัมพันธ์');
			$currentSheet->getStyle('C2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
			/* Fetching Data*/
			$sectionData = array();
			$queryResult = $this->db->select('regis_data.id, name, sirname, nickname, email, tel, birth, diase, food, eat, option_travel.place AS travel_name, section, option_religion.religion AS religion_name, parent_name, parent_relation, parent_phone, registered')->from('regis_data')->join('option_religion', 'regis_data.religion = option_religion.id', 'left')->join('option_travel', 'regis_data.travel = option_travel.id', 'left')->order_by('registered', 'ASC')->get();
			if($queryResult->num_rows() > 0){
				foreach ($queryResult->result_array() as $row) {
					if(!isset($sectionData[(int) $row['section']]))
						$sectionData[(int) $row['section']] = array();
					$sectionData[(int) $row['section']][] = $row;
				}
			}

			$data = array();
			if ($sheetIndex == 0) {
				foreach ($sectionData as $sectionId => $sectionDetail) {
					foreach ($sectionDetail as $row) {
						$data[] = $row;
					}
				}
			}else if(isset($sectionData[$sheetIndex])){
				$data = $sectionData[$sheetIndex];
			}

			if(!empty($data)){
				$rowId = 4;
				foreach ($data as $row) {
					$currentSheet
						//Table Header
						->setCellValue('A'.$rowId, $row['id'])
						->setCellValue('B'.$rowId, $row['name'])
						->setCellValue('C'.$rowId, $row['sirname'])
						->setCellValue('D'.$rowId, $row['nickname'])
						->setCellValue('E'.$rowId, $row['email'])
						->setCellValue('F'.$rowId, $row['tel'])
						->setCellValue('G'.$rowId, $row['birth'])
						->setCellValue('H'.$rowId, $row['diase'])
						->setCellValue('I'.$rowId, $row['food'])
						->setCellValue('J'.$rowId, $row['eat'])
						->setCellValue('K'.$rowId, empty($row['travel_name'])?'มาด้วยตนเอง':$row['travel_name'])
						->setCellValue('L'.$rowId, $row['religion_name'])
						->setCellValue('M'.$rowId, $row['parent_name'])
						->setCellValue('N'.$rowId, $row['parent_phone'])
						->setCellValue('O'.$rowId, $row['parent_relation'])
						->setCellValue('P'.$rowId, $row['registered']);
					$rowId++;
				}
			}
			/*Styling*/
			$currentSheet->getStyle('C1:J1')->applyFromArray(
				array(
					'font'    => array(
						'bold'      => true
					),
					'alignment' => array(
						'vertical'	 => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
					),
					'fill' => array(
			 			'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
			  			'rotation'   => 0,
			 			'startcolor' => array('argb' => $this->pheeList[$sheetIndex]['startcolor']),
			 			'endcolor'   => array('argb' => $this->pheeList[$sheetIndex]['endcolor'])
			 		)
				)
			);
			$currentSheet->getStyle('A1')->applyFromArray(
				array(
					'fill' => array(
			 			'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
			  			'rotation'   => 0,
			 			'startcolor' => array('argb' => $this->pheeList[$sheetIndex]['endcolor']),
			 			'endcolor'   => array('argb' => $this->pheeList[$sheetIndex]['startcolor'])
			 		)
				)
			);
			$currentSheet->getRowDimension('1')->setRowHeight(64);
			$currentSheet->getColumnDimension('A')->setWidth(12);

			$currentSheet->getStyle('C1')->getFont()
				->setSize(24)
				->setBold(true)
				->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$currentSheet->getStyle('C1')
				->getAlignment()->setWrapText(true);

			$currentSheet->getStyle('A2')->getFont()->setBold(true);
			$currentSheet->getStyle('A3:P3')->getFont()->setBold(true);
			$currentSheet->freezePane('L4');
			$currentSheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 3);
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		}
		$this->excel->setActiveSheetIndex(0);
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		$tempFileLocation = tempnam("/tmp", 'res'.time());
		$objWriter->save($tempFileLocation);
		$excelResult = file_get_contents($tempFileLocation);
		/* Exporting */
		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Comcamp-web-'.time().'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		echo $excelResult;
	}
}