<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zhaopin58 extends CI_Controller {
	
	var $header = array( "User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:40.0) Gecko/20100101 Firefox/40.0" 
			
			);
	public function index()
	{
		echo 'Welcome';
		$url = 'http://wh.58.com/jinrongtouzi/23126749225505x.shtml?psid=159333324188863188974832539&entinfo=23126749225505_0&role=3&PGTID=159333324188863188974832539&ClickID=1&iuType=j_1';
		$this->temp_zhaopin58($url);

		
	}


	public function run(){


         $query_urls = $this->db->query( "select url from urls where site_name = '58' and status = 0 limit 1000" );
         $res_urls   = $query_urls->result_array();
       
         foreach ($res_urls as $res_url ) {

	           $url =  $res_url['url'];
	           echo $url."\n";
		       $query   = $this->db->query(  "select id from docs where  md5_url = '". md5($url)."'" );
		       $res_num = $query->num_rows() ;
		       if( $res_num > 0 ){

					echo "已有 \n";    

		       }else {

					$data = $this->temp_zhaopin58( $url );
					$res  = $this->db->insert( 'docs' , $data );
					if( $res ){
						echo '插入成功 \n';
						$this->db->query( "update urls set status = 1 where url = '".$url."'" );
					}
		       }

         }


	}


	public function temp_zhaopin58( $url ){

		require_once ( APPPATH.'libraries/simple_html_dom.class.php' );
		
        $html = url2html( $url , $this->header ); 
 

        //内容
        $des  				=  $html->find( 'div[class=posMsg borb]',0)->plaintext ;
        $data['des']        =  trim($des) ;
        $content            =  $html->find( 'div[class=posMsg borb]',0)->innertext ;
        $data['content']    =  trim($content) ;
        //标题
        $title     			=  $html->find( 'div[class=headConLeft] h1' , 0 )->plaintext ;
        
        $data['title'] 		=  trim( $title );

        //薪资
        $salary         	=  $html->find( 'div[class=xq] ul li div span strong' , 0 )->plaintext;
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
        $corp_name 			=  $html->find( 'div[class=company] a ' , 0 )->plaintext;
        $data['corp_name']  =  $corp_name;

        //福利
        $welfare            =  $html->find( 'div[id=infoview] ul' , 0 )->plaintext;           
        $data['welfare']    =  $welfare;

        $trade              =  $html->find('div[class=compMsg clearfix] ul li a' , 0)->plaintext;
        $data['trade']      =  $trade;


        //发布时间
        $pdate 	  			=  $html->find( 'ul[class=headTag] li span strong', 0 )->plaintext;
        preg_match( '/\d/' , $pdate , $m );
        print_r ($m) ;
        $ptime              =  strtotime("-$m[0] day");        
        $pdate              =  date( 'Y年m月d号' , $ptime );
        $data['pdate']		=  $pdate;
        $data['ptime']      =  $ptime;
        $data['time']       =  $ptime;

        $data['site_name']	=  'zhaopin58';
        //url
        $data['url'] 		=  trim($url); 

       
        $data['md5_url']    =  md5($url);
        $data['type']		=  7;

        $html->clear();
        var_dump( $data );
        return $data;
	}
}
