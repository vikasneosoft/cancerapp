<?php

use Mail;
use Config;
use Auth;
use PDF;

/**
 * send email of plan to patient
 *
 *@param array
 */
function sendPlanToPatient($email, $name, $content)
{
    $data["doctorname"] = Auth::guard('doctor')->user()->name;
    $data["doctoremail"] = Auth::guard('doctor')->user()->email;
    $data["body"] = $content;
    $pdf = PDF::loadView('doctor.pdfs.sendPlan', $data);
    $emailData = array(
        'name' => $name,
    );
    $emailFrom =  Config::get('constants.EMAIL_FROM');
    Mail::send('emailTemplates.registerVendor', $confirmed = array('user_info' => $emailData), function ($message) use ($email, $emailFrom, $pdf) {
        $message->to($email)->from($emailFrom, 'CancerAPP')
            ->subject('CancerAPP – Your requested plan.')
            ->attachData($pdf->output(), "plan.pdf");;
    });
    return;
}

/**
 * send email and pssword to doctor
 *
 *@param array
 */
function sendCredentialsToDocor($email, $name, $password)
{
    $emailData = array(
        'name' => $name,
        'email' => $email,
        'password' => $password,
    );
    $emailFrom =  Config::get('constants.EMAIL_FROM');
    Mail::send('emailTemplates.registerDoctor', $confirmed = array('user_info' => $emailData), function ($message) use ($email, $emailFrom) {
        $message->to($email)->from($emailFrom, 'CancerAPP')
            ->subject('CancerAPP – Your login details.');
    });
    return;
}
