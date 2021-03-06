<?php

namespace App;

use Dnetix\Redirection\PlacetoPay as PlacetoPay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Session;

class Payment extends Model
{
    /**
     * Create payment request for placetopay gateway.
     *
     * @param Order $order
     * @param Placetopay $placetopay
     */
    public static function pay(Order $order, Placetopay $placetopay): JsonResponse
    {
        $request = [
            'locale' => 'es_CO',
            'buyer' => [
                'name' => $order->user->name,
                'email' => $order->user->email,
                'document_type' => $order->user->document_type,
                'document' => $order->user->document,
                'phone' => $order->user->phone,
                'address' => $order->user->address,
            ],
            'payment' => [
                'reference' => $order->id,
                'description' => 'Iusto sit et voluptatem.',
                'amount' => [
                    'currency' => 'COP',
                    'total' => $order->total,
                ],
            ],
            'expiration' => date('c', strtotime('+1 hour')),
            'ipAddress' => request()->ip(),
            'userAgent' => request()->header('user-agent'),
            'returnUrl' => route('user.payment', [$order->id]),
            'cancelUrl' => route('user.payment', [$order->id]),
            'skipResult' => false,
            'noBuyerFill' => false,
            'captureAddress' => false,
            'paymentMethod' => null,
        ];

        $response = $placetopay->request($request);

        if ($response->isSuccessful()) {
            Session::forget('cart');
            $order->update([
                'requestId' => $response->requestId(),
                'processUrl' => $response->processUrl(),
            ]);
            return response()->json(['La petición se ha procesado correctamente']);
        } else {
            $response->status()->message();
        }
    }
}
