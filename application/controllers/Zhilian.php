<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zhilian extends CI_Controller {
	
	var $header = array( "User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:40.0) Gecko/20100101 Firefox/40.0" 
			
			);

	public function index()
	{
		echo 'Welcome';
		$url = 'http://jobs.zhaopin.com/652674729250173.htm?utm_source=other&utm_medium=cnt&utm_term=&utm_campaign=121114863&utm_provider=zp&sid=121114863&site=sj006';
		$this->temp_zhilian($url);

		
	}


	public function run(){


         $query_urls = $this->db->query( "select url from urls where site_name = 'zhilian' and status = 0 limit 1000" );
         $res_urls   = $query_urls->result_array();
       
         foreach ($res_urls as $res_url ) {

	           $url =  $res_url['url'];
	           echo $url."\n";
		       $query   = $this->db->query(  "select id from docs where  md5_url = '". md5($url)."'" );
		       $res_num = $query->num_rows() ;
		       if( $res_num > 0 ){

					echo "已有 \n";    

		       }else {

					$data = $this->temp_zhilian( $url );
					$res  = $this->db->insert( 'docs' , $data );
					if( $res ){
						echo '插入成功 \n';
						$this->db->query( "update urls set status = 1 where url = '".$url."'" );
					}
		       }

         }


	}


	public function temp_zhilian( $url ){

		require_once ( APPPATH.'libraries/simple_html_dom.class.php' );
		
        $html = url2html( $url , $this->header ); 
 

        //内容
        $des  				=  $html->find( 'div[class=tab-inner-cont]',0)->plaintext ;
        $data['des']        =  trim( $des );

        $content            =  $html->find( 'div[class=tab-inner-cont]', 0 )->innertext ;
        $data['content']    =  trim( $content) ;

        //标题
        $title     			=  $html->find( 'div[class=inner-left fl] h1' , 0 )->plaintext ;
        $title              =  trim( $title );
        $data['title'] 		=   $title ;

        //薪资
        $salary         	=  $html->find( 'ul[class=terminal-ul clearfix] li strong' , 0 )->plaintext;
        $salary             =  trim( $salary );
        $arra_salaray       =  explode( '-', $salary);
        print_r( $arra_salaray );
        preg_match('/\d/' , $arra_salaray[0] , $min_salary );
        preg_match('/\d/' , $arra_salaray[1] , $max_salary);        
        $data['min_salary'] =  $min_salary[0]*1000;
        $data['max_salary'] =  $max_salary[0]*1000;
        $data['salary']     =  trim( $salary );

        //城市
        $city				=  $html->find( 'ul[class=terminal-ul clearfix] li strong a' , 0 )->plaintext;
        $data['city']		=  trim( $city) ;

        //公司
        $corp_name 			=  $html->find( 'p[class=company-name-t]' , 0 )->plaintext;
        $data['corp_name']  =  $corp_name;

        //福利
        $welfare            =  $html->find( 'div[class=welfare-tab-box]' , 0 )->plaintext;           
        $data['welfare']    =  $welfare;

        //发布时间
        $pdate 	  			=  $html->find( 'ul[class=terminal-ul clearfix] li strong', 2 )->plaintext;
        $ptime              =  strtotime( trim($pdate) );
        $data['ptime']      =  $ptime;
        $pdate				=  date( 'Y年m月d号' , $ptime );

        $data['pdate']		=  $pdate;

        $data['site_name']	=  'zhilian';
        //url
        $data['url'] 		=  trim($url); 

       
        $data['md5_url']    =  md5($url);
        $data['type']		=  7;
        $html->clear();
        var_dump( $data );
        return $data;
	}
}
