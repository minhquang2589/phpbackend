<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subemail' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all(),
            ]);
        }
        $existingSubscriber = Subscriber::where('subemail', $request->subemail)->first();
        if ($existingSubscriber) {
            return response()->json([
                'success' => false,
                'errors' => ['You have already subscribed.'],
            ]);
        }
        try {
            DB::beginTransaction();
            $subscriber = new Subscriber();
            $subscriber->subemail = $request->subemail;
            $subscriber->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'subscribe' => 'subscribe successfully!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'errors' => [$e->getMessage()],
            ]);
        }
    }
}
