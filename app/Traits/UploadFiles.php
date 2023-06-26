<?php

namespace App\Traits;

trait UploadFiles
{

    public function uploadImage($file, $path, $resized = false, $resize_image_x = 200, $resize_image_y = true)
    {
        $filename = md5(rand() . date('YMDhms'));
        $handle = new \Verot\Upload\Upload($file);

        // $image_convert = 'png';
        $image_convert = '';

        if ($handle->uploaded) {

            //$handle->image_max_width = 200;
            // $handle->image_max_height = 100;
            if ($resized) {

                $handle->file_new_name_body = $filename;
                $handle->file_overwrite = false;
                $handle->file_max_size = getConstant('options.image_max_size'); // 1KB
                $handle->allowed = array('image/*');
                $handle->image_convert = $image_convert;

                $handle->image_resize = $resized;
                $handle->image_x = $resize_image_x;
                $handle->image_ratio_y = $resize_image_y;

                $handle->process($path . '/thumbnail/');
                if (!$handle->processed) {
                    return ['action' => false, 'filename' => $handle->file_dst_name, 'message' => $handle->error];
                }
            }

            $handle->file_new_name_body = $filename;
            $handle->file_overwrite = false;
            $handle->file_max_size = getConstant('options.image_max_size'); // 1KB
            $handle->allowed = array('image/*');
            $handle->image_convert = $image_convert;

            $handle->process($path);
            if ($handle->processed) {
               // $handle->clean();
                return ['action' => true, 'filename' => $handle->file_dst_name];

            } else {
                return ['action' => false, 'filename' => $handle->file_dst_name, 'message' => $handle->error];
            }
        }
    }


    public function uploadThumbnailImage($file, $path,$folder_name, $resize_image_x = 200, $resize_image_y = 200, $image_ratio_y = false)
    {
        $filename = md5(rand() . date('YMDhms'));
        $handle = new \Verot\Upload\Upload($file);

        // $image_convert = 'png';
        $image_convert = '';

        if ($handle->uploaded) {

            //$handle->image_max_width = 200;
            // $handle->image_max_height = 100;

            $handle->file_new_name_body = $filename;
            $handle->file_overwrite = false;
            $handle->file_max_size = getConstant('options.image_max_size'); // 1KB
            $handle->allowed = array('image/*');
            $handle->image_convert = $image_convert;

            $handle->image_resize = true;
            $handle->image_x = $resize_image_x;

            if ($resize_image_y)
                $handle->image_ratio_y = $resize_image_y; else  $handle->image_y = $resize_image_y;

            $handle->process($path . '/'.$folder_name.'/');
            if ($handle->processed) {
                //$handle->clean();
                return ['action' => true, 'filename' => $handle->file_dst_name];
            } else {
                return ['action' => false, 'filename' => $handle->file_dst_name, 'message' => $handle->error];
            }

        }
    }

}
