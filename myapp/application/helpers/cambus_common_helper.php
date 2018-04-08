<?php
/**
 * 리다이렉트 함수
 * 
 * @param string 출력 메시지
 * @param string 이동할 URL
 */
function redirect_go($msg = '', $url) 
{
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
	$msg_str = "<script type='text/javascript'>";
	
	if ($msg != '')
	{
		$msg_str .= "alert('{$msg}');";
	}
	$msg_str .= "location.replace('{$url}');</script>";
	
	echo $msg_str;
}

/**
 * history back 함수
 * 
 * @param string 출력 메시지
 */
function redirect_back($msg)
{
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
	echo "<script type='text/javascript'>";
    if($msg !== '')
    {
        echo "alert('{$msg}');";
    }
    echo "history.go(-1);</script>";
}

/**
 * window.close 함수
 * 
 * @param string 출력 메시지
 */
function redirect_popup($msg)
{
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
	echo "<script type='text/javascript'>alert('{$msg}');window.close();</script>";
}

function get_code_name($code_kind, $code)
{
    $ret_str = '';
    
    if ($code_kind == 'delivery_state')
    {
        switch ($code)
        {
            case 0 :
                $ret_str = '입금전';
                break;
            case 1 :
                $ret_str = '상품준비중';
                break;
            case 2 :
                $ret_str = '상품포장중';
                break;
            case 3 :
                $ret_str = '배송중';
                break;
            case 4 :
                $ret_str = '부분배송중';
                break;
            case 10 :
                $ret_str = '배송 완료';
                break;
            case 99 :
                $ret_str = '미배송상품';
                break;
            default :
                $ret_str = '입금전';
        }
    }
    elseif ($code_kind == 'pay_state')
    {
        switch ($code)
        {
            case 'N' :
                $ret_str = '입금전';
                break;
            case 'Y' :
                $ret_str = '입금(결제)완료';
                break;
            case 'F' :
                $ret_str = '결제실패';
                break;
            default :
                $ret_str = '미확인';
        }
    }
    elseif ($code_kind == 'pay_type')
    {
        switch ($code)
        {
            case 'CARD' :
                $ret_str = '신용카드';
                break;
            case 'ABANK' :
                $ret_str = '계좌이체';
                break;
            case 'VBANK' :
                $ret_str = '가상계좌';
                break;
            case 'HP' :
                $ret_str = '휴대폰';
                break;
            case 'DEPO' :
                $ret_str = '무통장';
                break;
        }
    }
    elseif ($code_kind == 'payment_method_allat')
    {
        switch ($code)
        {
            case 1 :
                $ret_str = 'VBANK';
                break;
            case 2 :
                $ret_str = 'CARD';
                break;
            case 3 :
                $ret_str = 'HP';
                break;
            case 4 :
                $ret_str = 'ABANK';
                break;
        }
    }
    elseif ($code_kind == 'job')
    {
        switch ($code)
        {
            case 1 :
                $ret_str = '학생';
                break;
            case 2 :
                $ret_str = '회사원';
                break;
            case 3 :
                $ret_str = '가정주부';
                break;
            case 4 :
                $ret_str = '기타';
                break;
        }
    }
    elseif ($code_kind == 'pay_device')
    {
        switch ($code)
        {
            case 'PC' :
                $ret_str = 'PC';
                break;
            case 'MW' :
                $ret_str = 'Mobile Web';
                break;
            case 'MA' :
                $ret_str = 'Mobile App';
                break;
        }
    }

     return $ret_str;

    return $ret_str;
}

/**
 * 파일  업로드 함수
 * 
 * @param string input file 필드명
 * @param string 업로드 파일 확장자
 * @param number max 사이즈(kbyte)
 * @param number 가로 사이즈
 * @return array 에러 메시지 or 업로드 파일 정보
 */
function upload($field = 'userfile', $config)
{
	$upload_dir = $config['upload_path'];

	if ( ! is_dir($upload_dir))
	{
		mkdir($upload_dir);
	}
	
	$CI =& get_instance();
	
	$CI->load->library('upload', $config);
	if ( ! $CI->upload->do_upload($field))
	{
		$error = array(
				'error' => $CI->upload->display_errors('','')
		);
			
		return $error;
	}
	else
	{
		$data = $CI->upload->data();
		return $data;
	}
}

/**
 * 이미지 썸네일 생성, 3가지 사이즈의 썸네일 한꺼번에 생성
 * 
 * @param string 원본 이미지 경로
 */
