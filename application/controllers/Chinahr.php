<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chinahr extends CI_Controller {
	
	var $header = array( "User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:40.0) Gecko/20100101 Firefox/40.0" 
			
			);
	public function index()
	{
		echo 'Welcome';
		$url = 'http://www.chinahr.com/job/fa96ae84bdbb13551e6b25a8j.html';
		$this->temp_chinahr($url);

		
	}


	public function run(){


         $query_urls = $this->db->query( "select url from urls where site_name = 'chinahr' and status = 0 limit 1000" );
         $res_urls   = $query_urls->result_array();
       
         foreach ($res_urls as $res_url ) {

	           $url =  $res_url['url'];
	           echo $url."\n";
		       $query   = $this->db->query(  "select id from docs where  md5_url = '". md5($url)."'" );
		       $res_num = $query->num_rows() ;
		       if( $res_num > 0 ){

					echo "已有 \n";    

		       }else {

					$data = $this->temp_chinahr( $url );
					$res  = $this->db->insert( 'docs' , $data );
					if( $res ){
						echo '插入成功 \n';
						$this->db->query( "update urls set status = 1 where url = '".$url."'" );
					}
		       }

         }


	}


	public function temp_chinahr( $url ){

		require_once ( APPPATH.'libraries/simple_html_dom.class.php' );
		
        $html = url2html( $url , $this->header ); 
 

        //内容
        $des  				=  $html->find( 'div[class=job_desc]',0)->plaintext ;
        $data['des']        =  trim($des) ;
        $content                =  $html->find( 'div[class=job_desc]',0)->innertext ;
        $data['content']        =  trim($content) ;
        //标题
        $title     			=  $html->find( 'div[class=fl job_infoLeft] h1' , 0 )->plaintext ;
        
        $data['title'] 		=  trim( $title );

        //薪资
        $salary         	=  $html->find( 'div[class=detail_C_info] span' , 0 )->plaintext;
        $salary             =  trim( $salary );
        $arra_salaray       =  explode( '-', $salary);
        print_r( $arra_salaray );
        preg_match('/\d/' , $arra_salaray[0] , $min_salary );
        preg_match('/\d/' , $arra_salaray[1] , $max_salary);        
        $data['min_salary'] =  $min_salary[0]*1000;
        $data['max_salary'] =  $max_salary[0]*1000;
        $data['salary']     =  trim( $salary );

        //城市
        $city				=  $html->find( 'div[class=job_desc] p' , 0 )->plaintext;
        $data['city']		=  trim( $city) ;

        //公司
        $corp_name 			=  $html->find( 'span[class=subC_name] a' , 0 )->plaintext;
        $data['corp_name']  =  $corp_name;

        //福利
        $welfare            =  $html->find( 'ul[class=welf_list clear toggleWelfL]' , 0 )->plaintext;           
        $data['welfare']    =  $welfare;


        //发布时间
        $pdate 	  			=  $html->find( 'span[class=detail_C_Date fl]', 0 )->plaintext;
        preg_match( '/\d*-\d*-\d*/' , $pdate , $pdate_reg );
        $ptime              =  strtotime( trim($pdate_reg[0]) );
        $data['ptime']      =  $ptime;
        $pdate              =  date( 'Y年m月d号' , $ptime );

        $data['pdate']      =  $pdate;

        $data['site_name']	=  'chinahr';
        //url
        $data['url'] 		=  trim($url); 

       
        $data['md5_url']    =  md5($url);
        $data['type']		=  2;

        $html->clear();
        var_dump( $data );
        return $data;
	}
}
