<?php
/**
* PageName - class.zomatoapi.php
* API Vesrion V1
* Created Date - 09 May 2014.
* Version 		Username        		Date                    	Change
* 00000001		Bhaskar.Rabha 			09-05-2014					Created
**/
class ZomatoApi
{
	
	var $apiKey 	= '7749b19667964b87a3efc739e254ada2';
	var $baseUrl 	= 'https://api.zomato.com/v1/';
	var $error 		= '';
	var $returnFormat = 'json';
	function __construct($apiKey = '', $base_url = '', $returnFormat = 'json')
	{
		if(!empty($apiKey))		{ $this->apiKey = $apiKey; 		} //Assign the api key if api key not  empty 
		if(!empty($baseUrl))	{ $this->baseUrl = $baseUrl; 	} //Assign the api url if base URL not  empty
		if(!empty($returnFormat))	{ $this->returnFormat = $returnFormat; 	} //Assign the return format
		$this->error = new stdClass; 
		
	}
	public function __call($method, $args)
	{      
		
        if(method_exists($this,$method))
        {
        	return call_user_func_array(array($this, $method), $args);	
        }
        else
        {
        	$this->error->details ='Method Does Not exist';
        }
       
    }
	/**
	*	[verifyDate description]
	* 	@param 	name 		summary 									type 			required
	*	        date		date										datetime		Required				
	*  	@return [type]         [description]
	**/
	private function verifyDate($date)
	{
		return (DateTime::createFromFormat('m-d-Y H:i:s', $date) !== false);
	}
	/**
	*	[validationFields description]
	* 	@param 	name 		summary 									type 			required
	*	        field		Field Name									String			Required
				val			Value of Field								String			Required
				required	Empty check 0 - Not Required, 1 - Required	Boolean			Optional
	*  	@return [type]         [description]
	**/
	private function validationFields($field, $val, $required=false)
	{
		switch($field)
		{
			case 'city id':
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='City Id is empty';
						return false;	
					}
					else if(!preg_match('/^[1-9]+[0-9]*$/', $val))
					{
						$this->error->details ='Invalid City Id';
						return false;	
					}
				}
				else
				{
					if(!preg_match('/^|[1-9 ]+[0-9]*$/', $val))
					{
						$this->error->details ='Invalid City Id';
						return false;	
					}
				}
			break;
			case 'lat':
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Latitude is empty';
						return false;	
					}
					else if(!preg_match('/^[0-9\.]+$/', $val))
					{
						$this->error->details ='Invalid Latitude';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^[0-9\. ]+$/', $val))
					{
						$this->error->details ='Invalid Latitude';
						return false;
					}				
				}
			
			break;
			case 'lon':
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Latitude is empty';
						return false;	
					}
					else if(!preg_match('/^[0-9\.]+$/', $val))
					{
						$this->error->details ='Invalid Latitude';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^[0-9\. ]+$/', $val))
					{
						$this->error->details ='Invalid Longitude';
						return false;
					}				
				}
			break;
			case 'zone id':
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Zone Id is empty';
						return false;	
					}
					else if(!preg_match('/^[1-9]+[0-9]*$/', $val))
					{
						$this->error->details ='Invalid Zone Id';
						return false;	
					}
				}
				else
				{
					if(!preg_match('/^|[1-9 ]+[0-9]*$/', $val))
					{
						$this->error->details ='Invalid Zone Id';
						return false;	
					}
				}
			break;
			case 'category':
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Category is empty';
						return false;	
					}
					else if(!preg_match('/^[1-3]+$/', $val))
					{
						$this->error->details ='Invalid Category';
						return false;	
					}
										
				}
				else
				{
					if(!preg_match('/^[1-3 ]+$/', $val))
					{
						$this->error->details ='Invalid Category';
						return false;	
					}
				
				}
			break;
			case 'start':
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Start is empty';
						return false;	
					}
					else if(!preg_match('/^[0-9]+$/', $val)) 
					{
						$this->error->details ='Invalid Start';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^[0-9 ]+$/', $val)) 
					{
						$this->error->details ='Invalid Start';
						return false;
					}
				}
			break;
			case 'count':
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Count is empty';
						return false;	
					}
					else if(!preg_match('/^[1-9]+$/', $val)) 
					{
						$this->error->details ='Invalid Count';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^[1-9 ]+$/', $val)) 
					{
						$this->error->details ='Invalid Count';
						return false;
					}
				}
			break;
			case 'restaurant id';
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Restaurant Id is empty';
						return false;	
					}
					else if(!preg_match('/^[1-9]+[0-9]*$/', $val))
					{
						$this->error->details ='Invalid Restaurant Id';
						return false;	
					}
				}
				else
				{
					if(!preg_match('/^|[1-9 ]+[0-9]*$/', $val))
					{
						$this->error->details ='Invalid Restaurant Id';
						return false;	
					}
				}
			break;
			case 'data':
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Data is empty';
						return false;	
					}					
				}		
			break;
			case 'name':
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Name is empty';
						return false;	
					}
					else if(!preg_match('/^[a-z 0-9]+$/i', $val))
					{
						$this->error->details ='Invalid Name';
						return false;	
					}
				}
				else
				{
					if(!preg_match('/^[a-z 0-9]+$/', $val))
					{
						$this->error->details ='Invalid Name';
						return false;	
					}
				}
			break;
			case 'radius';
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Radius is empty';
						return false;	
					}
					else if(!preg_match('/^[1-9]+[0-9]*$/', $val))
					{
						$this->error->details ='Invalid Radius';
						return false;	
					}
				}
				else
				{
					if(!preg_match('/^|[1-9 ]+[0-9]*$/', $val))
					{
						$this->error->details ='Invalid Radius';
						return false;	
					}
				}
			break;
			case 'mincft';
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Mincft is empty';
						return false;	
					}
					else if(!preg_match('/^0|1+$/', $val)) 
					{
						$this->error->details ='Invalid Mincft';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^[0-1 ]+$/', $val)) 
					{
						$this->error->details ='Invalid Mincft';
						return false;
					}
				}
			break;
			case 'maxcft';
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Maxcft is empty';
						return false;	
					}
					else if(!preg_match('/^0|1+$/', $val)) 
					{
						$this->error->details ='Invalid Maxcft';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^[0-1 ]+$/', $val)) 
					{
						$this->error->details ='Invalid Maxcft';
						return false;
					}
				}
			break;
			case 'minrating';
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Maxcft is empty';
						return false;	
					}
					else if(!preg_match('/^0|1+$/', $val)) 
					{
						$this->error->details ='Invalid Start';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^[0-1 ]+$/', $val)) 
					{
						$this->error->details ='Invalid Start';
						return false;
					}
				}
			break;
			case 'maxrating';
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Start is empty';
						return false;	
					}
					else if(!preg_match('/^[0-1 ]+$/', $val)) 
					{
						$this->error->details ='Invalid Start';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^0|1+$/', $val)) 
					{
						$this->error->details ='Invalid Start';
						return false;
					}
				}
			break;
			case 'cc';
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Cc is empty';
						return false;	
					}
					else if(!preg_match('/^0|1+$/', $val)) 
					{
						$this->error->details ='Invalid Start';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^[0-1 ]+$/', $val)) 
					{
						$this->error->details ='Invalid Cc';
						return false;
					}
				}
			break;
			case 'bar';
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Bar is empty';
						return false;	
					}
					else if(!preg_match('/^0|1+$/', $val)) 
					{
						$this->error->details ='Invalid Bar';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^[0-1 ]+$/', $val)) 
					{
						$this->error->details ='Invalid Bar';
						return false;
					}
				}
			break;
			case 'veg';
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Veg is empty';
						return false;	
					}
					else if(!preg_match('/^0|1+$/', $val)) 
					{
						$this->error->details ='Invalid Veg';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^[0-1 ]+$/', $val)) 
					{
						$this->error->details ='Invalid Veg';
						return false;
					}
				}
			break;
			case 'open';
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Open is empty';
						return false;	
					}
					else if(!$this->verifyDate($val)) 
					{
						$this->error->details ='Invalid Open';
						return false;
					}
				}
				else
				{
					if(!$this->verifyDate($val)) 
					{
						$this->error->details ='Invalid Open';
						return false;
					}
				}
			break;
			case 'buffet';
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Buffet is empty';
						return false;	
					}
					else if(!preg_match('/^0|1+$/', $val)) 
					{
						$this->error->details ='Invalid Buffet';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^[0-1 ]+$/', $val)) 
					{
						$this->error->details ='Invalid Buffet';
						return false;
					}
				}
			break;
			case 'happyhour';
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Happyhour is empty';
						return false;	
					}
					else if(!preg_match('/^0|1+$/', $val)) 
					{
						$this->error->details ='Invalid Happyhour';
						return false;
					}
				}
				else
				{
					if(!preg_match('/^[0-1 ]+$/', $val)) 
					{
						$this->error->details ='Invalid Happyhour';
						return false;
					}
				}
			break;
			case 'cuisine id':
				if($required)
				{
					if(empty($val))
					{
						$this->error->details ='Cuisine Id is empty';
						return false;	
					}
					else if(!preg_match('/^[1-9]+[0-9]*$/', $val))
					{
						$this->error->details ='Invalid Cuisine Id';
						return false;	
					}
				}
				else
				{
					if(!preg_match('/^|[1-9 ]+[0-9]*$/', $val))
					{
						$this->error->details ='Invalid Cuisine Id';
						return false;	
					}
				}
			break;
		}
		return true;
	}
	/**
	*	[where description]
	* 	@param 	name 		summary 							type 			required
	*	        arrWhere	Prepare the Params for request		Array String	required				
	*  	@return [type]         [description]
	**/
	private function where($arrWhere = array())
	{
		$query = '';
		foreach($arrWhere as $key=>$value)
		{
			if(!empty($value) && $value !== 0)
			{
				if(empty($query))
				{
					$query = '?'.$key .'='. $value;
				}
				else
				{
					$query = '&'.$key .'='. $value;	
				}
			}
		}
		return $query;
	}
	/**
	*	[getRequest description]
	* 	@param 	name 	summary 							type 	required
	*	        url		API Request URL	with params			String	required	*			
	*  	@return [type]         [description]
	**/
	private function getRequest($url)
	{

		$ch = curl_init($url);
		$timeout = 5; // set to zero for no timeout
		$customHeader = array('X-Zomato-API-Key:'.$this->apiKey);
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeader);
		$result = curl_exec($ch);		
		curl_close($ch);
		return $result;
	}
	/**
	*	[postRequest description]
	* 	@param 	name 	summary 					type 	required
	*	        url		API Request URL				String	required
	*			data	Post Data					Array String	required
	*  	@return [type]         [description]
	**/
	private function postRequest($url, $data)
	{
		$fields_string = "";
		foreach($data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		
		$ch = curl_init($url);
		$timeout = 5; // set to zero for no timeout
		$customHeader = array('X-Zomato-API-Key:'.$this->apiKey);
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeader);
		curl_setopt($ch,CURLOPT_POST, count($data));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		$result = curl_exec($ch);		
		curl_close($ch);
		return $result;
	
	}
	/**
	*	[responseAnalyse description]
	* 	@param 	name 	summary 					type 	required
	*	        content	JSON content return API 	String	required
	*  	@return [type]         [description]
	**/
	private function responseAnalyse($output)
	{
		
		switch($this->returnFormat)
		{
			case 'json':			
				$arrData = json_decode($output);
				if(isset($arrData->status))
				{
					$this->error = $arrData;
					return false;
				}
				else
				{
					return $arrData;
				}
			break;
			case 'xml':
			$arrData = simplexml_load_string($output);			
			if(isset($arrData->status))
			{
				$this->error = $arrData;
				return false;
			}
			else
			{
				return $arrData;
			}
		}
	}
	/**
	*	[getError description]
	* 	@param 	name 	method 	summary type 	required
	*	        None	None	None	None	None
	*  	@return [type]         [description]
	**/
	function getError()
	{
		return $this->error;
	}
	/**
	*	[printError description]
	* 	@param 	name 	method 	summary type 	required
	*	        None	None	None	None	None
	*  	@return [type]         [description]
	**/
	function printError()
	{
		echo '<pre>';
		print_r($this->error);
		echo '</pre>';
	}
	/**
	*	[getAllCity description]
	* 	@param 	name 	method 	summary type 	required
	*	        None	None	None	None	None
	*  	@return [type]         [description]
	**/
	function getAllCity()
	{		
		$url =  $this->baseUrl . 'cities.'.$returnFormat;
		$retResult = $this->getRequest($url);
		return $this->responseAnalyse($retResult);

	}
	/**
	*	[getLocalityFromCoordinates description]
	* 	@param 	name 	method 	summary 			type 	required
	*	        lat		GET		Device latitude		double	Required
	*	        lon		GET		Device longitude	double	Required
	*  	@return [type]         [description]
	**/
	function getLocalityFromCoordinates($lat = '', $lon = '')
	{
		
		if(!$this->validationFields('lat', $lat, true) || !$this->validationFields('lon', $lon, true)){	return false; }	
		$where = $this->where(array('lat'=>$lat, 'lon'=> $lon));
		$url =  $this->baseUrl . 'geocode.'.$this->returnFormat . $where;
		$retResult = $this->getRequest($url);
		return $this->responseAnalyse($retResult);		
	}
	/**
	*	[getZonesInCity description]
	* 	@param 	name 	summary 	type 	required
	*  	        cityId	City id		int		Required
	*  	@return [type]         [description]
	**/
	function getZonesInCity($cityId = '')
	{		
		if(!$this->validationFields('city id', $cityId, true))	{ return false;	}
		$where = $this->where(array('city_id'=>$cityId));
		$url =  $this->baseUrl . 'zones.'.$this->returnFormat.$where;		
		$retResult = $this->getRequest($url);
		return $this->responseAnalyse($retResult);		
	}
	/**
	*	[getLocalitiesInCity description]
	* 	@param 	name 	summary 	type 	required
	*  	        city_id	id		int		Required
	*  	@return [type]         [description]
	**/
	function getLocalitiesInCity($cityId = '')
	{
		if(!$this->validationFields('city id', $cityId, true))	{	return false;	}
		$where = $this->where(array('city_id'=>$cityId));
		$url =  $this->baseUrl . 'subzones.'.$this->returnFormat.$where;	
		$retResult = $this->getRequest($url);	
		return $this->responseAnalyse($retResult);		
	}
	/**
	*	[getLocalitiesZone description]
	* 	@param name 	summary 	type 	required
	*  	       zone_id	Zone id		int		Required
	*  	@return [type]         [description]
	**/
	function getLocalitiesZone($zoneId = '')
	{		
		if(!$this->validationFields('zone id', $zoneId, true)){ return false;	}
		$where = $this->where(array('zone_id'=>$zoneId));
		$url =  $this->baseUrl . 'subzones.'.$this->returnFormat.$where;
		$retResult = $this->getRequest($url);	
		return $this->responseAnalyse($retResult);	
	}
	/**
 	* [getCuisinesByCityId description]
	* @param   name 		summary 								type 	required
	*		   city_id		City id									int		Required
	* @return [type]         [description]
	*/
	function getCuisinesByCityId($cityId = '')
	{		
		if(!$this->validationFields('city id', $cityId, true)){ return false;	}
		$where = $this->where(array('city_id'=>$cityId));
		$url =  $this->baseUrl . 'cuisines.'.$this->returnFormat. $where;
		$retResult = $this->getRequest($url);
		return $this->responseAnalyse($retResult);
	}
	/**
	* [getRestaurantsInZone description]
	* @param  	name		summary													type    required
				* zone_id	Zone id													int		Required
				* category	1 for Delivery, 2 for Dineout, 3 for Nightlife. 		int		Optional
				* 			Skip this to get all results	
				* start		The starting location within results from which 		int		Optional
				* 			the results should be fetched. Default is 0	
				* count		The number of results to fetch. Default is 10, 			int		Optional	
				* 			max is 50.	
	* @return [type]             [description]
	*/	
	function getRestaurantsInZone($zoneId = '', $category = '', $start = 0, $count = 10)
	{		
		if(!$this->validationFields('zone id', $cityId, true)){ return false;	}		
		if(!$this->validationFields('category', $cityId, true)){ return false;	}
		if(!$this->validationFields('start', $start, false)){ return false;	}
		if(!$this->validationFields('count', $count, false)){ return false;	}
		$where = $this->where(array('zone_id'=>$zoneId, 'category'=> $category, 'start'=> $start, 'count'=> $count));
		$url =  $this->baseUrl . 'search.json'.$this->returnFormat.$where;
		$retResult = $this->getRequest($url);
		return $this->responseAnalyse($retResult);	
	}
	/**
	* [getRestaurantsInLocality description]
	* @param 	name 		summary 													type 	required  
	*			city_id		City id														int		Required
	*			subzone_id	Subzone id													int		Required
	*			category	1 for Delivery, 2 for Dineout, 3 for Nightlife. 			int		Optional
	*						Skip this to get all results	
	*			start		The starting location within results from which 			int		Optional
	*						the results should be fetched. Default is 0	
	*			count		The number of results to fetch. Default is 10, max is 50	int		Optional
	* @return [type]         [description]
	**/
	function getRestaurantsInLocality($cityId = '', $subzoneId = '', $category = '', $start = 0, $count = 10)
	{		
		if(!$this->validationFields('city id', $cityId, true)){ return false;	}	
		if(!$this->validationFields('subzone id', $subzoneId, true)){ return false;	}
		if(!$this->validationFields('category', $category, false)){ return false;	}
		if(!$this->validationFields('start', $start, false)){ return false;	}
		if(!$this->validationFields('count', $count, false)){ return false;	}
		$where = $this->where(array('city_id'=>$cityId, 'subzone_id'=> $subzoneId ,'category'=> $category, 'start'=> $start, 'count'=> $count));		
		$url =  $this->baseUrl . 'search.'.$this->returnFormat. $where;
		$retResult = $this->getRequest($url);
		return $this->responseAnalyse($retResult);	
	}
	/**
	* [getRestaurantDetails description]
	* @param   name 			summary 			type 	required
	*          restaurantId		restaurant Id		int		Required
	* @return [type]            [description]
	**/
	function getRestaurantDetails($restaurantId = '')
	{
		if(!$this->validationFields('restaurant id', $restaurantId, true)){  return false;	}			
		$url =  $this->baseUrl . 'restaurant.'.$this->returnFormat.'/'.$restaurantId;
		$retResult = $this->getRequest($url);
		//echo '$url'.$url;
		return $this->responseAnalyse($retResult);			
	}
	/**
	* [getReviewsForRestaurant description]
	* @param  	name 			summary 													type 	required
	*			restaurantId	restaurant Id												int		Required.
	*         	start			The starting location within results from 					int		Optional
	*         					which the results should be fetched. Default is 0	
	*	      	count			The number of results to fetch. Default is 10, max is 50	int		Optional
	 * @return [type]                [description]
	 */
	function getReviewsForRestaurant($restaurantId = '', $start = 0, $count = 10)
	{	
		if(!$this->validationFields('restaurant id', $restaurantId, true)){ return false;	}
		if(!$this->validationFields('start', $start, false)){ return false;	}
		if(!$this->validationFields('count', $count, false)){ return false;	}
		$where = $this->where(array('start'=>$start, 'count'=> $count));		
		$url =  $this->baseUrl . 'reviews./'.$this->returnFormat.$restaurantId.'/user'. $where;
		
		$retResult = $this->getRequest($url);	
		return $this->responseAnalyse($retResult);			
	}
	/**
	* [postErrorInRestaurantDetails description]
	* @param  	
	*		name 		summary 					type 	required
	*		res_id		User email					int		Required
	*		data		Error in restaurant data	string	Required
	*		name		User name					string	Optional
	* @return [type]                [description]
	**/
	function postErrorInRestaurantDetails($res_id = '', $start = '', $count = '')
	{
		if(!$this->validationFields('restaurant id', $res_id, true)){ return false;	}
		if(!$this->validationFields('data', $data, true)){ return false;	}
		if(!$this->validationFields('name', $name, false)){ return false;	} 
		
		$data = $this->where(array('res_id'=> $res_id, 'data'=> $data, 'name' => $name));		
		$url =  $this->baseUrl . 'contact.'.$this->returnFormat;		
		$retResult = $this->postRequest($url, $data);	
		return $this->responseAnalyse($retResult);	
	
	}
	/**
	* [getRestaurantsByCuisine description]
	* @param  
    * 			name 			summary 												type 	required
	* 			city_id			City id													int		Required
	* 			cuisine_id		Cuisine id												int		Required
	* 			category		1 for Delivery, 2 for Dineout, 3 for Nightlife. 		int		Optional
	* 							Skip this to get all results	
	* 			start			The starting location within results from which 		int		Optional
	* 							the results should be fetched. Default is 0	
	* 			count			The number of results to fetch. Default is 10, 			int		Optional	
	* 							max is 50	
	* 			mincft			Filter restaurants where average cost for two is 				Optional
	* 							less than this value										
	* 			maxcft			Filter restaurants where average cost for two is 				Optional
	* 							above this value		
	* 			minrating		Filter restaurants with rating less than this 					Optional
	* 							value		
	* 			maxrating		Filter restaurants with rating above this value					Optional
	* 			cc				Set 1 to check if credit cards are accepted else 0		int		Optional
	* 			bar				Set 1 to check if restaurant has a bar else 0			int		Optional
	* 			veg				Set 1 to check if restaurant is pure veg else 0			int		Optional
	* 			open			Set 'now' to check if restaurant is open				string	Optional
	* 			buffet			Set 1 to check if restaurant has a buffet else 0		int		Optional
	* 			happyhour		Set 1 to check if restaurant has happy hours else 0		int		Optional
	* @return [type]             [description]
	**/
	function getRestaurantsByCuisine($cityId = '', $cuisineId = '', $category= '', $start = 0, $count = 10, $mincft = '', $maxcft = '', $minrating = '', $maxrating = '', $cc = 0, $bar = 0, $veg = 0, $open  = '', $buffet = 0, $happyhour = 0)
	{
		if(!$this->validationFields('city id', $cityId, true)){ return false;	}
		if(!$this->validationFields('cuisine id', $cuisineId, true)){ return false;	}
		if(!$this->validationFields('category', $category, false)){ return false;	}
		if(!$this->validationFields('mincft', $mincft, false)){ return false;	}
		if(!$this->validationFields('maxcft', $maxcft, false)){ return false;	}
		if(!$this->validationFields('minrating', $minrating, false)){ return false;	}
		if(!$this->validationFields('maxrating', $maxrating, false)){ return false;	}
		if(!$this->validationFields('cc', $cc, false)){ return false;	}
		if(!$this->validationFields('bar', $bar, false)){ return false;	}
		if(!$this->validationFields('veg', $veg, false)){ return false;	}
		if(!$this->validationFields('open', $open, false)){ return false;	}
		if(!$this->validationFields('buffet', $buffet, false)){ return false;	}
		if(!$this->validationFields('happyhour', $happyhour, false)){ return false;	}
		if(!$this->validationFields('start', $start, false)){ return false;	}
		if(!$this->validationFields('count', $count, false)){ return false;	}
		$where = $this->where(array('city_id' => $cityId, 'cuisine_id' => $cuisineId, 'category' => $category, 'start' => $start, 'limit' => $limit, 'mincft' => $mincft,  'maxcft' =>$maxcft, 'minrating' => $minrating,  'maxrating' => $maxrating, 'cc' => $cc, 'bar' => $bar, 'veg' => $veg, 'open'  => $open, 'buffet' => $buffet, 'happyhour' => $happyhour));
		$url =  $this->baseUrl . 'search.'.$this->returnFormat.$where;
		$retResult = $this->getRequest($url);
		return $this->responseAnalyse($retResult);				
	}
	/**
	* [getRandomRestaurantNearLocation description]
	* @param  	name 		summary 											type 	required
	*           lat			Device latitude										double	Required
	* 			lon			Device longitude									double	Required
	* 			city_id		City id												int		Required
	* 			random		Set this to true									bool	Required
	* 			radius		Radius within which to search(in meters)			integer	Optional
	* 			cuisine_id	Cuisine id	int	Required
	* 			category	1 for Delivery, 2 for Dineout, 3 for Nightlife.		int		Optional 
	* 								Skip this to get all results	
	* 			start		The starting location within results from which 	int		Optional
	* 								the results should be fetched. Default is 0	
	* 			count		The number of results to fetch. Default is 10, 		int		Optional
	* 								max is 50	
	* 			mincft		Filter restaurants where average cost for two is 			Optional
	* 								less than this value		
	* 			maxcft		Filter restaurants where average cost for two is 			Optional
	* 								above this value		
	* 			minrating	Filter restaurants with rating less than this value			Optional
	* 			maxrating	Filter restaurants with rating above this value				Optional
	* 			cc			Set 1 to check if credit cards are accepted else 0	int		Optional
	* 			bar			Set 1 to check if restaurant has a bar else 0		int		Optional
	* 			veg			Set 1 to check if restaurant is pure veg else 0		int		Optional
	* 			open		Set 'now' to check if restaurant is open			string	Optional
	* 			buffet		Set 1 to check if restaurant has a buffet else 0	int		Optional
	* 			happyhour	Set 1 to check if restaurant has happy hours else 0	int		Optional
	* @return [type]         [description]
	**/
	function getRandomRestaurantNearLocation($lat = '', $lon = '', $cityId = '', $radius = '', $cuisine_id = '', $category = '', $start = '', $count = '', $mincft = '', $maxcft = '', $minrating = '', $maxrating = '', $cc = '', $bar = '', $veg = '', $open = '', $buffet = '', $happyhour = '')
	{
		if(!$this->validationFields('lat', $lat, true) || !$this->validationFields('lon', $lon, true)){	return false; }	
		if(!$this->validationFields('city id', $cityId, true)){ return false; }	
		if(!$this->validationFields('radius', $radius, false)){ return false;	}
		if(!$this->validationFields('cuisine id', $cuisineId, false)){ return false;	}
		if(!$this->validationFields('category', $category, false)){ return false;	}
		if(!$this->validationFields('start', $start, false)){ return false;	}
		if(!$this->validationFields('count', $count, false)){ return false;	}
		if(!$this->validationFields('mincft', $mincft, false)){ return false;	}
		if(!$this->validationFields('maxcft', $maxcft, false)){ return false;	}
		if(!$this->validationFields('minrating', $minrating, false)){ return false;	}
		if(!$this->validationFields('cc', $cc, false)){ return false;	}
		if(!$this->validationFields('bar', $bar, false)){ return false;	}
		if(!$this->validationFields('veg', $veg, false)){ return false;	}
		if(!$this->validationFields('open', $open, false)){ return false;	}
		if(!$this->validationFields('buffet', $buffet, false)){ return false;	}
		if(!$this->validationFields('happyhour', $happyhour, false)){ return false;	}
			
		$where = $this->where(array('random'=>true,'city_id' => $cityId, 'cuisine_id' => $cuisineId, 'category' => $category, 'start' => $start, 'limit' => $limit, 'mincft' => $mincft,  'maxcft' => $maxcft, 'minrating' => $minrating,  'maxrating' => $maxrating, 'cc' => $cc, 'bar' => $bar, 'veg' => $veg, 'open'  => $open, 'buffet' => $buffet, 'happyhour' => $happyhour));
		
		$url =  $this->baseUrl . 'search./'.$this->returnFormat.'near'.$where; 
		$retResult = $this->getRequest($url);	
		return $this->responseAnalyse($retResult);		
	}
	/**
	* [searchRestaurants description]
	* @param  	name 		summary 														type 	required
	*			city_id		The city from which search results are to be returned.					Required
	*			q			query for keyword search												Optional
	*			lat			Latitude of the point near which search is to be made.					Optional
	*			lon			Longitude of the point near which search is to be made.					Optional
	*			mincft		Filter restaurants where average cost for two is less 					Optional
	*						than this value		
	*			maxcft		Filter restaurants where average cost for two is above 					Optional
	*						this value		
	*			minrating	Filter restaurants with rating less than this value						Optional
	*			maxrating	Filter restaurants with rating above this value							Optional
	*			start		Offset from the start of results. For e.g. if you require 				Optional
	*						results starting from the 10th result onwards, pass start=10		
	*			count		Number of results to be returned, default is 10, max is 50				Optional
	*			cuisines	cuisine id	int	Optional
	*			cc			Set 1 to check if credit cards are accepted else 0				int		Optional
	*			bar			Set 1 to check if restaurant has a bar else 0					int		Optional
	*			veg			Set 1 to check if restaurant is pure veg else 0					int		Optional
	*   		open		Set 'now' to check if restaurant is open						string	Optional
	*			buffet		Set 1 to check if restaurant has a buffet else 0				int		Optional
	*			happyhour	Set 1 to check if restaurant has happy hours else 0				int		Optiona
	* @return [type]         [description]
	*/	
	function searchRestaurants($cityId = '', $q = '', $lat = '', $lon = '', $mincft = '', $maxcft = '', $minrating = '', $maxrating = '', $start = '', $count = '', $cuisines = '',  $cc = '', $bar = '', $veg = '', $open = '', $buffet = '', $happyhour = '' )
	{
		
		if(!$this->validationFields('city id', $cityId, true)){ return false;	}
		if(!$this->validationFields('q', $q, false)){ return false;	}
		if(!$this->validationFields('lat', $lat, false)){ return false;	}
		if(!$this->validationFields('lon', $lon, false)){ return false;	}
		if(!$this->validationFields('mincft', $mincft, false)){ return false;	}
		if(!$this->validationFields('maxcft', $maxcft, false)){ return false;	}
		if(!$this->validationFields('minrating', $minrating, false)){ return false;	}
		if(!$this->validationFields('maxrating', $maxrating, false)){ return false;	}
		if(!$this->validationFields('start', $start, false)){ return false;	}
		if(!$this->validationFields('count', $count, false)){ return false;	}
		if(!$this->validationFields('cuisines', $cuisines, false)){ return false;	}
		if(!$this->validationFields('cc', $cc, false)){ return false;	}
		if(!$this->validationFields('bar', $bar, false)){ return false;	}
		if(!$this->validationFields('veg', $veg, false)){ return false;	}
		if(!$this->validationFields('open', $open, false)){ return false;	}
		if(!$this->validationFields('buffet', $buffet, false)){ return false;	}
		if(!$this->validationFields('happyhour', $happyhour, false)){ return false;	}

		$where = $this->where(array('random'=>true,'city_id' => $cityId, 'cuisine_id' => $cuisineId, 'category' => $category, 'start' => $start, 'limit' => $limit, 'mincft' => $mincft,  'maxcft' => $maxcft, 'minrating' => $minrating,  'maxrating' => $maxrating, 'cc' => $cc, 'bar' => $bar, 'veg' => $veg, 'open'  => $open, 'buffet' => $buffet, 'happyhour' => $happyhour));

		$url =  $this->baseUrl . 'search.'.$this->returnFormat. $where; 
		$retResult = $this->getRequest($url);
		return $this->responseAnalyse($retResult);	
	}
	/**
	 * [getNearByRestaurants description]
	 * name 		summary 														type 	required
	*  lat			Latitude of the point near which search is to be made.					Required
	*  lon			Longitude of the point near which search is to be made.					Required
	*  start		Offset from the start of results. For e.g. if you require 
	*  				results starting from the 10th result onwards, pass start=10			Optional
	*  count		Number of results to be returned, max is 50		Optional
	*  mincft		Filter restaurants where average cost for two is less than 				Optional
	*  				this value	
	*  maxcft		Filter restaurants where average cost for two is above 					Optional
	*  				this value		
	*  minrating	Filter restaurants with rating less than this value						Optional
	*  maxrating	Filter restaurants with rating above this value							Optional
	*  Returned Fields 
	 * @return [type]      [description]
	 */
	function getNearByRestaurants($lat = '', $lon = '', $start = '', $count = '', $mincft = '', $maxcrf = '', $minrating = '', $maxrating = '')
	{
		if(!$this->validationFields('lat', $lat, true) || !$this->validationFields('lon', $lon, true)){	return false; }	
		if(!$this->validationFields('start', $start, false)){ return false;	}
		if(!$this->validationFields('count', $count, false)){ return false;	}
		if(!$this->validationFields('mincft', $mincft, false)){ return false;	}
		if(!$this->validationFields('maxcft', $mincft, false)){ return false;	}
		if(!$this->validationFields('minrating', $mincft, false)){ return false;	}
		if(!$this->validationFields('maxrating', $mincft, false)){ return false;	}
		
		
		$where = $this->where(array('lat' => $lat, 'lon' => $lon, 'start' => $start, 'count' => $count, 'mincft' => $mincft, 'maxcft' => $maxcft, 'minrating' => $minrating, 'maxrating' => $maxrating));
		$url =  $this->baseUrl . 'search.'.$this->returnFormat.'/near'.$where; 
		$retResult = $this->getRequest($url);
		return $this->responseAnalyse($retResult);	
	}

}


$objZomatoApi = new ZomatoApi('7749b19667964b87a3efc739e254ada','','xml');
$data = $objZomatoApi->getRestaurantDetails(2);
if($data)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}
else
{
	$error = $objZomatoApi->getError();
	echo '<pre>';
	print_r($error);
	echo '</pre>';
}
