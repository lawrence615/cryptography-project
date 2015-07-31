<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SmsLogs;
use Illuminate\Http\Request;

use \AfricasTalkingGateway;

class SmsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }


    public function sendSms($recipients, $message, $user_id)
    {



        $username = "lawrence615";
        $apikey = "7b6d751a45a78908a32d7744008c334ba9e9e7b7a975bf16586f09fecf3239fd";


        // Create a new instance of our awesome gateway class
        $gateway = new AfricasTalkingGateway($username, $apikey);


        try {
            // Thats it, hit send and we'll take care of the rest.
            $results = $gateway->sendMessage($recipients, $message);

            foreach ($results as $result) {
                // status is either "Success" or "error message"
//                echo " Number: " . $result->number;
//                echo " Status: " . $result->status;
//                echo " MessageId: " . $result->messageId;
//                echo " Cost: " . $result->cost . "\n";

                SmsLogs::create(
                    [
                        'status' => ($result->status == 'Success') ? 1 : 0,
                        'user_id' => $user_id
                    ]
                );
            }
        } catch (AfricasTalkingGatewayException $e) {
            echo "Encountered an error while sending: " . $e->getMessage();
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
