<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\EmailConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Mailgun\Mailgun;

class VerificationController extends Controller
{
    /**
     * Ship the given order.
     *
     * @param  Request  $request
     * @param  int  $orderId
     * @return Response
     */
    public function verify(Request $request)
    {
        $id = $request->get('id');
        $url = $url = 'http://localhost:4200/email-confirmation?id=' . $id;

        Mail::to('leandrobiciato58@gmail.com')->send(new EmailConfirmation($url));
    }

    public function confirm($id, Request $request)
    {
        $user = User::find($id)->update(['email_verified_at' => $request->get('date')]);

        return response()->json($user, 201);
    }

    public function emailValidation(Request $request)
    {
        # Instantiate the client.
        $mgClient = new Mailgun('pubkey-34423f14fc159d2e4352dc1ad1365289');
        $validateAddress = $request->get('email');

        # Issue the call to the client.
        $result = $mgClient->get("address/validate", array('address' => $validateAddress));
        # is_valid is 0 or 1
        $isValid = $result->http_response_body->is_valid;

        return response()->json($isValid, 201);
    }
}
