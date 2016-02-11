<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chaoxing extends CI_Controller {
	
	var $header = array( "User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:40.0) Gecko/20100101 Firefox/40.0" 
			
			);
	public function index()
	{
		$headers = getallheaders();
		foreach ($headers as $key => $value) {
			echo "$key ----- $value <br>";
		}


		die();
		echo 'Welcome';
		$url = 'http://book.chaoxing.com/ebook/detail_81266724717c30ad06e7605b965d164cce6a60b75.html';
		$this->temp_chaoxing($url);

		
	}


	public function run(){


         $query_urls = $this->db->query( "select url from urls where site_name = 'chaoxing' and status = 0 limit 1000 " );
         $res_urls   = $query_urls->result_array();
       
         foreach ($res_urls as $res_url ) {

	           $url =  $res_url['url'];
	           echo $url."\n";
		       $query   = $this->db->query(  "select id from docs where  md5_url = '". md5($url)."'" );
		       $res_num = $query->num_rows() ;
		       if( $res_num > 0 ){

					echo "已有 \n";    

		       }else {

					$data = $this->temp_chaoxing( $url );
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


	public function temp_chaoxing( $url ){

		require_once ( APPPATH.'libraries/simple_html_dom.class.php' );
		
        $html = url2html( $url , $this->header ); 
        if( $html ){

	        //内容
	        $des  				=  $html->find( 'div[class=boxLeft]',0)->plaintext ;
	        $des 				=  trim( $des ); 
	        $data['des']        =  trim( msubstr( $des , 0 , 150 ) ) ;

	        //标题
	        $title     			=  $html->find('div[class=box_title] h1' , 0 )->plaintext ;
	        
	        $data['title'] 		=  trim( $title );
	        //url
	        $data['url'] 		= trim($url); 

	        $data['time']       = time();
	        $data['md5_url']    = md5($url);
	        $data['type']		= 9;
	        $html->clear();
	        var_dump( $data );
	        return $data;
        }else {
        	return 0;
        }
	}
}
