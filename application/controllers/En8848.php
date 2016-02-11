<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class En8848 extends CI_Controller {
	
	var $header = array( "User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:40.0) Gecko/20100101 Firefox/40.0" 
			
			);
	public function index()
	{
		echo 'Welcome';
		$url = 'http://www.en8848.com.cn/soft/fiction/children/4894.html';
		$this->temp_en8848($url);

		
	}


	public function run(){


         $query_urls = $this->db->query( "select url from urls where site_name = 'en8848' and status = 0 limit 1000 " );
         $res_urls   = $query_urls->result_array();
       
         foreach ($res_urls as $res_url ) {

	           $url =  $res_url['url'];
	           echo $url."\n";
		       $query   = $this->db->query(  "select id from docs where  md5_url = '". md5($url)."'" );
		       $res_num = $query->num_rows() ;
		       if( $res_num > 0 ){

					echo "已有 \n";    

		       }else {

					$data = $this->temp_en8848( $url );
					$res  = $this->db->insert( 'docs' , $data );
					if( $res ){
						echo '插入成功 \n';
						$this->db->query( "update urls set status = 1 where url = '".$url."'" );
					}
		       }

         }


	}


	public function temp_en8848( $url ){

		require_once ( APPPATH.'libraries/simple_html_dom.class.php' );
		
        $html = url2html( $url , $this->header ); 
 

        //内容
        $des  				=  $html->find( 'div[class=txt]',0)->plaintext ;
        $data['des']        =  trim( msubstr( $des , 0 , 150 ) ) ;

        //标题
        $title     			=  $html->find( 'div[class=m-bookinfo] h2' , 0 )->plaintext ;
        
        $data['title'] 		=  trim( $title );
        //url
        $data['url'] 		= trim($url); 

        $data['time']       = time();
        $data['md5_url']    = md5($url);
        $data['type']		= 7;
        $html->clear();
        var_dump( $data );
        return $data;
	}
}
