<?php

class pluginFolderSize extends Plugin {

	public function form()
	{
		global $L;

		function folderSize($dir) {

		$count_size = 0;
		$count = 0;
		$dir_array = scandir($dir);

  		foreach($dir_array as $key=>$filename){
    		if($filename!=".." && $filename!="."){
       		if(is_dir($dir."/".$filename)){
          	$new_foldersize = foldersize($dir."/".$filename);
          	$count_size = $count_size+ $new_foldersize;
        	}else if(is_file($dir."/".$filename)){
          	$count_size = $count_size + filesize($dir."/".$filename);
          	$count++;
        	}
   		  }
 			}

		  return $count_size;
	  
    }

		function sizeFormat($bytes){
		$kb = 1024;
		$mb = $kb * 1024;
		$gb = $mb * 1024;
		$tb = $gb * 1024;

		  if (($bytes >= 0) && ($bytes < $kb)) {
				return $bytes . ' B';

			} elseif (($bytes >= $kb) && ($bytes < $mb)) {
				return round($bytes / $kb , 2) . ' KB';

			} elseif (($bytes >= $mb) && ($bytes < $gb)) {
				return round($bytes / $mb , 2) . ' MB';

			} elseif (($bytes >= $gb) && ($bytes < $tb)) {
				return round($bytes / $gb , 2) . ' GB';

			} elseif ($bytes >= $tb) {
				return round($bytes / $tb , 2) . ' TB';
			} else {
				return $bytes . ' B';
			}

		}

    $html = '<style>.mt-1 {display: none;}</style>';
	  $html .= '<div style="margin:60px 0 20px">'.$L->get('size-of-the-folders-of-the-installation').'</div>';
	  $html .= '<table>';
	  $html .= '<tr><td style="padding-right:20px">'.$L->get('total').'</td><td style="text-align: right">'. sizeFormat(folderSize('.')) .'</td></tr>';
	  $html .= '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
	  $html .= '<tr><td style="padding-right:20px">'.$L->get('databases').'</td><td style="text-align: right">'. sizeFormat(folderSize('bl-content/databases')) .'</td></tr>';
	  $html .= '<tr><td style="padding-right:20px">'.$L->get('pages').'</td><td style="text-align: right">'. sizeFormat(folderSize('bl-content/pages')) .'</td></tr>';
	  $html .= '<tr><td style="padding-right:20px">'.$L->get('uploads').'</td><td style="text-align: right">'. sizeFormat(folderSize('bl-content/uploads')) .'</td></tr>';

	  $html .= '</table>';

  	return $html;

    }

}