function make_thumbnails($source, $type = 'Y')
{
	$result = 'SUCCESS';
	$arr_source = explode('/', $source);
	$cnt = count($arr_source) - 1;
	
	$src_img = $arr_source[$cnt];
	$src_path = str_replace($src_img, '', $source);
	
	$CI =& get_instance();
	$CI->load->library('image_lib');
	
	if ($type = 'Y')
	{
    	if ( ! make_thumbnail($CI, $src_path, $src_img, str_replace('origin', 'thumb148', $src_path), 148, 218))
    	{
    		$result = 'ERROR';
    	}
    	
    	if ( ! make_thumbnail($CI, $src_path, $src_img, str_replace('origin', 'thumb126', $src_path), 126, 180))
    	{
    		$result = 'ERROR';
    	}
    	
    	if ( ! make_thumbnail($CI, $src_path, $src_img, str_replace('origin', 'thumb198', $src_path), 198, 277))
    	{
    		$result = 'ERROR';
    	}
    	
    	if ( ! make_thumbnail($CI, $src_path, $src_img, str_replace('origin', 'thumb40', $src_path), 40, 52))
    	{
    		$result = 'ERROR';
    	}
    	
    	if ( ! make_thumbnail($CI, $src_path, $src_img, str_replace('origin', 'thumb130', $src_path), 130, 177))
    	{
    		$result = 'ERROR';
    	}
    	
    	if ( ! make_thumbnail($CI, $src_path, $src_img, str_replace('origin', 'thumb55', $src_path), 55, 77))
    	{
    		$result = 'ERROR';
    	}
    	
    	if ( ! make_thumbnail($CI, $src_path, $src_img, str_replace('origin', 'thumb444', $src_path), 444, 655))
    	{
    		$result = 'ERROR';
    	}
    	
    	if ( ! make_thumbnail($CI, $src_path, $src_img, str_replace('origin', 'thumb240', $src_path), 240, 390))
    	{
    		$result = 'ERROR';
    	}
    	
    	if ( ! make_thumbnail($CI, $src_path, $src_img, str_replace('origin', 'thumb96', $src_path), 96, 140))
    	{
    		$result = 'ERROR';
    	}
	}
	else 
	{
	    if ( ! make_thumbnail($CI, $src_path, $src_img, str_replace('origin', 'thumb40', $src_path), 40, 52))
	    {
	        $result = 'ERROR';
	    }
	}
	
	return $result;
}

/**
 * 이미지 썸네일 생성 함수
 * 
 * @param string 원본 이미지 경로
 * @param string 원본 이미지 명
 * @param string 썸네일 저장 경로
 * @param int 이미지 가로 크기
 * @param int 이미지 세로 크기
 */
function make_thumbnail($obj = NULL, $src_path, $src_img, $thumb_path, $width, $height)
{
	$config['image_library'] = 'gd2';
	$config['source_image'] = $src_path.$src_img;
	$config['thumb_marker'] = '';
	$config['new_image'] = $thumb_path.$src_img;
	$config['width'] = $width;
	$config['height'] = $height;
	
	if ( ! is_dir($thumb_path))
	{
		mkdir($thumb_path);
	}
	
	if ( ! $obj)
	{
		$obj =& get_instance();
		$obj->load->library('image_lib');
	}
	
	$obj->image_lib->clear();
	$obj->image_lib->initialize($config);
	
	$result = $obj->image_lib->resize();
	
	return $result;
}

/**
 * 페이징 UI 설정
 * @return array
 */
function get_paging_config()
{
    $config['display_always'] = TRUE;
    $config['use_page_numbers'] = TRUE;
    $config['use_fixed_page'] = TRUE;
    $config['fixed_page_num'] = 10;
    $config['page_query_string'] = TRUE;

    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = '처음';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = '마지막';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = '다음';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = "이전";
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li><a class="cb-button cb-blue"><b>';
    $config['cur_tag_close'] = '</b></a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    return $config;
}

/**
 * 배열을 string으로 변환
 * @param $param_array 변환할 배열
 * @param string $delimiter 요소간을 연결시켜줄 구분자
 * @return string
 */
function stringfy_array($param_array, $delimiter = '')
{
    $ret_str = '';
    $i = 0;

    foreach ($param_array as $key => $value)
    {
        if ($i === 0)
        {
            $ret_str .= "{$key}={$value}";
        }
        else
        {
            $ret_str .= "{$delimiter}{$key}={$value}";
        }
        $i++;
    }

    return $ret_str;
}

/**
 * 메일 발송 함수
 *
 * @param $mail       메일 정보 설정
 * @return bool       메일 발송 성공 여부
 */
function send_mail_api($mail)
{
    $CI =& get_instance();
    $CI->load->library('email');

    $CI->email->from($mail['from'], $mail['name']);
    $CI->email->to($mail['to']);

    if (isset($mail['cc']))
    {
        $CI->email->cc($mail['cc']);
    }

    if (isset($mail['bcc']))
    {
        $CI->email->bcc($mail['bcc']);
    }

    $CI->email->subject($mail['subject']);
    $CI->email->message($mail['message']);

    return $CI->email->send();
}

/**
 * @brief 클라이언트 아이피 리턴
 * @return string
 */
function get_client_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }

    return '0.0.0.0';
}

/**
 * 현재시간과 입력시간과의 시간차 계산
 * @param $compare_date
 * @return int
 */
function datetime_diff($compare_date)
{
    $now_datetime = strtotime("now"); //현재시간
    $compare_datetime = strtotime($compare_date); //넘어오는 시간

    $diff_time = intval(($now_datetime - $compare_datetime) / 3600); //계산

    return $diff_time;
}

/**
 * @param $in_array
 * @param $column_name
 * @param $pieces
 * @return string
 */
function object_array_to_string($in_array, $column_name, $pieces)
{
    $column_list = Array();
    foreach ($in_array as $li)
    {
        array_push($column_list, $li->$column_name);
    }

    return implode($column_list, $pieces);
}