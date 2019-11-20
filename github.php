<?php
$token = '6e484ceb1dfbc15b72c6730709abe6927e5c4d76';
$url = 'https://api.github.com/graphql';

//GRAPHQL request
$query = <<<'JSON'
query{
  repository(owner: "claaudius", name: "test") {
    object(expression: "master") {
      ... on Commit {
        history {                   
          edges {
            node {
              author {
                name
                email
              }
              message
              pushedDate
              commitUrl              
            }            
          }
          totalCount
        }        
      }
    }
  }
}
JSON;
$json = json_encode(['query' => $query]);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, TRUE);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  "User-Agent: GitHub Api",
  "Authorization: token $token"
));
$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
//check to see if we're ok
if ( $http_code == 200 ) {
  $temp = explode(PHP_EOL,$response);
  $count = count($temp);  
  $data = json_decode($temp[$count-1]);
  $data = $data->data->repository->object->history->edges; //data for the front-end
} else {
  die("Sorry, an error occurred.");
}