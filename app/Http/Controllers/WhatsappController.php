<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

class WhatsappController extends Controller
{    
    /**
     * listenToReplies
     *
     * @param  mixed $request
     * @return void
     */
    public function listenToReplies(Request $request)
    {
        $from = $request->input('From');
        $body = $request->input('Body');

        try {

            if(Str::contains($body, 'harga')) {
                $message = "Harga kentang goreng:\n";
                $message .= "1pcs : Rp.15.000,-\n";
                $message .= "10pcs : Rp.100.000,-\n";
                $message .= "15pcs : Rp.130.000,-\n";
                $message .= "25pcs : Rp.150.000,-\n";
                $message .= "50pcs : Rp.350.000,-\n";
                $message .= "Jika ada pertanyaan silahkan tanyakan kembali kak. :)\n";
            } else if(Str::contains($body, 'stok') ) {
                $message = "Stok barang banyak ya kak bisa langsung order\n";
            } else if(Str::contains($body, 'buka') || Str::contains($body, 'tutup') ) {
                $message = "Kita buka dari Jam 07:00 sampai Jam 20:00 ya kak :) \n";
            } else {
                $message = "Terima Kasih telah menghubungi kami\n";
                $message .= "Kamu bisa tanyakan hal berikut ke aku ya kak:\n";
                $message .= "1. Tanya *harga*\n";
                $message .= "2. Tanya *stok* ketersediaan\n";
                $message .= "3. Tanya jam *buka* dan *tutup* ketersediaan\n";
            }

            $this->sendWhatsAppMessage($message, $from);
        } catch (RequestException $th) {
            $response = json_decode($th->getResponse()->getBody());
            $this->sendWhatsAppMessage($response->message, $from);
        }
        return;

    }

    public function sendBroadcast(Request $request)
    {
        $from = $request->input('From');
        $body = $request->input('Body');

        try {
            //code...
            $this->sendWhatsAppMessage($body, $from);

        } catch (RequestException $th) {
            $response = json_decode($th->getResponse()->getBody());
            $this->sendWhatsAppMessage($response->message, $from);
        }
    }

    /**
     * Sends a WhatsApp message  to user using
     * @param string $message Body of sms
     * @param string $recipient Number of recipient
     */
    public function sendWhatsAppMessage(string $message, string $recipient)
    {
        $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
        $account_sid = getenv("TWILIO_ACCOUNT_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $client = new Client($account_sid, $auth_token);
        return $client->messages->create($recipient, array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));
    }

    //
}
