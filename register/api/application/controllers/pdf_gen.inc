<?php
	$this->pdf->SetKeywords("ใบสมัคร Comcamp Comcamp#27", true);
	$this->pdf->SetTitle("ใบสมัคร โครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์เบื้องต้น ครั้งที่ 27 รหัส {$registerData['id']}", true);
	$this->pdf->SetCreator("ระบบรับสมัคร โครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์เบื้องต้น ครั้งที่ 27", true);
	$this->pdf->SetAuthor("{$registerData['id']}:{$registerData['fullname']}", true);
	$this->pdf->SetSubject("โครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์เบื้องต้น ครั้งที่ 27", true);
	$pageCount = $this->pdf->setSourceFile($pdfTemplate);
	$this->pdf->SetAutoPageBreak(true, 1);
	$this->pdf->AddFont ( 'TH Sarabum New', '', 'THSarabunNew_0.php' );
	$this->pdf->AddFont ( 'TH Sarabum New', 'B', 'THSarabunNew Bold_0.php' );
	$this->pdf->AddFont ( 'TH Sarabum New', 'I', 'THSarabunNew Italic_0.php' );
	$this->pdf->AddFont ( 'TH Sarabum New', 'IB', 'THSarabunNew BoldItalic_0.php' );
	$this->pdf->AddFont ( 'RD CHULAJARUEK', '', 'RD CHULAJARUEK.php' );
	$this->pdf->SetFont('TH Sarabum New','',16);
	$this->pdf->SetDrawColor(0,0,255);
	$this->pdf->SetTextColor(0,0,255);

	for($i = 1; $i <= $pageCount; $i++){
		$tplIdx = $this->pdf->importPage($i);
		$this->pdf->addPage();
		$this->pdf->useTemplate($tplIdx/*, 10, 10, 90*/);
		if(isset($printData[$i])){
			foreach ($printData[$i] AS $printElement) {
				if(isset($registerData[$printElement[0]])){
					if(    isset($printElement[2]) 
						&& is_bool($printElement[2])
						&& is_array($printElement[1])
					){
						if(isset($printElement[3]) && $printElement[3]){
							$selectedChoice = false;
							foreach($printElement[1] AS $testPattern => $choiceValue){
								if(@preg_match($testPattern, $registerData[$printElement[0]])){
									$selectedChoice = $choiceValue;
									break;
								}
							}
						}else if(isset($printElement[1][$registerData[$printElement[0]]][0]) 
							&& isset($printElement[1][$registerData[$printElement[0]]][1]) 
							&& isset($printElement[1][$registerData[$printElement[0]]][2]) 
							&& isset($printElement[1][$registerData[$printElement[0]]][3])
						){
							$selectedChoice = $printElement[1][$registerData[$printElement[0]]];
						}
						if(isset($selectedChoice)){
							if($selectedChoice && $printElement[2] && isset($printElement[3]) && $printElement[3]){
								$this->pdf->Ellipse($selectedChoice[0], $selectedChoice[1], $selectedChoice[2], $selectedChoice[3]);
							}else{
								$this->pdf->Line(
									$selectedChoice[0], $selectedChoice[1], 
									$selectedChoice[2], $selectedChoice[3]);
								$this->pdf->Line(
									$selectedChoice[0], $selectedChoice[3], 
									$selectedChoice[2], $selectedChoice[1]);
							}
						}
					}else{
						//var_dump($strPrint, $printElement);
						$strPrint = iconv(
							'UTF-8', 
							'cp874//TRANSLIT', 
							isset($registerData[$printElement[0]])
								?sprintf(
									(isset($printElement[2])&&is_string($printElement[2]))?$printElement[2]:"%s",
									(isset($printElement[5]) && is_string($printElement[5]) && isset($printElement[6]) && is_string($printElement[6]))?preg_replace($printElement[5], $printElement[6], $registerData[$printElement[0]]):/*is_string(*/$registerData[$printElement[0]]/*)?$registerData[$printElement[0]]:"{$registerData[$printElement[0]]}"*/
									)
								:'-'
						);
						if(isset($printElement[4]) && is_string($printElement[4])){
							if(strtolower($printElement[4]) === 'c'){
								$paragraphWidth = $this->pdf->GetStringWidth($strPrint);
								$this->pdf->SetXY($printElement[1][0] - ($paragraphWidth / 2), $printElement[1][1]);
								/*$this->pdf->Line($printElement[1][0], $printElement[1][1] - 5, $printElement[1][0], $printElement[1][1] + 5);*/
							}else{
								$this->pdf->SetXY($printElement[1][0], $printElement[1][1]);
								$paragraphWidth = ($this->pdf->w) - $printElement[1][0] - 20;
							}
						}else{
							$this->pdf->SetXY($printElement[1][0], $printElement[1][1]);
							$paragraphWidth = ($this->pdf->w) - $printElement[1][0] - 20;
						}

						if(isset($printElement[3]) && is_array($printElement[3])){
							$this->pdf->SetFillColor($printElement[3][0], $printElement[3][1], $printElement[3][2]);
		            		$this->pdf->Rect(
		            			$printElement[1][0], 
		            			$printElement[1][1]-($printElement[3][3]/2), 
		            			$this->pdf->GetStringWidth($strPrint)*(isset($printElement[3][4])?$printElement[3][4]:1), 
		            			$printElement[3][3]*(isset($printElement[3][5])?$printElement[3][5]:1), 
		            			'F'
		            		); 
						}
						if(isset($printElement[1][2])){
							if(!isset($iconvSpace)){
								$iconvSpace = iconv('UTF-8', 'cp874//TRANSLIT', ' ');
								$iconvNewLine = iconv('UTF-8', 'cp874//TRANSLIT', "\n");
							}
							if(!isset($spaceWidth))
								$spaceWidth = $this->pdf->GetStringWidth($iconvSpace);
								

							/*Word tokenizing*/
							$currParagraphWidth = 0;
							$tokenedStrPrint = $this->pdf->justify($strPrint, $paragraphWidth);						
							//var_dump($tokenedStrPrint);
							$spaceTime = ceil(($printElement[1][2] - $printElement[1][0])/ $spaceWidth);
							if($spaceTime > 0)
								$tokenedStrPrint = str_repeat($iconvSpace, $spaceTime).$tokenedStrPrint;
							//var_dump($tokenedStrPrint, $spaceTime);
							$oldFontSize = $this->pdf->FontSizePt;
							$paragraphHeight = $this->pdf->GetMultiCellHeight(
								$paragraphWidth, 
								16*0.39,
								$tokenedStrPrint,
								0,
								(isset($printElement[4]) && is_string($printElement[4]))?$printElement[4]:'J'
							) ;
							if($paragraphHeight > $oldFontSize*0.4*2){
								$this->pdf->SetFontSize($oldFontSize*0.875);
								$tokenedStrPrint = $this->pdf->justify($strPrint, $paragraphWidth);
								//$this->pdf->SetFont($this->pdf->FontFamily,$this->pdf->FontStyle, $oldFontSize);
							}
							//var_dump($paragraphHeight, $this->pdf->FontSizePt);

							$this->pdf->MultiCell(
								$paragraphWidth, 
								16*0.55,
								$tokenedStrPrint,
								0,
								'J'
							);

							if($this->pdf->FontSizePt !== $oldFontSize){
								//var_dump("- -?");
								$this->pdf->SetFontSize($oldFontSize);
							}
							//var_dump($tokenedStrPrint);
						}else{
							$this->pdf->Cell(
								$paragraphWidth, 
								0,
								$strPrint
							);
							$this->pdf->Ln();
						}
					}
				}
			}
		}
	}

	$pdfResult = $this->pdf->Output($pdfFileName, 'S');