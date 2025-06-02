<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingConfig;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    // site_name
    // commission_fee   % hoa hồng trên mỗi đơn hàng CTV bán được
    // site_logo
    // site_favicon

    public function index()
    {
        $data = SettingConfig::all()->keyBy('key');
        return view('admin.settings.index', compact('data'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_name' => 'required',
            'commission_fee' => 'required|numeric',
        ], [
            'site_name.required' => 'Vui lòng nhập tên website.',
            'commission_fee.required' => 'Vui lòng nhập tỷ lệ hoa hồng.',
            'commission_fee.numeric' => 'Tỷ lệ hoa hồng phải là số.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            if ($request->site_name) {
                SettingConfig::where('key','site_name')->update(['value'=>$request->site_name]);
            }
            if ($request->commission_fee) {
                SettingConfig::where('key','commission_fee')->update(['value'=>$request->commission_fee]);
            }
            if ($request->site_logo) {
                $imagePath = $this->saveImageFromRequest(
                    $request,
                    'site_logo',
                    $this->noTrailingSlash('image/avatar'),
                    'logo.png'
                );
                SettingConfig::where('key','site_logo')->update(['value'=>$imagePath]);
            }
            if ($request->site_favicon) {
                $imagePath = $this->saveImageFromRequest(
                    $request,
                    'site_favicon',
                    $this->noTrailingSlash('image/avatar'),
                    'favicon.png'
                );
                SettingConfig::where('key','site_favicon')->update(['value'=>$imagePath]);
            }
            DB::commit();
            // dd('done',$request);
            return redirect()->route('admin.settings.index')->with('success', 'Cập nhật thành công');
        }catch(Exception $ex) {
            DB::rollback();
            dd($ex, $request);
            return back()->withInput();
        }
    }

    private function saveImageFromRequest(Request $request, $parameterName, string $savePath, string $fileName)
    {
        if ($request->hasFile($parameterName)) {
            if (file_exists(public_path($savePath . '/' . $fileName))) {
                unlink(public_path($savePath . '/' . $fileName));
            }
            $image = $request->file($parameterName);
            $image->move(public_path($savePath), $fileName);
            $imagePath = $savePath . '/' . $fileName;
            return $imagePath;
        }
    }

    // please don't add '/' at the end of the path
    private function noTrailingSlash($input) {
        if (!is_string($input) || $input === '') {
            return $input;
        }

        if (substr($input, -1) === '/' || substr($input, -1) === '\\') {
            return substr($input, 0, -1);
        }
        return $input;
    }
}
