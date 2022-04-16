<?php


namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Image;

class ImageService
{
    public function handleUploadedImage(Request $request): ?string
    {
        if ($this->canHandleImage()) {
            $imageName = time()."_".Auth::id().'.'.$request->server_banner->extension();

            $request->server_banner->move(public_path('img/banners'), $imageName);
        }
        else{
            return null;
        }

        return $imageName;
    }

    protected function canHandleImage(): bool
    {
        return request()->hasFile('server_banner');
    }
}
