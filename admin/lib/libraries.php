<?php
function upload_file($path, $file, $type = null, $name = null, $size = null, $w = null, $h = null) {
        $config = array();
        
        if ($type == '*') {
            $type = '*';
        }if ($type == 'image') {
            $type = 'gif|png|jpg|jpeg';
        }
        ini_set('memory_limit', '128M');
        ini_set('upload_max_filesize', '20M');
        ini_set("post_max_size", '20M');
        $config['upload_path'] = $path;
        $config['allowed_types'] = ($type) ? $type : '*' ;
        $config['max_size'] = ($size == null) ? $this->config->item("max_size") : $size;
        $config['max_width'] = ($w == null) ? $this->config->item("max_width") : $w;
        $config['max_height'] = ($h == null) ? $this->config->item("max_height") : $h;
        if ($config['max_size'] == '') {
            $config['max_size'] = 3000;
        }
        if ($config['max_width'] == '') {
            $config['max_width'] = 3000;
        }
        if ($config['max_height'] == '') {
            $config['max_height'] = 3000;
        }        
        $config['file_name'] = ($name == null) ? $_FILES[$file]['name'] : $name;
        //$config['file_name'] = vn_filter($config['file_name']);
		require_once 'ci/lib/image_lib.php';
		$image_lib = new CI_Image_lib();
        $image_lib->initialize($config); 
        if ($this->upload->do_upload($file)) {
            return $this->upload->data();
        } else {
            return $this->upload->display_errors();
        }
    }

    function createThumbs($source, $thumbpath, $w = null, $h = null) {
        ini_set("memory_limit", "32M");
        ini_set("post_max_size", "3M");
        if ($thumbpath != null) {
            $thumbpath = $thumbpath . '/';
        }
        if (is_file($source)) {
            $info = @getimagesize($source);
            $c_w = $info[0];
            $c_h = $info[1];
            if ($w != null & $h == null) {
                if ($c_w > $w) {
                    $tl = $c_h / $c_w;
                    $w = $w;
                    $h = $w * $tl;
                } else {
                    $tl = $c_h / $c_w;
                    $w = $c_w;
                    $h = $w * $tl;
                }
            } else {
                if ($w == null & $h != null) {
                    if ($c_h > $h) {
                        $tl = $c_w / $c_h;
                        $h = $h;
                        $w = $h * $tl;
                    } else {
                        $tl = $c_w / $c_h;
                        $h = $c_h;
                        $w = $w * $tl;
                    }
                }
            }
            $ar = explode("/", $source);
            $path = substr($source, 0, strlen($source) - strlen($ar[count($ar) - 1]));
            $config['image_library'] = 'gd2';
            $config['source_image'] = $source;
            $config['thumb_maker'] = '';
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = $w;
            $config['height'] = $h;
            $config['new_image'] = $path . $thumbpath . $ar[count($ar) - 1];
			require_once 'ci/lib/image_lib.php';
			$image_lib = new CI_Image_lib();
            $image_lib->initialize($config);
            $image_lib->resize();
            $image_lib->clear();
        }
    }