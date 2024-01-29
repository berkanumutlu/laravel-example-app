<?php
if (!function_exists('image_exists')) {
    function image_exists(string|null $image, string|null $default): string
    {
        if (is_null($image) || !file_exists(public_path($image))) {
            if (!empty($default)) {
                $image = $default;
            } elseif (!empty($settings) && !empty($settings->image_default_article)) {
                $image = $settings->image_default_article;
            }
        }
        return $image;
    }
}
