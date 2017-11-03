<?php
/**
 * Created by PhpStorm.
 * User: teenq
 * Date: 13/03/2017
 * Time: 3:25 CH
 */
if(!function_exists('create_breadcrumb')){
    function create_breadcrumb($tdk = array()){
        if(count($tdk) > 0){
            return '<li><i> / </i>'.$tdk['title'].'</li> ';
        }
        $ci = &get_instance();
        $i=1;
        $uri = $ci->uri->segment($i);
        $link = '';

        while($uri != ''){
            $prep_link = '';
            for($j=1; $j<=$i;$j++){
                $prep_link .= $ci->uri->segment($j).'/';
            }

            if($ci->uri->segment($i+1) == ''){
                $link.='<li><i> / </i><a href="'.site_url($prep_link).'"><b>';
                $link.=$ci->uri->segment($i).'</b></a></li> ';
            }else{
                $link.='<li><i> / </i><a href="'.site_url($prep_link).'">';
                $link.=$ci->uri->segment($i).'</a></li> ';
            }

            $i++;
            $uri = $ci->uri->segment($i);
        }
        $link .= '';
        return $link;
    }
}