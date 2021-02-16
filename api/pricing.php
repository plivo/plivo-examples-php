<?php
/**
 * Example for Pricing get
 */
require 'vendor/autoload.php';
use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;
$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

try {
    $response = $client->pricing->get(
        'GB'
    );
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

    /*
    Sample Output
    ( 
        [status] => 200 
        [response] => Array ( 
            [api_id] => 36d239fa-ac4e-11e4-96e3-22000abcb9af 
            [country] => United Kingdom 
            [country_code] => 44 
            [country_iso] => GB 
            [message] => Array ( 
                [inbound] => Array ( 
                    [rate] => 0.00000 
                ) [outbound] => Array ( 
                    [rate] => 0.03680 
                ) [outbound_networks_list] => Array ( 
                    [0] => Array ( 
                        [group_name] => United Kingdom - All 
                        [rate] => 0.03680 
                    ) 
                ) 
            ) [phone_numbers] => Array ( 
                [local] => Array ( 
                    [rate] => 0.80000 
                ) [tollfree] => Array ( 
                    [rate] => 1.40000 
                ) 
            ) [voice] => Array ( 
                [inbound] => Array ( 
                    [ip] => Array ( 
                        [rate] => 0.00300 
                    ) [local] => Array ( 
                        [rate] => 0.00500 
                    ) [tollfree] => Array ( 
                        [rate] => 0.05000 
                    ) 
                ) [outbound] => Array ( 
                    [ip] => Array ( 
                    [rate] => 0.00300 
                ) [local] => Array ( 
                    [rate] => 0.01020 
                ) [rates] => Array ( 
                    [0] => Array ( 
                        [prefix] => Array ( 
                            [0] => 44 
                            [1] => 44203 
                            [2] => 44207 
                            [3] => 44208 
                        ) [rate] => 0.01020 
                    ) [1] => Array ( 
                        [prefix] => Array ( 
                            [0] => 443 
                            [1] => 44551107 
                            [2] => 4455114 
                            [3] => 445516 
                            [4] => 44555500 
                            [5] => 4455551 
                            [6] => 4455553 
                            [7] => 4455554 
                            [8] => 4455555 
                            [9] => 44558866 
                            [10] => 4455888 
                            [11] => 4456 
                        ) [rate] => 0.01700 
                    ) [2] => Array ( 
                        [prefix] => Array ( 
                            [0] => 4470000 
                            [1] => 4470004 
                            [2] => 4470005 
                            [3] => 4470006 
                            [4] => 4470007 
                            [5] => 4470020 
                            [6] => 4470022 
                            [7] => 4470023 
                            [8] => 4470024 
                            [9] => 4470025 
                            [10] => 4470027 
                            [11] => 4470028 
                            [12] => 4470029 
                            [13] => 4470740 
                            [14] => 4470741 
                            [15] => 4470742 
                        ) [rate] => 0.02650 
                    ) [3] => Array ( 
                        [prefix] => Array ( 
                            [0] => 44843 
                            [1] => 44844 
                            [2] => 44845 
                        ) [rate] => 0.16520 
                    ) [4] => Array ( 
                        [prefix] => Array ( 
                            [0] => 44870 
                        ) [rate] => 0.22350 
                    ) [5] => Array ( 
                        [prefix] => Array ( 
                            [0] => 44871 
                            [1] => 44872 
                            [2] => 44873 
                        ) [rate] => 0.32010 
                    ) [6] => Array ( 
                        [prefix] => Array ( 
                            [0] => 4478360 
                            [1] => 4478361 
                            [2] => 4478369 
                        ) [rate] => 0.40880 
                    ) [7] => Array ( 
                        [prefix] => Array ( 
                            [0] => 447 
                        ) [rate] => 0.42870 
                    ) [8] => Array ( 
                        [prefix] => Array ( 
                            [0] => 4470 
                    ) [rate] => 0.44030
                ) 
            ) [tollfree] => Array ( 
                [rate] => 
            ) 
        ) 
    ) 
    */