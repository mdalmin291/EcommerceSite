<?php

namespace App\Http\Controllers;

    use App\SmsLog;
    use App\Models\Setting\SmsSetting;

    class SendSmsController extends Controller
    {
        private $test;

        private $numbers;

        private $message;

        private $actionFrom;

        public function __construct(array $numbers, $message, $actionFrom = null, $test = false, $auto = true)
        {
            $this->test = $test;
            $this->numbers = $numbers;
            $this->message = $message;
            $this->actionFrom = $actionFrom;
            if ($auto) {
                $this->sendSms();
            }
        }

        public function sendSms()
        {
            $SMSSEtting = SmsSetting::first();
            $data = [
            'username' => $SMSSEtting->username,
            'password' => $SMSSEtting->password,
            'sender' => $SMSSEtting->sender_id,
            'text' => $this->message,
            'to' => implode(',', $this->numbers),
            // 'type' => config('sms.type'),
            // 'api_key' => config('sms.api_key'),
            // "username"=>"YOUR_USERNAME","password"=>"YOUR_PASSWORD","sender"=>"YOUR_SENDER","message"=>"A text message sent using Messaging Service","to"=>"88017XXXXXXXX,88018XXXXXXXX"
            ];

            // http://63.142.254.221/api/v1/campaigns/sendsms/plain?username=nazmul2858&password=Nazmul@2021&sender=8809612441345&text=hello&to=8801776912858
            // http://63.142.254.221/balance?username=nazmul2858&password=Nazmul@2021
            if (!$this->test) {
                return $this->send($data);
            } else {
                return [
                'code' => 200,
                'status' => 'success',
                'count' => 1,
                ];
            }
        }

        public function send($data)
        {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'http://63.142.254.221/api/v2/sendsms/plaintext',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'], ]);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo 'cURL Error #:'.$err;
            } else {
                // $curls = curl_init();
                // curl_setopt_array($curls, [
                //     CURLOPT_URL => 'http://63.142.254.221/balance?username=nazmul2858&password=Nazmul@2021',
                //     CURLOPT_RETURNTRANSFER => true,
                //     ]);
                // $responses = curl_exec($curls);
                // $SmsBalance = response()->json($response);
                // $arr = json_decode($responses, true);
                // $SmsBalance= $arr["credit"];
                // curl_close($curls);
                // dd( $SmsBalance);

                // $query = new SmsLog();
                // $query->mobile = implode(',', $this->numbers);
                // $query->body = $this->message;
                // $query->current_balance = 0.80;
                // $query->save();

                return response()->json($response);
            }

            return response()->json($response);
        }
    }
