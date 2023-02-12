<?php


namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

final class ImageService
{
    public static function handleUploadedImage(Request $request): ?string
    {
        if (self::canHandleImage()) {
            $imageName = time()."_".Auth::id().'.'.$request->server_banner->extension();

            $request->server_banner->move(public_path('img/banners'), $imageName);
        }
        else{
            return null;
        }

        return $imageName;
    }

    public static function handleProfileUploadedImage(Request $request): ?string
    {
        if (self::canHandleProfileImage()) {
            $imageName = time()."_".Auth::id().'_profile.'.$request->profile_image->extension();

            $request->profile_image->move(public_path('img/profiles'), $imageName);
        }
        else{
            return null;
        }

        return $imageName;
    }

    protected static function canHandleImage(): bool
    {
        return request()->hasFile('server_banner');
    }

    protected static function canHandleProfileImage(): bool
    {
        return request()->hasFile('profile_image');
    }
}
