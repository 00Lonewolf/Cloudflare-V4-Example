<?php
/* 
 *Cloudflare Analysis Modular
 *Cloudflare数据分析
 */
require("Class/Cloudflare.php");
$data = '{
	"operationName": "GetZoneAnalytics",
	"variables": {
		"zoneTag": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
		"since": "2021-05-21",
		"until": "2021-05-22"	
	},
	"query": "query GetZoneAnalytics($zoneTag: string, $since: string, $until: string) {\n  viewer {\n    zones(filter: {zoneTag: $zoneTag}) {\n      totals: httpRequests1dGroups(limit: 10000, filter: {date_geq: $since, date_lt: $until}) {\n        uniq {\n          uniques\n          __typename\n        }\n        __typename\n      }\n      zones: httpRequests1dGroups(orderBy: [date_ASC], limit: 10000, filter: {date_geq: $since, date_lt: $until}) {\n        dimensions {\n          timeslot: date\n          __typename\n        }\n        uniq {\n          uniques\n          __typename\n        }\n        sum {\n          browserMap {\n            pageViews\n            key: uaBrowserFamily\n            __typename\n          }\n          bytes\n          cachedBytes\n          cachedRequests\n          contentTypeMap {\n            bytes\n            requests\n            key: edgeResponseContentTypeName\n            __typename\n          }\n          clientSSLMap {\n            requests\n            key: clientSSLProtocol\n            __typename\n          }\n          countryMap {\n            bytes\n            requests\n            threats\n            key: clientCountryName\n            __typename\n          }\n          encryptedBytes\n          encryptedRequests\n          ipClassMap {\n            requests\n            key: ipType\n            __typename\n          }\n          pageViews\n          requests\n          responseStatusMap {\n            requests\n            key: edgeResponseStatus\n            __typename\n          }\n          threats\n          threatPathingMap {\n            requests\n            key: threatPathingName\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}\n"
}';
$data = json_decode($data,true);
$response = post::postgo('https://api.cloudflare.com/client/v4/graphql','POST',$data,$cfapi['0']['global_api_key'],$cfapi['1']['email']);
echo '威胁总数：'.(json_decode($response,true)['data']['viewer']['zones']['0']['zones']['0']['sum']['threats']);//威胁总合
echo "<br/>";
echo '独立访问者：'.(json_decode($response,true)['data']['viewer']['zones']['0']['totals']['0']['uniq']['uniques']);//独立访问者
?>
