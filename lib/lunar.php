<?php
/*
 基于云南省曲靖师范学院计算机科学与工程学院-杨海熙编写Launar库的
*/	
class Lunar
{
	private $_LStart=2013;
	private $_LMDay=array(
		array(40,30,29,30,29,30,30,29,30,29,30,29,30),
		array(30,29,30,29,30,29,30,29,30,59,30,29,30,30),
		array(49,29,30,29,29,30,29,30,30,30,29,30,29),
		array(38,30,29,30,29,29,30,29,30,30,29,30,30),
		array(27,29,30,29,30,29,59,29,30,29,30,30,30,29),
		array(46,29,30,29,30,29,29,30,29,30,29,30,30),
		array(35,30,29,30,29,30,29,29,30,29,29,30,30),
		array(24,29,30,30,59,30,29,29,30,29,30,29,30,30),
		array(42,29,30,30,29,30,29,30,29,30,29,30,29),
		array(31,30,29,30,29,30,30,29,30,29,30,29,30),
		array(21,29,59,29,30,30,29,30,30,29,30,29,30,30),
		array(40,29,30,29,29,30,29,30,30,29,30,30,29),
		array(28,30,29,30,29,29,59,30,29,30,30,30,29,30),
		array(47,30,29,30,29,29,30,29,29,30,30,30,29),
		array(36,30,30,29,30,29,29,30,29,29,30,30,29),
		array(25,30,30,30,29,59,29,30,29,29,30,30,29,30),
		array(43,30,30,29,30,29,30,29,30,29,29,30,30),
		array(33,29,30,29,30,30,29,30,29,30,29,30,29),
		array(22,29,30,59,30,29,30,30,29,30,29,30,29,30),
		array(41,30,29,29,30,29,30,30,29,30,30,29,30),
		array(30,29,30,29,29,30,29,30,29,30,30,59,30,30),
		array(49,29,30,29,29,30,29,30,29,30,30,29,30),
		array(38,30,29,30,29,29,30,29,29,30,30,29,30),
		array(27,30,30,29,30,29,59,29,29,30,29,30,30,29),
		array(45,30,30,29,30,29,29,30,29,29,30,29,30),
		array(34,30,30,29,30,29,30,29,30,29,29,30,29),
		array(23,30,30,29,30,59,30,29,30,29,30,29,29,30),
		array(42,30,29,30,30,29,30,29,30,30,29,30,29),
		array(31,29,30,29,30,29,30,30,29,30,30,29,30),
		array(21,29,59,29,30,29,30,29,30,30,29,30,30,30),
		array(40,29,30,29,29,30,29,29,30,30,29,30,30),
		array(29,30,29,30,29,29,30,58,30,29,30,30,30,29),
		array(47,30,29,30,29,29,30,29,29,30,29,30,30),
		array(36,30,29,30,29,30,29,30,29,29,30,29,30),
		array(25,30,29,30,30,59,29,30,29,29,30,29,30,29),
		array(44,29,30,30,29,30,30,29,30,29,29,30,29),
		array(32,30,29,30,29,30,30,29,30,30,29,30,29),
		array(22,29,30,59,29,30,29,30,30,29,30,30,29,29),
	);

	public function S2L($t=''){
		if($t=='')$t=time();
		$year=date('Y', $t);
		$month=date('m', $t);
		$day=date('d', $t);
		if($year<$this->_LStart || $month<=0 || $day<=0 || $year>=2051)return false;
		$date1=strtotime($year.'-01-01');
		$date2=strtotime($year.'-'.$month.'-'.$day);
		$days=round(($date2-$date1)/86400);
		$days+=1;
		$Larray=$this->_LMDay[$year-$this->_LStart];
		if($days<=$Larray[0]){
			$Lyear=$year-1;
			$days=$Larray[0]-$days;
			$Larray=$this->_LMDay[$Lyear-$this->_LStart];
			if($days<$Larray[12]){
				$Lmonth=12;
				$Lday=$Larray[12]-$days;
			}else{
				$Lmonth=11;
				$days=$days-$Larray[12];
				$Lday=$Larray[11]-$days;
			}			
		}else{
			$Lyear=$year;
			$days=$days-$Larray[0];
			for($i=1;$i<=12;$i++){
				if($days>$Larray[$i]){
					$days=$days-$Larray[$i];
				}else{
					if($days>30){
						$days=$days-$Larray[13];
						$Ltype=1;
					}
					$Lmonth=$i;
					$Lday=$days;
					break;
				}
			}
		}
		return array($Lmonth, $Lday);
	}

	public function LYearName($year){
		$Name=array('零','一','二','三','四','五','六','七','八','九');
		$j=strlen($year);
		$tmp='';
		for($i=0;$i<$j;$i++){
			for($k=0;$k<10;$k++){
				if($year[$i]==$k)$tmp.=$Name[$k];
			}
		}
		return $tmp;
	}

	public function LMonName($month){
		if($month>=1 && $month<=12){
			$Name=array(1=>'正','二','三','四','五','六','七','八','九','十','十一','十二');
			return $Name[$month];
		}
		return $month;
	}

	public function LDayName($day){
		if($day>=1 && $day<=30){
			$Name=array(1=>'初一','初二','初三','初四','初五','初六','初七','初八','初九','初十','十一','十二','十三','十四','十五','十六','十七','十八','十九','二十','廿一','廿二','廿三','廿四','廿五','廿六','廿七','廿八','廿九','三十');
			return $Name[$day];
		} 
		return $day;
	}
}
