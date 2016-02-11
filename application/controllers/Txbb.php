<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Txbb extends CI_Controller {
	
	var $header = array( "User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:40.0) Gecko/20100101 Firefox/40.0" 
			
			);
	public function index(){
		echo 'Welcome';
		$url = 'http://www.txbb.com/w/parttime/304226620992946176';
		$this->temp_txbb($url);
	}

	public function temp_txbb($url){

		require_once ( APPPATH.'libraries/simple_html_dom.class.php' );
		
        $html = url2html( $url , $this->header ); 
 
        //标题
        $title     			  =  $html->find( 'div[class=ptd-title]' , 0 )->plaintext ;
        $data['title'] 		  =  trim( $title );

        //招聘人数
        $zp_num 			  = $html->find('table[class=ptd-item] tbody tr td',1)->plaintext;
        $data['zp_num']       = trim($zp_num);
        
        $work_dom 			  =  $html->find('table[class=ptd-item]',1);
        // 工作日期
        $work_day			  =  $work_dom->find('tbody tr td',1)->plaintext;
        $data['work_day']     =  trim($work_day);
        //工作地点
        $work_place 	      =  $work_dom->find('tbody tr',2)->find('td',1)->plaintext;
        $data['work_place']   =  trim($work_place);
        //工作要求
        $work_content 	      =  $work_dom->find('tbody tr',3)->find('td',1)->plaintext;
        $data['work_content'] =  trim($work_content);
        //联系电话
        $tel   	      		  =  $work_dom->find('tbody tr',4)->find('td',1)->plaintext;
        $data['tel']		  =  trim($tel);
        //报名截止时间
        $end_time   	      =  $work_dom->find('tbody tr',5)->find('td',1)->plaintext;
        $data['end_time'] = trim($end_time);
        var_dump($data);

	}
}