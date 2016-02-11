<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tieba extends CI_Controller {
	
	var $header = array( "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:40.0) Gecko/20100101 Firefox/40.0" 
			
			);
	public function index()
	{
		echo 'Welcome';
		$url = 'http;???/http://tieba.baidu.com/p/3576871667';
		$this->temp_tieba($url);

		
	}

	public function listrun (){

		require_once ( APPPATH.'libraries/simple_html_dom.class.php' );
		$url     = "http://tieba.baidu.com/f?kw=kindle&ie=utf-8";
		$arr_url = parse_url( $url );
		//var_dump( $arr_url );
		$host     = $arr_url['scheme'].'://'.$arr_url['host'];
		$html = url2html( $url , $this->header );
		foreach ($html->find('a') as $element) {
			$des_url = $element->href.'<br>';
			if( preg_match('(/p/\d*)' , $des_url) ){
				$bool_contain = strpos( $des_url , 'http' )  ;
				var_dump( $bool_contain );
				if( $bool_contain === false ){
					$des_url = $host.$des_url;
				}
				echo $des_url;
			}

		}


	}

	public function run(){


         $query_urls = $this->db->query( "select url from urls where site_name = 'tieba' and status = 0 limit 1000" );
         $res_urls   = $query_urls->result_array();
       
         foreach ($res_urls as $res_url ) {

	           $url =  $res_url['url'];
	           echo $url."\n";
		       $query   = $this->db->query(  "select id from docs where  md5_url = '". md5($url)."'" );
		       $res_num = $query->num_rows() ;
		       if( $res_num > 0 ){

					echo "已有 \n";    

		       }else {

					$data = $this->temp_tieba( $url );
					if( $data ){
						$res  = $this->db->insert( 'docs' , $data );
						if( $res ){
							echo '插入成功 \n';
							$this->db->query( "update urls set status = 1 where url = '".$url."'" );
						}						
					} else {
						echo '链接有问题\n';
						$this->db->query( "update urls set status = -1 where url = '".$url."'" );
					}

		       }

         }


	}


	public function temp_tieba( $url ){

		require_once ( APPPATH.'libraries/simple_html_dom.class.php' );
		
        $html = url2html( $url , $this->header ); 
        if( $html ){
	        //内容
	        $des  				=  $html->find( 'div[class=d_post_content j_d_post_content  clearfix]',0)->plaintext ;
	        $des 				=  trim( $des ); 
	        $data['des']        =  trim( msubstr( $des , 0 , 150 ) ) ;

	        //标题
	        $title     			=  $html->find('div[class=core_title core_title_theme_bright] h1' , 0 )->plaintext ;
	        
	        $data['title'] 		=  trim( $title );
	        //url
	        $data['url'] 		= trim($url); 

	        $data['time']       = time();
	        $data['md5_url']    = md5($url);
	        $data['type']		= 9;
	        $html->clear();
	        var_dump( $data );
	        return $data;

        } else {
        	return 0;
        }

	}
}
