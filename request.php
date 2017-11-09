<?php

include 'vendor/autoload.php';

include 'credentails.php';

try {

    $client = new GuzzleHttp\Client(['base_uri' => 'https://yourdomain.com']);

    // Send a request to https://foo.com/root
    $response = $client->request('POST', '/token', [
        'headers' => array(
            "Content-Type" => "application /x-www-form-encoded",
            "Clientid" => "yourclientid"
            ),
        'form_params' => array(
            'username' => 'shambhu.kumar',
            'password' => $password,
            'grant_type' => 'password'
        )
    ]);

    $auth = json_decode((string) $response->getBody(), true);
    if($auth) {
        $accesstoken = $auth['access_token'];
        switch ($argv[1]) {
            case 'search':
                $response = $client->request('GET', '/api/emp/GetAllEmp/'.$argv[2], [
                    'headers' => array(
                        "Authorization" => "Bearer {$auth['access_token']}",
                        "Clientid" => "8er4lt18-opo4xc7u.apps.techaspect.com",
                        "Content-Type" => "application /x-www-form-encoded",
                    )
                ]);
            break;
            case 'find':
                $response = $client->request('GET', '/api/emp/GetEmpbyId/'.$argv[2], [
                    'headers' => array(
                        "Authorization" => "Bearer {$auth['access_token']}",
                        "Clientid" => "8er4lt18-opo4xc7u.apps.techaspect.com",
                        "Content-Type" => "application /x-www-form-encoded",
                    )
                ]);
            break;
            case 'fiddnd':
                $response = $client->request('GET', '/api/emp/GetEmpbyId/'.$argv[2], [
                    'headers' => array(
                        "Authorization" => "Bearer {$auth['access_token']}",
                        "Clientid" => "8er4lt18-opo4xc7u.apps.techaspect.com",
                        "Content-Type" => "application /x-www-form-encoded",
                    )
                ]);
            break;

            default:
                // code...
            break;
        }
        draw_text_table(json_decode($response->getBody()));
    }
} catch (Exception $e) {
    echo "$e";
}







function draw_text_table ($table) {
	// Work out max lengths of each cell
	foreach ($table AS $row) {
		$cell_count = 0;
		foreach ($row AS $key=>$cell) {
			$cell_length = strlen($cell);
			$cell_count++;
			if (!isset($cell_lengths[$key]) || $cell_length > $cell_lengths[$key]) $cell_lengths[$key] = $cell_length;
        }
    }
	// Build header bar
	$bar = '+';
	$header = '|';
	$i=0;
	foreach ($cell_lengths AS $fieldname => $length) {
		$i++;
		$bar .= str_pad('', $length+2, '-')."+";
		$name = $i.") ".$fieldname;
		if (strlen($name) > $length) {
			// crop long headings
			$name = substr($name, 0, $length-1);
		}
		$header .= ' '.str_pad($name, $length, ' ', STR_PAD_RIGHT) . " |";
	}
	$output = '';
	$output .= $bar."\n";
	$output .= $header."\n";
	$output .= $bar."\n";
	// Draw rows
	foreach ($table AS $row) {
		$output .= "|";
		foreach ($row AS $key=>$cell) {
			$output .= ' '.str_pad($cell, $cell_lengths[$key], ' ', STR_PAD_RIGHT) . " |";
		}
		$output .= "\n";
	}
	$output .= $bar."\n";
	echo $output;
}

