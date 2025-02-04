<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class InformationController extends Controller
{
    public function index()
    {
        $information = Information::first();
        return view('main.information.index', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
        try {
            $rules = [
                'name' => 'required',
                'description' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'google_map' => 'required',
                'order_wa' => 'required',
            ];

            $request->validate($rules);

            $input = $request->except(['_token', '_method']);

            if (!$request->hasFile('logo_header') && !$information->logo_header) {
                $rules['logo_header'] = 'required|image|mimes:jpeg,jpg,png|max:2048';
            } elseif ($request->hasFile('logo_header')) {
                $rules['logo_header'] = 'image|mimes:jpeg,jpg,png|max:2048';
            }

            if (!$request->hasFile('logo_favicon') && !$information->logo_favicon) {
                $rules['logo_favicon'] = 'required|image|mimes:jpeg,jpg,png|max:2048';
            } elseif ($request->hasFile('logo_favicon')) {
                $rules['logo_favicon'] = 'image|mimes:jpeg,jpg,png|max:2048';
            }

            if (!$request->hasFile('logo_company') && !$information->logo_company) {
                $rules['logo_company'] = 'required|image|mimes:jpeg,jpg,png|max:2048';
            } elseif ($request->hasFile('logo_company')) {
                $rules['logo_company'] = 'image|mimes:jpeg,jpg,png|max:2048';
            }

            if (!$request->hasFile('image') && !$information->image) {
                $rules['image'] = 'required|image|mimes:jpeg,jpg,png|max:2048';
            } elseif ($request->hasFile('image')) {
                $rules['image'] = 'image|mimes:jpeg,jpg,png|max:2048';
            }


            if (!empty($information->logo_header) && $request->hasFile('logo_header')) {
                $imagePath = $information->logo_header;

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            if (!empty($information->logo_favicon) && $request->hasFile('logo_favicon')) {
                $imagePath = $information->logo_favicon;

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            if (!empty($information->logo_company) && $request->hasFile('logo_company')) {
                $imagePath = $information->logo_company;

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            if (!empty($information->image) && $request->hasFile('image')) {
                $imagePath = $information->image;

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            if ($logo_header = $request->file('logo_header')) {
                $destinationPath = 'images/information/logo_header/';
                $profileImage = "information" . "-" . "logo_header-" . date('YmdHis') . "." . $logo_header->getClientOriginalExtension();
                $logo_header->move($destinationPath, $profileImage);
                $input['logo_header'] = $destinationPath . $profileImage;
            } elseif (!$request->hasFile('logo_header') && !$information->logo_header) {
                unset($input['logo_header']);
            }

            if ($logo_favicon = $request->file('logo_favicon')) {
                $destinationPath = 'images/information/logo_favicon/';
                $profileImage = "information" . "-" . "logo_favicon-" . date('YmdHis') . "." . $logo_favicon->getClientOriginalExtension();
                $logo_favicon->move($destinationPath, $profileImage);
                $input['logo_favicon'] = $destinationPath . $profileImage;
            } elseif (!$request->hasFile('logo_favicon') && !$information->logo_favicon) {
                unset($input['logo_favicon']);
            }

            if ($logo_company = $request->file('logo_company')) {
                $destinationPath = 'images/information/logo_company/';
                $profileImage = "information" . "-" . "logo_company-" . date('YmdHis') . "." . $logo_company->getClientOriginalExtension();
                $logo_company->move($destinationPath, $profileImage);
                $input['logo_company'] = $destinationPath . $profileImage;
            } elseif (!$request->hasFile('logo_company') && !$information->logo_company) {
                unset($input['logo_company']);
            }

            if ($image = $request->file('image')) {
                $destinationPath = 'images/information/image/';
                $profileImage = "information" . "-" . "image-" . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['image'] = $destinationPath . $profileImage;
            } elseif (!$request->hasFile('image') && !$information->image) {
                unset($input['image']);
            }

            $input['phone'] = (strpos($request->phone, '0') === 0) ? '62' . substr($request->phone, 1) : $request->phone;

            $input['order_wa'] = (strpos($request->order_wa, '0') === 0) ? '62' . substr($request->order_wa, 1) : $request->order_wa;

            if ($input['phone'] !== $information->phone || $input['order_wa'] !== $information->order_wa) {
                $whatsappLink = 'https://wa.me/' . urlencode($input['phone']) . '?text=' . urlencode($input['order_wa']);
                $input['link_wa'] = $whatsappLink;
            }

            $information->update($input);

            return redirect()->route('information.index')
                ->with('success', 'Information updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update information. Please try again.');
        }
    }
}
