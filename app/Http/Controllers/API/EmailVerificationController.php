<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


class EmailVerificationController extends Controller
{
    public function verifyOld(
        // EmailVerificationRequest $request
        Request $request,
        $id,
        $hash
    ) {
        $user = User::findOrFail($id);

        if (! hash_equals(
            sha1($user->getEmailForVerification()),
            $hash
        )) {
            abort(403, 'Invalid verification hash.');
        }

        if (! $request->hasValidSignature()) {
            abort(403, 'Invalid or expired verification link.');
        }

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        // $request->fulfill();

        return response()->json([
            'message' => 'Email verified successfully'
        ]);
    }

    public function verifyoo(EmailVerificationRequest $request)
    {
        dd([
            'full_url' => $request->fullUrl(),
            'has_valid_signature' => $request->hasValidSignature(),
            'route' => $request->route()->uri(),
            'host' => $request->getHost(),
            'scheme' => $request->getScheme(),
        ]);
        $request->fulfill();

        return response()->json([
            'message' => 'Email verified successfully',
        ]);
    }

    public function verify(Request $request, $id, $hash): JsonResponse
    {
        $user = User::findOrFail($id);

        if (! $request->hasValidSignature()) {
            return response()->json(['message' => 'Invalid or expired verification link.'], 403);
        }

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['message' => 'Invalid verification hash.'], 403);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email is already verified.']);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json(['message' => 'Email verified successfully!']);
    }
}
