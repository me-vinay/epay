<?php

/*$customerData = [
     'ExternalId' => "Yuri-002",
     "Success" => true,
     "Image" => false,
     'Dimensions'=> [
     	[ "Name" =>"Bust",
         "Value" =>1.045585],
     	[ "Name" =>"Chest",
         "Value" =>1.039829],
         [ "Name" =>"Biceps",
         "Value" =>0.326062],
         [ "Name" =>"Hips",
         "Value" => 0.970713],
         [ "Name" =>"Neck",
         "Value" =>0.427559],
         [ "Name" =>"NeckBase",
         "Value" =>0.440047],
         [ "Name" =>"Waist",
         "Value" =>0.961412],
         [ "Name" =>"Wrist",
         "Value" =>0.185585],
         [ "Name" =>"HPStoFloor",
         "Value" =>1.508328],
         [ "Name" =>"NapeToFloor",
         "Value" =>1.487458],
         [ "Name" =>"AcrossBack",
         "Value" =>0.413836],
         [ "Name" =>"AcrossBust",
         "Value" =>0.454007],
         [ "Name" =>"ArmLength",
         "Value" =>0.569534],
         [ "Name" =>"ShoulderSpan",
         "Value" => 0.421429],
         [ "Name" =>"ChestMin",
         "Value" => 1.030079],
         [ "Name" =>"ShoulderDropAngleL",
         "Value" =>18.486631]
    ],
    "BodyId" => 120820
 ];*/

$customerData = '{

             "ExternalId": "Yuri-002",

              "Success": true,

              "Image": false,

              "Dimensions": [

                             {

                                           "Name": "Bust",

                                           "Value": 1.045585

                             },

                             {

                                           "Name": "Chest",

                                           "Value": 1.039829

                             },

                             {

                                           "Name": "Biceps",

                                           "Value": 0.326062

                             },

                             {

                                           "Name": "Hips",

                                           "Value": 0.970713

                             },

                             {

                                           "Name": "Neck",

                                           "Value": 0.427559

                             },

                             {

                                           "Name": "NeckBase",

                                           "Value": 0.440047

                             },

                             {

                                           "Name": "Waist",

                                           "Value": 0.961412

                             },

                             {

                                           "Name": "Wrist",

                                           "Value": 0.185585

                             },

                             {

                                           "Name": "HPStoFloor",

                                           "Value": 1.508328

                             },

                             {

                                           "Name": "NapeToFloor",

                                           "Value": 1.487458

                             },

                             {

                                           "Name": "AcrossBack",

                                           "Value": 0.413836

                             },

                             {

                                           "Name": "AcrossBust",

                                           "Value": 0.454007

                             },

                             {

                                           "Name": "ArmLength",

                                           "Value": 0.569534

                             },

                             {

                                           "Name": "ShoulderSpan",

                                           "Value": 0.421429

                             },

                             {

                                           "Name": "ChestMin",

                                           "Value": 1.030079

                             },

                             {

                                           "Name": "ShoulderDropAngleL",

                                           "Value": 18.486631

                             },

                             {

                                           "Name": "ShoulderDropAngleR",

                                           "Value": 18.79276

                             }

                            ],

              "BodyId": 120820
                        

}';

//$data = json_decode($customerData, true);
//$data= json_encode($data);

print_r($customerData);

$ch = curl_init("http://agri.epayerz.local/rest/V1/nettelo");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $customerData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "ntws-secret: test","Authorization:Bearer", "Accept: application/json"));

$result = curl_exec($ch);
echo '<pre>';print_r($result);
curl_close($ch);
