<?php

namespace App\Lib;

use App\Exceptions\QoreIdError;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class QuoreId
{


    public function getAccessToken(): string
    {
        $cacheKey = 'accessToken';
        if ($token = Cache::get($cacheKey)) {
            return $token;
        }

        $response = Http::withHeaders([
            'accept' => 'text/plain',
            'content-type' => 'application/json',
        ])
            ->post('https://api.qoreid.com/token', [
                'clientId' => config('services.qoreid.clientid'),
                'secret' => config('services.qoreid.secret')
            ]);

        if (!$response->successful()) {
            logger()->error("QoreId Failed to retrieve access token", $response->json());
            throw new QoreIdError('Something went wrong. Kindly try again later.');
        }

        $data = $response->json();

        Cache::put($cacheKey, $data['accessToken'], $data['expiresIn']);


        return $data['accessToken'];
    }


    public function validateNin(?array $data = null, string $token)
    {
        $nin = $data['nin'];
        unset($data['nin']);
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'authorization' => "Bearer {$token}"
        ])->post('https://api.qoreid.com/v1/ng/identities/nin/' . $nin, $data);

        if (!$response->successful()) {
            throw new QoreIdError($response->json('message'));
        }

        return $response->json();
    }

    public function verifyId($data)
    {
        $token = $this->getAccessToken();

        $data = $this->validateNin($data, $token);

        if ($data['status']['state'] === 'complete' && $data['status']['status'] === 'verified') {
            return $data;
        }

        throw new QoreIdError('NIN is incomplete or not verified');
    }
}
