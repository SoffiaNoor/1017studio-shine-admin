<?php

namespace App\Http\Controllers;

use App\Models\EnquireReservation;
use Illuminate\Http\Request;
use App\Models\WhyChooseUs;

class HomeSettingController extends Controller
{
    public function index()
    {
        $whyChooseUs = WhyChooseUs::first();
        $reservation = EnquireReservation::first();

        return view('main.home.index', compact('whyChooseUs', 'reservation'));
    }

    public function storeWhyChooseUs(Request $request, WhyChooseUs $whyChooseUs)
    {
        try {
            $rules = [
                'title' => 'required',
                'description' => 'required',
            ];

            $whyChooseUs = WhyChooseUs::find($request['id']);

            if (!$whyChooseUs) {
                return redirect()->back()->with('error', 'Record not found.');
            }

            $request->validate($rules);
            $input = $request->except(['_token', '_method']);
            $whyChooseUs->update($input);

            return redirect()->route('home_settings.index')
                ->with('success', $whyChooseUs->title . ' Updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update information. Please try again.');
        }
    }

    public function storeEnquire(Request $request, EnquireReservation $enquire)
    {
        try {
            $rules = [
                'title' => 'required',
                'description_reservation' => 'required',
            ];

            $enquire = EnquireReservation::find($request['id']);
            if (!$enquire) {
                return redirect()->back()->with('error', 'Record not found.');
            }

            $request->validate($rules);

            $input = $request->except(['_token', '_method']);
            $enquire['description'] = $request['description_reservation'];
            $enquire->update($input);

            return redirect()->route('home_settings.index')
                ->with('success', $enquire->title . ' Updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update information. Please try again.');
        }
    }
}
