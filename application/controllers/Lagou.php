<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lagou extends CI_Controller {
	
	var $header = array( "User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:40.0) Gecko/20100101 Firefox/40.0" 
			
			);
	public function index()
	{
		echo 'Welcome';
		$url = 'http://www.lagou.com/jobs/1031905.html';
		$this->temp_lagou($url);

		
	}


	public function run(){


         $query_urls = $this->db->query( "select url from urls where site_name = 'lagou' and status = 0 limit 1000" );
         $res_urls   = $query_urls->result_array();
       
         foreach ($res_urls as $res_url ) {

	           $url =  $res_url['url'];
	           echo $url."\n";
		       $query   = $this->db->query(  "select id from docs where  md5_url = '". md5($url)."'" );
		       $res_num = $query->num_rows() ;
		       if( $res_num > 0 ){

					echo "已有 \n";    

		       }else {

					$data = $this->temp_lagou( $url );
					$res  = $this->db->insert( 'docs' , $data );
					if( $res ){
						echo '插入成功 \n';
						$this->db->query( "update urls set status = 1 where url = '".$url."'" );
					}
		       }

         }


	}


	public function temp_lagou( $url ){

		require_once ( APPPATH.'libraries/simple_html_dom.class.php' );
		
        $html = url2html( $url , $this->header ); 
 

        //内容
        $des  				=  $html->find( 'dd[class=job_bt]',0)->plaintext ;
        $data['des']        =  trim($des) ;
        $content                =  $html->find( 'dd[class=job_bt]',0)->innertext ;
        $data['content']        =  trim($content) ;
        //标题
        $title     			=  $html->find( 'div[class=content_l content_l_jobdetail] dl dt h1' , 0 )->plaintext ;
        
        $data['title'] 		=  trim( $title );

        //薪资
        $salary         	=  $html->find( 'dd[class=job_request] span' , 0 )->plaintext;
        $salary             =  trim( $salary );
        $arra_salaray       =  explode( '-', $salary);
        print_r( $arra_salaray );
        preg_match('/\d/' , $arra_salaray[0] , $min_salary );
        preg_match('/\d/' , $arra_salaray[1] , $max_salary);        
        $data['min_salary'] =  $min_salary[0]*1000;
        $data['max_salary'] =  $max_salary[0]*1000;
        $data['salary']     =  trim( $salary );

        //城市
        $city				=  $html->find( 'dd[class=job_request] span' , 1 )->plaintext;
        $data['city']		=  trim( $city) ;

        //公司
        $corp_name 			=  $html->find( 'dl[class=job_company] dt div h2' , 0 )->plaintext;
        $data['corp_name']  =  $corp_name;

        //福利
        $welfare            =  $html->find( 'dd[class=job_request] span' , 4 )->plaintext;           
        $data['welfare']    =  $welfare;


        //发布时间
        $pdate 	  			=  $html->find( 'dd[class=job_request] div', 0 )->plaintext;
        preg_match( '/\d/' , $pdate , $m );
        print_r ($m) ;
        $ptime              =  strtotime("-$m[0] day");        
        $pdate              =  date( 'Y年m月d号' , $ptime );
        $data['pdate']		=  $pdate;
        $data['ptime']      =  $ptime;
        $data['time']       =  $ptime;

        $data['site_name']	=  'lagou';
        //url
        $data['url'] 		=  trim($url); 

       
        $data['md5_url']    =  md5($url);
        $data['type']		=  7;

        $html->clear();
        var_dump( $data );
        return $data;
	}
}
