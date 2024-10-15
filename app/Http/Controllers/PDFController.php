<?php

namespace App\Http\Controllers;
use phpseclib3\Crypt\RSA;
use App\Models\User;



class PDFController extends Controller
{
    public function generateKey($userId)
    {
        $private = RSA::createKey();
        $public = $private->getPublicKey();

        $user = User::findorfail($userId);

        $user->update([
            'private_key' => $private,
            'public_key' => $public
        ]);
    }
    public function AESencrypt($data, $key, $iv, $is_file)
    {

        $key = base64_decode($key);
        $iv = base64_decode($iv);
        $plaintext = file_get_contents($data);

        $ciphertext = openssl_encrypt($plaintext, 'AES-256-CBC', $key, 0, $iv); // AES-256 CBC

        if ($is_file == 1)
            file_put_contents($data, $ciphertext);
        else
            return $ciphertext;
    }
    public function AESdecrypt($data, $key, $iv, $is_file)
    {

        $key = base64_decode($key);
        $iv = base64_decode($iv);
        $ciphertext = file_get_contents($data);

        // Start calculating usage statistics
        $start_usage = getrusage();

        $plaintext = openssl_decrypt($ciphertext, 'AES-256-CBC', $key, 0, $iv);

        // Stop calculating usage statistics
        $end_usage = getrusage();

        // Output user run time and system run time from usage statistics
        $user_time = $end_usage["ru_utime.tv_sec"] - $start_usage["ru_utime.tv_sec"];
        $user_time += ($end_usage["ru_utime.tv_usec"] - $start_usage["ru_utime.tv_usec"]) / 1000000;

        $system_time = $end_usage["ru_stime.tv_sec"] - $start_usage["ru_stime.tv_sec"];
        $system_time += ($end_usage["ru_stime.tv_usec"] - $start_usage["ru_stime.tv_usec"]) / 1000000;

        error_log("AES Decryption user run time : " . $user_time . " second");
        error_log("AES Decryption system run time : " . $system_time . " second");

        $total_time = $user_time + $system_time;
        error_log("AES Decryption total time : " . $total_time . " second");


        if ($is_file == 1)
            file_put_contents($data, $plaintext);
        else
            return $plaintext;
    }


}