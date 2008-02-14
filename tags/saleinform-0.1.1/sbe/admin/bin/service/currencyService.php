<?php
/* configuration
<PluginService Name="currencyService" Package="service" Class="currencyService">
	<Webservices>
		<Webservice Name="NBU" Country="UA" Url="http://www.ufs.com.ua/xml/nbu_fx.php" CharCode="title" CurrName="description" Value="rate" Nominal="qty" Date="date" />
		<Webservice Name="CBR" Country="RU" Url="http://cbr.ru/scripts/XML_daily.asp" CharCode="CharCode" CurrName="Name" Value="Value" Nominal="Nominal" Date="" />
	</Webservices>
</PluginService>
*/
include_once(OPENBIZ_HOME."/bin/xmltoarray.php");
class currencyService extends MetaObject 
{
	private $m_ConfigFile = "currencyService.xml";
	private $m_CurrencyBizObj = null;
	private $m_CountriesBizObj = null;
	private $m_CourcesBizObj = null;
	private $m_BizObjWebservices = null;
	private $m_CurrencyWebservices = null;
	private $m_Errors = '';
	
	function __construct(&$xmlArr)
	{
		$this->ReadMetadata($xmlArr);
	}

	protected function ReadMetadata(&$xmlArr)
	{
		parent::ReadMetaData($xmlArr);
		$this->m_CurrencyWebservices = new MetaIterator($xmlArr["PLUGINSERVICE"]["WEBSERVICES"]["WEBSERVICE"],"CurrencyWebservice");
		$this->m_BizObjWebservices = new MetaIterator($xmlArr["PLUGINSERVICE"]["BIZOBJECTS"]["BIZOBJ"],"BizObjCurrencyWebsevice");
	}
   
	
	public function runService()
	{
		global $g_BizSystem;
		$CourcesBOName = '';
		$CountriesBOName = '';
		$CurrencyBOName = '';
		foreach($this->m_BizObjWebservices as $bo)
		{
			if($bo->m_Name=="Cources") $CourcesBOName = $bo->m_BizObj;	
			if($bo->m_Name=="Countries") $CountriesBOName = $bo->m_BizObj;
			if($bo->m_Name=="Currency") $CurrencyBOName = $bo->m_BizObj;			
		}
		$boCources = $g_BizSystem->GetObjectFactory()->GetObject($CourcesBOName);
		$boCountries = $g_BizSystem->GetObjectFactory()->GetObject($CountriesBOName);
		$boCurrency = $g_BizSystem->GetObjectFactory()->GetObject($CurrencyBOName);
		
		foreach($this->m_CurrencyWebservices as $webservice)
		{
			$searchRule = "[cod]='$webservice->m_Country'";
			$recordList = array();
			$boCountries->FetchRecords($searchRule, $recordList, 1);
			if (!count($recordList)) continue;
			else $countriesRid = $recordList[0]['Id'];
			if ($webservice->m_Name == "NBU")
			{
				try
				{
		        	$parser = new XMLParser($webservice->m_Url, 'url', 1);
        			$xmlContent = $parser->getTree();
				}
				catch(Exception $e)
				{
					$this->m_Errors .= 'Ошибка обработки XML файла';
					return $this->serviceResult();
				}
				#$this->archiveOld();
				foreach($xmlContent['CHAPTER']['ITEM'] as $item)
				{
					$recordList = array();
					$currCode = $item['CHAR3']['VALUE'];
					$currDate = $item['DATE']['VALUE'];
					$currValue = $item['RATE']['VALUE'];
					$currNominal = $item['SIZE']['VALUE'];
					$currChange = $item['CHANGE']['VALUE'];
					$searchRule = "[cod]='$currCode'";
					$boCurrency->FetchRecords($searchRule, $recordList, 1);	
					if (!count($recordList))continue;
					$recArr = array();
					$recArr['_countries_rid'] = (string)$countriesRid;
					$recArr['_currency_rid'] = (string)$recordList[0]['Id'];
					$recArr['cource'] = (string)((float)$currValue/(float)$currNominal);
					$recArr['courcedate'] = (string)$currDate;
					$ok = $boCources->InsertRecord($recArr);
					if(!$ok) //$this->m_Errors .= $boCources->GetErrorMessage();
					$this->m_Errors .= 'Ошибка обновления курсов '.$webservice->m_Name.' по валюте '.$currCode.'\n';
				}
			}
			else if($webservice->m_Name == "CBRF"){
				try{
				    $parser = new XMLParser($webservice->m_Url.date('d-m-Y'), 'url', 1);
				    $xmlContent = $parser->getTree();
				}
				catch(Exception $e){
					
				    $this->m_Errors .= 'Ошибка обработки XML файла';
				    return $this->serviceResult();
				}
				foreach($xmlContent['VALCURS']['VALUTE'] as $item)
				{
					$recordList = array();
					$currCode = $item['CHARCODE']['VALUE'];
					$currDate = date('Y-m-d');
					$currValue = $item['VALUE']['VALUE'];
					$currNominal = $item['NOMINAL']['VALUE'];
					$searchRule = "[cod]='$currCode'";
					$boCurrency->FetchRecords($searchRule, $recordList, 1);	
					if (!count($recordList))continue;
					$recArr = array();
					$recArr['_countries_rid'] = (string)$countriesRid;
					$recArr['_currency_rid'] = (string)$recordList[0]['Id'];
					$recArr['cource'] = (string)((float)$currValue/(float)$currNominal);
					$recArr['courcedate'] = (string)$currDate;
					$ok = $boCources->InsertRecord($recArr);
					if(!$ok) //$this->m_Errors .= $boCources->GetErrorMessage();
					$this->m_Errors .= 'Ошибка обновления курсов '.$webservice->m_Name.' по валюте '.$currCode.'\n';
				}
			}
		}
		return $this->serviceResult();
		
	}
	
	public function serviceResult()
	{
		global $g_BizSystem;
		$now = date('Y-m-d H:i:s');
		$last_status = (!empty($this->m_Errors))?'ERROR':'OK';
		$sql = "UPDATE sys_services SET 
						service_last_status='$last_status', 
						service_error_descr='{$this->m_Errors}',
						startDT='$now'
				WHERE service_class='currencyService'";
		$db = $g_BizSystem->GetDBConnection();
		$db->query($sql); 
		return;
	}
	
	public function archiveOld()
	{
		global $g_BizSystem;
		$sql = "UPDATE _officialcources SET archive='1'"; 
		$db = $g_BizSystem->GetDBConnection();
		$db->query($sql); 
		return;
	}
	
}

class CurrencyWebservice extends MetaObject 
{
   public $m_Name;
   public $m_Country;
   public $m_Url;
   public function __construct($xmlArr)
   {
      $this->m_Name = $xmlArr["ATTRIBUTES"]["NAME"];
      $this->m_Country = $xmlArr["ATTRIBUTES"]["COUNTRY"];
      $this->m_Url = $xmlArr["ATTRIBUTES"]["URL"];
   }
}

class BizObjCurrencyWebsevice extends MetaObject 
{
   public $m_Name;
   public $m_BizObj;
   public function __construct($xmlArr)
   {
      $this->m_Name = $xmlArr["ATTRIBUTES"]["NAME"];
      $this->m_BizObj = $xmlArr["ATTRIBUTES"]["BO"];
   }
}

?>