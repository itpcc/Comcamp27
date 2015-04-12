<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__.'/fpdf/fpdf.php');
require_once(__DIR__.'/fpdf/fpdi.php');
require_once(__DIR__.'/THSplitLib/segment.php');
//require_once(__DIR__.'/facebookTime.php');

class pdf extends FPDI{
	private $iconvNewLine, $iconvSpace, $thaiSegment;
	public $id;
	function __construct(){
		parent::__construct();
		$this->id = 112;
		$this->iconvSpace = iconv('UTF-8', 'cp874//TRANSLIT', ' ');
		$this->iconvNewLine = iconv('UTF-8', 'cp874//TRANSLIT', "\n");
		$this->thaiSegment = new Segment();
	}

	function GetMultiCellHeight($w, $h, $txt, $border=null, $align='J') {
		// Calculate MultiCell with automatic or explicit line breaks height
		// $border is un-used, but I kept it in the parameters to keep the call
		//   to this function consistent with MultiCell()
		$cw = &$this->CurrentFont['cw'];
		if($w==0)
			$w = $this->w-$this->rMargin-$this->x;
		$wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
		$s = str_replace("\r",'',$txt);
		$nb = strlen($s);
		if($nb>0 && $s[$nb-1]=="\n")
			$nb--;
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$ns = 0;
		$height = 0;
		while($i<$nb)
		{
			// Get next character
			$c = $s[$i];
			if($c=="\n")
			{
				// Explicit line break
				if($this->ws>0)
				{
					$this->ws = 0;
					$this->_out('0 Tw');
				}
				//Increase Height
				$height += $h;
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$ns = 0;
				continue;
			}
			if($c==' ')
			{
				$sep = $i;
				$ls = $l;
				$ns++;
			}
			$l += $cw[$c];
			if($l>$wmax)
			{
				// Automatic line break
				if($sep==-1)
				{
					if($i==$j)
						$i++;
					if($this->ws>0)
					{
						$this->ws = 0;
						$this->_out('0 Tw');
					}
					//Increase Height
					$height += $h;
				}
				else
				{
					if($align=='J')
					{
						$this->ws = ($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
						$this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
					}
					//Increase Height
					$height += $h;
					$i = $sep+1;
				}
				$sep = -1;
				$j = $i;
				$l = 0;
				$ns = 0;
			}
			else
				$i++;
		}
		// Last chunk
		if($this->ws>0)
		{
			$this->ws = 0;
			$this->_out('0 Tw');
		}
		//Increase Height
		$height += $h;

		return $height;
	}

	function Circle($x, $y, $r, $style=''){
		$this->Ellipse($x, $y, $r, $r, $style);
	}

	function Ellipse($x, $y, $rx, $ry, $style='D'){
		if($style=='F')
			$op='f';
		elseif($style=='FD' or $style=='DF')
			$op='B';
		else
			$op='S';
		$lx=4/3*(M_SQRT2-1)*$rx;
		$ly=4/3*(M_SQRT2-1)*$ry;
		$k=$this->k;
		$h=$this->h;
		$this->_out(sprintf('%.2f %.2f m %.2f %.2f %.2f %.2f %.2f %.2f c', 
			($x+$rx)*$k, ($h-$y)*$k, 
			($x+$rx)*$k, ($h-($y-$ly))*$k, 
			($x+$lx)*$k, ($h-($y-$ry))*$k, 
			$x*$k, ($h-($y-$ry))*$k));
		$this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c', 
			($x-$lx)*$k, ($h-($y-$ry))*$k, 
			($x-$rx)*$k, ($h-($y-$ly))*$k, 
			($x-$rx)*$k, ($h-$y)*$k));
		$this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c', 
			($x-$rx)*$k, ($h-($y+$ly))*$k, 
			($x-$lx)*$k, ($h-($y+$ry))*$k, 
			$x*$k, ($h-($y+$ry))*$k));
		$this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c %s', 
			($x+$lx)*$k, ($h-($y+$ry))*$k, 
			($x+$rx)*$k, ($h-($y+$ly))*$k, 
			($x+$rx)*$k, ($h-$y)*$k, 
			$op));
	}

	function Header(){
		/*if(in_array($this->pageNo(), array(1, 7, 8)))*/
			$this->setY(10.5);
		/*else
			$this->setY(16.25);*/
		if(isset($this->fonts['RD CHULAJARUEK']))
			$this->SetFont('RD CHULAJARUEK','',10);
		$strSystemLog = iconv(
			'UTF-8', 
			'cp874//TRANSLIT', 
			'ส่งออกเมื่อ '.
			generate_date_today("j F Y H:i:s", time(), "th", false).' รหัสควบคุม '.md5(($this->id).'|'.time())
		);
		$this->SetX(30);
		$this->Cell(
			$this->GetStringWidth($strSystemLog),
			0,
			$strSystemLog,
			0,
			0,
			'L'
		);
		/*$this->SetFont('TH Sarabum New','',16);
		$this->SetX(30);
		$this->Cell(
			$this->w - 48,
			0,
			iconv(
				'UTF-8', 
				'cp874//TRANSLIT', 
				'หน้า '.$this->pageNo()
			),
			0,
			0,
			'R'
		);*/
	}
	function justify($strPrint, $paragraphWidth){
		$tokenedStrPrint = ''; $currParagraphWidth = 0; $cntNewline = 1;
		foreach(explode($this->iconvSpace, $strPrint) AS $segmentsNo => $eachSegments){
			if($segmentsNo > 0)
				$tokenedStrPrint .= $this->iconvSpace;						
			foreach(explode($this->iconvNewLine, $eachSegments) AS $lineNo=> $eachSegment){
				if($lineNo > 0){
					$tokenedStrPrint .= $this->iconvNewLine;
				}
				if(!empty($eachSegment)){
					$segmentWidth = $this->GetStringWidth($eachSegment);
					if($currParagraphWidth+$segmentWidth <= $paragraphWidth){
						$tokenedStrPrint .= $eachSegment;
						$currParagraphWidth += $segmentWidth;
					}else{
						$tokenedArray = $this->thaiSegment->get_segment_array(iconv('cp874', 'UTF-8', $eachSegment));
						foreach($tokenedArray AS $tokenWord){
							$iconvWord = iconv('UTF-8', 'cp874//TRANSLIT', $tokenWord);
							$wordWidth = $this->GetStringWidth($iconvWord);
							if($currParagraphWidth+$wordWidth < $paragraphWidth){
								$currParagraphWidth += $wordWidth;
							}else if(substr($tokenedStrPrint, -1) !== $this->iconvNewLine){
								$currParagraphWidth = $wordWidth;
							}
							$tokenedStrPrint .= $iconvWord;
						}
						//var_dump($tokenedArray);
					}
				}
				//var_dump("segment#{$segmentsNo} line#{$lineNo} : ", $eachSegment);
			}
		}
		//var_dump($tokenedStrPrint);
		return $tokenedStrPrint;
	}
}